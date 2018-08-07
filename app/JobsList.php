<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class JobsList extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'jobs_list';

    protected $fillable = [
        'jobs_code',
        'id_users', 
        'name', 
        'job_description'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];
    
    public function partisipan(){
        return $this->hasMany('App\Proposal', 'id_jobs_list', 'id')
                    ->with('freelancer')
                    ->orderBy('provide_budget', 'DESC');
    }
}
