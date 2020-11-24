<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedules extends Model
{
    protected $fillable = [
       'game',
       'date',
       'opponent',
       's_t',
       'f_t',
       'place',
    ];

    protected $dates =[
        'date',
        's_t',
        'f_t',
    ];

    public function Userschedule(){
        return $this->belongsTo('App\Userchedule','id','schedule_id');
    }
    public function place(){
        return $this->belongsToMany('App\Place','name','place');
    }
}
