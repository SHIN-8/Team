<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $fillable = [
        'name',
        'adress',
    ];

    public function schedule(){
        return $this->belongsTo('App\Schedule','place','name');
    }

    protected $table = 'place';
}
