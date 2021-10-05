<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pitchresult extends Model
{
    protected $fillable = [
        'user_id',
        'game_id',
        'y',
        'm',
        'd',
        'pitch_order',
        'pitch_games',
        'wins',
        'inning',
        'inningathird',
        'earned_run',
        'runs_allowed',
        'k',
        'give_four_dead_balls',
    ];

    public function user(){
        return $this->belongsTo('App\User','user_id','number');
    }

    public function result(){
        return $this->belongsTo('App\Result','game_id','id');
    }
    
    protected $table = 'pitchresults';
}
