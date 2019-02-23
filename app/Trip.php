<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class Trip extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;
     
     protected $table="create_trips";
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        //'source', 'destination','trip_id','trip_organiser','max_acc','cur_acc','status','rating'
         'trip_id', 'trip_org_email','trip_org_name', 'source', 'destination', 'max_accomodation' , 'current_accomodation', 'status', 'rating_of_trip'
        ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}