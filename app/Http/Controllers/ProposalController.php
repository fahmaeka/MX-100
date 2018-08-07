<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\JobsList;
use App\Proposal;
use App\RegistrasiUsersRank;
use Exception;

class ProposalController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['only' => ['store']]);
    }
    
    public function index(Request $request)
    {
        $params = $request->all();
        $jobs_list = empty($params) ? 
        JobsList::get() : JobsList::where($params)->with('partisipan')->first();

        if(is_null($jobs_list)):
            return response()->json([
                'message' => 'Record not found',
            ], 404);
        endif;

        return response($jobs_list);
    }

    public function store(Request $request)
    {
        $data = $this->checkParameters($request);

        if(!is_null(@$data['valid']) ):
        return response()->json([
            'message' => $data['valid'],
        ], 404);
        endif;

        DB::beginTransaction();
        try {
            $data_freelance = [
                    'id_jobs_list'    => @$data['jobs']->id,
                    'id_users'        => DB::raw($this->performCheckBalance(@$data['freelance_id']->id)),
                    'provide_budget'  => @$data['provide_budget'],
                    'completion_date_estimation' => date('Y-m-d', strtotime(@$data['completion_date_estimation'])),
            ];
            $post_data = Proposal::insert($data_freelance);
            
            $balance_freelance = RegistrasiUsersRank::whereIdUsers(@$data['freelance_id']->id);
            $before_balance = $balance_freelance->first();
            $new_balance = [ 'balance' => ($before_balance->balance - 2) ];
            $balance_point = $balance_freelance->update($new_balance);

            $data_proposal['success'] = true;
            $data_proposal['message'] = "success";

            DB::commit();
            return response()->json($data_proposal, 200);
        }catch( Exception $e){
            $log = ['Controler' => 'Proposal', 'function' => 'store'];
            DB::rollback();
            return response()->json([
                'message' => 'failed to insert data',
            ], 409);
        }
    }

    public function checkParameters($request)
    {
        $input          = $request->only(['jobs_code','provide_budget', 'completion_date_estimation']);
        $jobs_code      = is_null($input['jobs_code'])? null:$input['jobs_code'];
        $provide_budget = is_null( $input['provide_budget'])? null:$input['provide_budget'];
        $completion_date_estimation = is_null($input['completion_date_estimation'])? null:$input['completion_date_estimation'];
        
        $valid = null;
        if(is_null($provide_budget)):
            $valid['valid'] = "Parameters 'provide_budget' not found";
            return $valid;
        elseif(is_null($completion_date_estimation)):
            $valid['valid'] = "Parameters 'completion_date_estimation' not found";
            return $valid;
        elseif(is_null($jobs_code)):
            $valid['valid'] = "Parameters 'jobs_code' not found";
            return $valid;
        endif;
        
        $valid_integer = filter_var($provide_budget, FILTER_VALIDATE_INT) ? null:"Parameters 'provide_budget' must be integer";
        $valid_date = date('d-m-Y') <= date('d-m-Y', strtotime($completion_date_estimation)) ? null:"Parameters 'completion_date_estimation' must be date format";
        if( !is_null($valid_integer) ):
            $valid['valid'] = $valid_integer;
            return $valid;
        elseif(!is_null($valid_date)):
            $valid['valid'] = $valid_date;
            return $valid;
        endif;

        $jobs = JobsList::where('jobs_code', $jobs_code)->first();
        if(is_null($jobs)):
            $valid['valid'] = "Job code is not found";
            return $valid;
        endif;

        $token = $request->input('api_token');
        $freelance_id = $this->tokenDataUser($token);
        $first_applay = Proposal::whereIdUsers($freelance_id->id)->whereIdJobsList($jobs->id)->first();
        if(!is_null($first_applay)):
            $valid['valid'] = "Freelancer can only submit one proposal to any published job";
            return $valid;
        endif;

        $data = [
            'valid'                         => $valid,
            'provide_budget'                => $provide_budget,
            'completion_date_estimation'    => $completion_date_estimation,
            'freelance_id'                  => $freelance_id,
            'jobs'                          => $jobs,
        ];
        return $data;
    }

    public function tokenDataUser($data)
    {
        $check_token = User::where('api_token', $data)->first();
        return $check_token;
    }

    public function performCheckBalance($id)
    {
        /** lock table before insert when hit together */
        $balance_freelance = "
            (
                SELECT
                    CASE
                        WHEN balance >= 2 THEN $id
                        ELSE NULL
                    END
                FROM
                    registration_users_rank
                WHERE
                    id_users = $id
            )
            ";
        return $balance_freelance;
    }
}