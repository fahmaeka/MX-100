<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index(Request $request, $id)
    {
        $user = User::where('id', $id)->get();
        if ($user) {
              $res['success'] = true;
              $res['message'] = $user;
        
              return response($res);
        }else{
          $res['success'] = false;
          $res['message'] = 'Cannot find user!';
        
          return response($res);
        }
    }

    public function registerFreelancer(Request $request)
    {
        try {
            $res['success'] = false;
            $res['message'] = 'Failed to register!, Check yours params';
            $hasher   = app()->make('hash');
            $username = @$request->input('username');
            $email    = @$request->input('email');
            $password = $hasher->make(@$request->input('password'));
            
            if(!is_null($email) && !is_null($username) && !is_null($password)):
                 $register = User::create([
                    'username' => $username,
                    'email'    => $email,
                    'password' => $password,
                    'type'     => 'freelancer'
                ]);

                if ($register) {
                    $res['success'] = true;
                    $res['message'] = 'Success register!';
                    return response($res);
                }else{
                    $res['success'] = false;
                    $res['message'] = 'Failed to register!';
                    return response($res);
                }
            endif;
            return response($res);
        }catch(Exception $e){
            $log = ['Controller' => 'UserController', 'function' => 'register'];
            logError($e, $log );
            return false;
        }
    }

    public function registerCompany(Request $request)
    {
        try {
            $res['success'] = false;
            $res['message'] = 'Failed to register!, Check yours params';
            $hasher   = app()->make('hash');
            $username = @$request->input('company_name');
            $email    = @$request->input('email');
            $password = $hasher->make(@$request->input('password'));
            
            if(!is_null($email) && !is_null($username) && !is_null($password)):
                 $register = User::create([
                    'username' => $username,
                    'email'    => $email,
                    'password' => $password,
                    'type'     => 'company'
                ]);

                if ($register) {
                    $res['success'] = true;
                    $res['message'] = "Success register your's Company!";
                    return response($res);
                }else{
                    $res['success'] = false;
                    $res['message'] = 'Failed to register!';
                    return response($res);
                }
            endif;
            return response($res);
        }catch(Exception $e){
            $log = ['Controller' => 'UserController', 'function' => 'register'];
            logError($e, $log );
            return false;
        }
    }
    
}