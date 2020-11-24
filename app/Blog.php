<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'text',
        'writer',
        'img',
        'release',
     ];

     protected $dates =[
        'created_at',
    ];

    public function user(){
        return $this->belongsTo('App\User','writer','id');
    }

    protected $table = 'blog';
}
