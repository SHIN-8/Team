<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{


    protected $fillable = [
        'y',
        'm',
        'd',
        'game',
        'S_name',
        'K_name',
        'place',
        'S1',
        'S2',
        'S3',
        'S4',
        'S5',
        'S6',
        'S7',
        'S8',
        'S9',
        'K1',
        'K2',
        'K3',
        'K4',
        'K5',
        'K6',
        'K7',
        'K8',
        'K9',
        'wl',
    ];

    public $sortable = ['id','companyname_kana','email','status'];

    public function userresult(){
        return $this->belongsTo('App\Userresult','id','game_id');
    }

    public function pitchresult(){
        return $this->belongsTo('App\Pitchresult','id','game_id');
    }

}
