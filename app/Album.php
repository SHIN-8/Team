<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = [
        'img',
     ];
    
     
    protected $table = 'album';

}
