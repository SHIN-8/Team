<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pitchresult;
use App\Result;

class PitchresultsController extends Controller
{
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Pitchresult $pitchresult,Result $result)
    {
        $rules = [
            'pitch_order'=>['required','integer'],
            'pitch_games'=>['required'],
            'wins'=>['nullable'],
            'inning'=>['nullable','integer','between:0,9'],
            'inningathird'=>['nullable','numeric','between:0,2'],
            'earned_run'=>['nullable','integer','between:0,30'],
            'runs_allowed'=>['nullable','integer','between:0,30'],
            'k'=>['nullable','integer','between:0,30'],
            'give_four_dead_balls'=>['nullable','integer','between:0,30'],
        ];
        $this->validate($request,$rules);

        $pitchresult->updateOrCreate(['user_id' => $request->user_id,'game_id' => $request->game_id ],
        $request->all());
        $result = Result::findOrFail($request->game_id);
        
        return redirect()
        ->route('results.edit',compact('result'))
        ->with('status','登録しました。');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pitchresult $pitchresult)
    {
        $pitchresult->delete();

        return redirect()->back()
        ->with('status','削除しました。');

    }
}
