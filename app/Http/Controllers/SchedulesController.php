<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schedules;
use App\User;
use App\Userschedule;
use App\Place;
use Illuminate\Support\Facades\Auth;

class SchedulesController extends Controller
{
    public function index(){
        $user = Auth::user();
        $today = date("Y-m-d");
        $schedules = Schedules::where('date','>=',$today)->orderBy('date','asc')->get();

        return view('schedules.index',compact('schedules','user','today'));
    }

    public function show($id){
        $schedule = Schedules::findOrFail($id);
        $user = Auth::user();
        $place = Place::where('id',$schedule->place)->first();
        $players = User::get('id')->all();

        // 参加
        $participationPlayers = Userschedule::where([['schedule_id',$schedule->id],['participation',"1"]])->get()->all();
        // 不参加
        $nonParticipationPlayers = Userschedule::where([['schedule_id',$schedule->id],['participation',"2"]])->get()->all();
        // 未定
        $undecidedPlayers = Userschedule::where([['schedule_id',$schedule->id],['participation',"3"]])->get()->all();
        // 入力済
        $onPlayers = Userschedule::where([['schedule_id',$schedule->id],['participation',"1"]])->orWhere([['schedule_id',$schedule->id],['participation',"2"]])->orWhere([['schedule_id',$schedule->id],['participation',"3"]])->get('id')->all();
        // 未入力
        $noPlayers = array_diff($players,$onPlayers);

        $Players = User::get()->all();
        $y = date("Y");

        return view('schedules.show',compact(
        'schedule','user','participationPlayers','nonParticipationPlayers'
        ,'undecidedPlayers','onPlayers','players','noPlayers','Players','place','y'
    ));
    }

    public function create(Place $places){
        $user = Auth::user();
        $today = date("Y-m-d");
        $places = Place::get()->all();
        $schedules = Schedules::where('date','>=',$today)->orderBy('date','asc')->get();

        if(Auth::check()){
            if(Auth::user()->admin ==1){
                return view('schedules.create',compact('places'));
            }else{
                return view('schedules.index',compact('schedules','user','today'))->with('message','管理者としてログインして下さい');
            }
        }else{
            return redirect()->route('login')->withInput()->with('message','ログインして下さい');
        }
    }


    public function edit($id){
        $schedule = Schedules::findOrFail($id);
        $participationPlayers = Userschedule::where([['schedule_id',$schedule->id],['participation',"1"]])->get()->all();
        $user = Auth::user();
        $today = date("Y-m-d");
        $places = Place::get()->all();
        $schedules = Schedules::where('date','>=',$today)->orderBy('date','asc')->get();

        if(Auth::check()){
            if(Auth::user()->admin ==1){
                return view('schedules.edit',compact('schedule','participationPlayers','places'));
            }else{
                return view('schedules.index',compact('schedules','user','today'))->with('message','管理者としてログインして下さい');
            }
        }else{
            return redirect()->route('login')->withInput()->with('message','ログインして下さい');
        }
    }

    public function store(Request $request,schedules $schedule){
        $rules = [
            'date'=>['required'],
            'opponent'=>['required'],
            's_t'=>['required','date_format:"H:i"'],
            'f_t'=>['required','date_format:"H:i"'],
            'f_t' =>'after:s_t',
            'place'=>['required'],
        ];
        $this->validate($request,$rules);
        $schedule->create($request->all());

        return redirect()
        ->route('schedules.index')
        ->with('status','登録しました。');
    }
    
    public function update(Request $request,schedules $schedule){
        $rules = [
            'date'=>['required'],
            'opponent'=>['required'],
            's_t'=>['required','date_format:"H:i"'],
            'f_t'=>['required','date_format:"H:i"'],
            'f_t' =>'after:s_t',
            'place'=>['required'],
            'a'=> ['nullable','different:b,c,d_,e,f,g,h,i'],
            'an'=> ['nullable','different:bn,cn,dn,en,fn,gn,hn,i_n'],
            'b'=> ['nullable','different:a,c,d_,e,f,g,h,i'],
            'bn'=> ['nullable','different:an,cn,dn,en,fn,gn,hn,i_n'],
            'c'=> ['nullable','different:a,b,d_,e,f,g,h,i'],
            'cn'=> ['nullable','different:an,bn,dn,en,fn,gn,hn,i_n'],
            'd_'=> ['nullable','different:a,b,c,e,f,g,h,i'],
            'dn'=> ['nullable','different:an,bn,cn,en,fn,gn,hn,i_n'],
            'e'=> ['nullable','different:a,b,c,d_,f,g,h,i'],
            'en'=> ['nullable','different:an,bn,cn,dn,fn,gn,hn,i_n'],
            'f'=> ['nullable','different:a,b,c,d_,e,g,h,i'],
            'fn'=> ['nullable','different:an,bn,cn,dn,en,gn,hn,i_n'],
            'g'=> ['nullable','different:a,b,c,d_,e,f,h,i'],
            'gn'=> ['nullable','different:an,bn,cn,dn,en,fn,hn,i_n'],
            'h'=> ['nullable','different:a,b,c,d_,e,f,g,i'],
            'hn'=> ['nullable','different:an,bn,cn,dn,en,fn,gn,i_n'],
            'i'=> ['nullable','different:a,b,c,d_,e,f,g,h'],
            'i_n'=> ['nullable','different:an,bn,cn,dn,en,fn,gn,hn'],
        ];
        $this->validate($request,$rules);
        $schedule->update($request->all());
        

        return redirect()
        ->route('schedules.index')
        ->with('status','更新しました。');
        }

    public function user_schedule_store(Request $request,schedules $schedule){
        $data = Userschedule::get();
        
        $data->sync($request->all());

        return redirect()
        ->route('schedules.index',compact('schedule','user','data'))
        ->with('status','日程を登録しました。');
    }


    public function destroy(schedules $schedule)
    {
        $schedule->delete();

        return redirect()
        ->route('schedules.index')
        ->with('status','削除しました。');
    }

}
