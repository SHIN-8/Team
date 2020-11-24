<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\Common;


class TablesController extends Controller
{
    // 打率
    public function index(Request $request){
        $y = date("Y");    
        $year = Common::year($request);
        $GAME = Common::game($request);
        return view('table.index',compact('y','year','GAME'));
    }

    // 試合数
    public function games(Request $request){
        $y = date("Y");
        $year = Common::year($request);
        $GAME = Common::game($request);

        return view('table.games',compact('y','year','GAME'));
    }

    // 打点
    public function r(Request $request){
        $y = date("Y");
        $year = Common::year($request);
        $GAME = Common::game($request);

        return view('table.r',compact('y','year','GAME'));
    }

    // 安打数
    public function hits(Request $request){
        $y = date("Y");
        $year = Common::year($request);
        $GAME = Common::game($request);

        return view('table.hits',compact('y','year','GAME'));
    }

    // 二塁打
    public function two(Request $request){
        $y = date("Y");
        $year = Common::year($request);
        $GAME = Common::game($request);

        return view('table.two',compact('y','year','GAME'));
    }

    // 三塁打
    public function three(Request $request){
        $y = date("Y");
        $year = Common::year($request);
        $GAME = Common::game($request);

        return view('table.three',compact('y','year','GAME'));
    }

    // 本塁打
    public function homerun(Request $request){
        $y = date("Y");
        $year = Common::year($request);
        $GAME = Common::game($request);

        return view('table.homerun',compact('y','year','GAME'));
    }

    // 打席数
    public function atbat(Request $request){
        $y = date("Y");
        $year = Common::year($request);
        $GAME = Common::game($request);

        return view('table.atbat',compact('y','year','GAME'));
    }

    // 打数
    public function bat(Request $request){
        $y = date("Y");
        $year = Common::year($request);
        $GAME = Common::game($request);

        return view('table.bat',compact('y','year','GAME'));
    }

    // 盗塁数
    public function steal(Request $request){
        $y = date("Y");
        $year = Common::year($request);
        $GAME = Common::game($request);

        return view('table.steal',compact('y','year','GAME'));
    }

    // 四死球
    public function fourball(Request $request){
        $y = date("Y");
        $year = Common::year($request);
        $GAME = Common::game($request);

        return view('table.fourball',compact('y','year','GAME'));
    }

    // 三振
    public function k(Request $request){
        $y = date("Y");
        $year = Common::year($request);
        $GAME = Common::game($request);

        return view('table.k',compact('y','year','GAME'));
    }

    // 犠打
    public function bant(Request $request){
        $y = date("Y");
        $year = Common::year($request);
        $GAME = Common::game($request);

        return view('table.bant',compact('y','year','GAME'));
    }

    // 犠飛
    public function sacrificefly(Request $request){
        $y = date("Y");
        $year = Common::year($request);
        $GAME = Common::game($request);

        return view('table.sacrificefly',compact('y','year','GAME'));
    }

    // 出塁率
    public function onbase(Request $request){
        $y = date("Y");
        $year = Common::year($request);
        $GAME = Common::game($request);

        return view('table.onbase',compact('y','year','GAME'));
    }

    // 長打率
    public function slugging(Request $request){
        $y = date("Y");
        $year = Common::year($request);
        $GAME = Common::game($request);

        return view('table.slugging',compact('y','year','GAME'));
    }

    // OPS
    public function ops(Request $request){
        $y = date("Y");
        $year = Common::year($request);
        $GAME = Common::game($request);

        return view('table.ops',compact('y','year','GAME'));
    }

    // 試合数
    public function pitchgames(Request $request){
        $y = date("Y");
        $year = Common::year($request);
        $GAME = Common::game($request);

        return view('table.pitchgames',compact('y','year','GAME'));
    }

    // 勝数
    public function pitchwin(Request $request){
        $y = date("Y");
        $year = Common::year($request);
        $GAME = Common::game($request);

        return view('table.pitchwin',compact('y','year','GAME'));
    }

    // 負数
    public function pitchlose(Request $request){
        $y = date("Y");
        $year = Common::year($request);
        $GAME = Common::game($request);

        return view('table.pitchlose',compact('y','year','GAME'));
    }

    // セーブ数
    public function pitchsave(Request $request){
        $y = date("Y");
        $year = Common::year($request);
        $GAME = Common::game($request);

        return view('table.pitchsave',compact('y','year','GAME'));
    }

    // 投球回数
    public function pitchinning(Request $request){
        $y = date("Y");
        $year = Common::year($request);
        $GAME = Common::game($request);

        return view('table.pitchinning',compact('y','year','GAME'));
    }
    public function pitchera(Request $request){
        $y = date("Y");
        $year = Common::year($request);
        $GAME = Common::game($request);

        return view('table.pitchera',compact('y','year','GAME'));
    }

    // 自責点
    public function pitchearned_run(Request $request){
        $y = date("Y");
        $year = Common::year($request);
        $GAME = Common::game($request);

        return view('table.pitchearned_run',compact('y','year','GAME'));
    }

    // 失点
    public function pitchruns_allowed(Request $request){
        $y = date("Y");
        $year = Common::year($request);
        $GAME = Common::game($request);

        return view('table.pitchruns_allowed',compact('y','year','GAME'));
    }

    // 奪三振
    public function pitchk(Request $request){
        $y = date("Y");
        $year = Common::year($request);
        $GAME = Common::game($request);

        return view('table.pitchk',compact('y','year','GAME'));
    }

    public function pitchfourball(Request $request){
        $y = date("Y");
        $year = Common::year($request);
        $GAME = Common::game($request);

        return view('table.pitchfourball',compact('y','year','GAME'));
    }


}
