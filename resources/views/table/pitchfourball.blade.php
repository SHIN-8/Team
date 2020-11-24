@extends('layouts.Ptable')

@section('title','top')

@section('content')
<thead>
  <tr>
    <th>  
        <div   class="playertitle">投手</div>
    </th>
    <th></th>
    <th>
        <div class="title text-nowrap">
          <a  href="{{ route('table.pitchgames',['year'=>$year,'GAME'=>$GAME]) }}">試合数</a>
        </div>
    </th>
    <th>
        <div class="title text-nowrap">
          <a  href="{{ route('table.pitchwin',['year'=>$year,'GAME'=>$GAME]) }}">勝</a>
        </div>
    </th>
    <th>
        <div class="title text-nowrap">
          <a  href="{{ route('table.pitchlose',['year'=>$year,'GAME'=>$GAME]) }}">負</a>
        </div>
    </th>
    <th>
        <div class="title text-nowrap">
          <a  href="{{ route('table.pitchsave',['year'=>$year,'GAME'=>$GAME]) }}">Ｓ</a>
        </div>
    </th>
    <th>
        <div class="title text-nowrap">
          <a  href="{{ route('table.pitchera',['year'=>$year,'GAME'=>$GAME]) }}">防御率</a>
        </div>
    </th>
    <th>
        <div class="title text-nowrap">
          <a  href="{{ route('table.pitchinning',['year'=>$year,'GAME'=>$GAME]) }}">イニング</a>
        </div>
    </th>
    <th>
        <div class="title text-nowrap">
          <a  href="{{ route('table.pitchearned_run',['year'=>$year,'GAME'=>$GAME]) }}">自責点</a>
        </div>
    </th>
    <th>
        <div class="title text-nowrap">
          <a  href="{{ route('table.pitchruns_allowed',['year'=>$year,'GAME'=>$GAME]) }}">失点</a>
        </div>
    </th>
    <th>
        <div class="title text-nowrap">
          <a  href="{{ route('table.pitchk',['year'=>$year,'GAME'=>$GAME]) }}">奪三振</a>
        </div>
    </th>
    <th>
        <div class="titleSelect text-nowrap">
          <a  href="{{ route('table.pitchfourball',['year'=>$year,'GAME'=>$GAME]) }}">四死球</a>
        </div>
    </th>     
  </tr>
</thead>
@endsection

@section('content2')
      <?php
           if($GAME == 4){
            $game = App\Result::where('y',$year)->get()->count();
            $orderresult = App\Pitchresult::groupBy('user_id')->where('y',$year);
          }else{
            $game = App\Result::where('y',$year)->where('game',$GAME)->get()->count();
            $orderresult = App\Pitchresult::groupBy('user_id')->where('y',$year)->where('pitch_games',$GAME);
          }
            $GAMES = $orderresult->select('user_id',DB::raw('count(*) as total'))->get()->sortByDesc('total');
             $maxGAMES = $GAMES->max('total');
            $WIN = $orderresult->select('user_id',DB::raw('count(wins = "勝"or null) as total'))->get()->sortByDesc('total');
             $maxWIN = $WIN->max('total');
            $LOSE = $orderresult->select('user_id',DB::raw('count(wins = "負"or null) as total'))->get()->sortByDesc('total');
             $maxLOSE = $LOSE->max('total');
            $SAVE = $orderresult->select('user_id',DB::raw('count(wins = "Ｓ"or null) as total'))->get()->sortByDesc('total');
             $maxSAVE = $SAVE->max('total');
            $INNING = $orderresult->select('user_id',DB::raw('sum(inning)+sum(inningathird)/3 as total'))->get()->sortByDesc('total');
            $maxINNING = $INNING->max('total');
            $EARNEDRUN = $orderresult->select('user_id',DB::raw('sum(earned_run) as total'))->get()->sortByDesc('total');
             $maxEARNEDRUN = $EARNEDRUN->max('total');
            $RUNSALLOWED = $orderresult->select('user_id',DB::raw('sum(runs_allowed) as total'))->get()->sortByDesc('total');
             $maxRUNSALLOWED = $RUNSALLOWED->max('total');
            $K = $orderresult->select('user_id',DB::raw('sum(k) as total'))->get()->sortByDesc('total');
             $maxK = $K->max('total');
            $FOURBALL = $orderresult->select('user_id',DB::raw('sum(give_four_dead_balls) as total'))->get()->sortByDesc('total');
             $maxFOURBALL = $FOURBALL->max('total');
            $ERA = $orderresult->select('user_id',DB::raw('sum(inning)+sum(inningathird)/3 as Total'),DB::raw('(sum(earned_run)*9)/(sum(inning)+sum(inningathird)/3) as total'))->get()->sortBy('total');
             $minERA = $ERA->where('Total','>=',$game)->min('total');
    
            $players = $FOURBALL;
            ?>

@endsection

@section('content3')
<form action="{{ url('table/pitchfourball') }}" method="get">
      <div class="row">
          <div class="d-flex align-items-start col-sm-3">
              <label for="custom-select-1b" class="text-nowrap"><h4>年度</h4></label>
                <input type="text" name="year" class="col-8" value="{{$year}}">
          </div>
        <div class="d-flex align-items-start col-sm-4">
            <label for="custom-select-1b" class="text-nowrap"><h4>形式</h4></label>
                <select name="GAME" id="custom-select-1b" class="custom-select form-control-sm col-8" value="{{$GAME}}">
                  @if($GAME == 4)
                    <option value="4">全て</option>
                  @elseif($GAME == 1)
                    <option value="1">大会</option>
                  @elseif($GAME == 2)
                  <option value="2">練習試合</option>
                  @elseif($GAME == 3)
                    <option value="3">練習</option>
                  @else
                    <option></option>
                  @endif
                    <option value="1">大会</option>
                    <option value="2">練習試合</option>
                    <option value="3">練習</option>
                    <option value="4">全て</option>
                </select>
            </div>
        <div class="col-sm-2">
            <input type="submit" class="btn btn-info btn-block" value="検索">
        </div>
    </form>
    <br>
    
@endsection