@extends('layouts.app')

@section('title','show')

@section('content')


<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-9 text-nowrap">
                  <h4> {{$schedule->date->format('Y年m月d日')}}</h4>
                </div>
                <div class="col-3 text-center">
                  @guest
                  @else
                      <?php
                      $user_schedule = App\Userschedule::where([['id',$user->id],['schedule_id',$schedule->id]])->first();
                      ?>
                    @if($user_schedule)
                        @if($user_schedule->participation == "1")
                            <div class="btn btn-primary btn-sm text-nowrap">
                                参加
                            </div>
                        @elseif($user_schedule->participation == "2")
                            <div class="btn btn-primary btn-sm text-nowrap">
                                不参加
                            </div>
                        @else
                            <div class="btn btn-primary btn-sm text-nowrap">
                                未定
                            </div>
                        @endif
                    @else
                        <div class="btn btn-danger btn-sm text-nowrap">
                            未入力
                        </div>
                    @endif
                  @endguest             
                </div>
            </div>
        </div>
      <div class="card-body">
          <div class="text-center">
              <div class="contentstitle">
                  {{$schedule->opponent}}
              </div>
          </div>                
            <div class="col card-text text-center">
              {{$schedule->s_t->format('H:i')}}-{{$schedule->f_t->format('H:i')}}　
                @if($place)
                    {{$place->name}}
                @else
                    会場未定
                @endif
                @if($schedule->game == 1)
                  【公式戦】
                @elseif($schedule->game == 2)
                  【練習試合】
                @else
                  【練習】
                @endif
            </div>
      @guest
        @if (Route::has('register'))
          <div class="col card-text text-center">
            <h6>
                <?php
                    $userschedule = App\Userschedule::where('schedule_id',$schedule->id)->where('participation','1')->count();
                    $nouserschedule = App\Userschedule::where('schedule_id',$schedule->id)->where('participation','2')->count();
                    $undefind = App\Userschedule::where('schedule_id',$schedule->id)->where('participation','3')->count();
                ?>
                参加{{$userschedule}}人　　
                不参加{{$nouserschedule}}人　　
                未定{{$undefind}}人
            </h6>
          </div>
        @endif
      @else
      <div class="row">
          <div class="col-4 text-center">
              <form method="post" action="{{route('userschedules.store')}}">
              @csrf
                <input type="hidden" name="id" class="form-control" id="text4b" value="{{$user->id}}">
                <input type="hidden" name="schedule_id" class="form-control" id="text4b" value="{{$schedule->id}}">
                <input type="hidden" name="participation" class="form-control" id="text4b" value="1">
                <input type="submit" class="btn btn-info btn-block btn-lg"  value="参加" >
              </form>
          </div>
          <div class="col-4 text-center">
              <form method="post" action="{{route('userschedules.store')}}">
              @csrf
                <input type="hidden" name="id" class="form-control" id="text4b" value="{{$user->id}}">
                <input type="hidden" name="schedule_id" class="form-control" id="text4b" value="{{$schedule->id}}">
                <input type="hidden" name="participation" class="form-control" id="text4b" value="2">
                <input type="submit" class="btn btn-info btn-block btn-lg"  value="不参加" >
              </form>
          </div>
          <div class="col-4 text-center">
              <form method="post" action="{{route('userschedules.store')}}">
              @csrf
                <input type="hidden" name="id" class="form-control" id="text4b" value="{{$user->id}}">
                <input type="hidden" name="schedule_id" class="form-control" id="text4b" value="{{$schedule->id}}">
                <input type="hidden" name="participation" class="form-control" id="text4b" value="3">
                <input type="submit" class="btn btn-info btn-block btn-lg"  value="未定" >
              </form>
          </div>   
      </div>
      @endguest
    </div>
  </div>

  <div class="row">
    <div class="row col-lg-4 ">
      <div class="text-center">
          <table class="table table-sm table-borderless col-md-4">
              <thead>
                  <tr>
                    <th></th>
                    <th></th>
                    <th>StartingMember</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                  </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">1</th>
                    <td>
                        @if($schedule->a == null)
                          <div class="score">-</div>
                        @else
                          @if($schedule->a == "投" )
                            <div class="position position1">{{$schedule->a}}</div>
                          @elseif($schedule->a == "捕" )
                            <div class="position position2">{{$schedule->a}}</div>
                          @elseif($schedule->a == "一"|| $schedule->a == "二"||$schedule->a == "三"||$schedule->a == "遊")
                            <div class="position position3">{{$schedule->a}}</div>
                          @elseif($schedule->a == "左"||$schedule->a == "中"||$schedule->a == "右")
                            <div class="position position4">{{$schedule->a}}</div>
                          @elseif($schedule->a == "DH")
                            <div class="position position17">{{$schedule->a}}</div>
                          @elseif($schedule->a == "打"||$schedule->a == "走")
                            <div class="position position18">{{$schedule->a}}</div>
                          @endif
                        @endif
                    </td>
                    <td>
                      <?php                
                      $auser = App\user::where('number',$schedule->an)->first();
                        if($auser){
                        $userresults = App\Userresult::where('user_id',$auser->number)->where('y',$y)->get();
                        $a = App\Userresult::select('a')->where('user_id',$auser->number)->where('y',$y)->get();
                        $b = App\Userresult::select('b')->where('user_id',$auser->number)->where('y',$y)->get();
                        $c = App\Userresult::select('c')->where('user_id',$auser->number)->where('y',$y)->get();
                        $d = App\Userresult::select('d')->where('user_id',$auser->number)->where('y',$y)->get();
                        $e = App\Userresult::select('e')->where('user_id',$auser->number)->where('y',$y)->get();
                        $f = App\Userresult::select('f')->where('user_id',$auser->number)->where('y',$y)->get();
                        $g = App\Userresult::select('g')->where('user_id',$auser->number)->where('y',$y)->get();
                        $h = App\Userresult::select('h')->where('user_id',$auser->number)->where('y',$y)->get();
                        $i = App\Userresult::select('i')->where('user_id',$auser->number)->where('y',$y)->get();
                        $r = $userresults->sum('ar')+$userresults->sum('br')+$userresults->sum('cr')+$userresults->sum('dr')+$userresults->sum('er')+$userresults->sum('fr')+$userresults->sum('gr')+$userresults->sum('hr')+$userresults->sum('ir');
                        $hit = $a->where('a',"安")->count()+$b->where('b',"安")->count()+$c->where('c',"安")->count()+$d->where('d',"安")->count()+$e->where('e',"安")->count()+$f->where('f',"安")->count()+$g->where('g',"安")->count()+$h->where('h',"安")->count()+$i->where('i',"安")->count();
                        $two = $a->where('a',"２")->count()+$b->where('b',"２")->count()+$c->where('c',"２")->count()+$d->where('d',"２")->count()+$e->where('e',"２")->count()+$f->where('f',"２")->count()+$g->where('g',"２")->count()+$h->where('h',"２")->count()+$i->where('i',"２")->count();
                        $three = $a->where('a',"３")->count()+$b->where('b',"３")->count()+$c->where('c',"３")->count()+$d->where('d',"３")->count()+$e->where('e',"３")->count()+$f->where('f',"３")->count()+$g->where('g',"３")->count()+$h->where('h',"３")->count()+$i->where('i',"３")->count();
                        $homerun = $a->where('a',"本")->count()+$b->where('b',"本")->count()+$c->where('c',"本")->count()+$d->where('d',"本")->count()+$e->where('e',"本")->count()+$f->where('f',"本")->count()+$g->where('g',"本")->count()+$h->where('h',"本")->count()+$i->where('i',"本")->count();
                        $hits = $hit+$two+$three+$homerun;
                        $numberofatbat = $a->where('a','!==',null)->count()+$b->where('b','!==',null)->count()+$c->where('c','!==',null)->count()+$d->where('d','!==',null)->count()+$e->where('e','!==',null)->count()+$f->where('f','!==',null)->count()+$g->where('g','!==',null)->count()+$h->where('h','!==',null)->count()+$i->where('i','!==',null)->count();
                        $fourdeadball = $a->where('a',"四球")->count()+$b->where('b',"四球")->count()+$c->where('c',"四球")->count()+$d->where('d',"四球")->count()+$e->where('e',"四球")->count()+$f->where('f',"四球")->count()+$g->where('g',"四球")->count()+$h->where('h',"四球")->count()+$i->where('i',"四球")->count()+$a->where('a',"死球")->count()+$b->where('b',"死球")->count()+$c->where('c',"死球")->count()+$d->where('d',"死球")->count()+$e->where('e',"死球")->count()+$f->where('f',"死球")->count()+$g->where('g',"死球")->count()+$h->where('h',"死球")->count()+$i->where('i',"死球")->count();
                        $bant = $a->where('a',"犠")->count()+$b->where('b',"犠")->count()+$c->where('c',"犠")->count()+$d->where('d',"犠")->count()+$e->where('e',"犠")->count()+$f->where('f',"犠")->count()+$g->where('g',"犠")->count()+$h->where('h',"犠")->count()+$i->where('i',"犠")->count();
                        $sacrificefly = $a->where('a',"犠飛")->count()+$b->where('b',"犠飛")->count()+$c->where('c',"犠飛")->count()+$d->where('d',"犠飛")->count()+$e->where('e',"犠飛")->count()+$f->where('f',"犠飛")->count()+$g->where('g',"犠飛")->count()+$h->where('h',"犠飛")->count()+$i->where('i',"犠飛")->count();
                        $atbat = $numberofatbat-$fourdeadball-$bant-$sacrificefly;
                        }
                      ?>
                      
                      @if($auser)
                        @if($auser->position == "投手" && $auser->SubPosition == null )
                          <div class="result_userName position1">{{$auser->Name}}</div>
                        @elseif($auser->position == "捕手" && $auser->SubPosition == null )
                          <div class="result_userName position2">{{$auser->Name}}</div>
                        @elseif($auser->position == "外野手" && $auser->SubPosition == null )
                          <div class="result_userName position4">{{$auser->Name}}</div>
                        @elseif($auser->position == "投手" && $auser->SubPosition == "捕手" )
                          <div class="result_userName position5">{{$auser->Name}}</div>
                        @elseif($auser->position == "投手" && $auser->SubPosition == "一塁手" || $auser->position == "投手" && $auser->SubPosition == "二塁手" || $auser->position == "投手" && $auser->SubPosition == "三塁手" || $auser->position == "投手" && $auser->SubPosition == "遊撃手" )
                          <div class="result_userName position6">{{$auser->Name}}</div>
                        @elseif($auser->position == "投手" && $auser->SubPosition == "外野手" )
                          <div class="result_userName position7">{{$auser->Name}}</div>
                        @elseif($auser->position == "捕手" && $auser->SubPosition == "投手" )
                          <div class="result_userName position8">{{$auser->Name}}</div>
                        @elseif($auser->position == "捕手" && $auser->SubPosition == "一塁手" || $auser->position == "捕手" && $auser->SubPosition == "二塁手" || $auser->position == "捕手" && $auser->SubPosition == "三塁手" || $auser->position == "捕手" && $auser->SubPosition == "遊撃手" )
                          <div class="result_userName position9">{{$auser->Name}}</div>
                        @elseif($auser->position == "捕手" && $auser->SubPosition == "外野手" )
                          <div class="result_userName position10">{{$auser->Name}}</div>
                        @elseif($auser->position == "一塁手" && $auser->SubPosition == "投手"|| $auser->position == "二塁手" && $auser->SubPosition == "投手"|| $auser->position == "三塁手" && $auser->SubPosition == "投手"|| $auser->position == "遊撃手" && $auser->SubPosition == "投手"  )
                          <div class="result_userName position11">{{$auser->Name}}</div>
                        @elseif($auser->position == "一塁手" && $auser->SubPosition == "捕手"|| $auser->position == "二塁手" && $auser->SubPosition == "捕手"|| $auser->position == "三塁手" && $auser->SubPosition == "捕手"|| $auser->position == "遊撃手" && $auser->SubPosition == "捕手"  )
                          <div class="result_userName position12">{{$auser->Name}}</div>
                        @elseif($auser->position == "一塁手" && $auser->SubPosition == "外野手"|| $auser->position == "二塁手" && $auser->SubPosition == "外野手"|| $auser->position == "三塁手" && $auser->SubPosition == "外野手"|| $auser->position == "遊撃手" && $auser->SubPosition == "外野手"  )
                          <div class="result_userName position13">{{$auser->Name}}</div>
                        @elseif($auser->position == "外野手" && $auser->SubPosition == "投手" )
                          <div class="result_userName position14">{{$auser->Name}}</div>
                        @elseif($auser->position == "外野手" && $auser->SubPosition == "捕手" )
                          <div class="result_userName position15">{{$auser->Name}}</div>
                        @elseif($auser->position == "外野手" && $auser->SubPosition == "一塁手" || $auser->position == "外野手" && $auser->SubPosition == "二塁手" || $auser->position == "外野手" && $auser->SubPosition == "三塁手" || $auser->position == "外野手" && $auser->SubPosition == "遊撃手" )
                          <div class="result_userName position16">{{$auser->Name}}</div>
                        @elseif($auser->position == "一塁手"|| $auser->position == "二塁手"|| $auser->position == "三塁手"|| $auser->position == "遊撃手"  )
                          <div class="result_userName position3">{{$auser->Name}}</div>
                        @elseif($auser->position == "マネージャー" || $auser->SubPosition == "マネージャー" )
                          <div class="result_userName position17">{{$auser->Name}}</div>
                        @endif    
                        @else
                          <div class="score">---</div>
                        @endif               
                  </td>
                  
                  <td>
                      @if($auser)
                          @if($atbat)
                            <div class="score">{{number_format($hits/$atbat,3)}}</div>
                          @else
                            <div class="score">0.000</div>
                          @endif
                      @else                 
                        <div class="score">-</div>
                      @endif
                  </td>
                  <td>
                    @if($auser)
                      <div class="score">{{$homerun}}</div>
                    @else
                      <div class="score">-</div>
                    @endif                          
                  </td>
                  <td>
                    @if($auser)
                      <div class="score">{{$r}}</div>
                    @else
                      <div class="score">-</div>
                    @endif
                  </td>

                </tr>
                <tr>
                  <th scope="row">2</th>
                  <td>
                    @if($schedule->b == null)
                      <div class="score">-</div>
                    @else
                      @if($schedule->b == "投" )
                        <div class="position position1">{{$schedule->b}}</div>
                      @elseif($schedule->b == "捕" )
                        <div class="position position2">{{$schedule->b}}</div>
                      @elseif($schedule->b == "一"|| $schedule->b == "二"||$schedule->b == "三"||$schedule->b == "遊")
                        <div class="position position3">{{$schedule->b}}</div>
                      @elseif($schedule->b == "左"||$schedule->b == "中"||$schedule->b == "右")
                        <div class="position position4">{{$schedule->b}}</div>
                      @elseif($schedule->b == "DH")
                        <div class="position position17">{{$schedule->b}}</div>
                      @elseif($schedule->b == "打"||$schedule->b == "走")
                        <div class="position position18">{{$schedule->b}}</div>
                      @endif
                    @endif
                  </td>
                  <td>                    
                    <?php
                      $buser = App\user::where('number',$schedule->bn)->first();
                    if($buser){
                      $userresults = App\Userresult::where('user_id',$buser->number)->where('y',$y)->get();
                      $a = App\Userresult::select('a')->where('user_id',$buser->number)->where('y',$y)->get();
                      $b = App\Userresult::select('b')->where('user_id',$buser->number)->where('y',$y)->get();
                      $c = App\Userresult::select('c')->where('user_id',$buser->number)->where('y',$y)->get();
                      $d = App\Userresult::select('d')->where('user_id',$buser->number)->where('y',$y)->get();
                      $e = App\Userresult::select('e')->where('user_id',$buser->number)->where('y',$y)->get();
                      $f = App\Userresult::select('f')->where('user_id',$buser->number)->where('y',$y)->get();
                      $g = App\Userresult::select('g')->where('user_id',$buser->number)->where('y',$y)->get();
                      $h = App\Userresult::select('h')->where('user_id',$buser->number)->where('y',$y)->get();
                      $i = App\Userresult::select('i')->where('user_id',$buser->number)->where('y',$y)->get();
                      $r = $userresults->sum('ar')+$userresults->sum('br')+$userresults->sum('cr')+$userresults->sum('dr')+$userresults->sum('er')+$userresults->sum('fr')+$userresults->sum('gr')+$userresults->sum('hr')+$userresults->sum('ir');
                      $hit = $a->where('a',"安")->count()+$b->where('b',"安")->count()+$c->where('c',"安")->count()+$d->where('d',"安")->count()+$e->where('e',"安")->count()+$f->where('f',"安")->count()+$g->where('g',"安")->count()+$h->where('h',"安")->count()+$i->where('i',"安")->count();
                      $two = $a->where('a',"２")->count()+$b->where('b',"２")->count()+$c->where('c',"２")->count()+$d->where('d',"２")->count()+$e->where('e',"２")->count()+$f->where('f',"２")->count()+$g->where('g',"２")->count()+$h->where('h',"２")->count()+$i->where('i',"２")->count();
                      $three = $a->where('a',"３")->count()+$b->where('b',"３")->count()+$c->where('c',"３")->count()+$d->where('d',"３")->count()+$e->where('e',"３")->count()+$f->where('f',"３")->count()+$g->where('g',"３")->count()+$h->where('h',"３")->count()+$i->where('i',"３")->count();
                      $homerun = $a->where('a',"本")->count()+$b->where('b',"本")->count()+$c->where('c',"本")->count()+$d->where('d',"本")->count()+$e->where('e',"本")->count()+$f->where('f',"本")->count()+$g->where('g',"本")->count()+$h->where('h',"本")->count()+$i->where('i',"本")->count();
                      $hits = $hit+$two+$three+$homerun;
                      $numberofatbat = $a->where('a','!==',null)->count()+$b->where('b','!==',null)->count()+$c->where('c','!==',null)->count()+$d->where('d','!==',null)->count()+$e->where('e','!==',null)->count()+$f->where('f','!==',null)->count()+$g->where('g','!==',null)->count()+$h->where('h','!==',null)->count()+$i->where('i','!==',null)->count();
                      $fourdeadball = $a->where('a',"四球")->count()+$b->where('b',"四球")->count()+$c->where('c',"四球")->count()+$d->where('d',"四球")->count()+$e->where('e',"四球")->count()+$f->where('f',"四球")->count()+$g->where('g',"四球")->count()+$h->where('h',"四球")->count()+$i->where('i',"四球")->count()+$a->where('a',"死球")->count()+$b->where('b',"死球")->count()+$c->where('c',"死球")->count()+$d->where('d',"死球")->count()+$e->where('e',"死球")->count()+$f->where('f',"死球")->count()+$g->where('g',"死球")->count()+$h->where('h',"死球")->count()+$i->where('i',"死球")->count();
                      $bant = $a->where('a',"犠")->count()+$b->where('b',"犠")->count()+$c->where('c',"犠")->count()+$d->where('d',"犠")->count()+$e->where('e',"犠")->count()+$f->where('f',"犠")->count()+$g->where('g',"犠")->count()+$h->where('h',"犠")->count()+$i->where('i',"犠")->count();
                      $sacrificefly = $a->where('a',"犠飛")->count()+$b->where('b',"犠飛")->count()+$c->where('c',"犠飛")->count()+$d->where('d',"犠飛")->count()+$e->where('e',"犠飛")->count()+$f->where('f',"犠飛")->count()+$g->where('g',"犠飛")->count()+$h->where('h',"犠飛")->count()+$i->where('i',"犠飛")->count();
                      $atbat = $numberofatbat-$fourdeadball-$bant-$sacrificefly;
                      }
                    ?>
                    @if($buser)
                        @if($buser->position == "投手" && $buser->SubPosition == null )
                          <div class="result_userName position1">{{$buser->Name}}</div>
                        @elseif($buser->position == "捕手" && $buser->SubPosition == null )
                          <div class="result_userName position2">{{$buser->Name}}</div>
                        @elseif($buser->position == "外野手" && $buser->SubPosition == null )
                          <div class="result_userName position4">{{$buser->Name}}</div>
                        @elseif($buser->position == "投手" && $buser->SubPosition == "捕手" )
                          <div class="result_userName position5">{{$buser->Name}}</div>
                        @elseif($buser->position == "投手" && $buser->SubPosition == "一塁手" || $buser->position == "投手" && $buser->SubPosition == "二塁手" || $buser->position == "投手" && $buser->SubPosition == "三塁手" || $buser->position == "投手" && $buser->SubPosition == "遊撃手" )
                          <div class="result_userName position6">{{$buser->Name}}</div>
                        @elseif($buser->position == "投手" && $buser->SubPosition == "外野手" )
                          <div class="result_userName position7">{{$buser->Name}}</div>
                        @elseif($buser->position == "捕手" && $buser->SubPosition == "投手" )
                          <div class="result_userName position8">{{$buser->Name}}</div>
                        @elseif($buser->position == "捕手" && $buser->SubPosition == "一塁手" || $buser->position == "捕手" && $buser->SubPosition == "二塁手" || $buser->position == "捕手" && $buser->SubPosition == "三塁手" || $buser->position == "捕手" && $buser->SubPosition == "遊撃手" )
                          <div class="result_userName position9">{{$buser->Name}}</div>
                        @elseif($buser->position == "捕手" && $buser->SubPosition == "外野手" )
                          <div class="result_userName position10">{{$buser->Name}}</div>
                        @elseif($buser->position == "一塁手" && $buser->SubPosition == "投手"|| $buser->position == "二塁手" && $buser->SubPosition == "投手"|| $buser->position == "三塁手" && $buser->SubPosition == "投手"|| $buser->position == "遊撃手" && $buser->SubPosition == "投手"  )
                          <div class="result_userName position11">{{$buser->Name}}</div>
                        @elseif($buser->position == "一塁手" && $buser->SubPosition == "捕手"|| $buser->position == "二塁手" && $buser->SubPosition == "捕手"|| $buser->position == "三塁手" && $buser->SubPosition == "捕手"|| $buser->position == "遊撃手" && $buser->SubPosition == "捕手"  )
                          <div class="result_userName position12">{{$buser->Name}}</div>
                        @elseif($buser->position == "一塁手" && $buser->SubPosition == "外野手"|| $buser->position == "二塁手" && $buser->SubPosition == "外野手"|| $buser->position == "三塁手" && $buser->SubPosition == "外野手"|| $buser->position == "遊撃手" && $buser->SubPosition == "外野手"  )
                          <div class="result_userName position13">{{$buser->Name}}</div>
                        @elseif($buser->position == "外野手" && $buser->SubPosition == "投手" )
                          <div class="result_userName position14">{{$buser->Name}}</div>
                        @elseif($buser->position == "外野手" && $buser->SubPosition == "捕手" )
                          <div class="result_userName position15">{{$buser->Name}}</div>
                        @elseif($buser->position == "外野手" && $buser->SubPosition == "一塁手" || $buser->position == "外野手" && $buser->SubPosition == "二塁手" || $buser->position == "外野手" && $buser->SubPosition == "三塁手" || $buser->position == "外野手" && $buser->SubPosition == "遊撃手" )
                          <div class="result_userName position16">{{$buser->Name}}</div>
                        @elseif($buser->position == "一塁手"|| $buser->position == "二塁手"|| $buser->position == "三塁手"|| $buser->position == "遊撃手"  )
                          <div class="result_userName position3">{{$buser->Name}}</div>
                        @elseif($buser->position == "マネージャー" || $buser->SubPosition == "マネージャー" )
                          <div class="result_userName position17">{{$buser->Name}}</div>
                        @endif
                    @else
                      <div class="score">---</div>
                    @endif   
                </td>
                
                <td>
                    @if($buser)
                      @if($atbat)
                        <div class="score">{{number_format($hits/$atbat,3)}}</div>
                      @else
                        <div class="score">0.000</div>
                      @endif
                    @else                 
                      <div class="score">-</div>
                    @endif
                  </td>
                  <td>
                    @if($buser)
                      <div class="score">{{$homerun}}</div>
                    @else
                      <div class="score">-</div>
                    @endif                          
                  </td>
                  <td>
                    @if($buser)
                      <div class="score">{{$r}}</div>
                    @else
                      <div class="score">-</div>
                    @endif
                  </td>
                </tr> 
                <tr>
                  <th scope="row">3</th>
                  <td>
                    @if($schedule->c == null)
                      <div class="score">-</div>
                    @else 
                      @if($schedule->c == "投" )
                        <div class="position position1">{{$schedule->c}}</div>
                      @elseif($schedule->c == "捕" )
                        <div class="position position2">{{$schedule->c}}</div>
                      @elseif($schedule->c == "一"|| $schedule->c == "二"||$schedule->c == "三"||$schedule->c == "遊")
                        <div class="position position3">{{$schedule->c}}</div>
                      @elseif($schedule->c == "左"||$schedule->c == "中"||$schedule->c == "右")
                        <div class="position position4">{{$schedule->c}}</div>
                      @elseif($schedule->c == "DH")
                        <div class="position position17">{{$schedule->c}}</div>
                      @elseif($schedule->c == "打"||$schedule->c == "走")
                        <div class="position position18">{{$schedule->c}}</div>
                      @endif
                    @endif
                  </td>
                  <td>                    
                    <?php
                      $cuser = App\user::where('number',$schedule->cn)->first();
                      if($cuser){
                      $userresults = App\Userresult::where('user_id',$cuser->number)->where('y',$y)->get();
                      $a = App\Userresult::select('a')->where('user_id',$cuser->number)->where('y',$y)->get();
                      $b = App\Userresult::select('b')->where('user_id',$cuser->number)->where('y',$y)->get();
                      $c = App\Userresult::select('c')->where('user_id',$cuser->number)->where('y',$y)->get();
                      $d = App\Userresult::select('d')->where('user_id',$cuser->number)->where('y',$y)->get();
                      $e = App\Userresult::select('e')->where('user_id',$cuser->number)->where('y',$y)->get();
                      $f = App\Userresult::select('f')->where('user_id',$cuser->number)->where('y',$y)->get();
                      $g = App\Userresult::select('g')->where('user_id',$cuser->number)->where('y',$y)->get();
                      $h = App\Userresult::select('h')->where('user_id',$cuser->number)->where('y',$y)->get();
                      $i = App\Userresult::select('i')->where('user_id',$cuser->number)->where('y',$y)->get();
                      $r = $userresults->sum('ar')+$userresults->sum('br')+$userresults->sum('cr')+$userresults->sum('dr')+$userresults->sum('er')+$userresults->sum('fr')+$userresults->sum('gr')+$userresults->sum('hr')+$userresults->sum('ir');
                      $hit = $a->where('a',"安")->count()+$b->where('b',"安")->count()+$c->where('c',"安")->count()+$d->where('d',"安")->count()+$e->where('e',"安")->count()+$f->where('f',"安")->count()+$g->where('g',"安")->count()+$h->where('h',"安")->count()+$i->where('i',"安")->count();
                      $two = $a->where('a',"２")->count()+$b->where('b',"２")->count()+$c->where('c',"２")->count()+$d->where('d',"２")->count()+$e->where('e',"２")->count()+$f->where('f',"２")->count()+$g->where('g',"２")->count()+$h->where('h',"２")->count()+$i->where('i',"２")->count();
                      $three = $a->where('a',"３")->count()+$b->where('b',"３")->count()+$c->where('c',"３")->count()+$d->where('d',"３")->count()+$e->where('e',"３")->count()+$f->where('f',"３")->count()+$g->where('g',"３")->count()+$h->where('h',"３")->count()+$i->where('i',"３")->count();
                      $homerun = $a->where('a',"本")->count()+$b->where('b',"本")->count()+$c->where('c',"本")->count()+$d->where('d',"本")->count()+$e->where('e',"本")->count()+$f->where('f',"本")->count()+$g->where('g',"本")->count()+$h->where('h',"本")->count()+$i->where('i',"本")->count();
                      $hits = $hit+$two+$three+$homerun;
                      $numberofatbat = $a->where('a','!==',null)->count()+$b->where('b','!==',null)->count()+$c->where('c','!==',null)->count()+$d->where('d','!==',null)->count()+$e->where('e','!==',null)->count()+$f->where('f','!==',null)->count()+$g->where('g','!==',null)->count()+$h->where('h','!==',null)->count()+$i->where('i','!==',null)->count();
                      $fourdeadball = $a->where('a',"四球")->count()+$b->where('b',"四球")->count()+$c->where('c',"四球")->count()+$d->where('d',"四球")->count()+$e->where('e',"四球")->count()+$f->where('f',"四球")->count()+$g->where('g',"四球")->count()+$h->where('h',"四球")->count()+$i->where('i',"四球")->count()+$a->where('a',"死球")->count()+$b->where('b',"死球")->count()+$c->where('c',"死球")->count()+$d->where('d',"死球")->count()+$e->where('e',"死球")->count()+$f->where('f',"死球")->count()+$g->where('g',"死球")->count()+$h->where('h',"死球")->count()+$i->where('i',"死球")->count();
                      $bant = $a->where('a',"犠")->count()+$b->where('b',"犠")->count()+$c->where('c',"犠")->count()+$d->where('d',"犠")->count()+$e->where('e',"犠")->count()+$f->where('f',"犠")->count()+$g->where('g',"犠")->count()+$h->where('h',"犠")->count()+$i->where('i',"犠")->count();
                      $sacrificefly = $a->where('a',"犠飛")->count()+$b->where('b',"犠飛")->count()+$c->where('c',"犠飛")->count()+$d->where('d',"犠飛")->count()+$e->where('e',"犠飛")->count()+$f->where('f',"犠飛")->count()+$g->where('g',"犠飛")->count()+$h->where('h',"犠飛")->count()+$i->where('i',"犠飛")->count();
                      $atbat = $numberofatbat-$fourdeadball-$bant-$sacrificefly;
                      }
                    ?>
                    @if($cuser)
                        @if($cuser->position == "投手" && $cuser->SubPosition == null )
                          <div class="result_userName position1">{{$cuser->Name}}</div>
                        @elseif($cuser->position == "捕手" && $cuser->SubPosition == null )
                          <div class="result_userName position2">{{$cuser->Name}}</div>
                        @elseif($cuser->position == "外野手" && $cuser->SubPosition == null )
                          <div class="result_userName position4">{{$cuser->Name}}</div>
                        @elseif($cuser->position == "投手" && $cuser->SubPosition == "捕手" )
                          <div class="result_userName position5">{{$cuser->Name}}</div>
                        @elseif($cuser->position == "投手" && $cuser->SubPosition == "一塁手" || $cuser->position == "投手" && $cuser->SubPosition == "二塁手" || $cuser->position == "投手" && $cuser->SubPosition == "三塁手" || $cuser->position == "投手" && $cuser->SubPosition == "遊撃手" )
                          <div class="result_userName position6">{{$cuser->Name}}</div>
                        @elseif($cuser->position == "投手" && $cuser->SubPosition == "外野手" )
                          <div class="result_userName position7">{{$cuser->Name}}</div>
                        @elseif($cuser->position == "捕手" && $cuser->SubPosition == "投手" )
                          <div class="result_userName position8">{{$cuser->Name}}</div>
                        @elseif($cuser->position == "捕手" && $cuser->SubPosition == "一塁手" || $cuser->position == "捕手" && $cuser->SubPosition == "二塁手" || $cuser->position == "捕手" && $cuser->SubPosition == "三塁手" || $cuser->position == "捕手" && $cuser->SubPosition == "遊撃手" )
                          <div class="result_userName position9">{{$cuser->Name}}</div>
                        @elseif($cuser->position == "捕手" && $cuser->SubPosition == "外野手" )
                          <div class="result_userName position10">{{$cuser->Name}}</div>
                        @elseif($cuser->position == "一塁手" && $cuser->SubPosition == "投手"|| $cuser->position == "二塁手" && $cuser->SubPosition == "投手"|| $cuser->position == "三塁手" && $cuser->SubPosition == "投手"|| $cuser->position == "遊撃手" && $cuser->SubPosition == "投手"  )
                          <div class="result_userName position11">{{$cuser->Name}}</div>
                        @elseif($cuser->position == "一塁手" && $cuser->SubPosition == "捕手"|| $cuser->position == "二塁手" && $cuser->SubPosition == "捕手"|| $cuser->position == "三塁手" && $cuser->SubPosition == "捕手"|| $cuser->position == "遊撃手" && $cuser->SubPosition == "捕手"  )
                          <div class="result_userName position12">{{$cuser->Name}}</div>
                        @elseif($cuser->position == "一塁手" && $cuser->SubPosition == "外野手"|| $cuser->position == "二塁手" && $cuser->SubPosition == "外野手"|| $cuser->position == "三塁手" && $cuser->SubPosition == "外野手"|| $cuser->position == "遊撃手" && $cuser->SubPosition == "外野手"  )
                          <div class="result_userName position13">{{$cuser->Name}}</div>
                        @elseif($cuser->position == "外野手" && $cuser->SubPosition == "投手" )
                          <div class="result_userName position14">{{$cuser->Name}}</div>
                        @elseif($cuser->position == "外野手" && $cuser->SubPosition == "捕手" )
                          <div class="result_userName position15">{{$cuser->Name}}</div>
                        @elseif($cuser->position == "外野手" && $cuser->SubPosition == "一塁手" || $cuser->position == "外野手" && $cuser->SubPosition == "二塁手" || $cuser->position == "外野手" && $cuser->SubPosition == "三塁手" || $cuser->position == "外野手" && $cuser->SubPosition == "遊撃手" )
                          <div class="result_userName position16">{{$cuser->Name}}</div>
                        @elseif($cuser->position == "一塁手"|| $cuser->position == "二塁手"|| $cuser->position == "三塁手"|| $cuser->position == "遊撃手"  )
                          <div class="result_userName position3">{{$cuser->Name}}</div>
                        @elseif($cuser->position == "マネージャー" || $cuser->SubPosition == "マネージャー" )
                          <div class="result_userName position17">{{$cuser->Name}}</div>
                        @endif
                    @else
                      <div class="score">---</div>
                    @endif
                </td>
                
                <td>
                  @if($cuser)
                    @if($atbat)
                      <div class="score">{{number_format($hits/$atbat,3)}}</div>
                    @else
                      <div class="score">0.000</div>
                    @endif
                  @else                 
                    <div class="score">-</div>
                  @endif
                </td>
                <td>
                  @if($cuser)
                    <div class="score">{{$homerun}}</div>
                  @else
                    <div class="score">-</div>
                  @endif                          
                </td>
                <td>
                  @if($cuser)
                    <div class="score">{{$r}}</div>
                  @else
                    <div class="score">-</div>
                  @endif
                </td>
                </tr>
                <tr>
                  <th scope="row">4</th>
                  <td>
                    @if($schedule->d_ == null)
                      <div class="score">-</div>
                    @else
                      @if($schedule->d_ == "投" )
                        <div class="position position1">{{$schedule->d_}}</div>
                      @elseif($schedule->d_ == "捕" )
                        <div class="position position2">{{$schedule->d_}}</div>
                      @elseif($schedule->d_ == "一"|| $schedule->d_ == "二"||$schedule->d_ == "三"||$schedule->d_ == "遊")
                        <div class="position position3">{{$schedule->d_}}</div>
                      @elseif($schedule->d_ == "左"||$schedule->d_ == "中"||$schedule->d_ == "右")
                        <div class="position position4">{{$schedule->d_}}</div>
                      @elseif($schedule->d_ == "DH")
                        <div class="position position17">{{$schedule->d_}}</div>
                      @elseif($schedule->d_ == "打"||$schedule->d_ == "走")
                        <div class="position position18">{{$schedule->d_}}</div>
                      @endif
                    @endif
                  </td>
                  <td>
                    
                    <?php
                      $duser = App\user::where('number',$schedule->dn)->first();
                      if($duser){
                      $userresults = App\Userresult::where('user_id',$duser->number)->where('y',$y)->get();
                      $a = App\Userresult::select('a')->where('user_id',$duser->number)->where('y',$y)->get();
                      $b = App\Userresult::select('b')->where('user_id',$duser->number)->where('y',$y)->get();
                      $c = App\Userresult::select('c')->where('user_id',$duser->number)->where('y',$y)->get();
                      $d = App\Userresult::select('d')->where('user_id',$duser->number)->where('y',$y)->get();
                      $e = App\Userresult::select('e')->where('user_id',$duser->number)->where('y',$y)->get();
                      $f = App\Userresult::select('f')->where('user_id',$duser->number)->where('y',$y)->get();
                      $g = App\Userresult::select('g')->where('user_id',$duser->number)->where('y',$y)->get();
                      $h = App\Userresult::select('h')->where('user_id',$duser->number)->where('y',$y)->get();
                      $i = App\Userresult::select('i')->where('user_id',$duser->number)->where('y',$y)->get();
                      $r = $userresults->sum('ar')+$userresults->sum('br')+$userresults->sum('cr')+$userresults->sum('dr')+$userresults->sum('er')+$userresults->sum('fr')+$userresults->sum('gr')+$userresults->sum('hr')+$userresults->sum('ir');
                      $hit = $a->where('a',"安")->count()+$b->where('b',"安")->count()+$c->where('c',"安")->count()+$d->where('d',"安")->count()+$e->where('e',"安")->count()+$f->where('f',"安")->count()+$g->where('g',"安")->count()+$h->where('h',"安")->count()+$i->where('i',"安")->count();
                      $two = $a->where('a',"２")->count()+$b->where('b',"２")->count()+$c->where('c',"２")->count()+$d->where('d',"２")->count()+$e->where('e',"２")->count()+$f->where('f',"２")->count()+$g->where('g',"２")->count()+$h->where('h',"２")->count()+$i->where('i',"２")->count();
                      $three = $a->where('a',"３")->count()+$b->where('b',"３")->count()+$c->where('c',"３")->count()+$d->where('d',"３")->count()+$e->where('e',"３")->count()+$f->where('f',"３")->count()+$g->where('g',"３")->count()+$h->where('h',"３")->count()+$i->where('i',"３")->count();
                      $homerun = $a->where('a',"本")->count()+$b->where('b',"本")->count()+$c->where('c',"本")->count()+$d->where('d',"本")->count()+$e->where('e',"本")->count()+$f->where('f',"本")->count()+$g->where('g',"本")->count()+$h->where('h',"本")->count()+$i->where('i',"本")->count();
                      $hits = $hit+$two+$three+$homerun;
                      $numberofatbat = $a->where('a','!==',null)->count()+$b->where('b','!==',null)->count()+$c->where('c','!==',null)->count()+$d->where('d','!==',null)->count()+$e->where('e','!==',null)->count()+$f->where('f','!==',null)->count()+$g->where('g','!==',null)->count()+$h->where('h','!==',null)->count()+$i->where('i','!==',null)->count();
                      $fourdeadball = $a->where('a',"四球")->count()+$b->where('b',"四球")->count()+$c->where('c',"四球")->count()+$d->where('d',"四球")->count()+$e->where('e',"四球")->count()+$f->where('f',"四球")->count()+$g->where('g',"四球")->count()+$h->where('h',"四球")->count()+$i->where('i',"四球")->count()+$a->where('a',"死球")->count()+$b->where('b',"死球")->count()+$c->where('c',"死球")->count()+$d->where('d',"死球")->count()+$e->where('e',"死球")->count()+$f->where('f',"死球")->count()+$g->where('g',"死球")->count()+$h->where('h',"死球")->count()+$i->where('i',"死球")->count();
                      $bant = $a->where('a',"犠")->count()+$b->where('b',"犠")->count()+$c->where('c',"犠")->count()+$d->where('d',"犠")->count()+$e->where('e',"犠")->count()+$f->where('f',"犠")->count()+$g->where('g',"犠")->count()+$h->where('h',"犠")->count()+$i->where('i',"犠")->count();
                      $sacrificefly = $a->where('a',"犠飛")->count()+$b->where('b',"犠飛")->count()+$c->where('c',"犠飛")->count()+$d->where('d',"犠飛")->count()+$e->where('e',"犠飛")->count()+$f->where('f',"犠飛")->count()+$g->where('g',"犠飛")->count()+$h->where('h',"犠飛")->count()+$i->where('i',"犠飛")->count();
                      $atbat = $numberofatbat-$fourdeadball-$bant-$sacrificefly;
                      }
                    ?>
                    @if($duser)
                        @if($duser->position == "投手" && $duser->SubPosition == null )
                          <div class="result_userName position1">{{$duser->Name}}</div>
                        @elseif($duser->position == "捕手" && $duser->SubPosition == null )
                          <div class="result_userName position2">{{$duser->Name}}</div>
                        @elseif($duser->position == "外野手" && $duser->SubPosition == null )
                          <div class="result_userName position4">{{$duser->Name}}</div>
                        @elseif($duser->position == "投手" && $duser->SubPosition == "捕手" )
                          <div class="result_userName position5">{{$duser->Name}}</div>
                        @elseif($duser->position == "投手" && $duser->SubPosition == "一塁手" || $duser->position == "投手" && $duser->SubPosition == "二塁手" || $duser->position == "投手" && $duser->SubPosition == "三塁手" || $duser->position == "投手" && $duser->SubPosition == "遊撃手" )
                          <div class="result_userName position6">{{$duser->Name}}</div>
                        @elseif($duser->position == "投手" && $duser->SubPosition == "外野手" )
                          <div class="result_userName position7">{{$duser->Name}}</div>
                        @elseif($duser->position == "捕手" && $duser->SubPosition == "投手" )
                          <div class="result_userName position8">{{$duser->Name}}</div>
                        @elseif($duser->position == "捕手" && $duser->SubPosition == "一塁手" || $duser->position == "捕手" && $duser->SubPosition == "二塁手" || $duser->position == "捕手" && $duser->SubPosition == "三塁手" || $duser->position == "捕手" && $duser->SubPosition == "遊撃手" )
                          <div class="result_userName position9">{{$duser->Name}}</div>
                        @elseif($duser->position == "捕手" && $duser->SubPosition == "外野手" )
                          <div class="result_userName position10">{{$duser->Name}}</div>
                        @elseif($duser->position == "一塁手" && $duser->SubPosition == "投手"|| $duser->position == "二塁手" && $duser->SubPosition == "投手"|| $duser->position == "三塁手" && $duser->SubPosition == "投手"|| $duser->position == "遊撃手" && $duser->SubPosition == "投手"  )
                          <div class="result_userName position11">{{$duser->Name}}</div>
                        @elseif($duser->position == "一塁手" && $duser->SubPosition == "捕手"|| $duser->position == "二塁手" && $duser->SubPosition == "捕手"|| $duser->position == "三塁手" && $duser->SubPosition == "捕手"|| $duser->position == "遊撃手" && $duser->SubPosition == "捕手"  )
                          <div class="result_userName position12">{{$duser->Name}}</div>
                        @elseif($duser->position == "一塁手" && $duser->SubPosition == "外野手"|| $duser->position == "二塁手" && $duser->SubPosition == "外野手"|| $duser->position == "三塁手" && $duser->SubPosition == "外野手"|| $duser->position == "遊撃手" && $duser->SubPosition == "外野手"  )
                          <div class="result_userName position13">{{$duser->Name}}</div>
                        @elseif($duser->position == "外野手" && $duser->SubPosition == "投手" )
                          <div class="result_userName position14">{{$duser->Name}}</div>
                        @elseif($duser->position == "外野手" && $duser->SubPosition == "捕手" )
                          <div class="result_userName position15">{{$duser->Name}}</div>
                        @elseif($duser->position == "外野手" && $duser->SubPosition == "一塁手" || $duser->position == "外野手" && $duser->SubPosition == "二塁手" || $duser->position == "外野手" && $duser->SubPosition == "三塁手" || $duser->position == "外野手" && $duser->SubPosition == "遊撃手" )
                          <div class="result_userName position16">{{$duser->Name}}</div>
                        @elseif($duser->position == "一塁手"|| $duser->position == "二塁手"|| $duser->position == "三塁手"|| $duser->position == "遊撃手"  )
                          <div class="result_userName position3">{{$duser->Name}}</div>
                        @elseif($duser->position == "マネージャー" || $duser->SubPosition == "マネージャー" )
                          <div class="result_userName position17">{{$duser->Name}}</div>
                        @endif
                    @else
                      <div class="score">---</div>
                    @endif
                </td>
                
                <td>
                  @if($duser)
                    @if($atbat)
                      <div class="score">{{number_format($hits/$atbat,3)}}</div>
                    @else
                      <div class="score">0.000</div>
                    @endif
                  @else                 
                    <div class="score">-</div>
                  @endif
                </td>
                <td>
                  @if($duser)
                    <div class="score">{{$homerun}}</div>
                  @else
                    <div class="score">-</div>
                  @endif                          
                </td>
                <td>
                  @if($duser)
                    <div class="score">{{$r}}</div>
                  @else
                    <div class="score">-</div>
                  @endif
                </td>

                </tr>
                <tr>
                  <th scope="row">5</th>
                  <td>
                    @if($schedule->e == null)
                      <div class="score">-</div>
                    @else
                      @if($schedule->e == "投" )
                        <div class="position position1">{{$schedule->e}}</div>
                      @elseif($schedule->e == "捕" )
                        <div class="position position2">{{$schedule->e}}</div>
                      @elseif($schedule->e == "一"|| $schedule->e == "二"||$schedule->e == "三"||$schedule->e == "遊")
                        <div class="position position3">{{$schedule->e}}</div>
                      @elseif($schedule->e == "左"||$schedule->e == "中"||$schedule->e == "右")
                        <div class="position position4">{{$schedule->e}}</div>
                      @elseif($schedule->e == "DH")
                        <div class="position position17">{{$schedule->e}}</div>
                      @elseif($schedule->e == "打"||$schedule->e == "走")
                        <div class="position position18">{{$schedule->e}}</div>
                      @endif
                    @endif
                  </td>
                  <td>
                    
                    <?php
                      $euser = App\user::where('number',$schedule->en)->first();
                      if($euser){
                      $userresults = App\Userresult::where('user_id',$euser->number)->where('y',$y)->get();
                      $a = App\Userresult::select('a')->where('user_id',$euser->number)->where('y',$y)->get();
                      $b = App\Userresult::select('b')->where('user_id',$euser->number)->where('y',$y)->get();
                      $c = App\Userresult::select('c')->where('user_id',$euser->number)->where('y',$y)->get();
                      $d = App\Userresult::select('d')->where('user_id',$euser->number)->where('y',$y)->get();
                      $e = App\Userresult::select('e')->where('user_id',$euser->number)->where('y',$y)->get();
                      $f = App\Userresult::select('f')->where('user_id',$euser->number)->where('y',$y)->get();
                      $g = App\Userresult::select('g')->where('user_id',$euser->number)->where('y',$y)->get();
                      $h = App\Userresult::select('h')->where('user_id',$euser->number)->where('y',$y)->get();
                      $i = App\Userresult::select('i')->where('user_id',$euser->number)->where('y',$y)->get();
                      $r = $userresults->sum('ar')+$userresults->sum('br')+$userresults->sum('cr')+$userresults->sum('dr')+$userresults->sum('er')+$userresults->sum('fr')+$userresults->sum('gr')+$userresults->sum('hr')+$userresults->sum('ir');
                      $hit = $a->where('a',"安")->count()+$b->where('b',"安")->count()+$c->where('c',"安")->count()+$d->where('d',"安")->count()+$e->where('e',"安")->count()+$f->where('f',"安")->count()+$g->where('g',"安")->count()+$h->where('h',"安")->count()+$i->where('i',"安")->count();
                      $two = $a->where('a',"２")->count()+$b->where('b',"２")->count()+$c->where('c',"２")->count()+$d->where('d',"２")->count()+$e->where('e',"２")->count()+$f->where('f',"２")->count()+$g->where('g',"２")->count()+$h->where('h',"２")->count()+$i->where('i',"２")->count();
                      $three = $a->where('a',"３")->count()+$b->where('b',"３")->count()+$c->where('c',"３")->count()+$d->where('d',"３")->count()+$e->where('e',"３")->count()+$f->where('f',"３")->count()+$g->where('g',"３")->count()+$h->where('h',"３")->count()+$i->where('i',"３")->count();
                      $homerun = $a->where('a',"本")->count()+$b->where('b',"本")->count()+$c->where('c',"本")->count()+$d->where('d',"本")->count()+$e->where('e',"本")->count()+$f->where('f',"本")->count()+$g->where('g',"本")->count()+$h->where('h',"本")->count()+$i->where('i',"本")->count();
                      $hits = $hit+$two+$three+$homerun;
                      $numberofatbat = $a->where('a','!==',null)->count()+$b->where('b','!==',null)->count()+$c->where('c','!==',null)->count()+$d->where('d','!==',null)->count()+$e->where('e','!==',null)->count()+$f->where('f','!==',null)->count()+$g->where('g','!==',null)->count()+$h->where('h','!==',null)->count()+$i->where('i','!==',null)->count();
                      $fourdeadball = $a->where('a',"四球")->count()+$b->where('b',"四球")->count()+$c->where('c',"四球")->count()+$d->where('d',"四球")->count()+$e->where('e',"四球")->count()+$f->where('f',"四球")->count()+$g->where('g',"四球")->count()+$h->where('h',"四球")->count()+$i->where('i',"四球")->count()+$a->where('a',"死球")->count()+$b->where('b',"死球")->count()+$c->where('c',"死球")->count()+$d->where('d',"死球")->count()+$e->where('e',"死球")->count()+$f->where('f',"死球")->count()+$g->where('g',"死球")->count()+$h->where('h',"死球")->count()+$i->where('i',"死球")->count();
                      $bant = $a->where('a',"犠")->count()+$b->where('b',"犠")->count()+$c->where('c',"犠")->count()+$d->where('d',"犠")->count()+$e->where('e',"犠")->count()+$f->where('f',"犠")->count()+$g->where('g',"犠")->count()+$h->where('h',"犠")->count()+$i->where('i',"犠")->count();
                      $sacrificefly = $a->where('a',"犠飛")->count()+$b->where('b',"犠飛")->count()+$c->where('c',"犠飛")->count()+$d->where('d',"犠飛")->count()+$e->where('e',"犠飛")->count()+$f->where('f',"犠飛")->count()+$g->where('g',"犠飛")->count()+$h->where('h',"犠飛")->count()+$i->where('i',"犠飛")->count();
                      $atbat = $numberofatbat-$fourdeadball-$bant-$sacrificefly;
                      }
                    ?>
                    @if($euser)
                        @if($euser->position == "投手" && $euser->SubPosition == null )
                          <div class="result_userName position1">{{$euser->Name}}</div>
                        @elseif($euser->position == "捕手" && $euser->SubPosition == null )
                          <div class="result_userName position2">{{$euser->Name}}</div>
                        @elseif($euser->position == "外野手" && $euser->SubPosition == null )
                          <div class="result_userName position4">{{$euser->Name}}</div>
                        @elseif($euser->position == "投手" && $euser->SubPosition == "捕手" )
                          <div class="result_userName position5">{{$euser->Name}}</div>
                        @elseif($euser->position == "投手" && $euser->SubPosition == "一塁手" || $euser->position == "投手" && $euser->SubPosition == "二塁手" || $euser->position == "投手" && $euser->SubPosition == "三塁手" || $euser->position == "投手" && $euser->SubPosition == "遊撃手" )
                          <div class="result_userName position6">{{$euser->Name}}</div>
                        @elseif($euser->position == "投手" && $euser->SubPosition == "外野手" )
                          <div class="result_userName position7">{{$euser->Name}}</div>
                        @elseif($euser->position == "捕手" && $euser->SubPosition == "投手" )
                          <div class="result_userName position8">{{$euser->Name}}</div>
                        @elseif($euser->position == "捕手" && $euser->SubPosition == "一塁手" || $euser->position == "捕手" && $euser->SubPosition == "二塁手" || $euser->position == "捕手" && $euser->SubPosition == "三塁手" || $euser->position == "捕手" && $euser->SubPosition == "遊撃手" )
                          <div class="result_userName position9">{{$euser->Name}}</div>
                        @elseif($euser->position == "捕手" && $euser->SubPosition == "外野手" )
                          <div class="result_userName position10">{{$euser->Name}}</div>
                        @elseif($euser->position == "一塁手" && $euser->SubPosition == "投手"|| $euser->position == "二塁手" && $euser->SubPosition == "投手"|| $euser->position == "三塁手" && $euser->SubPosition == "投手"|| $euser->position == "遊撃手" && $euser->SubPosition == "投手"  )
                          <div class="result_userName position11">{{$euser->Name}}</div>
                        @elseif($euser->position == "一塁手" && $euser->SubPosition == "捕手"|| $euser->position == "二塁手" && $euser->SubPosition == "捕手"|| $euser->position == "三塁手" && $euser->SubPosition == "捕手"|| $euser->position == "遊撃手" && $euser->SubPosition == "捕手"  )
                          <div class="result_userName position12">{{$euser->Name}}</div>
                        @elseif($euser->position == "一塁手" && $euser->SubPosition == "外野手"|| $euser->position == "二塁手" && $euser->SubPosition == "外野手"|| $euser->position == "三塁手" && $euser->SubPosition == "外野手"|| $euser->position == "遊撃手" && $euser->SubPosition == "外野手"  )
                          <div class="result_userName position13">{{$euser->Name}}</div>
                        @elseif($euser->position == "外野手" && $euser->SubPosition == "投手" )
                          <div class="result_userName position14">{{$euser->Name}}</div>
                        @elseif($euser->position == "外野手" && $euser->SubPosition == "捕手" )
                          <div class="result_userName position15">{{$euser->Name}}</div>
                        @elseif($euser->position == "外野手" && $euser->SubPosition == "一塁手" || $euser->position == "外野手" && $euser->SubPosition == "二塁手" || $euser->position == "外野手" && $euser->SubPosition == "三塁手" || $euser->position == "外野手" && $euser->SubPosition == "遊撃手" )
                          <div class="result_userName position16">{{$euser->Name}}</div>
                        @elseif($euser->position == "一塁手"|| $euser->position == "二塁手"|| $euser->position == "三塁手"|| $euser->position == "遊撃手"  )
                          <div class="result_userName position3">{{$euser->Name}}</div>
                        @elseif($euser->position == "マネージャー" || $euser->SubPosition == "マネージャー" )
                          <div class="result_userName position17">{{$euser->Name}}</div>
                        @endif
                    @else
                      <div class="score">---</div>
                  @endif
                </td>
                
                <td>
                  @if($euser)
                    @if($atbat)
                      <div class="score">{{number_format($hits/$atbat,3)}}</div>
                    @else
                      <div class="score">0.000</div>
                    @endif
                  @else                 
                    <div class="score">-</div>
                  @endif
                </td>
                <td>
                  @if($euser)
                    <div class="score">{{$homerun}}</div>
                  @else
                    <div class="score">-</div>
                  @endif                          
                </td>
                <td>
                  @if($euser)
                    <div class="score">{{$r}}</div>
                  @else
                    <div class="score">-</div>
                  @endif
                </td>
                </tr>
                <tr>
                  <th scope="row">6</th>
                  <td>
                    @if($schedule->f == null)
                      <div class="score">-</div>
                    @else
                      @if($schedule->f == "投" )
                        <div class="position position1">{{$schedule->f}}</div>
                      @elseif($schedule->f == "捕" )
                        <div class="position position2">{{$schedule->f}}</div>
                      @elseif($schedule->f == "一"|| $schedule->f == "二"||$schedule->f == "三"||$schedule->f == "遊")
                        <div class="position position3">{{$schedule->f}}</div>
                      @elseif($schedule->f == "左"||$schedule->f == "中"||$schedule->f == "右")
                        <div class="position position4">{{$schedule->f}}</div>
                      @elseif($schedule->f == "DH")
                        <div class="position position17">{{$schedule->f}}</div>
                      @elseif($schedule->f == "打"||$schedule->f == "走")
                        <div class="position position18">{{$schedule->f}}</div>
                      @endif
                    @endif
                  </td>
                  <td>
                    
                    <?php
                      $fuser = App\user::where('number',$schedule->fn)->first();
                      if($fuser){
                      $userresults = App\Userresult::where('user_id',$fuser->number)->where('y',$y)->get();
                      $a = App\Userresult::select('a')->where('user_id',$fuser->number)->where('y',$y)->get();
                      $b = App\Userresult::select('b')->where('user_id',$fuser->number)->where('y',$y)->get();
                      $c = App\Userresult::select('c')->where('user_id',$fuser->number)->where('y',$y)->get();
                      $d = App\Userresult::select('d')->where('user_id',$fuser->number)->where('y',$y)->get();
                      $e = App\Userresult::select('e')->where('user_id',$fuser->number)->where('y',$y)->get();
                      $f = App\Userresult::select('f')->where('user_id',$fuser->number)->where('y',$y)->get();
                      $g = App\Userresult::select('g')->where('user_id',$fuser->number)->where('y',$y)->get();
                      $h = App\Userresult::select('h')->where('user_id',$fuser->number)->where('y',$y)->get();
                      $i = App\Userresult::select('i')->where('user_id',$fuser->number)->where('y',$y)->get();
                      $r = $userresults->sum('ar')+$userresults->sum('br')+$userresults->sum('cr')+$userresults->sum('dr')+$userresults->sum('er')+$userresults->sum('fr')+$userresults->sum('gr')+$userresults->sum('hr')+$userresults->sum('ir');
                      $hit = $a->where('a',"安")->count()+$b->where('b',"安")->count()+$c->where('c',"安")->count()+$d->where('d',"安")->count()+$e->where('e',"安")->count()+$f->where('f',"安")->count()+$g->where('g',"安")->count()+$h->where('h',"安")->count()+$i->where('i',"安")->count();
                      $two = $a->where('a',"２")->count()+$b->where('b',"２")->count()+$c->where('c',"２")->count()+$d->where('d',"２")->count()+$e->where('e',"２")->count()+$f->where('f',"２")->count()+$g->where('g',"２")->count()+$h->where('h',"２")->count()+$i->where('i',"２")->count();
                      $three = $a->where('a',"３")->count()+$b->where('b',"３")->count()+$c->where('c',"３")->count()+$d->where('d',"３")->count()+$e->where('e',"３")->count()+$f->where('f',"３")->count()+$g->where('g',"３")->count()+$h->where('h',"３")->count()+$i->where('i',"３")->count();
                      $homerun = $a->where('a',"本")->count()+$b->where('b',"本")->count()+$c->where('c',"本")->count()+$d->where('d',"本")->count()+$e->where('e',"本")->count()+$f->where('f',"本")->count()+$g->where('g',"本")->count()+$h->where('h',"本")->count()+$i->where('i',"本")->count();
                      $hits = $hit+$two+$three+$homerun;
                      $numberofatbat = $a->where('a','!==',null)->count()+$b->where('b','!==',null)->count()+$c->where('c','!==',null)->count()+$d->where('d','!==',null)->count()+$e->where('e','!==',null)->count()+$f->where('f','!==',null)->count()+$g->where('g','!==',null)->count()+$h->where('h','!==',null)->count()+$i->where('i','!==',null)->count();
                      $fourdeadball = $a->where('a',"四球")->count()+$b->where('b',"四球")->count()+$c->where('c',"四球")->count()+$d->where('d',"四球")->count()+$e->where('e',"四球")->count()+$f->where('f',"四球")->count()+$g->where('g',"四球")->count()+$h->where('h',"四球")->count()+$i->where('i',"四球")->count()+$a->where('a',"死球")->count()+$b->where('b',"死球")->count()+$c->where('c',"死球")->count()+$d->where('d',"死球")->count()+$e->where('e',"死球")->count()+$f->where('f',"死球")->count()+$g->where('g',"死球")->count()+$h->where('h',"死球")->count()+$i->where('i',"死球")->count();
                      $bant = $a->where('a',"犠")->count()+$b->where('b',"犠")->count()+$c->where('c',"犠")->count()+$d->where('d',"犠")->count()+$e->where('e',"犠")->count()+$f->where('f',"犠")->count()+$g->where('g',"犠")->count()+$h->where('h',"犠")->count()+$i->where('i',"犠")->count();
                      $sacrificefly = $a->where('a',"犠飛")->count()+$b->where('b',"犠飛")->count()+$c->where('c',"犠飛")->count()+$d->where('d',"犠飛")->count()+$e->where('e',"犠飛")->count()+$f->where('f',"犠飛")->count()+$g->where('g',"犠飛")->count()+$h->where('h',"犠飛")->count()+$i->where('i',"犠飛")->count();
                      $atbat = $numberofatbat-$fourdeadball-$bant-$sacrificefly;
                      }                    
                    ?>
                    @if($fuser)
                      @if($fuser->position == "投手" && $fuser->SubPosition == null )
                        <div class="result_userName position1">{{$fuser->Name}}</div>
                      @elseif($fuser->position == "捕手" && $fuser->SubPosition == null )
                        <div class="result_userName position2">{{$fuser->Name}}</div>
                      @elseif($fuser->position == "外野手" && $fuser->SubPosition == null )
                        <div class="result_userName position4">{{$fuser->Name}}</div>
                      @elseif($fuser->position == "投手" && $fuser->SubPosition == "捕手" )
                        <div class="result_userName position5">{{$fuser->Name}}</div>
                      @elseif($fuser->position == "投手" && $fuser->SubPosition == "一塁手" || $fuser->position == "投手" && $fuser->SubPosition == "二塁手" || $fuser->position == "投手" && $fuser->SubPosition == "三塁手" || $fuser->position == "投手" && $fuser->SubPosition == "遊撃手" )
                        <div class="result_userName position6">{{$fuser->Name}}</div>
                      @elseif($fuser->position == "投手" && $fuser->SubPosition == "外野手" )
                        <div class="result_userName position7">{{$fuser->Name}}</div>
                      @elseif($fuser->position == "捕手" && $fuser->SubPosition == "投手" )
                        <div class="result_userName position8">{{$fuser->Name}}</div>
                      @elseif($fuser->position == "捕手" && $fuser->SubPosition == "一塁手" || $fuser->position == "捕手" && $fuser->SubPosition == "二塁手" || $fuser->position == "捕手" && $fuser->SubPosition == "三塁手" || $fuser->position == "捕手" && $fuser->SubPosition == "遊撃手" )
                        <div class="result_userName position9">{{$fuser->Name}}</div>
                      @elseif($fuser->position == "捕手" && $fuser->SubPosition == "外野手" )
                        <div class="result_userName position10">{{$fuser->Name}}</div>
                      @elseif($fuser->position == "一塁手" && $fuser->SubPosition == "投手"|| $fuser->position == "二塁手" && $fuser->SubPosition == "投手"|| $fuser->position == "三塁手" && $fuser->SubPosition == "投手"|| $fuser->position == "遊撃手" && $fuser->SubPosition == "投手"  )
                        <div class="result_userName position11">{{$fuser->Name}}</div>
                      @elseif($fuser->position == "一塁手" && $fuser->SubPosition == "捕手"|| $fuser->position == "二塁手" && $fuser->SubPosition == "捕手"|| $fuser->position == "三塁手" && $fuser->SubPosition == "捕手"|| $fuser->position == "遊撃手" && $fuser->SubPosition == "捕手"  )
                        <div class="result_userName position12">{{$fuser->Name}}</div>
                      @elseif($fuser->position == "一塁手" && $fuser->SubPosition == "外野手"|| $fuser->position == "二塁手" && $fuser->SubPosition == "外野手"|| $fuser->position == "三塁手" && $fuser->SubPosition == "外野手"|| $fuser->position == "遊撃手" && $fuser->SubPosition == "外野手"  )
                        <div class="result_userName position13">{{$fuser->Name}}</div>
                      @elseif($fuser->position == "外野手" && $fuser->SubPosition == "投手" )
                        <div class="result_userName position14">{{$fuser->Name}}</div>
                      @elseif($fuser->position == "外野手" && $fuser->SubPosition == "捕手" )
                        <div class="result_userName position15">{{$fuser->Name}}</div>
                      @elseif($fuser->position == "外野手" && $fuser->SubPosition == "一塁手" || $fuser->position == "外野手" && $fuser->SubPosition == "二塁手" || $fuser->position == "外野手" && $fuser->SubPosition == "三塁手" || $fuser->position == "外野手" && $fuser->SubPosition == "遊撃手" )
                        <div class="result_userName position16">{{$fuser->Name}}</div>
                      @elseif($fuser->position == "一塁手"|| $fuser->position == "二塁手"|| $fuser->position == "三塁手"|| $fuser->position == "遊撃手"  )
                        <div class="result_userName position3">{{$fuser->Name}}</div>
                      @elseif($fuser->position == "マネージャー" || $fuser->SubPosition == "マネージャー" )
                        <div class="result_userName position17">{{$fuser->Name}}</div>
                      @endif
                    @else
                      <div class="score">---</div>
                    @endif
                </td>
                
                <td>
                  @if($fuser)
                    @if($atbat)
                      <div class="score">{{number_format($hits/$atbat,3)}}</div>
                    @else
                      <div class="score">0.000</div>
                    @endif
                  @else                 
                    <div class="score">-</div>
                  @endif
                </td>
                <td>
                  @if($fuser)
                    <div class="score">{{$homerun}}</div>
                  @else
                    <div class="score">-</div>
                  @endif                          
                </td>
                <td>
                  @if($fuser)
                    <div class="score">{{$r}}</div>
                  @else
                    <div class="score">-</div>
                  @endif
                </td>

                </tr>
                <tr>
                  <th scope="row">7</th>
                  <td>
                    @if($schedule->g == null)
                      <div class="score">-</div>
                    @else
                      @if($schedule->g == "投" )
                        <div class="position position1">{{$schedule->g}}</div>
                      @elseif($schedule->g == "捕" )
                        <div class="position position2">{{$schedule->g}}</div>
                      @elseif($schedule->g == "一"|| $schedule->g == "二"||$schedule->g == "三"||$schedule->g == "遊")
                        <div class="position position3">{{$schedule->g}}</div>
                      @elseif($schedule->g == "左"||$schedule->g == "中"||$schedule->g == "右")
                        <div class="position position4">{{$schedule->g}}</div>
                      @elseif($schedule->g == "DH")
                        <div class="position position17">{{$schedule->g}}</div>
                      @elseif($schedule->g == "打"||$schedule->g == "走")
                        <div class="position position18">{{$schedule->g}}</div>
                      @endif
                    @endif
                  </td>
                  <td>
                    
                    <?php
                      $guser = App\user::where('number',$schedule->gn)->first();
                      if($guser){
                      $userresults = App\Userresult::where('user_id',$guser->number)->where('y',$y)->get();
                      $a = App\Userresult::select('a')->where('user_id',$guser->number)->where('y',$y)->get();
                      $b = App\Userresult::select('b')->where('user_id',$guser->number)->where('y',$y)->get();
                      $c = App\Userresult::select('c')->where('user_id',$guser->number)->where('y',$y)->get();
                      $d = App\Userresult::select('d')->where('user_id',$guser->number)->where('y',$y)->get();
                      $e = App\Userresult::select('e')->where('user_id',$guser->number)->where('y',$y)->get();
                      $f = App\Userresult::select('f')->where('user_id',$guser->number)->where('y',$y)->get();
                      $g = App\Userresult::select('g')->where('user_id',$guser->number)->where('y',$y)->get();
                      $h = App\Userresult::select('h')->where('user_id',$guser->number)->where('y',$y)->get();
                      $i = App\Userresult::select('i')->where('user_id',$guser->number)->where('y',$y)->get();
                      $r = $userresults->sum('ar')+$userresults->sum('br')+$userresults->sum('cr')+$userresults->sum('dr')+$userresults->sum('er')+$userresults->sum('fr')+$userresults->sum('gr')+$userresults->sum('hr')+$userresults->sum('ir');
                      $hit = $a->where('a',"安")->count()+$b->where('b',"安")->count()+$c->where('c',"安")->count()+$d->where('d',"安")->count()+$e->where('e',"安")->count()+$f->where('f',"安")->count()+$g->where('g',"安")->count()+$h->where('h',"安")->count()+$i->where('i',"安")->count();
                      $two = $a->where('a',"２")->count()+$b->where('b',"２")->count()+$c->where('c',"２")->count()+$d->where('d',"２")->count()+$e->where('e',"２")->count()+$f->where('f',"２")->count()+$g->where('g',"２")->count()+$h->where('h',"２")->count()+$i->where('i',"２")->count();
                      $three = $a->where('a',"３")->count()+$b->where('b',"３")->count()+$c->where('c',"３")->count()+$d->where('d',"３")->count()+$e->where('e',"３")->count()+$f->where('f',"３")->count()+$g->where('g',"３")->count()+$h->where('h',"３")->count()+$i->where('i',"３")->count();
                      $homerun = $a->where('a',"本")->count()+$b->where('b',"本")->count()+$c->where('c',"本")->count()+$d->where('d',"本")->count()+$e->where('e',"本")->count()+$f->where('f',"本")->count()+$g->where('g',"本")->count()+$h->where('h',"本")->count()+$i->where('i',"本")->count();
                      $hits = $hit+$two+$three+$homerun;
                      $numberofatbat = $a->where('a','!==',null)->count()+$b->where('b','!==',null)->count()+$c->where('c','!==',null)->count()+$d->where('d','!==',null)->count()+$e->where('e','!==',null)->count()+$f->where('f','!==',null)->count()+$g->where('g','!==',null)->count()+$h->where('h','!==',null)->count()+$i->where('i','!==',null)->count();
                      $fourdeadball = $a->where('a',"四球")->count()+$b->where('b',"四球")->count()+$c->where('c',"四球")->count()+$d->where('d',"四球")->count()+$e->where('e',"四球")->count()+$f->where('f',"四球")->count()+$g->where('g',"四球")->count()+$h->where('h',"四球")->count()+$i->where('i',"四球")->count()+$a->where('a',"死球")->count()+$b->where('b',"死球")->count()+$c->where('c',"死球")->count()+$d->where('d',"死球")->count()+$e->where('e',"死球")->count()+$f->where('f',"死球")->count()+$g->where('g',"死球")->count()+$h->where('h',"死球")->count()+$i->where('i',"死球")->count();
                      $bant = $a->where('a',"犠")->count()+$b->where('b',"犠")->count()+$c->where('c',"犠")->count()+$d->where('d',"犠")->count()+$e->where('e',"犠")->count()+$f->where('f',"犠")->count()+$g->where('g',"犠")->count()+$h->where('h',"犠")->count()+$i->where('i',"犠")->count();
                      $sacrificefly = $a->where('a',"犠飛")->count()+$b->where('b',"犠飛")->count()+$c->where('c',"犠飛")->count()+$d->where('d',"犠飛")->count()+$e->where('e',"犠飛")->count()+$f->where('f',"犠飛")->count()+$g->where('g',"犠飛")->count()+$h->where('h',"犠飛")->count()+$i->where('i',"犠飛")->count();
                      $atbat = $numberofatbat-$fourdeadball-$bant-$sacrificefly;
                      }
                    ?>
                    @if($guser)
                      @if($guser->position == "投手" && $guser->SubPosition == null )
                        <div class="result_userName position1">{{$guser->Name}}</div>
                      @elseif($guser->position == "捕手" && $guser->SubPosition == null )
                        <div class="result_userName position2">{{$guser->Name}}</div>
                      @elseif($guser->position == "外野手" && $guser->SubPosition == null )
                        <div class="result_userName position4">{{$guser->Name}}</div>
                      @elseif($guser->position == "投手" && $guser->SubPosition == "捕手" )
                        <div class="result_userName position5">{{$guser->Name}}</div>
                      @elseif($guser->position == "投手" && $guser->SubPosition == "一塁手" || $guser->position == "投手" && $guser->SubPosition == "二塁手" || $guser->position == "投手" && $guser->SubPosition == "三塁手" || $guser->position == "投手" && $guser->SubPosition == "遊撃手" )
                        <div class="result_userName position6">{{$guser->Name}}</div>
                      @elseif($guser->position == "投手" && $guser->SubPosition == "外野手" )
                        <div class="result_userName position7">{{$guser->Name}}</div>
                      @elseif($guser->position == "捕手" && $guser->SubPosition == "投手" )
                        <div class="result_userName position8">{{$guser->Name}}</div>
                      @elseif($guser->position == "捕手" && $guser->SubPosition == "一塁手" || $guser->position == "捕手" && $guser->SubPosition == "二塁手" || $guser->position == "捕手" && $guser->SubPosition == "三塁手" || $guser->position == "捕手" && $guser->SubPosition == "遊撃手" )
                        <div class="result_userName position9">{{$guser->Name}}</div>
                      @elseif($guser->position == "捕手" && $guser->SubPosition == "外野手" )
                        <div class="result_userName position10">{{$guser->Name}}</div>
                      @elseif($guser->position == "一塁手" && $guser->SubPosition == "投手"|| $guser->position == "二塁手" && $guser->SubPosition == "投手"|| $guser->position == "三塁手" && $guser->SubPosition == "投手"|| $guser->position == "遊撃手" && $guser->SubPosition == "投手"  )
                        <div class="result_userName position11">{{$guser->Name}}</div>
                      @elseif($guser->position == "一塁手" && $guser->SubPosition == "捕手"|| $guser->position == "二塁手" && $guser->SubPosition == "捕手"|| $guser->position == "三塁手" && $guser->SubPosition == "捕手"|| $guser->position == "遊撃手" && $guser->SubPosition == "捕手"  )
                        <div class="result_userName position12">{{$guser->Name}}</div>
                      @elseif($guser->position == "一塁手" && $guser->SubPosition == "外野手"|| $guser->position == "二塁手" && $guser->SubPosition == "外野手"|| $guser->position == "三塁手" && $guser->SubPosition == "外野手"|| $guser->position == "遊撃手" && $guser->SubPosition == "外野手"  )
                        <div class="result_userName position13">{{$guser->Name}}</div>
                      @elseif($guser->position == "外野手" && $guser->SubPosition == "投手" )
                        <div class="result_userName position14">{{$guser->Name}}</div>
                      @elseif($guser->position == "外野手" && $guser->SubPosition == "捕手" )
                        <div class="result_userName position15">{{$guser->Name}}</div>
                      @elseif($guser->position == "外野手" && $guser->SubPosition == "一塁手" || $guser->position == "外野手" && $guser->SubPosition == "二塁手" || $guser->position == "外野手" && $guser->SubPosition == "三塁手" || $guser->position == "外野手" && $guser->SubPosition == "遊撃手" )
                        <div class="result_userName position16">{{$guser->Name}}</div>
                      @elseif($guser->position == "一塁手"|| $guser->position == "二塁手"|| $guser->position == "三塁手"|| $guser->position == "遊撃手"  )
                        <div class="result_userName position3">{{$guser->Name}}</div>
                      @elseif($guser->position == "マネージャー" || $guser->SubPosition == "マネージャー" )
                        <div class="result_userName position17">{{$guser->Name}}</div>
                      @endif
                    @else
                      <div class="score">---</div>
                    @endif
                </td>
                
                <td>
                  @if($guser)
                    @if($atbat)
                      <div class="score">{{number_format($hits/$atbat,3)}}</div>
                    @else
                      <div class="score">0.000</div>
                    @endif
                  @else                 
                    <div class="score">-</div>
                  @endif
                </td>
                <td>
                  @if($guser)
                    <div class="score">{{$homerun}}</div>
                  @else
                    <div class="score">-</div>
                  @endif                          
                </td>
                <td>
                  @if($guser)
                    <div class="score">{{$r}}</div>
                  @else
                    <div class="score">-</div>
                  @endif
                </td>

                </tr>
                <tr>
                  <th scope="row">8</th>
                  <td>
                    @if($schedule->h == null)
                      <div class="score">-</div>
                    @else
                      @if($schedule->h == "投" )
                        <div class="position position1">{{$schedule->h}}</div>
                      @elseif($schedule->h == "捕" )
                        <div class="position position2">{{$schedule->h}}</div>
                      @elseif($schedule->h == "一"|| $schedule->h == "二"||$schedule->h == "三"||$schedule->h == "遊")
                        <div class="position position3">{{$schedule->h}}</div>
                      @elseif($schedule->h == "左"||$schedule->h == "中"||$schedule->h == "右")
                        <div class="position position4">{{$schedule->h}}</div>
                      @elseif($schedule->h == "DH")
                        <div class="position position17">{{$schedule->h}}</div>
                      @elseif($schedule->h == "打"||$schedule->h == "走")
                        <div class="position position18">{{$schedule->h}}</div>
                      @endif
                    @endif
                  </td>
                  <td>
                    
                    <?php
                      $huser = App\user::where('number',$schedule->hn)->first();
                      if($huser){
                      $userresults = App\Userresult::where('user_id',$huser->number)->where('y',$y)->get();
                      $a = App\Userresult::select('a')->where('user_id',$huser->number)->where('y',$y)->get();
                      $b = App\Userresult::select('b')->where('user_id',$huser->number)->where('y',$y)->get();
                      $c = App\Userresult::select('c')->where('user_id',$huser->number)->where('y',$y)->get();
                      $d = App\Userresult::select('d')->where('user_id',$huser->number)->where('y',$y)->get();
                      $e = App\Userresult::select('e')->where('user_id',$huser->number)->where('y',$y)->get();
                      $f = App\Userresult::select('f')->where('user_id',$huser->number)->where('y',$y)->get();
                      $g = App\Userresult::select('g')->where('user_id',$huser->number)->where('y',$y)->get();
                      $h = App\Userresult::select('h')->where('user_id',$huser->number)->where('y',$y)->get();
                      $i = App\Userresult::select('i')->where('user_id',$huser->number)->where('y',$y)->get();
                      $r = $userresults->sum('ar')+$userresults->sum('br')+$userresults->sum('cr')+$userresults->sum('dr')+$userresults->sum('er')+$userresults->sum('fr')+$userresults->sum('gr')+$userresults->sum('hr')+$userresults->sum('ir');
                      $hit = $a->where('a',"安")->count()+$b->where('b',"安")->count()+$c->where('c',"安")->count()+$d->where('d',"安")->count()+$e->where('e',"安")->count()+$f->where('f',"安")->count()+$g->where('g',"安")->count()+$h->where('h',"安")->count()+$i->where('i',"安")->count();
                      $two = $a->where('a',"２")->count()+$b->where('b',"２")->count()+$c->where('c',"２")->count()+$d->where('d',"２")->count()+$e->where('e',"２")->count()+$f->where('f',"２")->count()+$g->where('g',"２")->count()+$h->where('h',"２")->count()+$i->where('i',"２")->count();
                      $three = $a->where('a',"３")->count()+$b->where('b',"３")->count()+$c->where('c',"３")->count()+$d->where('d',"３")->count()+$e->where('e',"３")->count()+$f->where('f',"３")->count()+$g->where('g',"３")->count()+$h->where('h',"３")->count()+$i->where('i',"３")->count();
                      $homerun = $a->where('a',"本")->count()+$b->where('b',"本")->count()+$c->where('c',"本")->count()+$d->where('d',"本")->count()+$e->where('e',"本")->count()+$f->where('f',"本")->count()+$g->where('g',"本")->count()+$h->where('h',"本")->count()+$i->where('i',"本")->count();
                      $hits = $hit+$two+$three+$homerun;
                      $numberofatbat = $a->where('a','!==',null)->count()+$b->where('b','!==',null)->count()+$c->where('c','!==',null)->count()+$d->where('d','!==',null)->count()+$e->where('e','!==',null)->count()+$f->where('f','!==',null)->count()+$g->where('g','!==',null)->count()+$h->where('h','!==',null)->count()+$i->where('i','!==',null)->count();
                      $fourdeadball = $a->where('a',"四球")->count()+$b->where('b',"四球")->count()+$c->where('c',"四球")->count()+$d->where('d',"四球")->count()+$e->where('e',"四球")->count()+$f->where('f',"四球")->count()+$g->where('g',"四球")->count()+$h->where('h',"四球")->count()+$i->where('i',"四球")->count()+$a->where('a',"死球")->count()+$b->where('b',"死球")->count()+$c->where('c',"死球")->count()+$d->where('d',"死球")->count()+$e->where('e',"死球")->count()+$f->where('f',"死球")->count()+$g->where('g',"死球")->count()+$h->where('h',"死球")->count()+$i->where('i',"死球")->count();
                      $bant = $a->where('a',"犠")->count()+$b->where('b',"犠")->count()+$c->where('c',"犠")->count()+$d->where('d',"犠")->count()+$e->where('e',"犠")->count()+$f->where('f',"犠")->count()+$g->where('g',"犠")->count()+$h->where('h',"犠")->count()+$i->where('i',"犠")->count();
                      $sacrificefly = $a->where('a',"犠飛")->count()+$b->where('b',"犠飛")->count()+$c->where('c',"犠飛")->count()+$d->where('d',"犠飛")->count()+$e->where('e',"犠飛")->count()+$f->where('f',"犠飛")->count()+$g->where('g',"犠飛")->count()+$h->where('h',"犠飛")->count()+$i->where('i',"犠飛")->count();
                      $atbat = $numberofatbat-$fourdeadball-$bant-$sacrificefly;
                      }
                    ?>
                    @if($huser)
                      @if($huser->position == "投手" && $huser->SubPosition == null )
                        <div class="result_userName position1">{{$huser->Name}}</div>
                      @elseif($huser->position == "捕手" && $huser->SubPosition == null )
                        <div class="result_userName position2">{{$huser->Name}}</div>
                      @elseif($huser->position == "外野手" && $huser->SubPosition == null )
                        <div class="result_userName position4">{{$huser->Name}}</div>
                      @elseif($huser->position == "投手" && $huser->SubPosition == "捕手" )
                        <div class="result_userName position5">{{$huser->Name}}</div>
                      @elseif($huser->position == "投手" && $huser->SubPosition == "一塁手" || $huser->position == "投手" && $huser->SubPosition == "二塁手" || $huser->position == "投手" && $huser->SubPosition == "三塁手" || $huser->position == "投手" && $huser->SubPosition == "遊撃手" )
                        <div class="result_userName position6">{{$huser->Name}}</div>
                      @elseif($huser->position == "投手" && $huser->SubPosition == "外野手" )
                        <div class="result_userName position7">{{$huser->Name}}</div>
                      @elseif($huser->position == "捕手" && $huser->SubPosition == "投手" )
                        <div class="result_userName position8">{{$huser->Name}}</div>
                      @elseif($huser->position == "捕手" && $huser->SubPosition == "一塁手" || $huser->position == "捕手" && $huser->SubPosition == "二塁手" || $huser->position == "捕手" && $huser->SubPosition == "三塁手" || $huser->position == "捕手" && $huser->SubPosition == "遊撃手" )
                        <div class="result_userName position9">{{$huser->Name}}</div>
                      @elseif($huser->position == "捕手" && $huser->SubPosition == "外野手" )
                        <div class="result_userName position10">{{$huser->Name}}</div>
                      @elseif($huser->position == "一塁手" && $huser->SubPosition == "投手"|| $huser->position == "二塁手" && $huser->SubPosition == "投手"|| $huser->position == "三塁手" && $huser->SubPosition == "投手"|| $huser->position == "遊撃手" && $huser->SubPosition == "投手"  )
                        <div class="result_userName position11">{{$huser->Name}}</div>
                      @elseif($huser->position == "一塁手" && $huser->SubPosition == "捕手"|| $huser->position == "二塁手" && $huser->SubPosition == "捕手"|| $huser->position == "三塁手" && $huser->SubPosition == "捕手"|| $huser->position == "遊撃手" && $huser->SubPosition == "捕手"  )
                        <div class="result_userName position12">{{$huser->Name}}</div>
                      @elseif($huser->position == "一塁手" && $huser->SubPosition == "外野手"|| $huser->position == "二塁手" && $huser->SubPosition == "外野手"|| $huser->position == "三塁手" && $huser->SubPosition == "外野手"|| $huser->position == "遊撃手" && $huser->SubPosition == "外野手"  )
                        <div class="result_userName position13">{{$huser->Name}}</div>
                      @elseif($huser->position == "外野手" && $huser->SubPosition == "投手" )
                        <div class="result_userName position14">{{$huser->Name}}</div>
                      @elseif($huser->position == "外野手" && $huser->SubPosition == "捕手" )
                        <div class="result_userName position15">{{$huser->Name}}</div>
                      @elseif($huser->position == "外野手" && $huser->SubPosition == "一塁手" || $huser->position == "外野手" && $huser->SubPosition == "二塁手" || $huser->position == "外野手" && $huser->SubPosition == "三塁手" || $huser->position == "外野手" && $huser->SubPosition == "遊撃手" )
                        <div class="result_userName position16">{{$huser->Name}}</div>
                      @elseif($huser->position == "一塁手"|| $huser->position == "二塁手"|| $huser->position == "三塁手"|| $huser->position == "遊撃手"  )
                        <div class="result_userName position3">{{$huser->Name}}</div>
                      @elseif($huser->position == "マネージャー" || $huser->SubPosition == "マネージャー" )
                        <div class="result_userName position17">{{$huser->Name}}</div>
                      @endif
                    @else
                      <div class="score">---</div>
                    @endif
                </td>
                
                <td>
                  @if($huser)
                    @if($atbat)
                      <div class="score">{{number_format($hits/$atbat,3)}}</div>
                    @else
                      <div class="score">0.000</div>
                    @endif
                  @else                 
                    <div class="score">-</div>
                  @endif
                </td>
                <td>
                  @if($huser)
                    <div class="score">{{$homerun}}</div>
                  @else
                    <div class="score">-</div>
                  @endif                          
                </td>
                <td>
                  @if($huser)
                    <div class="score">{{$r}}</div>
                  @else
                    <div class="score">-</div>
                  @endif
                </td>

                </tr>
                <tr>
                  <th scope="row">9</th>
                  <td>
                    @if($schedule->i == null)
                      <div class="score">-</div>
                    @else
                      @if($schedule->i == "投" )
                        <div class="position position1">{{$schedule->i}}</div>
                      @elseif($schedule->i == "捕" )
                        <div class="position position2">{{$schedule->i}}</div>
                      @elseif($schedule->i == "一"|| $schedule->i == "二"||$schedule->i == "三"||$schedule->i == "遊")
                        <div class="position position3">{{$schedule->i}}</div>
                      @elseif($schedule->i == "左"||$schedule->i == "中"||$schedule->i == "右")
                        <div class="position position4">{{$schedule->i}}</div>
                      @elseif($schedule->i == "DH")
                        <div class="position position17">{{$schedule->i}}</div>
                      @elseif($schedule->i == "打"||$schedule->i == "走")
                        <div class="position position18">{{$schedule->i}}</div>
                      @endif
                    @endif
                  </td>
                  <td>                  
                    <?php
                      $iuser = App\user::where('number',$schedule->i_n)->first();
                      if($iuser){
                      $userresults = App\Userresult::where('user_id',$iuser->number)->where('y',$y)->get();
                      $a = App\Userresult::select('a')->where('user_id',$iuser->number)->where('y',$y)->get();
                      $b = App\Userresult::select('b')->where('user_id',$iuser->number)->where('y',$y)->get();
                      $c = App\Userresult::select('c')->where('user_id',$iuser->number)->where('y',$y)->get();
                      $d = App\Userresult::select('d')->where('user_id',$iuser->number)->where('y',$y)->get();
                      $e = App\Userresult::select('e')->where('user_id',$iuser->number)->where('y',$y)->get();
                      $f = App\Userresult::select('f')->where('user_id',$iuser->number)->where('y',$y)->get();
                      $g = App\Userresult::select('g')->where('user_id',$iuser->number)->where('y',$y)->get();
                      $h = App\Userresult::select('h')->where('user_id',$iuser->number)->where('y',$y)->get();
                      $i = App\Userresult::select('i')->where('user_id',$iuser->number)->where('y',$y)->get();
                      $r = $userresults->sum('ar')+$userresults->sum('br')+$userresults->sum('cr')+$userresults->sum('dr')+$userresults->sum('er')+$userresults->sum('fr')+$userresults->sum('gr')+$userresults->sum('hr')+$userresults->sum('ir');
                      $hit = $a->where('a',"安")->count()+$b->where('b',"安")->count()+$c->where('c',"安")->count()+$d->where('d',"安")->count()+$e->where('e',"安")->count()+$f->where('f',"安")->count()+$g->where('g',"安")->count()+$h->where('h',"安")->count()+$i->where('i',"安")->count();
                      $two = $a->where('a',"２")->count()+$b->where('b',"２")->count()+$c->where('c',"２")->count()+$d->where('d',"２")->count()+$e->where('e',"２")->count()+$f->where('f',"２")->count()+$g->where('g',"２")->count()+$h->where('h',"２")->count()+$i->where('i',"２")->count();
                      $three = $a->where('a',"３")->count()+$b->where('b',"３")->count()+$c->where('c',"３")->count()+$d->where('d',"３")->count()+$e->where('e',"３")->count()+$f->where('f',"３")->count()+$g->where('g',"３")->count()+$h->where('h',"３")->count()+$i->where('i',"３")->count();
                      $homerun = $a->where('a',"本")->count()+$b->where('b',"本")->count()+$c->where('c',"本")->count()+$d->where('d',"本")->count()+$e->where('e',"本")->count()+$f->where('f',"本")->count()+$g->where('g',"本")->count()+$h->where('h',"本")->count()+$i->where('i',"本")->count();
                      $hits = $hit+$two+$three+$homerun;
                      $numberofatbat = $a->where('a','!==',null)->count()+$b->where('b','!==',null)->count()+$c->where('c','!==',null)->count()+$d->where('d','!==',null)->count()+$e->where('e','!==',null)->count()+$f->where('f','!==',null)->count()+$g->where('g','!==',null)->count()+$h->where('h','!==',null)->count()+$i->where('i','!==',null)->count();
                      $fourdeadball = $a->where('a',"四球")->count()+$b->where('b',"四球")->count()+$c->where('c',"四球")->count()+$d->where('d',"四球")->count()+$e->where('e',"四球")->count()+$f->where('f',"四球")->count()+$g->where('g',"四球")->count()+$h->where('h',"四球")->count()+$i->where('i',"四球")->count()+$a->where('a',"死球")->count()+$b->where('b',"死球")->count()+$c->where('c',"死球")->count()+$d->where('d',"死球")->count()+$e->where('e',"死球")->count()+$f->where('f',"死球")->count()+$g->where('g',"死球")->count()+$h->where('h',"死球")->count()+$i->where('i',"死球")->count();
                      $bant = $a->where('a',"犠")->count()+$b->where('b',"犠")->count()+$c->where('c',"犠")->count()+$d->where('d',"犠")->count()+$e->where('e',"犠")->count()+$f->where('f',"犠")->count()+$g->where('g',"犠")->count()+$h->where('h',"犠")->count()+$i->where('i',"犠")->count();
                      $sacrificefly = $a->where('a',"犠飛")->count()+$b->where('b',"犠飛")->count()+$c->where('c',"犠飛")->count()+$d->where('d',"犠飛")->count()+$e->where('e',"犠飛")->count()+$f->where('f',"犠飛")->count()+$g->where('g',"犠飛")->count()+$h->where('h',"犠飛")->count()+$i->where('i',"犠飛")->count();
                      $atbat = $numberofatbat-$fourdeadball-$bant-$sacrificefly;
                      }
                    ?>
                    @if($iuser)
                      @if($iuser->position == "投手" && $iuser->SubPosition == null )
                        <div class="result_userName position1">{{$iuser->Name}}</div>
                      @elseif($iuser->position == "捕手" && $iuser->SubPosition == null )
                        <div class="result_userName position2">{{$iuser->Name}}</div>
                      @elseif($iuser->position == "外野手" && $iuser->SubPosition == null )
                        <div class="result_userName position4">{{$iuser->Name}}</div>
                      @elseif($iuser->position == "投手" && $iuser->SubPosition == "捕手" )
                        <div class="result_userName position5">{{$iuser->Name}}</div>
                      @elseif($iuser->position == "投手" && $iuser->SubPosition == "一塁手" || $iuser->position == "投手" && $iuser->SubPosition == "二塁手" || $iuser->position == "投手" && $iuser->SubPosition == "三塁手" || $iuser->position == "投手" && $iuser->SubPosition == "遊撃手" )
                        <div class="result_userName position6">{{$iuser->Name}}</div>
                      @elseif($iuser->position == "投手" && $iuser->SubPosition == "外野手" )
                        <div class="result_userName position7">{{$iuser->Name}}</div>
                      @elseif($iuser->position == "捕手" && $iuser->SubPosition == "投手" )
                        <div class="result_userName position8">{{$iuser->Name}}</div>
                      @elseif($iuser->position == "捕手" && $iuser->SubPosition == "一塁手" || $iuser->position == "捕手" && $iuser->SubPosition == "二塁手" || $iuser->position == "捕手" && $iuser->SubPosition == "三塁手" || $iuser->position == "捕手" && $iuser->SubPosition == "遊撃手" )
                        <div class="result_userName position9">{{$iuser->Name}}</div>
                      @elseif($iuser->position == "捕手" && $iuser->SubPosition == "外野手" )
                        <div class="result_userName position10">{{$iuser->Name}}</div>
                      @elseif($iuser->position == "一塁手" && $iuser->SubPosition == "投手"|| $iuser->position == "二塁手" && $iuser->SubPosition == "投手"|| $iuser->position == "三塁手" && $iuser->SubPosition == "投手"|| $iuser->position == "遊撃手" && $iuser->SubPosition == "投手"  )
                        <div class="result_userName position11">{{$iuser->Name}}</div>
                      @elseif($iuser->position == "一塁手" && $iuser->SubPosition == "捕手"|| $iuser->position == "二塁手" && $iuser->SubPosition == "捕手"|| $iuser->position == "三塁手" && $iuser->SubPosition == "捕手"|| $iuser->position == "遊撃手" && $iuser->SubPosition == "捕手"  )
                        <div class="result_userName position12">{{$iuser->Name}}</div>
                      @elseif($iuser->position == "一塁手" && $iuser->SubPosition == "外野手"|| $iuser->position == "二塁手" && $iuser->SubPosition == "外野手"|| $iuser->position == "三塁手" && $iuser->SubPosition == "外野手"|| $iuser->position == "遊撃手" && $iuser->SubPosition == "外野手"  )
                        <div class="result_userName position13">{{$iuser->Name}}</div>
                      @elseif($iuser->position == "外野手" && $iuser->SubPosition == "投手" )
                        <div class="result_userName position14">{{$iuser->Name}}</div>
                      @elseif($iuser->position == "外野手" && $iuser->SubPosition == "捕手" )
                        <div class="result_userName position15">{{$iuser->Name}}</div>
                      @elseif($iuser->position == "外野手" && $iuser->SubPosition == "一塁手" || $iuser->position == "外野手" && $iuser->SubPosition == "二塁手" || $iuser->position == "外野手" && $iuser->SubPosition == "三塁手" || $iuser->position == "外野手" && $iuser->SubPosition == "遊撃手" )
                        <div class="result_userName position16">{{$iuser->Name}}</div>
                      @elseif($iuser->position == "一塁手"|| $iuser->position == "二塁手"|| $iuser->position == "三塁手"|| $iuser->position == "遊撃手"  )
                        <div class="result_userName position3">{{$iuser->Name}}</div>
                      @elseif($iuser->position == "マネージャー" || $iuser->SubPosition == "マネージャー" )
                        <div class="result_userName position17">{{$iuser->Name}}</div>
                      @endif
                    @else
                      <div class="score">---</div>
                    @endif
                </td>
                
                <td>
                  @if($iuser)
                    @if($atbat)
                      <div class="score">{{number_format($hits/$atbat,3)}}</div>
                    @else
                      <div class="score">0.000</div>
                    @endif
                  @else                 
                    <div class="score">-</div>
                  @endif
                </td>
                <td>
                  @if($iuser)
                    <div class="score">{{$homerun}}</div>
                  @else
                    <div class="score">-</div>
                  @endif                          
                </td>
                <td>
                  @if($iuser)
                    <div class="score">{{$r}}</div>
                  @else
                    <div class="score">-</div>
                  @endif
                </td>
                </tr>                
              </tbody>
            </table>
          </div>
        </div>

        <div class="row col-lg-8">
          <table class="table table-sm table-borderless col-3">
            <thead >
              <tr class="text-center text-nowrap">
                <th>参加</th>
              </tr>       
            </thead>
            <tbody class="d-flex justify-content-center">
              <tr>
                @foreach($participationPlayers as $participationPlayer)                  
                    @if($participationPlayer->user->position == "投手" && $participationPlayer->user->SubPosition == null )
                      <td class="schedule_userName position1">{{$participationPlayer->user->Name}}</td>
                    @elseif($participationPlayer->user->position == "捕手" && $participationPlayer->user->SubPosition == null )
                      <td class="schedule_userName position2">{{$participationPlayer->user->Name}}</td>                     
                    @elseif($participationPlayer->user->position == "外野手" && $participationPlayer->user->SubPosition == null )
                      <td class="schedule_userName  position4">{{$participationPlayer->user->Name}}</td>
                    @elseif($participationPlayer->user->position == "投手" && $participationPlayer->user->SubPosition == "捕手" )
                      <td class="schedule_userName position5">{{$participationPlayer->user->Name}}</td>
                    @elseif($participationPlayer->user->position == "投手" && $participationPlayer->user->SubPosition == "一塁手" || $participationPlayer->user->position == "投手" && $participationPlayer->user->SubPosition == "二塁手" || $participationPlayer->user->position == "投手" && $participationPlayer->user->SubPosition == "三塁手" || $participationPlayer->user->position == "投手" && $participationPlayer->user->SubPosition == "遊撃手" )
                      <td class="schedule_userName position6">{{$participationPlayer->user->Name}}</td>
                    @elseif($participationPlayer->user->position == "投手" && $participationPlayer->user->SubPosition == "外野手" )
                      <td class="schedule_userName position7">{{$participationPlayer->user->Name}}</td>
                    @elseif($participationPlayer->user->position == "捕手" && $participationPlayer->user->SubPosition == "投手" )
                      <td class="schedule_userName position8">{{$participationPlayer->user->Name}}</td>
                    @elseif($participationPlayer->user->position == "捕手" && $participationPlayer->user->SubPosition == "一塁手" || $participationPlayer->user->position == "捕手" && $participationPlayer->user->SubPosition == "二塁手" || $participationPlayer->user->position == "捕手" && $participationPlayer->user->SubPosition == "三塁手" || $participationPlayer->user->position == "捕手" && $participationPlayer->user->SubPosition == "遊撃手" )
                      <td class="schedule_userName position9">{{$participationPlayer->user->Name}}</td>
                    @elseif($participationPlayer->user->position == "捕手" && $participationPlayer->user->SubPosition == "外野手" )
                      <td class="schedule_userName position10">{{$participationPlayer->user->Name}}</td>
                    @elseif($participationPlayer->user->position == "一塁手" && $participationPlayer->user->SubPosition == "投手"|| $participationPlayer->user->position == "二塁手" && $participationPlayer->user->SubPosition == "投手"|| $participationPlayer->user->position == "三塁手" && $participationPlayer->user->SubPosition == "投手"|| $participationPlayer->user->position == "遊撃手" && $participationPlayer->user->SubPosition == "投手"  )
                      <td class="schedule_userName position11">{{$participationPlayer->user->Name}}</td>
                    @elseif($participationPlayer->user->position == "一塁手" && $participationPlayer->user->SubPosition == "捕手"|| $participationPlayer->user->position == "二塁手" && $participationPlayer->user->SubPosition == "捕手"|| $participationPlayer->user->position == "三塁手" && $participationPlayer->user->SubPosition == "捕手"|| $participationPlayer->user->position == "遊撃手" && $participationPlayer->user->SubPosition == "捕手"  )
                      <td class="schedule_userName position12">{{$participationPlayer->user->Name}}</td>
                    @elseif($participationPlayer->user->position == "一塁手" && $participationPlayer->user->SubPosition == "外野手"|| $participationPlayer->user->position == "二塁手" && $participationPlayer->user->SubPosition == "外野手"|| $participationPlayer->user->position == "三塁手" && $participationPlayer->user->SubPosition == "外野手"|| $participationPlayer->user->position == "遊撃手" && $participationPlayer->user->SubPosition == "外野手"  )
                      <td class="schedule_userName position13">{{$participationPlayer->user->Name}}</td>
                    @elseif($participationPlayer->user->position == "外野手" && $participationPlayer->user->SubPosition == "投手" )
                      <td class="schedule_userName position14">{{$participationPlayer->user->Name}}</td>
                    @elseif($participationPlayer->user->position == "外野手" && $participationPlayer->user->SubPosition == "捕手" )
                      <td class="schedule_userName position15">{{$participationPlayer->user->Name}}</td>
                    @elseif($participationPlayer->user->position == "外野手" && $participationPlayer->user->SubPosition == "一塁手" || $participationPlayer->user->position == "外野手" && $participationPlayer->user->SubPosition == "二塁手" || $participationPlayer->user->position == "外野手" && $participationPlayer->user->SubPosition == "三塁手" || $participationPlayer->user->position == "外野手" && $participationPlayer->user->SubPosition == "遊撃手" )
                      <td class="schedule_userName position16">{{$participationPlayer->user->Name}}</td>
                    @elseif($participationPlayer->user->position == "一塁手" && $participationPlayer->user->SubPosition == null||$participationPlayer->user->position == "一塁手" && $participationPlayer->user->SubPosition == "二塁手"||$participationPlayer->user->position == "一塁手" && $participationPlayer->user->SubPosition == "三塁手"||$participationPlayer->user->position == "一塁手" && $participationPlayer->user->SubPosition == "遊撃手"|| $participationPlayer->user->position == "二塁手" && $participationPlayer->user->SubPosition == null||$participationPlayer->user->position == "二塁手" && $participationPlayer->user->SubPosition == "一塁手"||$participationPlayer->user->position == "二塁手" && $participationPlayer->user->SubPosition == "三塁手"||$participationPlayer->user->position == "二塁手" && $participationPlayer->user->SubPosition == "遊撃手"|| $participationPlayer->user->position == "三塁手" && $participationPlayer->user->SubPosition == null||$participationPlayer->user->position == "三塁手" && $participationPlayer->user->SubPosition == "一塁手"||$participationPlayer->user->position == "三塁手" && $participationPlayer->user->SubPosition == "二塁手"||$participationPlayer->user->position == "三塁手" && $participationPlayer->user->SubPosition == "遊撃手"|| $participationPlayer->user->position == "遊撃手" && $participationPlayer->user->SubPosition == null||$participationPlayer->user->position == "遊撃手" && $participationPlayer->user->SubPosition == "一塁手"||$participationPlayer->user->position == "遊撃手" && $participationPlayer->user->SubPosition == "二塁手"||$participationPlayer->user->position == "遊撃手" && $participationPlayer->user->SubPosition == "三塁手" )
                      <td class="schedule_userName position3">{{$participationPlayer->user->Name}}</td>
                    @elseif($participationPlayer->user->position == "マネージャー" || $participationPlayer->user->SubPosition == "マネージャー" )
                      <td class="schedule_userName position17">{{$participationPlayer->user->Name}}</td>                    
                    @endif                 
                  @endforeach
                </tr>
              </tbody>
            </table>
          <table class="table table-sm table-borderless col-3">            
            <thead>
              <tr class="text-center text-nowrap">
                <th>不参加</th>
              </tr>
            </thead>
            <tbody class="d-flex justify-content-center">
              <tr>
                @foreach($nonParticipationPlayers as $nonParticipationPlayer)
                  @if($nonParticipationPlayer->user->position == "投手" && $nonParticipationPlayer->user->SubPosition == null )
                    <td class="schedule_userName position1">{{$nonParticipationPlayer->user->Name}}</td>
                  @elseif($nonParticipationPlayer->user->position == "捕手" && $nonParticipationPlayer->user->SubPosition == null )
                    <td class="schedule_userName position2">{{$nonParticipationPlayer->user->Name}}</td>                  
                  @elseif($nonParticipationPlayer->user->position == "外野手" && $nonParticipationPlayer->user->SubPosition == null )
                    <td class="schedule_userName position4">{{$nonParticipationPlayer->user->Name}}</td>
                  @elseif($nonParticipationPlayer->user->position == "投手" && $nonParticipationPlayer->user->SubPosition == "捕手" )
                    <td class="schedule_userName position5">{{$nonParticipationPlayer->user->Name}}</td>
                  @elseif($nonParticipationPlayer->user->position == "投手" && $nonParticipationPlayer->user->SubPosition == "一塁手" || $nonParticipationPlayer->user->position == "投手" && $nonParticipationPlayer->user->SubPosition == "二塁手" || $nonParticipationPlayer->user->position == "投手" && $nonParticipationPlayer->user->SubPosition == "三塁手" || $nonParticipationPlayer->user->position == "投手" && $nonParticipationPlayer->user->SubPosition == "遊撃手" )
                    <td class="schedule_userName position6">{{$nonParticipationPlayer->user->Name}}</td>
                  @elseif($nonParticipationPlayer->user->position == "投手" && $nonParticipationPlayer->user->SubPosition == "外野手" )
                    <td class="schedule_userName position7">{{$nonParticipationPlayer->user->Name}}</td>
                  @elseif($nonParticipationPlayer->user->position == "捕手" && $nonParticipationPlayer->user->SubPosition == "投手" )
                    <td class="schedule_userName position8">{{$nonParticipationPlayer->user->Name}}</td>
                  @elseif($nonParticipationPlayer->user->position == "捕手" && $nonParticipationPlayer->user->SubPosition == "一塁手" || $nonParticipationPlayer->user->position == "捕手" && $nonParticipationPlayer->user->SubPosition == "二塁手" || $nonParticipationPlayer->user->position == "捕手" && $nonParticipationPlayer->user->SubPosition == "三塁手" || $nonParticipationPlayer->user->position == "捕手" && $nonParticipationPlayer->user->SubPosition == "遊撃手" )
                    <td class="schedule_userName position9">{{$nonParticipationPlayer->user->Name}}</td>
                  @elseif($nonParticipationPlayer->user->position == "捕手" && $nonParticipationPlayer->user->SubPosition == "外野手" )
                    <td class="schedule_userName position10">{{$nonParticipationPlayer->user->Name}}</td>
                  @elseif($nonParticipationPlayer->user->position == "一塁手" && $nonParticipationPlayer->user->SubPosition == "投手"|| $nonParticipationPlayer->user->position == "二塁手" && $nonParticipationPlayer->user->SubPosition == "投手"|| $nonParticipationPlayer->user->position == "三塁手" && $nonParticipationPlayer->user->SubPosition == "投手"|| $nonParticipationPlayer->user->position == "遊撃手" && $nonParticipationPlayer->user->SubPosition == "投手"  )
                    <td class="schedule_userName position11">{{$nonParticipationPlayer->user->Name}}</td>
                  @elseif($nonParticipationPlayer->user->position == "一塁手" && $nonParticipationPlayer->user->SubPosition == "捕手"|| $nonParticipationPlayer->user->position == "二塁手" && $nonParticipationPlayer->user->SubPosition == "捕手"|| $nonParticipationPlayer->user->position == "三塁手" && $nonParticipationPlayer->user->SubPosition == "捕手"|| $nonParticipationPlayer->user->position == "遊撃手" && $nonParticipationPlayer->user->SubPosition == "捕手"  )
                    <td class="schedule_userName position12">{{$nonParticipationPlayer->user->Name}}</td>
                  @elseif($nonParticipationPlayer->user->position == "一塁手" && $nonParticipationPlayer->user->SubPosition == "外野手"|| $nonParticipationPlayer->user->position == "二塁手" && $nonParticipationPlayer->user->SubPosition == "外野手"|| $nonParticipationPlayer->user->position == "三塁手" && $nonParticipationPlayer->user->SubPosition == "外野手"|| $nonParticipationPlayer->user->position == "遊撃手" && $nonParticipationPlayer->user->SubPosition == "外野手"  )
                    <td class="schedule_userName position13">{{$nonParticipationPlayer->user->Name}}</td>
                  @elseif($nonParticipationPlayer->user->position == "外野手" && $nonParticipationPlayer->user->SubPosition == "投手" )
                    <td class="schedule_userName position14">{{$nonParticipationPlayer->user->Name}}</td>
                  @elseif($nonParticipationPlayer->user->position == "外野手" && $nonParticipationPlayer->user->SubPosition == "捕手" )
                    <td class="schedule_userName position15">{{$nonParticipationPlayer->user->Name}}</td>
                  @elseif($nonParticipationPlayer->user->position == "外野手" && $nonParticipationPlayer->user->SubPosition == "一塁手" || $nonParticipationPlayer->user->position == "外野手" && $nonParticipationPlayer->user->SubPosition == "二塁手" || $nonParticipationPlayer->user->position == "外野手" && $nonParticipationPlayer->user->SubPosition == "三塁手" || $nonParticipationPlayer->user->position == "外野手" && $nonParticipationPlayer->user->SubPosition == "遊撃手" )
                    <td class="schedule_userName position16">{{$nonParticipationPlayer->user->Name}}</td>
                  @elseif($nonParticipationPlayer->user->position == "一塁手" && $nonParticipationPlayer->user->SubPosition == null||$nonParticipationPlayer->user->position == "一塁手" && $nonParticipationPlayer->user->SubPosition == "二塁手"||$nonParticipationPlayer->user->position == "一塁手" && $nonParticipationPlayer->user->SubPosition == "三塁手"||$nonParticipationPlayer->user->position == "一塁手" && $nonParticipationPlayer->user->SubPosition == "遊撃手"|| $nonParticipationPlayer->user->position == "二塁手" && $nonParticipationPlayer->user->SubPosition == null||$nonParticipationPlayer->user->position == "二塁手" && $nonParticipationPlayer->user->SubPosition == "一塁手"||$nonParticipationPlayer->user->position == "二塁手" && $nonParticipationPlayer->user->SubPosition == "三塁手"||$nonParticipationPlayer->user->position == "二塁手" && $nonParticipationPlayer->user->SubPosition == "遊撃手"|| $nonParticipationPlayer->user->position == "三塁手" && $nonParticipationPlayer->user->SubPosition == null||$nonParticipationPlayer->user->position == "三塁手" && $nonParticipationPlayer->user->SubPosition == "一塁手"||$nonParticipationPlayer->user->position == "三塁手" && $nonParticipationPlayer->user->SubPosition == "二塁手"||$nonParticipationPlayer->user->position == "三塁手" && $nonParticipationPlayer->user->SubPosition == "遊撃手"|| $nonParticipationPlayer->user->position == "遊撃手" && $nonParticipationPlayer->user->SubPosition == null||$nonParticipationPlayer->user->position == "遊撃手" && $nonParticipationPlayer->user->SubPosition == "一塁手"||$nonParticipationPlayer->user->position == "遊撃手" && $nonParticipationPlayer->user->SubPosition == "二塁手"||$nonParticipationPlayer->user->position == "遊撃手" && $nonParticipationPlayer->user->SubPosition == "三塁手" )
                      <td class="schedule_userName position3">{{$nonParticipationPlayer->user->Name}}</td>
                  @elseif($nonParticipationPlayer->user->position == "マネージャー" || $nonParticipationPlayer->user->SubPosition == "マネージャー" )
                    <td class="schedule_userName position17">{{$nonParticipationPlayer->user->Name}}</td>
                  @endif                
                @endforeach
              </tr>
            </tbody>
          </table>
          <table class="table table-sm table-borderless col-3">
            <thead>
              <tr class="text-center text-nowrap">
                <th>未定</th>
              </tr>
            </thead>            
            <tbody class="d-flex justify-content-center">
              <tr>
                @foreach($undecidedPlayers as $undecidedPlayer)
                  @if($undecidedPlayer->user->position == "投手" && $undecidedPlayer->user->SubPosition == null )
                    <td class="schedule_userName position1">{{$undecidedPlayer->user->Name}}</td>
                  @elseif($undecidedPlayer->user->position == "捕手" && $undecidedPlayer->user->SubPosition == null )
                    <td class="schedule_userName position2">{{$undecidedPlayer->user->Name}}</td>                
                  @elseif($undecidedPlayer->user->position == "外野手" && $undecidedPlayer->user->SubPosition == null )
                    <td class="schedule_userName position4">{{$undecidedPlayer->user->Name}}</td>
                  @elseif($undecidedPlayer->user->position == "投手" && $undecidedPlayer->user->SubPosition == "捕手" )
                    <td class="schedule_userName position5">{{$undecidedPlayer->user->Name}}</td>
                  @elseif($undecidedPlayer->user->position == "投手" && $undecidedPlayer->user->SubPosition == "一塁手" || $undecidedPlayer->user->position == "投手" && $undecidedPlayer->user->SubPosition == "二塁手" || $undecidedPlayer->user->position == "投手" && $undecidedPlayer->user->SubPosition == "三塁手" || $undecidedPlayer->user->position == "投手" && $undecidedPlayer->user->SubPosition == "遊撃手" )
                    <td class="schedule_userName position6">{{$undecidedPlayer->user->Name}}</td>
                  @elseif($undecidedPlayer->user->position == "投手" && $undecidedPlayer->user->SubPosition == "外野手" )
                    <td class="schedule_userName position7">{{$undecidedPlayer->user->Name}}</td>
                  @elseif($undecidedPlayer->user->position == "捕手" && $undecidedPlayer->user->SubPosition == "投手" )
                    <td class="schedule_userName position8">{{$undecidedPlayer->user->Name}}</td>
                  @elseif($undecidedPlayer->user->position == "捕手" && $undecidedPlayer->user->SubPosition == "一塁手" || $undecidedPlayer->user->position == "捕手" && $undecidedPlayer->user->SubPosition == "二塁手" || $undecidedPlayer->user->position == "捕手" && $undecidedPlayer->user->SubPosition == "三塁手" || $undecidedPlayer->user->position == "捕手" && $undecidedPlayer->user->SubPosition == "遊撃手" )
                    <td class="schedule_userName position9">{{$undecidedPlayer->user->Name}}</td>
                  @elseif($undecidedPlayer->user->position == "捕手" && $undecidedPlayer->user->SubPosition == "外野手" )
                    <td class="schedule_userName position10">{{$undecidedPlayer->user->Name}}</td>
                  @elseif($undecidedPlayer->user->position == "一塁手" && $undecidedPlayer->user->SubPosition == "投手"|| $undecidedPlayer->user->position == "二塁手" && $undecidedPlayer->user->SubPosition == "投手"|| $undecidedPlayer->user->position == "三塁手" && $undecidedPlayer->user->SubPosition == "投手"|| $undecidedPlayer->user->position == "遊撃手" && $undecidedPlayer->user->SubPosition == "投手"  )
                    <td class="schedule_userName position11">{{$undecidedPlayer->user->Name}}</td>
                  @elseif($undecidedPlayer->user->position == "一塁手" && $undecidedPlayer->user->SubPosition == "捕手"|| $undecidedPlayer->user->position == "二塁手" && $undecidedPlayer->user->SubPosition == "捕手"|| $undecidedPlayer->user->position == "三塁手" && $undecidedPlayer->user->SubPosition == "捕手"|| $undecidedPlayer->user->position == "遊撃手" && $undecidedPlayer->user->SubPosition == "捕手"  )
                    <td class="schedule_userName position12">{{$undecidedPlayer->user->Name}}</td>
                  @elseif($undecidedPlayer->user->position == "一塁手" && $undecidedPlayer->user->SubPosition == "外野手"|| $undecidedPlayer->user->position == "二塁手" && $undecidedPlayer->user->SubPosition == "外野手"|| $undecidedPlayer->user->position == "三塁手" && $undecidedPlayer->user->SubPosition == "外野手"|| $undecidedPlayer->user->position == "遊撃手" && $undecidedPlayer->user->SubPosition == "外野手"  )
                    <td class="schedule_userName position13">{{$undecidedPlayer->user->Name}}</td>
                  @elseif($undecidedPlayer->user->position == "外野手" && $undecidedPlayer->user->SubPosition == "投手" )
                    <td class="schedule_userName position14">{{$undecidedPlayer->user->Name}}</td>
                  @elseif($undecidedPlayer->user->position == "外野手" && $undecidedPlayer->user->SubPosition == "捕手" )
                    <td class="schedule_userName position15">{{$undecidedPlayer->user->Name}}</td>
                  @elseif($undecidedPlayer->user->position == "外野手" && $undecidedPlayer->user->SubPosition == "一塁手" || $undecidedPlayer->user->position == "外野手" && $undecidedPlayer->user->SubPosition == "二塁手" || $undecidedPlayer->user->position == "外野手" && $undecidedPlayer->user->SubPosition == "三塁手" || $undecidedPlayer->user->position == "外野手" && $undecidedPlayer->user->SubPosition == "遊撃手" )
                    <td class="schedule_userName position16">{{$undecidedPlayer->user->Name}}</td>
                  @elseif($undecidedPlayer->user->position == "一塁手" && $undecidedPlayer->user->SubPosition == null||$undecidedPlayer->user->position == "一塁手" && $undecidedPlayer->user->SubPosition == "二塁手"||$undecidedPlayer->user->position == "一塁手" && $undecidedPlayer->user->SubPosition == "三塁手"||$undecidedPlayer->user->position == "一塁手" && $undecidedPlayer->user->SubPosition == "遊撃手"|| $undecidedPlayer->user->position == "二塁手" && $undecidedPlayer->user->SubPosition == null||$undecidedPlayer->user->position == "二塁手" && $undecidedPlayer->user->SubPosition == "一塁手"||$undecidedPlayer->user->position == "二塁手" && $undecidedPlayer->user->SubPosition == "三塁手"||$undecidedPlayer->user->position == "二塁手" && $undecidedPlayer->user->SubPosition == "遊撃手"|| $undecidedPlayer->user->position == "三塁手" && $undecidedPlayer->user->SubPosition == null||$undecidedPlayer->user->position == "三塁手" && $undecidedPlayer->user->SubPosition == "一塁手"||$undecidedPlayer->user->position == "三塁手" && $undecidedPlayer->user->SubPosition == "二塁手"||$undecidedPlayer->user->position == "三塁手" && $undecidedPlayer->user->SubPosition == "遊撃手"|| $undecidedPlayer->user->position == "遊撃手" && $undecidedPlayer->user->SubPosition == null||$undecidedPlayer->user->position == "遊撃手" && $undecidedPlayer->user->SubPosition == "一塁手"||$undecidedPlayer->user->position == "遊撃手" && $undecidedPlayer->user->SubPosition == "二塁手"||$undecidedPlayer->user->position == "遊撃手" && $undecidedPlayer->user->SubPosition == "三塁手" )
                    <td class="schedule_userName position3">{{$undecidedPlayer->user->Name}}</td>
                  @elseif($undecidedPlayer->user->position == "マネージャー" || $undecidedPlayer->user->SubPosition == "マネージャー" )
                    <td class="schedule_userName position17">{{$undecidedPlayer->user->Name}}</td>
                  @endif                
                @endforeach
              </tr>
            </tbody>
          </table>
          <table class="table table-sm table-borderless col-3">
            <thead>
              <tr class="text-center">
                <th>未入力</th>
              </tr>
            </thead>
            <tbody class="d-flex justify-content-center">
              <tr>
                @foreach($noPlayers as $noPlayer)
                  @if($Players[array_search($noPlayer->id,array_column($Players,'id'))]->position == "投手" && $Players[array_search($noPlayer->id,array_column($Players,'id'))]->SubPosition == null )
                    <td class="schedule_userName position1">{{$Players[array_search($noPlayer->id,array_column($Players,'id'))]->Name}}</td>
                  @elseif($Players[array_search($noPlayer->id,array_column($Players,'id'))]->position == "捕手" && $Players[array_search($noPlayer->id,array_column($Players,'id'))]->SubPosition == null )
                    <td class="schedule_userName position2">{{$Players[array_search($noPlayer->id,array_column($Players,'id'))]->Name}}</td>
                  
                  @elseif($Players[array_search($noPlayer->id,array_column($Players,'id'))]->position == "外野手" && $Players[array_search($noPlayer->id,array_column($Players,'id'))]->SubPosition == null )
                    <td class="schedule_userName position4">{{$Players[array_search($noPlayer->id,array_column($Players,'id'))]->Name}}</td>
                  @elseif($Players[array_search($noPlayer->id,array_column($Players,'id'))]->position == "投手" && $Players[array_search($noPlayer->id,array_column($Players,'id'))]->SubPosition == "捕手" )
                    <td class="schedule_userName position5">{{$Players[array_search($noPlayer->id,array_column($Players,'id'))]->Name}}</td>
                  @elseif($Players[array_search($noPlayer->id,array_column($Players,'id'))]->position == "投手" && $Players[array_search($noPlayer->id,array_column($Players,'id'))]->SubPosition == "一塁手" || $Players[array_search($noPlayer->id,array_column($Players,'id'))]->position == "投手" && $Players[array_search($noPlayer->id,array_column($Players,'id'))]->SubPosition == "二塁手" || $Players[array_search($noPlayer->id,array_column($Players,'id'))]->position == "投手" && $Players[array_search($noPlayer->id,array_column($Players,'id'))]->SubPosition == "三塁手" || $Players[array_search($noPlayer->id,array_column($Players,'id'))]->position == "投手" && $Players[array_search($noPlayer->id,array_column($Players,'id'))]->SubPosition == "遊撃手" )
                    <td class="schedule_userName position6">{{$Players[array_search($noPlayer->id,array_column($Players,'id'))]->Name}}</td>
                  @elseif($Players[array_search($noPlayer->id,array_column($Players,'id'))]->position == "投手" && $Players[array_search($noPlayer->id,array_column($Players,'id'))]->SubPosition == "外野手" )
                    <td class="schedule_userName position7">{{$Players[array_search($noPlayer->id,array_column($Players,'id'))]->Name}}</td>
                  @elseif($Players[array_search($noPlayer->id,array_column($Players,'id'))]->position == "捕手" && $Players[array_search($noPlayer->id,array_column($Players,'id'))]->SubPosition == "投手" )
                    <td class="schedule_userName position8">{{$Players[array_search($noPlayer->id,array_column($Players,'id'))]->Name}}</td>
                  @elseif($Players[array_search($noPlayer->id,array_column($Players,'id'))]->position == "捕手" && $Players[array_search($noPlayer->id,array_column($Players,'id'))]->SubPosition == "一塁手" || $Players[array_search($noPlayer->id,array_column($Players,'id'))]->position == "捕手" && $Players[array_search($noPlayer->id,array_column($Players,'id'))]->SubPosition == "二塁手" || $Players[array_search($noPlayer->id,array_column($Players,'id'))]->position == "捕手" && $Players[array_search($noPlayer->id,array_column($Players,'id'))]->SubPosition == "三塁手" || $Players[array_search($noPlayer->id,array_column($Players,'id'))]->position == "捕手" && $Players[array_search($noPlayer->id,array_column($Players,'id'))]->SubPosition == "遊撃手" )
                    <td class="schedule_userName position9">{{$Players[array_search($noPlayer->id,array_column($Players,'id'))]->Name}}</td>
                  @elseif($Players[array_search($noPlayer->id,array_column($Players,'id'))]->position == "捕手" && $Players[array_search($noPlayer->id,array_column($Players,'id'))]->SubPosition == "外野手" )
                    <td class="schedule_userName position10">{{$Players[array_search($noPlayer->id,array_column($Players,'id'))]->Name}}</td>
                  @elseif($Players[array_search($noPlayer->id,array_column($Players,'id'))]->position == "一塁手" && $Players[array_search($noPlayer->id,array_column($Players,'id'))]->SubPosition == "投手"|| $Players[array_search($noPlayer->id,array_column($Players,'id'))]->position == "二塁手" && $Players[array_search($noPlayer->id,array_column($Players,'id'))]->SubPosition == "投手"|| $Players[array_search($noPlayer->id,array_column($Players,'id'))]->position == "三塁手" && $Players[array_search($noPlayer->id,array_column($Players,'id'))]->SubPosition == "投手"|| $Players[array_search($noPlayer->id,array_column($Players,'id'))]->position == "遊撃手" && $Players[array_search($noPlayer->id,array_column($Players,'id'))]->SubPosition == "投手"  )
                    <td class="schedule_userName position11">{{$Players[array_search($noPlayer->id,array_column($Players,'id'))]->Name}}</td>
                  @elseif($Players[array_search($noPlayer->id,array_column($Players,'id'))]->position == "一塁手" && $Players[array_search($noPlayer->id,array_column($Players,'id'))]->SubPosition == "捕手"|| $Players[array_search($noPlayer->id,array_column($Players,'id'))]->position == "二塁手" && $Players[array_search($noPlayer->id,array_column($Players,'id'))]->SubPosition == "捕手"|| $Players[array_search($noPlayer->id,array_column($Players,'id'))]->position == "三塁手" && $Players[array_search($noPlayer->id,array_column($Players,'id'))]->SubPosition == "捕手"|| $Players[array_search($noPlayer->id,array_column($Players,'id'))]->position == "遊撃手" && $Players[array_search($noPlayer->id,array_column($Players,'id'))]->SubPosition == "捕手"  )
                    <td class="schedule_userName position12">{{$Players[array_search($noPlayer->id,array_column($Players,'id'))]->Name}}</td>
                  @elseif($Players[array_search($noPlayer->id,array_column($Players,'id'))]->position == "一塁手" && $Players[array_search($noPlayer->id,array_column($Players,'id'))]->SubPosition == "外野手"|| $Players[array_search($noPlayer->id,array_column($Players,'id'))]->position == "二塁手" && $Players[array_search($noPlayer->id,array_column($Players,'id'))]->SubPosition == "外野手"|| $Players[array_search($noPlayer->id,array_column($Players,'id'))]->position == "三塁手" && $Players[array_search($noPlayer->id,array_column($Players,'id'))]->SubPosition == "外野手"|| $Players[array_search($noPlayer->id,array_column($Players,'id'))]->position == "遊撃手" && $Players[array_search($noPlayer->id,array_column($Players,'id'))]->SubPosition == "外野手"  )
                    <td class="schedule_userName position13">{{$Players[array_search($noPlayer->id,array_column($Players,'id'))]->Name}}</td>
                  @elseif($Players[array_search($noPlayer->id,array_column($Players,'id'))]->position == "外野手" && $Players[array_search($noPlayer->id,array_column($Players,'id'))]->SubPosition == "投手" )
                    <td class="schedule_userName position14">{{$Players[array_search($noPlayer->id,array_column($Players,'id'))]->Name}}</td>
                  @elseif($Players[array_search($noPlayer->id,array_column($Players,'id'))]->position == "外野手" && $Players[array_search($noPlayer->id,array_column($Players,'id'))]->SubPosition == "捕手" )
                    <td class="schedule_userName position15">{{$Players[array_search($noPlayer->id,array_column($Players,'id'))]->Name}}</td>
                  @elseif($Players[array_search($noPlayer->id,array_column($Players,'id'))]->position == "外野手" && $Players[array_search($noPlayer->id,array_column($Players,'id'))]->SubPosition == "一塁手" || $Players[array_search($noPlayer->id,array_column($Players,'id'))]->position == "外野手" && $Players[array_search($noPlayer->id,array_column($Players,'id'))]->SubPosition == "二塁手" || $Players[array_search($noPlayer->id,array_column($Players,'id'))]->position == "外野手" && $Players[array_search($noPlayer->id,array_column($Players,'id'))]->SubPosition == "三塁手" || $Players[array_search($noPlayer->id,array_column($Players,'id'))]->position == "外野手" && $Players[array_search($noPlayer->id,array_column($Players,'id'))]->SubPosition == "遊撃手" )
                    <td class="schedule_userName position16">{{$Players[array_search($noPlayer->id,array_column($Players,'id'))]->Name}}</td>
                  @elseif($Players[array_search($noPlayer->id,array_column($Players,'id'))]->position == "一塁手" && $Players[array_search($noPlayer->id,array_column($Players,'id'))]->SubPosition == null||$Players[array_search($noPlayer->id,array_column($Players,'id'))]->position == "一塁手" && $Players[array_search($noPlayer->id,array_column($Players,'id'))]->SubPosition == "二塁手"||$Players[array_search($noPlayer->id,array_column($Players,'id'))]->position == "一塁手" && $Players[array_search($noPlayer->id,array_column($Players,'id'))]->SubPosition == "三塁手"||$Players[array_search($noPlayer->id,array_column($Players,'id'))]->position == "一塁手" && $Players[array_search($noPlayer->id,array_column($Players,'id'))]->SubPosition == "遊撃手"|| $Players[array_search($noPlayer->id,array_column($Players,'id'))]->position == "二塁手" && $Players[array_search($noPlayer->id,array_column($Players,'id'))]->SubPosition == null||$Players[array_search($noPlayer->id,array_column($Players,'id'))]->position == "二塁手" && $Players[array_search($noPlayer->id,array_column($Players,'id'))]->SubPosition == "一塁手"||$Players[array_search($noPlayer->id,array_column($Players,'id'))]->position == "二塁手" && $Players[array_search($noPlayer->id,array_column($Players,'id'))]->SubPosition == "三塁手"||$Players[array_search($noPlayer->id,array_column($Players,'id'))]->position == "二塁手" && $Players[array_search($noPlayer->id,array_column($Players,'id'))]->SubPosition == "遊撃手"|| $Players[array_search($noPlayer->id,array_column($Players,'id'))]->position == "三塁手" && $Players[array_search($noPlayer->id,array_column($Players,'id'))]->SubPosition == null||$Players[array_search($noPlayer->id,array_column($Players,'id'))]->position == "三塁手" && $Players[array_search($noPlayer->id,array_column($Players,'id'))]->SubPosition == "一塁手"||$Players[array_search($noPlayer->id,array_column($Players,'id'))]->position == "三塁手" && $Players[array_search($noPlayer->id,array_column($Players,'id'))]->SubPosition == "二塁手"||$Players[array_search($noPlayer->id,array_column($Players,'id'))]->position == "三塁手" && $Players[array_search($noPlayer->id,array_column($Players,'id'))]->SubPosition == "遊撃手"|| $Players[array_search($noPlayer->id,array_column($Players,'id'))]->position == "遊撃手" && $Players[array_search($noPlayer->id,array_column($Players,'id'))]->SubPosition == null||$Players[array_search($noPlayer->id,array_column($Players,'id'))]->position == "遊撃手" && $Players[array_search($noPlayer->id,array_column($Players,'id'))]->SubPosition == "一塁手"||$Players[array_search($noPlayer->id,array_column($Players,'id'))]->position == "遊撃手" && $Players[array_search($noPlayer->id,array_column($Players,'id'))]->SubPosition == "二塁手"||$Players[array_search($noPlayer->id,array_column($Players,'id'))]->position == "遊撃手" && $Players[array_search($noPlayer->id,array_column($Players,'id'))]->SubPosition == "三塁手" )
                    <td class="schedule_userName position3">{{$Players[array_search($noPlayer->id,array_column($Players,'id'))]->Name}}</td>
                  @elseif($Players[array_search($noPlayer->id,array_column($Players,'id'))]->position == "マネージャー" || $Players[array_search($noPlayer->id,array_column($Players,'id'))]->SubPosition == "マネージャー" )
                    <td class="schedule_userName position17">{{$Players[array_search($noPlayer->id,array_column($Players,'id'))]->Name}}</td>
                  @endif                
                @endforeach
              </tr>
            </tbody>
          </table>
        </div>
    </div>
  </div>
    <a href="{{ route('schedules.index') }}">一覧へ戻る</a>
</div>

@endsection