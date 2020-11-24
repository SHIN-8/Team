<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'name',
        'comment',
        'place',
        'manager',
        'manager_name',
        'manager_comment',
        'Recruitment',
    ];

    public function user(){
        return $this->belongsTo('App\User','manager_name','Name');
    }
}
