<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends \TCG\Voyager\Models\User
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number',
        'Name',
        'password',
        'FullName',
        'Birthday_y',
        'Birthday_m',
        'Birthday_d',
        'position',
        'dominant_hand',
        'height',
        'weight',
        'admin',
        'user_image',
        'user_img',
        'alma_mater'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userschedule(){
        return $this->belongsToMany('App\Userschedule','id','id');
    }

    public function userresult(){
        return $this->belongsToMany('App\Userresult','number','user_id');
    }

    public function pitchresult(){
        return $this->belongsToMany('App\Pitchresult','number','user_id');
    }

    public function blog(){
        return $this->belongsToMany('App\Blog','id','writer');
    }

    public function team(){
        return $this->belongsToMany('App\Team','Name','manager_name');
    }

}
