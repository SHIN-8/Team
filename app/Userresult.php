<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Userresult extends Model
{
    protected $fillable = [
        'user_id',
        'game_id',
        'y',
        'm',
        'day',
        'game',
        'steal',
        'ord',
        'generation',
        'position',
        'ad',
        'a',
        'ar',
        'bd',
        'b',
        'br',
        'cd',
        'c',
        'cr',
        'dd',
        'd',
        'dr',
        'ed',
        'e',
        'er',
        'fd',
        'f',
        'fr',
        'gd',
        'g',
        'gr',
        'hd',
        'h',
        'hr',
        'i_d',
        'i',
        'ir',
    ];

    public function user(){
        return $this->belongsTo('App\User','user_id','number');
    }

    public function result(){
        return $this->belongsTo('App\Result','game_id','id');
    }
    
    protected $table = 'userresults';
}
