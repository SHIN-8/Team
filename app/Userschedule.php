<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Userschedule extends Model
{
    protected $fillable = [
       'user_schedule_id',
        'id',
        'schedule_id',
        'participation',
    ];

    public function user(){
        return $this->belongsTo('App\User','id','id');
    }
    
    public function schedule(){
        return $this->belongsToMany('App\Schedule','schedule_id','id');
    }

    protected $table = 'userschedules';
}
