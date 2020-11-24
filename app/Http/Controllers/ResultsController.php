<?php

namespace App\Http\Controllers;

use App\Result;
use App\Place;
use App\Userresult;
use App\User;
use App\Pitchresult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ResultsController extends Controller
{
    public function index(Request $request){
        $y = date("Y");
        $year = $request->input('year',$y);
        $month = $request->input('month');
        $opponent = $request->input('opponent');
        $game = $request->input('game',4);
        $data['params'] = array(
            'year' => $year,
            'month' => $month,
            'opponent' => $opponent,
            'game' => $game,
        );
        
        return view('results.index',compact('y','year','game','month','opponent','data'));
    }
    
    public function show($id){
        $result = Result::findOrFail($id);
        $place = Place::where('id',$result->place)->first();
        $userresults = Userresult::where('game_id',$result->id)->orderBy('ord')->orderBy('generation')->get();
        $pitchresults = Pitchresult::where('game_id',$result->id)->orderBy('pitch_order')->get();


        return view('results.show',compact('result','userresults','pitchresults','place'));
    }
    

    public function create(Request $request){
        $y = date("Y");
        $year = $request->input('year',$y);
        $month = $request->input('month');
        $opponent = $request->input('opponent');
        $game = $request->input('game',4);
        $places = Place::get()->all();
        if(Auth::check()){
            if(Auth::user()->admin ==1){
                return view('results.create',compact('places'));
            }else{
                return view('results.index',compact('y','year','game','month','opponent'))->with('message','管理者としてログインして下さい');
            }
        }else{
            return redirect()->route('login')->withInput()->with('message','ログインして下さい');
        }
    }

    public function build($id){
        $result = Result::findOrFail($id);
        $userresults = Userresult::where('game_id',$result->id)->orderBy('ord')->orderBy('generation')->get();
        $pitchresults = Pitchresult::where('game_id',$result->id)->orderBy('pitch_order')->get();
        $places = Place::get()->all();
        $place = Place::get()->all();
        $users = User::get()->all();
        if(Auth::check()){
            if(Auth::user()->admin ==1){
                return view('results.build',compact('result','users'));
            }else{
                return view('results.show',compact('result','userresults','pitchresults','place'))->with('message','管理者としてログインして下さい');
            }
        }else{
            return redirect()->route('login')->withInput()->with('message','ログインして下さい');
        }
    }

    public function buildEdit($id){
        $userresult = Userresult::findOrFail($id);
        $result = Result::where('id',$userresult->game_id)->first();
        $users = User::get()->all();

        if(Auth::check()){
            if(Auth::user()->admin ==1){
                return view('results.buildEdit',compact('result','userresult','users'));
            }else{
                return redirect()->back()->with('message','管理者としてログインして下さい');
            }
        }else{
            return redirect()->route('login')->withInput()->with('message','ログインして下さい');
        }
    }

    public function pitchBuild($id){
        $result = Result::findOrFail($id);
        $userresults = Userresult::where('game_id',$result->id)->orderBy('ord')->orderBy('generation')->get();
        $pitchresults = Pitchresult::where('game_id',$result->id)->orderBy('pitch_order')->get();
        $places = Place::get()->all();
        $place = Place::get()->all();
        $users = User::get()->all();

        if(Auth::check()){
            if(Auth::user()->admin ==1){
                return view('results.pitchBuild',compact('result','users'));
            }else{
                return view('results.show',compact('result','userresults','pitchresults','place'))->with('message','管理者としてログインして下さい');
            }
        }else{
             return redirect()->route('login')->withInput()->with('message','ログインして下さい');
        }
    }

    public function pitchBuildEdit($id){
        $pitchresults = Pitchresult::findOrFail($id);
        $result = Result::where('id',$pitchresults->game_id)->first();
        $users = User::get()->all();

        if(Auth::check()){
            if(Auth::user()->admin ==1){
                return view('results.pitchBuildEdit',compact('result','pitchresults','users'));
            }else{
                return redirect()->back()->with('message','管理者としてログインして下さい');
            }
            }else{
                return redirect()->route('login')->withInput()->with('message','ログインして下さい');
            }
    }

  public function edit($id){
        $result = Result::findOrFail($id);
        $userresults = Userresult::where('game_id',$result->id)->orderBy('ord')->orderBy('generation')->get();
        $pitchresults = Pitchresult::where('game_id',$result->id)->orderBy('pitch_order')->get();
        $places = Place::get()->all();
        $place = Place::get()->all();
        if(Auth::check()){
            if(Auth::user()->admin ==1){
                return view('results.edit',compact('result','userresults','pitchresults','places'));
            }else{
                return view('results.show',compact('result','userresults','pitchresults','place'))->with('message','管理者としてログインして下さい');
            }
        }else{
            return redirect()->route('login')->withInput()->with('message','ログインして下さい');
        }

    }

    public function store(Request $request,result $result){
        $rules = [
            'y'=>['required','integer'],
            'm'=>['required','integer'],
            'd'=>['required','integer'],
            'game'=>['required'],
            'S_name'=>['required'],
            'K_name'=>['required'],
            'place'=>['required'],
        ];
        $this->validate($request,$rules);
        $result->create($request->all());
        $result = Result::orderBy('created_at','desc')->first();

        return redirect()
        ->route('results.edit',compact('result'))
        ->with('status','登録しました。');

    }


    public function update(Request $request, Result $result)
    {
        $result->update($request->all());
        $result = Result::findOrFail($result->id);

        return redirect()
        ->route('results.show',compact('result'))
        ->with('status','更新しました。');

    }

    public function destroy(Result $result,Userresult $userresults,Pitchresult $pitchresults)
    {
        $userresults = Userresult::where('game_id',$result->id)->delete();
        $pitchresults = Pitchresult::where('game_id',$result->id)->delete();
        $result->delete();

        return redirect()
        ->route('results.index',compact('result','userresults','pitchresults'))
        ->with('status','削除しました。');

    }

}
