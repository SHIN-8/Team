<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Userresult;
use App\Result;

class UserresultsController extends Controller
{
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Userresult $userresult,Result $result)
    {
        $rules = [
            'user_id'=>['required'],
            'steal'=>['nullable','integer','between:0,10'],
            'ord'=>['required'],
            'generation'=>['required'],
            'position'=>['required'],
            'ad'=>['nullable'],
            'a'=>['nullable'],
            'ar'=>['nullable','integer','between:0,4'],
            'bd'=>['nullable'],
            'b'=>['nullable'],
            'br'=>['nullable','integer','between:0,4'],
            'cd'=>['nullable'],
            'c'=>['nullable'],
            'cr'=>['nullable','integer','between:0,4'],
            'dd'=>['nullable'],
            'd'=>['nullable'],
            'dr'=>['nullable','integer','between:0,4'],
            'ed'=>['nullable'],
            'e'=>['nullable'],
            'er'=>['nullable','integer','between:0,4'],
            'fd'=>['nullable'],
            'f'=>['nullable'],
            'fr'=>['nullable','integer','between:0,4'],
            'gd'=>['nullable'],
            'g'=>['nullable'],
            'gr'=>['nullable','integer','between:0,4'],
            'hd'=>['nullable'],
            'h'=>['nullable'],
            'hr'=>['nullable','integer','between:0,4'],
            'i_d'=>['nullable'],
            'i'=>['nullable'],
            'ir'=>['nullable','integer','between:0,4'],
    
        ];
        $this->validate($request,$rules);
        // 以下の結果を入力するときは打球方向(*d)は不要
        if($request->a == '三振' || $request->a == '四球' ||$request->a == '死球'||$request->a == '他')
        {$request->merge(['ad' => null]);};
        if($request->b == '三振' || $request->b == '四球' ||$request->b == '死球'||$request->b == '他')
        {$request->merge(['bd' => null]);};
        if($request->c == '三振' || $request->c == '四球' ||$request->c == '死球'||$request->c == '他')
        {$request->merge(['cd' => null]);};
        if($request->d == '三振' || $request->d == '四球' ||$request->d == '死球'||$request->d == '他')
        {$request->merge(['dd' => null]);};
        if($request->e == '三振' || $request->e == '四球' ||$request->e == '死球'||$request->e == '他')
        {$request->merge(['ed' => null]);};
        if($request->f == '三振' || $request->f == '四球' ||$request->f == '死球'||$request->f == '他')
        {$request->merge(['fd' => null]);};
        if($request->g == '三振' || $request->g == '四球' ||$request->g == '死球'||$request->g == '他')
        {$request->merge(['gd' => null]);};
        if($request->h == '三振' || $request->h == '四球' ||$request->h == '死球'||$request->h == '他')
        {$request->merge(['hd' => null]);};
        if($request->i == '三振' || $request->i == '四球' ||$request->i == '死球'||$request->i == '他')
        {$request->merge(['i_d' => null]);};

        $userresult->updateOrCreate(['user_id' => $request->user_id ,'game_id' => $request->game_id],
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
    public function destroy(Userresult $userresult)
    {
        $userresult->delete();

        return redirect()->back()
        ->with('status','削除しました。');

    }
}
