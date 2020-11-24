<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;
use App\User;
use App\Schedules;
use App\Result;
use App\Place;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    public function index(){
        $team = Team::findOrFail(1);
        return redirect()

        ->route('team.show',compact('team'));
    }

    public function show(){
        $team = Team::findOrFail(1);

        return view('team.show',compact('team'));
    }

    public function edit($id){
        $team = Team::findOrFail(1);
        $users = User::get()->all();
        if(Auth::check()){
            if(Auth::user()->admin == 1 ){
                return view('team.edit',compact('team','users'));
            }else{
                return redirect()->route('team.show',compact('team'))
                ->withInput()->with('message','管理者としてログインして下さい');
            }
        }else{
            return redirect()->route('login')->withInput()->with('message','ログインして下さい');
        }
    }
    
    public function update(Request $request, Team $team)
    {
        $rules = [
            'name' => ['required'],
            'comment' => ['required'],
            'place' => ['required'],
            'img'=>['nullable','image'],
            'manager' => ['required'],
            'manager_name' => ['required'],
            'manager_comment' => ['required'],
            'Recruitment' => ['required'],
        ];
        $this->validate($request,$rules);

        $team->update($request->all());
        if($request->hasFile('img')){
            $team->img = $request->file('img')->getClientOriginalName();
            $team->save();
            $name = $team->img;
            $request->file('img')->storeAs('public/img',$name);
        }
        
        return redirect()
        ->route('team.show',compact('team'))
        ->with('message','更新しました。');
    }

    // 管理者画面
    public function admin(){
        $team = Team::findOrFail(1);
        $today = date("Y-m-d");
        $schedules = Schedules::where('date','>=',$today)->orderBy('date','asc')->first();
        $place = Place::where('id',$schedules->place)->first();

        if(Auth::check()){
            if(Auth::user()->admin ==1){             
                return view('team.admin',compact('team'));
            }else{
                $team = Team::findOrFail(1);
                return view('index',compact('team','schedules','place'))->with('message','管理者としてログインして下さい');
            }
        }else{
            return redirect()->route('login')->withInput()->with('message','ログインして下さい');
        }
    }

    //   ユーザー管理
    public function user(){
        if(Auth::check()){
            if(Auth::user()->admin ==1){
                $users = User::get()->sortBy('number');
                return view('team.user',compact('users'));
            }else{
                $team = Team::findOrFail(1);
                $today = date("Y-m-d");
                $schedules = Schedules::where('date','>=',$today)->orderBy('date','asc')->first();
                $place = Place::where('id',$schedules->place)->first();
                return view('index',compact('team','schedules','place'))->with('message','管理者としてログインして下さい');
              }
        }else{
            return redirect()->route('login')->withInput()->with('message','ログインして下さい');
        }    
    }

    // スケジュール管理
    public function schedule(){
        if(Auth::check()){
            if(Auth::user()->admin ==1){
                $today = date("Y-m-d");
                $schedules = Schedules::where('date','>=',$today)->orderBy('date','asc')->get();
                return view('team.schedule',compact('schedules','today'));
            }else{
                $team = Team::findOrFail(1);
                $today = date("Y-m-d");
                $schedules = Schedules::where('date','>=',$today)->orderBy('date','asc')->first();
                $place = Place::where('id',$schedules->place)->first();
                return view('index',compact('team','schedules','place'))->with('message','管理者としてログインして下さい');
            }
        }else{
            return redirect()->route('login')->withInput()->with('message','ログインして下さい');
        }      
    }

    // 試合結果管理
    public function result(){
        if(Auth::check()){
            if(Auth::user()->admin ==1){
                $results =Result::orderByDesc('y')->orderByDesc('m')->orderByDesc('d')->get();
                return view('team.result',compact('results'));
            }else{
                $team = Team::findOrFail(1);
                $today = date("Y-m-d");
                $schedules = Schedules::where('date','>=',$today)->orderBy('date','asc')->first();
                $place = Place::where('id',$schedules->place)->first();
                return view('index',compact('team','schedules','place'))->with('message','管理者としてログインして下さい');
            }
        }else{
            return redirect()->route('login')->withInput()->with('message','ログインして下さい');
        }
    }
    
    // 球場管理
    public function place(){
        if(Auth::check()){
            if(Auth::user()->admin ==1){
                $places = Place::get()->all();
                return view('team.place',compact('places'));
            }else{
                $team = Team::findOrFail(1);
                $today = date("Y-m-d");
                $schedules = Schedules::where('date','>=',$today)->orderBy('date','asc')->first();
                $place = Place::where('id',$schedules->place)->first();
                return view('index',compact('team','schedules','place'))->with('message','管理者としてログインして下さい');
            }
        }else{
            return redirect()->route('login')->withInput()->with('message','ログインして下さい');
        }    
    }
}
