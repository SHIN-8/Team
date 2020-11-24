<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schedules;
use App\User;
use App\Userschedule;

class UserschedulesController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request,Userschedule $userschedule,User $user,schedules $schedule){
        $userschedule = Userschedule::updateOrCreate(['id' => $request->id , 'schedule_id' => $request->schedule_id],
        ['id' => $request->id , 'schedule_id' => $request->schedule_id , 'participation' => $request->participation]);

        return redirect()
        ->route('schedules.index',compact('userschedule','schedule','user'))
        ->with('status','登録しました。');
    }

}