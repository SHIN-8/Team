@extends('layouts.app')

@section('title','show')

@section('content')

<div class="container">
    <h2 class="contents text-nowrap">選手紹介</h2>
          @if($user->position == "投手" && $user->SubPosition == null )
            <p class="userName position1">{{$user->Name}}</p>
          @elseif($user->position == "捕手" && $user->SubPosition == null )
            <p class="userName position2">{{$user->Name}}</p>
          @elseif($user->position == "一塁手" && $user->SubPosition == null|| $user->position == "二塁手" && $user->SubPosition == null|| $user->position == "三塁手" && $user->SubPosition == null|| $user->position == "遊撃手" && $user->SubPosition == null )
            <p class="userName position3">{{$user->Name}}</p>
          @elseif($user->position == "外野手" && $user->SubPosition == null )
            <p class="userName position4">{{$user->Name}}</p>
          @elseif($user->position == "投手" && $user->SubPosition == "捕手")
            <p class="userName position5">{{$user->Name}}</p>
          @elseif($user->position == "投手" && $user->SubPosition == "一塁手" || $user->position == "投手" && $user->SubPosition == "二塁手" || $user->position == "投手" && $user->SubPosition == "三塁手" || $user->position == "投手" && $user->SubPosition == "遊撃手")
            <p class="userName position6">{{$user->Name}}</p>
          @elseif($user->position == "投手" && $user->SubPosition == "外野手")
            <p class="userName position7">{{$user->Name}}</p>
          @elseif($user->position == "捕手" && $user->SubPosition == "投手")
            <p class="userName position8">{{$user->Name}}</p>
          @elseif($user->position == "捕手" && $user->SubPosition == "一塁手" || $user->position == "捕手" && $user->SubPosition == "二塁手" || $user->position == "捕手" && $user->SubPosition == "三塁手" || $user->position == "捕手" && $user->SubPosition == "遊撃手")
            <p class="userName position9">{{$user->Name}}</p>
          @elseif($user->position == "捕手" && $user->SubPosition == "外野手")
            <p class="userName position10">{{$user->Name}}</p>
          @elseif($user->position == "一塁手" && $user->SubPosition == "投手" || $user->position == "二塁手" && $user->SubPosition == "投手" || $user->position == "三塁手" && $user->SubPosition == "投手" || $user->position == "遊撃手" && $user->SubPosition == "投手")
            <p class="userName position11">{{$user->Name}}</p>
          @elseif($user->SubPosition == "捕手" && $user->position == "一塁手" || $user->SubPosition == "捕手" && $user->position == "二塁手" || $user->SubPosition == "捕手" && $user->position == "三塁手" || $user->SubPosition == "捕手" && $user->position == "遊撃手")
            <p class="userName position12">{{$user->Name}}</p>
          @elseif($user->position == "一塁手" && $user->SubPosition == "外野手" || $user->position == "二塁手" && $user->SubPosition == "外野手" || $user->position == "三塁手" && $user->SubPosition == "外野手" || $user->position == "遊撃手" && $user->SubPosition == "外野手")
            <p class="userName position13">{{$user->Name}}</p>
          @elseif($user->position == "外野手" && $user->SubPosition == "投手")
            <p class="userName position14">{{$user->Name}}</p>
          @elseif($user->position == "外野手" && $user->SubPosition == "捕手")
            <p class="userName position15">{{$user->Name}}</p>
          @elseif($user->position == "外野手" && $user->SubPosition == "一塁手" || $user->position == "外野手" && $user->SubPosition == "二塁手" || $user->position == "外野手" && $user->SubPosition == "三塁手" || $user->position == "外野手" && $user->SubPosition == "遊撃手")
            <p class="userName position16">{{$user->Name}}</p>
          @elseif($user->position == "マネージャー" || $user->SubPosition == "マネージャー")
            <p class="userName position17">{{$user->Name}}</p>
          @endif
    <div class="row">
      <div class="col imgtext">
        @if($user->user_img == null)
          <img src="{{ asset('/storage/img/'.'noimage.png')}}" class="max">
        @else
          <img src="{{ asset('/storage/img/'.$user->user_img)}}" class="max">
        @endif
          <div class="imgtextno">{{$user->number}}</div>
            <p class="imgtexttext text-nowrap">{{$user->FullName}}</p>
      </div>
    </div>

    <div>
        <h2 class="contentstitle text-nowrap text-center">PROFILE</h2>
      <div class="row">
        <table class="table table-sm table-dark">
          <thead>
              <tr>
                <th>名前</th>
                <th>{{$user->FullName}}</th>
              </tr>
          </thead>
          <tbody>
              <tr>
                <th scope="row">背番号</th>
                <td>{{$user->number}}</td>
              </tr>
              <tr>
                <th scope="row">ポジション</th>
                <td>{{$user->position}}/{{$user->SubPosition}}</td>
              </tr>
              <tr>
                <th scope="row">投打</th>
                <td>{{$user->dominant_hand}}</td>
              </tr>
              <tr>
                <th scope="row">誕生日</th>
                  <?php $today = date("Y"); ?>
                <td>{{$user->Birthday_y}}年{{$user->Birthday_m}}月{{$user->Birthday_d}}日({{$today-$user->Birthday_y}}歳)</td>
              </tr>
              <tr>
                <th scope="row">身長/体重</th>
                <td>{{$user->height}}cm/{{$user->weight}}kg</td>
              </tr>
              <tr>
                <th scope="row">出身校</th>
                <td>
                    @if($user->alma_mater ==null)
                      -
                    @else
                      {{$user->alma_mater}}
                    @endif
                </td>
              </tr>    
          </tbody>
        </table>
      </div>
  </div>

  
    <div class="col-5  float-right text-nowrap">
        <a  href="{{ route('users.total',['user'=>$user]) }}"><div class="btn totalresult">通算成績</div></a>
    </div>
    <div>
      <div class="row">
          <div class="col-12 text-nowrap">
              <div class="yearresult">{{$y}}年度成績</div>
          </div>
    </div>
    <div class="table-responsive">
        <table class="table table-sm">
            <h3 class="resulttitle">BATTING</h3>
        <thead>
                <tr>
                  <th><div class="title text-nowrap">試合数</div></th>
                  <th><div class="title text-nowrap">打率</div></th>
                  <th><div class="title text-nowrap">打点</div></th>
                  <th><div class="title text-nowrap">安打</div></th>
                  <th><div class="title text-nowrap">二塁打</div></th>
                  <th><div class="title text-nowrap">三塁打</div></th>
                  <th><div class="title text-nowrap">本塁打</div></th>
                  <th><div class="title text-nowrap">打席</div></th>
                  <th><div class="title text-nowrap">打数</div></th>
                  <th><div class="title text-nowrap">盗塁</div></th>
                  <th><div class="title text-nowrap">四死球</div></th>
                  <th><div class="title text-nowrap">三振</div></th>
                  <th><div class="title text-nowrap">犠打</div></th>
                  <th><div class="title text-nowrap">犠飛</div></th>
                  <th><div class="title text-nowrap">出塁率</div></th>
                  <th><div class="title text-nowrap">長打率</div></th>
                  <th><div class="title text-nowrap">OPS</div></th>
                </tr>
              </thead>
              <tbody>
                      <?php
                      $r = $userresults->sum('ar')+$userresults->sum('br')+$userresults->sum('cr')+$userresults->sum('dr')+$userresults->sum('er')+$userresults->sum('fr')+$userresults->sum('gr')+$userresults->sum('hr')+$userresults->sum('ir');
                      $hit = $a->where('a',"安")->count()+$b->where('b',"安")->count()+$c->where('c',"安")->count()+$d->where('d',"安")->count()+$e->where('e',"安")->count()+$f->where('f',"安")->count()+$g->where('g',"安")->count()+$h->where('h',"安")->count()+$i->where('i',"安")->count();
                        $two = $a->where('a',"２")->count()+$b->where('b',"２")->count()+$c->where('c',"２")->count()+$d->where('d',"２")->count()+$e->where('e',"２")->count()+$f->where('f',"２")->count()+$g->where('g',"２")->count()+$h->where('h',"２")->count()+$i->where('i',"２")->count();
                        $three = $a->where('a',"３")->count()+$b->where('b',"３")->count()+$c->where('c',"３")->count()+$d->where('d',"３")->count()+$e->where('e',"３")->count()+$f->where('f',"３")->count()+$g->where('g',"３")->count()+$h->where('h',"３")->count()+$i->where('i',"３")->count();
                        $homerun = $a->where('a',"本")->count()+$b->where('b',"本")->count()+$c->where('c',"本")->count()+$d->where('d',"本")->count()+$e->where('e',"本")->count()+$f->where('f',"本")->count()+$g->where('g',"本")->count()+$h->where('h',"本")->count()+$i->where('i',"本")->count();
                        $goro = $a->where('a',"ゴ")->count()+$b->where('b',"ゴ")->count()+$c->where('c',"ゴ")->count()+$d->where('d',"ゴ")->count()+$e->where('e',"ゴ")->count()+$f->where('f',"ゴ")->count()+$g->where('g',"ゴ")->count()+$h->where('h',"ゴ")->count()+$i->where('i',"ゴ")->count();
                        $liner = $a->where('a',"直")->count()+$b->where('b',"直")->count()+$c->where('c',"直")->count()+$d->where('d',"直")->count()+$e->where('e',"直")->count()+$f->where('f',"直")->count()+$g->where('g',"直")->count()+$h->where('h',"直")->count()+$i->where('i',"直")->count();
                      $fly = $a->where('a',"飛")->count()+$b->where('b',"飛")->count()+$c->where('c',"飛")->count()+$d->where('d',"飛")->count()+$e->where('e',"飛")->count()+$f->where('f',"飛")->count()+$g->where('g',"飛")->count()+$h->where('h',"飛")->count()+$i->where('i',"飛")->count();
                      $ALL = $goro +$liner +$fly;
                        $hits = $hit+$two+$three+$homerun;
                        $numberofatbat = $a->where('a','!==',null)->count()+$b->where('b','!==',null)->count()+$c->where('c','!==',null)->count()+$d->where('d','!==',null)->count()+$e->where('e','!==',null)->count()+$f->where('f','!==',null)->count()+$g->where('g','!==',null)->count()+$h->where('h','!==',null)->count()+$i->where('i','!==',null)->count();
                        $fourdeadball = $a->where('a',"四球")->count()+$b->where('b',"四球")->count()+$c->where('c',"四球")->count()+$d->where('d',"四球")->count()+$e->where('e',"四球")->count()+$f->where('f',"四球")->count()+$g->where('g',"四球")->count()+$h->where('h',"四球")->count()+$i->where('i',"四球")->count()+$a->where('a',"死球")->count()+$b->where('b',"死球")->count()+$c->where('c',"死球")->count()+$d->where('d',"死球")->count()+$e->where('e',"死球")->count()+$f->where('f',"死球")->count()+$g->where('g',"死球")->count()+$h->where('h',"死球")->count()+$i->where('i',"死球")->count();
                      $bant = $a->where('a',"犠")->count()+$b->where('b',"犠")->count()+$c->where('c',"犠")->count()+$d->where('d',"犠")->count()+$e->where('e',"犠")->count()+$f->where('f',"犠")->count()+$g->where('g',"犠")->count()+$h->where('h',"犠")->count()+$i->where('i',"犠")->count();
                      $sacrificefly = $a->where('a',"犠飛")->count()+$b->where('b',"犠飛")->count()+$c->where('c',"犠飛")->count()+$d->where('d',"犠飛")->count()+$e->where('e',"犠飛")->count()+$f->where('f',"犠飛")->count()+$g->where('g',"犠飛")->count()+$h->where('h',"犠飛")->count()+$i->where('i',"犠飛")->count();
                      $atbat = $numberofatbat-$fourdeadball-$bant-$sacrificefly;
                      $k = $a->where('a',"三振")->count()+$b->where('b',"三振")->count()+$c->where('c',"三振")->count()+$d->where('d',"三振")->count()+$e->where('e',"三振")->count()+$f->where('f',"三振")->count()+$g->where('g',"三振")->count()+$h->where('h',"三振")->count()+$i->where('i',"三振")->count();
                      $steal = $userresults->sum('steal');
                      $p = $ad->where('ad',"投")->count()+$bd->where('bd',"投")->count()+$cd->where('cd',"投")->count()+$dd->where('dd',"投")->count()+$ed->where('ed',"投")->count()+$fd->where('fd',"投")->count()+$gd->where('gd',"投")->count()+$hd->where('hd',"投")->count()+$i_d->where('i_d',"投")->count();
                      $c = $ad->where('ad',"捕")->count()+$bd->where('bd',"捕")->count()+$cd->where('cd',"捕")->count()+$dd->where('dd',"捕")->count()+$ed->where('ed',"捕")->count()+$fd->where('fd',"捕")->count()+$gd->where('gd',"捕")->count()+$hd->where('hd',"捕")->count()+$i_d->where('i_d',"捕")->count();
                      $f = $ad->where('ad',"一")->count()+$bd->where('bd',"一")->count()+$cd->where('cd',"一")->count()+$dd->where('dd',"一")->count()+$ed->where('ed',"一")->count()+$fd->where('fd',"一")->count()+$gd->where('gd',"一")->count()+$hd->where('hd',"一")->count()+$i_d->where('i_d',"一")->count();
                      $se = $ad->where('ad',"二")->count()+$bd->where('bd',"二")->count()+$cd->where('cd',"二")->count()+$dd->where('dd',"二")->count()+$ed->where('ed',"二")->count()+$fd->where('fd',"二")->count()+$gd->where('gd',"二")->count()+$hd->where('hd',"二")->count()+$i_d->where('i_d',"二")->count();
                      $th = $ad->where('ad',"三")->count()+$bd->where('bd',"三")->count()+$cd->where('cd',"三")->count()+$dd->where('dd',"三")->count()+$ed->where('ed',"三")->count()+$fd->where('fd',"三")->count()+$gd->where('gd',"三")->count()+$hd->where('hd',"三")->count()+$i_d->where('i_d',"三")->count();
                      $s = $ad->where('ad',"遊")->count()+$bd->where('bd',"遊")->count()+$cd->where('cd',"遊")->count()+$dd->where('dd',"遊")->count()+$ed->where('ed',"遊")->count()+$fd->where('fd',"遊")->count()+$gd->where('gd',"遊")->count()+$hd->where('hd',"遊")->count()+$i_d->where('i_d',"遊")->count();
                      $l = $ad->where('ad',"左")->count()+$bd->where('bd',"左")->count()+$cd->where('cd',"左")->count()+$dd->where('dd',"左")->count()+$ed->where('ed',"左")->count()+$fd->where('fd',"左")->count()+$gd->where('gd',"左")->count()+$hd->where('hd',"左")->count()+$i_d->where('i_d',"左")->count();
                      $ce = $ad->where('ad',"中")->count()+$bd->where('bd',"中")->count()+$cd->where('cd',"中")->count()+$dd->where('dd',"中")->count()+$ed->where('ed',"中")->count()+$fd->where('fd',"中")->count()+$gd->where('gd',"中")->count()+$hd->where('hd',"中")->count()+$i_d->where('i_d',"中")->count();
                      $ri = $ad->where('ad',"右")->count()+$bd->where('bd',"右")->count()+$cd->where('cd',"右")->count()+$dd->where('dd',"右")->count()+$ed->where('ed',"右")->count()+$fd->where('fd',"右")->count()+$gd->where('gd',"右")->count()+$hd->where('hd',"右")->count()+$i_d->where('i_d',"右")->count();
                      $all = $p+$c+$f+$se+$th+$s+$l+$ce+$ri;
                      ?>
              <tr>
                <td>
                  <div class="score">{{$userresults->count()}}</div>
                </td>
                <td>
                  @if($atbat)
                    <div class="score">{{number_format($hits/$atbat,3)}}</div>
                  @else
                    <div class="score">0.000</div>
                  @endif
                </td>
                <td><div class="score">{{$r}}</div></td>
                <td><div class="score">{{$hits}}</div></td>
                <td><div class="score">{{$two}}</div></td>
                <td><div class="score">{{$three}}</div></td>
                <td><div class="score">{{$homerun}}</div></td>
                <td><div class="score">{{$numberofatbat}}</div></td>
                <td><div class="score">{{$atbat}}</div></td>
                <td><div class="score">{{$steal}}</div></td>
                <td><div class="score">{{$fourdeadball}}</div></td>
                <td><div class="score">{{$k}}</div></td>
                <td><div class="score">{{$bant}}</div></td>
                <td><div class="score">{{$sacrificefly}}</div></td>
                <td>
                  @if($numberofatbat)
                    <div class="score">{{number_format(($hits+$fourdeadball)/$numberofatbat,3)}}</div>
                  @else
                    <div class="score">0.000</div>
                  @endif
                </td>
                <td>
                  @if($atbat)
                    <div class="score">{{number_format(($hit+$two*2+$three*3+$homerun*4)/$atbat,3)}}</div>
                  @else
                    <div class="score">0.000</div>
                  @endif
                </td>
                <td>
                  @if($atbat)
                    <div class="score">{{number_format(number_format(($hits+$fourdeadball)/$numberofatbat,3)+number_format(($hit+$two*2+$three*3+$homerun*4)/$atbat,3),3)}}</div>
                  @else
                    <div class="score">0.000</div>
                  @endif
                </td>
              </tr>                
            </tbody>
          </table>

          <table class="table table-sm">
            <thead>
              <tr>
                  <th>
                    <div class="userresult outrresult position1">投</div>
                        @if($p)
                          <div class="score">{{number_format($p/$all,2)*100}}%</div>
                        @else
                          <div class="score">0%</div>
                        @endif
                  </th>
                  <th>
                    <div class="userresult outrresult position2">捕</div>
                        @if($c)
                          <div class="score">{{number_format($c/$all,2)*100}}%</div>
                        @else
                          <div class="score">0%</div>
                        @endif
                  </th>
                  <th>
                    <div class="userresult outrresult position3">一</div>
                        @if($f)
                          <div class="score">{{number_format($f/$all,2)*100}}%</div>
                        @else
                          <div class="score">0%</div>
                        @endif
                  </th>
                  <th>
                    <div class="userresult outrresult position3">二</div>
                        @if($se)
                          <div class="score">{{number_format($se/$all,2)*100}}%</div>
                        @else
                          <div class="score">0%</div>
                        @endif
                  </th>
                  <th>
                    <div class="userresult outrresult position3">三</div>
                        @if($th)
                          <div class="score">{{number_format($th/$all,2)*100}}%</div>
                        @else
                          <div class="score">0%</div>
                        @endif
                  </th>
                  <th>
                    <div class="userresult outrresult position3">遊</div>
                        @if($s)
                          <div class="score">{{number_format($s/$all,2)*100}}%</div>
                        @else
                          <div class="score">0%</div>
                        @endif
                  </th>
                  <th>
                    <div class="userresult outrresult position4">左</div>
                        @if($l)
                          <div class="score">{{number_format($l/$all,2)*100}}%</div>
                        @else
                          <div class="score">0%</div>
                        @endif
                  </th>
                  <th>
                    <div class="userresult outrresult position4">中</div>
                        @if($ce)
                          <div class="score">{{number_format($ce/$all,2)*100}}%</div>
                        @else
                          <div class="score">0%</div>
                        @endif
                  </th>
                  <th>
                    <div class="userresult outrresult position4">右</div>
                        @if($ri)
                          <div class="score">{{number_format($ri/$all,2)*100}}%</div>
                        @else
                          <div class="score">0%</div>
                        @endif
                  </th>
                  <th>
                    <div class="userresult outrresult out">ゴ</div>
                        @if($goro)
                          <div class="score">{{number_format($goro/$ALL,2)*100}}%</div>
                        @else
                          <div class="score">0%</div>
                        @endif
                  </th>
                  <th>
                    <div class="userresult outrresult out">直</div>
                        @if($liner)
                          <div class="score">{{number_format($liner/$ALL,2)*100}}%</div>
                        @else
                          <div class="score">0%</div>
                        @endif
                  </th>
                  <th>
                    <div class="userresult outrresult out">飛</div>
                        @if($fly)
                          <div class="score">{{number_format($fly/$ALL,2)*100}}%</div>
                        @else
                          <div class="score">0%</div>
                        @endif
                  </th>
              </tr>
            </thead>            
          </table>
        </div>
            <div class="table-responsive">
                  <table class="table table-sm">
                    <h3 class="resulttitle text-nowrap">PITCHNG</h3>
                    <thead>
                        <tr>
                          <th><div class="title text-nowrap">試合数</div></th>
                          <th><div class="title text-nowrap">勝</div></th>
                          <th><div class="title text-nowrap">負</div></th>
                          <th><div class="title text-nowrap">Ｓ</div></th>
                          <th><div class="title text-nowrap">防御率</div></th>
                          <th><div class="title text-nowrap">イニング</div></th>
                          <th><div class="title text-nowrap">自責点</div></th>
                          <th><div class="title text-nowrap">失点</div></th>
                          <th><div class="title text-nowrap">奪三振</div></th>
                          <th><div class="title text-nowrap">四死球</div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  
                          $win = $wins->where('wins',"勝")->count();
                          $lose = $wins->where('wins',"負")->count();
                          $save = $wins->where('wins',"Ｓ")->count();
                          $inning = $pitchresults->sum('inning')+$pitchresults->sum('inningathird')/3;
                          $innings = floor($inning);
                          $inningathird = $inning-$innings;
                          $inningsathird =floor($inningathird*10)/3;
                          $earned_run = $pitchresults->sum('earned_run');
                          $runs_allowed = $pitchresults->sum('runs_allowed');
                          $k = $pitchresults->sum('k');
                          $give_four_dead_balls = $pitchresults->sum('give_four_dead_balls');
                          ?>
                    <tr>
                      <td><div class="score">{{$pitchresults->count()}}</div></td>
                      <td><div class="score">{{$win}}</div></td>
                      <td><div class="score">{{$lose}}</div></td>
                      <td><div class="score">{{$save}}</div></td>
                      <td>
                          @if($inning)
                              @if($inning<0.3 and $earned_run>0)
                                  <div class="score">999.99</div>
                                @else
                                  <div class="score">{{number_format($earned_run*9/$inning,2)}}</div>
                              @endif
                          @else
                            <div class="score">0.000</div>
                          @endif
                      </td>
                      <td><div class="score text-nowrap">{{$innings}}回{{$inningsathird}}/3</div></td>
                      <td><div class="score">{{$earned_run}}</div></td>
                      <td><div class="score">{{$runs_allowed}}</div></td>
                      <td><div class="score">{{$k}}</div></td>
                      <td><div class="score">{{$give_four_dead_balls}}</div></td>                    
                    </tr>                
                  </tbody>
                </table>
              </div>
            </div>
              <div>
                  <h2 class="yearresult text-nowrap">{{$y}}年度成績詳細</h2>
                  <h3 class="resulttitle">BATTING</h3>
                <div class="table-responsive">
                  <table class="table table-hover table-striped">
                    <thead>
                      <tr>
                        <th class="text-center"></th>
                        <th class="text-center"></th>
                        <th class="text-center"></th>
                        <th class="text-center"></th>
                        <th class="text-center">1</th>
                        <th class="text-center">2</th>
                        <th class="text-center">3</th>
                        <th class="text-center">4</th>
                        <th class="text-center">5</th>
                        <th class="text-center">6</th>
                        <th class="text-center">7</th>
                        <th class="text-center">8</th>
                        <th class="text-center">9</th>
                        <th class="text-center">盗</th>                
                      </tr>
                    </thead>
                  <tbody>                     
                    @foreach($userresults as $userresult)                
                    <tr>
                      <td>
                          <div class="score">{{$userresult->m}}/{{$userresult->day}}</div>
                      </td>
                      <td>
                          <div class="score mright">{{$userresult->ord}}</>
                      </td>                    
                      <td>
                          @if($userresult->user->position == "投手" && $userresult->user->SubPosition == null )
                            <div class="result_userName position1">{{$userresult->user->Name}}</div>
                          @elseif($userresult->user->position == "捕手" && $userresult->user->SubPosition == null )
                            <div class="result_userName position2">{{$userresult->user->Name}}</div>                        
                          @elseif($userresult->user->position == "外野手" && $userresult->user->SubPosition == null )
                            <div class="result_userName position4">{{$userresult->user->Name}}</div>
                          @elseif($userresult->user->position == "投手" && $userresult->user->SubPosition == "捕手" )
                            <div class="result_userName position5">{{$userresult->user->Name}}</div>
                          @elseif($userresult->user->position == "投手" && $userresult->user->SubPosition == "一塁手" || $userresult->user->position == "投手" && $userresult->user->SubPosition == "二塁手" || $userresult->user->position == "投手" && $userresult->user->SubPosition == "三塁手" || $userresult->user->position == "投手" && $userresult->user->SubPosition == "遊撃手" )
                            <div class="result_userName position6">{{$userresult->user->Name}}</div>
                          @elseif($userresult->user->position == "投手" && $userresult->user->SubPosition == "外野手" )
                            <div class="result_userName position7">{{$userresult->user->Name}}</div>
                          @elseif($userresult->user->position == "捕手" && $userresult->user->SubPosition == "投手" )
                            <div class="result_userName position8">{{$userresult->user->Name}}</div>
                          @elseif($userresult->user->position == "捕手" && $userresult->user->SubPosition == "一塁手" || $userresult->user->position == "捕手" && $userresult->user->SubPosition == "二塁手" || $userresult->user->position == "捕手" && $userresult->user->SubPosition == "三塁手" || $userresult->user->position == "捕手" && $userresult->user->SubPosition == "遊撃手" )
                            <div class="result_userName position9">{{$userresult->user->Name}}</div>
                          @elseif($userresult->user->position == "捕手" && $userresult->user->SubPosition == "外野手" )
                            <div class="result_userName position10">{{$userresult->user->Name}}</div>
                          @elseif($userresult->user->position == "一塁手" && $userresult->user->SubPosition == "投手"|| $userresult->user->position == "二塁手" && $userresult->user->SubPosition == "投手"|| $userresult->user->position == "三塁手" && $userresult->user->SubPosition == "投手"|| $userresult->user->position == "遊撃手" && $userresult->user->SubPosition == "投手"  )
                            <div class="result_userName position11">{{$userresult->user->Name}}</div>
                          @elseif($userresult->user->position == "一塁手" && $userresult->user->SubPosition == "捕手"|| $userresult->user->position == "二塁手" && $userresult->user->SubPosition == "捕手"|| $userresult->user->position == "三塁手" && $userresult->user->SubPosition == "捕手"|| $userresult->user->position == "遊撃手" && $userresult->user->SubPosition == "捕手"  )
                            <div class="result_userName position12">{{$userresult->user->Name}}</div>
                          @elseif($userresult->user->position == "一塁手" && $userresult->user->SubPosition == "外野手"|| $userresult->user->position == "二塁手" && $userresult->user->SubPosition == "外野手"|| $userresult->user->position == "三塁手" && $userresult->user->SubPosition == "外野手"|| $userresult->user->position == "遊撃手" && $userresult->user->SubPosition == "外野手"  )
                            <div class="result_userName position13">{{$userresult->user->Name}}</div>
                          @elseif($userresult->user->position == "外野手" && $userresult->user->SubPosition == "投手" )
                            <div class="result_userName position14">{{$userresult->user->Name}}</div>
                          @elseif($userresult->user->position == "外野手" && $userresult->user->SubPosition == "捕手" )
                            <div class="result_userName position15">{{$userresult->user->Name}}</div>
                          @elseif($userresult->user->position == "外野手" && $userresult->user->SubPosition == "一塁手" || $userresult->user->position == "外野手" && $userresult->user->SubPosition == "二塁手" || $userresult->user->position == "外野手" && $userresult->user->SubPosition == "三塁手" || $userresult->user->position == "外野手" && $userresult->user->SubPosition == "遊撃手" )
                            <div class="result_userName position16">{{$userresult->user->Name}}</div>
                          @elseif($userresult->user->position == "一塁手"|| $userresult->user->position == "二塁手"|| $userresult->user->position == "三塁手"|| $userresult->user->position == "遊撃手"  )
                            <div class="result_userName position3">{{$userresult->user->Name}}</div>
                          @elseif($userresult->user->position == "マネージャー" || $userresult->user->SubPosition == "マネージャー" )
                            <div class="result_userName position17">{{$userresult->user->Name}}</div>
                          @endif
                      </td>
                      <td>
                        @if($userresult->position == "投" )
                          <div class="position position1 mleft">{{$userresult->position}}</div>
                        @elseif($userresult->position == "捕" )
                          <div class="position position2 mleft">{{$userresult->position}}</div>
                        @elseif($userresult->position == "一"|| $userresult->position == "二"||$userresult->position == "三"||$userresult->position == "遊")
                          <div class="position position3 mleft">{{$userresult->position}}</div>
                        @elseif($userresult->position == "左"||$userresult->position == "中"||$userresult->position == "右")
                          <div class="position position4 mleft">{{$userresult->position}}</div>
                        @elseif($userresult->position == "DH")
                          <div class="position position17 mleft">{{$userresult->position}}</div>
                        @elseif($userresult->position == "打"||$userresult->position == "走")
                          <div class="position position18 mleft">{{$userresult->position}}</div>
                        @endif
                      </td>                    
                      <td>
                        <div class="form-group">
                          @if($userresult->a == "安"||$userresult->a == "２"||$userresult->a == "３"||$userresult->a == "本")
                            <div class="userresult hit text-nowrap">{{$userresult->ad}}{{$userresult->a}}
                          @elseif($userresult->a == "ゴ"||$userresult->a == "飛"||$userresult->a == "直"||$userresult->a == "三振")
                            <div class="userresult out text-nowrap">{{$userresult->ad}}{{$userresult->a}}
                          @elseif($userresult->a == "犠"||$userresult->a == "犠飛"||$userresult->a == "他")
                            <div class="userresult bunt text-nowrap">{{$userresult->ad}}{{$userresult->a}}
                          @elseif($userresult->a == "四球"||$userresult->a == "死球")
                            <div class="userresult fourball text-nowrap">{{$userresult->ad}}{{$userresult->a}}
                          @endif
                          @if($userresult->ar)
                            <div class="r">{{$userresult->ar}}</div>
                          @endif
                          </div>
                        </div>
                      </td>

                      <td>
                        <div class="form-group">
                          @if($userresult->b == "安"||$userresult->b == "２"||$userresult->b == "３"||$userresult->b == "本")
                            <div class="userresult hit text-nowrap">{{$userresult->bd}}{{$userresult->b}}
                          @elseif($userresult->b == "ゴ"||$userresult->b == "飛"||$userresult->b == "直"||$userresult->b == "三振")
                            <div class="userresult out text-nowrap">{{$userresult->bd}}{{$userresult->b}}
                          @elseif($userresult->b == "犠"||$userresult->b == "犠飛"||$userresult->b == "他")
                            <div class="userresult bunt text-nowrap">{{$userresult->bd}}{{$userresult->b}}
                          @elseif($userresult->b == "四球"||$userresult->b == "死球")
                            <div class="userresult fourball text-nowrap">{{$userresult->bd}}{{$userresult->b}}
                          @endif
                          @if($userresult->br)                            
                            <div class="r">{{$userresult->br}}</div>
                          @endif
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          @if($userresult->c == "安"||$userresult->c == "２"||$userresult->c == "３"||$userresult->c == "本")
                            <div class="userresult hit text-nowrap">{{$userresult->cd}}{{$userresult->c}}
                          @elseif($userresult->c == "ゴ"||$userresult->c == "飛"||$userresult->c == "直"||$userresult->c == "三振")
                            <div class="userresult out text-nowrap">{{$userresult->cd}}{{$userresult->c}}
                          @elseif($userresult->c == "犠"||$userresult->c == "犠飛"||$userresult->c == "他")
                            <div class="userresult bunt text-nowrap">{{$userresult->cd}}{{$userresult->c}}
                          @elseif($userresult->c == "四球"||$userresult->c == "死球")
                            <div class="userresult fourball text-nowrap">{{$userresult->cd}}{{$userresult->c}}
                          @endif
                          @if($userresult->cr)
                            <div class="r">{{$userresult->cr}}</div>
                          @endif
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          @if($userresult->d == "安"||$userresult->d == "２"||$userresult->d == "３"||$userresult->d == "本")
                            <div class="userresult hit text-nowrap">{{$userresult->dd}}{{$userresult->d}}
                          @elseif($userresult->d == "ゴ"||$userresult->d == "飛"||$userresult->d == "直"||$userresult->d == "三振")
                            <div class="userresult out text-nowrap">{{$userresult->dd}}{{$userresult->d}}
                          @elseif($userresult->d == "犠"||$userresult->d == "犠飛"||$userresult->d == "他")
                            <div class="userresult bunt text-nowrap">{{$userresult->dd}}{{$userresult->d}}
                          @elseif($userresult->d == "四球"||$userresult->d == "死球")
                            <div class="userresult fourball text-nowrap">{{$userresult->dd}}{{$userresult->d}}
                          @endif
                          @if($userresult->dr)
                            <div class="r">{{$userresult->dr}}</div>
                          @endif
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          @if($userresult->e == "安"||$userresult->e == "２"||$userresult->e == "３"||$userresult->e == "本")
                            <div class="userresult hit text-nowrap">{{$userresult->ed}}{{$userresult->e}}
                          @elseif($userresult->e == "ゴ"||$userresult->e == "飛"||$userresult->e == "直"||$userresult->e == "三振")
                            <div class="userresult out text-nowrap">{{$userresult->ed}}{{$userresult->e}}
                          @elseif($userresult->e == "犠"||$userresult->e == "犠飛"||$userresult->e == "他")
                            <div class="userresult bunt text-nowrap">{{$userresult->ed}}{{$userresult->e}}
                          @elseif($userresult->e == "四球"||$userresult->e == "死球")
                            <div class="userresult fourball text-nowrap">{{$userresult->ed}}{{$userresult->e}}
                          @endif
                          @if($userresult->er)
                            <div class="r">{{$userresult->er}}</div>
                          @endif
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          @if($userresult->f == "安"||$userresult->f == "２"||$userresult->f == "３"||$userresult->f == "本")
                            <div class="userresult hit text-nowrap">{{$userresult->fd}}{{$userresult->f}}
                          @elseif($userresult->f == "ゴ"||$userresult->f == "飛"||$userresult->f == "直"||$userresult->f == "三振")
                            <div class="userresult out text-nowrap">{{$userresult->fd}}{{$userresult->f}}
                          @elseif($userresult->f == "犠"||$userresult->f == "犠飛"||$userresult->f == "他")
                            <div class="userresult bunt text-nowrap">{{$userresult->fd}}{{$userresult->f}}
                          @elseif($userresult->f == "四球"||$userresult->f == "死球")
                            <div class="userresult fourball text-nowrap">{{$userresult->fd}}{{$userresult->f}}
                          @endif
                          @if($userresult->fr)
                            <div class="r">{{$userresult->fr}}</div>
                          @endif
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          @if($userresult->g == "安"||$userresult->g == "２"||$userresult->g == "３"||$userresult->g == "本")
                            <div class="userresult hit text-nowrap">{{$userresult->gd}}{{$userresult->g}}
                          @elseif($userresult->g == "ゴ"||$userresult->g == "飛"||$userresult->g == "直"||$userresult->g == "三振")
                            <div class="userresult out text-nowrap">{{$userresult->gd}}{{$userresult->g}}
                          @elseif($userresult->g == "犠"||$userresult->g == "犠飛"||$userresult->g == "他")
                            <div class="userresult bunt text-nowrap">{{$userresult->gd}}{{$userresult->g}}
                          @elseif($userresult->g == "四球"||$userresult->g == "死球")
                            <div class="userresult fourball text-nowrap">{{$userresult->gd}}{{$userresult->g}}
                          @endif
                          @if($userresult->gr)
                            <div class="r">{{$userresult->gr}}</div>
                          @endif
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          @if($userresult->h == "安"||$userresult->h == "２"||$userresult->h == "３"||$userresult->h == "本")
                            <div class="userresult hit text-nowrap">{{$userresult->hd}}{{$userresult->h}}
                          @elseif($userresult->h == "ゴ"||$userresult->h == "飛"||$userresult->h == "直"||$userresult->h == "三振")
                            <div class="userresult out text-nowrap">{{$userresult->hd}}{{$userresult->h}}
                          @elseif($userresult->h == "犠"||$userresult->h == "犠飛"||$userresult->h == "他")
                            <div class="userresult bunt text-nowrap">{{$userresult->hd}}{{$userresult->h}}
                          @elseif($userresult->h == "四球"||$userresult->h == "死球")
                            <div class="userresult fourball text-nowrap">{{$userresult->hd}}{{$userresult->h}}
                          @endif
                          @if($userresult->hr)
                            <div class="r">{{$userresult->hr}}</div>
                          @endif
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          @if($userresult->i == "安"||$userresult->i == "２"||$userresult->i == "３"||$userresult->i == "本")
                            <div class="userresult hit text-nowrap">{{$userresult->i_d}}{{$userresult->i}}
                          @elseif($userresult->i == "ゴ"||$userresult->i == "飛"||$userresult->i == "直"||$userresult->i == "三振")
                            <div class="userresult out text-nowrap">{{$userresult->i_d}}{{$userresult->i}}
                          @elseif($userresult->i == "犠"||$userresult->i == "犠飛"||$userresult->i == "他")
                            <div class="userresult bunt text-nowrap">{{$userresult->i_d}}{{$userresult->i}}
                          @elseif($userresult->i == "四球"||$userresult->i == "死球")
                            <div class="userresult fourball text-nowrap">{{$userresult->i_d}}{{$userresult->i}}
                          @endif
                          @if($userresult->ir)
                            <div class="r">{{$userresult->ir}}</div>
                          @endif
                          </div>
                        </div>
                      </td>                     
                      <td>
                        <div class="form-group">
                            <div class="score">{{$userresult->steal}}</div>                
                        </div>     
                      </td>                   
                  </tr>
              @endforeach                    
            </tbody>
        </table>
    </div>

          <h3 class="resulttitle">PITCHING</h3>
            <div class="table-responsive">
              <table class="table table-hover table-striped">
                <thead>
                  <tr>
                      <th class="text-center text-nowrap"></th>
                      <th class="text-center text-nowrap"></th>
                      <th class="text-center text-nowrap">イニング数</th>
                      <th class="text-center text-nowrap">自責点</th>
                      <th class="text-center text-nowrap">失点</th>
                      <th class="text-center text-nowrap">奪三振</th>
                      <th class="text-center text-nowrap">四死球</th>
                      <th class="text-center text-nowrap">勝敗</th>                      
                    </tr>
                </thead>
                <tbody>
                  <tr>
                    @foreach($pitchresults as $pitchresult)
                      <td>
                          <div class="score">{{$pitchresult->m}}/{{$pitchresult->d}}</div>
                      </td>
                      <td>
                              @if($pitchresult->user->position == "投手" && $pitchresult->user->SubPosition == null )
                                <div class="result_userName position1">{{$pitchresult->user->Name}}</div>
                              @elseif($pitchresult->user->position == "捕手" && $pitchresult->user->SubPosition == null )
                                <div class="result_userName position2">{{$pitchresult->user->Name}}</div>
                              @elseif($pitchresult->user->position == "一塁手" && $pitchresult->user->SubPosition == null|| $pitchresult->user->position == "二塁手" && $pitchresult->user->SubPosition == null|| $pitchresult->user->position == "三塁手" && $pitchresult->user->SubPosition == null|| $pitchresult->user->position == "遊撃手" && $pitchresult->user->SubPosition == null  )
                                <div class="result_userName position3">{{$pitchresult->user->Name}}</div>
                              @elseif($pitchresult->user->position == "外野手" && $pitchresult->user->SubPosition == null )
                                <div class="result_userName position4">{{$pitchresult->user->Name}}</div>
                              @elseif($pitchresult->user->position == "投手" && $pitchresult->user->SubPosition == "捕手" )
                                <div class="result_userName position5">{{$pitchresult->user->Name}}</div>
                              @elseif($pitchresult->user->position == "投手" && $pitchresult->user->SubPosition == "一塁手" || $pitchresult->user->position == "投手" && $pitchresult->user->SubPosition == "二塁手" || $pitchresult->user->position == "投手" && $pitchresult->user->SubPosition == "三塁手" || $pitchresult->user->position == "投手" && $pitchresult->user->SubPosition == "遊撃手" )
                                <div class="result_userName position6">{{$pitchresult->user->Name}}</div>
                              @elseif($pitchresult->user->position == "投手" && $pitchresult->user->SubPosition == "外野手" )
                                <div class="result_userName position7">{{$pitchresult->user->Name}}</div>
                              @elseif($pitchresult->user->position == "捕手" && $pitchresult->user->SubPosition == "投手" )
                                <div class="result_userName position8">{{$pitchresult->user->Name}}</div>
                              @elseif($pitchresult->user->position == "捕手" && $pitchresult->user->SubPosition == "一塁手" || $pitchresult->user->position == "捕手" && $pitchresult->user->SubPosition == "二塁手" || $pitchresult->user->position == "捕手" && $pitchresult->user->SubPosition == "三塁手" || $pitchresult->user->position == "捕手" && $pitchresult->user->SubPosition == "遊撃手" )
                                <div class="result_userName position9">{{$pitchresult->user->Name}}</div>
                              @elseif($pitchresult->user->position == "捕手" && $pitchresult->user->SubPosition == "外野手" )
                                <div class="result_userName position10">{{$pitchresult->user->Name}}</div>
                              @elseif($pitchresult->user->position == "一塁手" && $pitchresult->user->SubPosition == "投手"|| $pitchresult->user->position == "二塁手" && $pitchresult->user->SubPosition == "投手"|| $pitchresult->user->position == "三塁手" && $pitchresult->user->SubPosition == "投手"|| $pitchresult->user->position == "遊撃手" && $pitchresult->user->SubPosition == "投手"  )
                                <div class="result_userName position11">{{$pitchresult->user->Name}}</div>
                              @elseif($pitchresult->user->position == "一塁手" && $pitchresult->user->SubPosition == "捕手"|| $pitchresult->user->position == "二塁手" && $pitchresult->user->SubPosition == "捕手"|| $pitchresult->user->position == "三塁手" && $pitchresult->user->SubPosition == "捕手"|| $pitchresult->user->position == "遊撃手" && $pitchresult->user->SubPosition == "捕手"  )
                                <div class="result_userName position12">{{$pitchresult->user->Name}}</div>
                              @elseif($pitchresult->user->position == "一塁手" && $pitchresult->user->SubPosition == "外野手"|| $pitchresult->user->position == "二塁手" && $pitchresult->user->SubPosition == "外野手"|| $pitchresult->user->position == "三塁手" && $pitchresult->user->SubPosition == "外野手"|| $pitchresult->user->position == "遊撃手" && $pitchresult->user->SubPosition == "外野手"  )
                                <div class="result_userName position13">{{$pitchresult->user->Name}}</div>
                              @elseif($pitchresult->user->position == "外野手" && $pitchresult->user->SubPosition == "投手" )
                                <div class="result_userName position14">{{$pitchresult->user->Name}}</div>
                              @elseif($pitchresult->user->position == "外野手" && $pitchresult->user->SubPosition == "捕手" )
                                <div class="result_userName position15">{{$pitchresult->user->Name}}</div>
                              @elseif($pitchresult->user->position == "外野手" && $pitchresult->user->SubPosition == "一塁手" || $pitchresult->user->position == "外野手" && $pitchresult->user->SubPosition == "二塁手" || $pitchresult->user->position == "外野手" && $pitchresult->user->SubPosition == "三塁手" || $pitchresult->user->position == "外野手" && $pitchresult->user->SubPosition == "遊撃手" )
                                <div class="result_userName position16">{{$pitchresult->user->Name}}</div>
                              @elseif($pitchresult->user->position == "一塁手"|| $pitchresult->user->position == "二塁手"|| $pitchresult->user->position == "三塁手"|| $pitchresult->user->position == "遊撃手"  )
                                <div class="result_userName position3">{{$pitchresult->user->Name}}</div>
                              @elseif($pitchresult->user->position == "マネージャー" || $pitchresult->user->SubPosition == "マネージャー" )
                                <div class="result_userName position17">{{$pitchresult->user->Name}}</div>
                              @endif
                      </td>
                      <td>
                          <div class="score text-nowrap">{{$pitchresult->inning}}回{{$pitchresult->inningathird}}/3</div>
                      </td>
                      <td>
                          <div class="score"> {{$pitchresult->earned_run}}</div>
                      </td>
                      <td>
                          <div class="score"> {{$pitchresult->runs_allowed}}</div>
                      </td>
                      <td>
                          <div class="score"> {{$pitchresult->k}}</div>
                      </td>
                      <td>
                          <div class="score"> {{$pitchresult->give_four_dead_balls}}</div>
                      </td>
                      <td>
                          <div class="score"> {{$pitchresult->wins}}</div>
                      </td>                                          
                  @endforeach
              </tr>
          </tbody>
        </table>
      </div>
  </div>

    @guest
    @else
      @if(Auth::user()->id == $user->id)
        <div class="row  justify-content-center">
              <div class="col-sm-6 mt-3">
                  <a href="{{ route('users.edit',$user) }}" class="btn btn-info btn-lg btn-block">プロフィール編集</a>
              </div>
        </div>
      @else
      @endif
    @endguest
  <a href="{{ route('users.index') }}">一覧へ戻る</a>
</div>

@endsection