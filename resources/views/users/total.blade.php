@extends('layouts.app')

@section('title','total')

@section('content')

<div class="container">
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
  <div class="col-7  float-right text-nowrap">
      <a href="{{ route('users.show',['user'=>$user]) }}">
          <div class="yearresult btn">{{$y}}年度成績</div>
      </a>
  </div>
<div>
    <div class="row">
        <div class="col-12 text-nowrap">
            <div class="totalresult">通算成績</div>
        </div>
    </div>  
  <h3 class="resulttitle">BATTING</h3>
      <div class="table-responsive">
          <table class="table table-sm">
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
                    $rT = $userresultsT->sum('ar')+$userresultsT->sum('br')+$userresultsT->sum('cr')+$userresultsT->sum('dr')+$userresultsT->sum('er')+$userresultsT->sum('fr')+$userresultsT->sum('gr')+$userresultsT->sum('hr')+$userresultsT->sum('ir');
                    $hitT = $aT->where('a',"安")->count()+$bT->where('b',"安")->count()+$cT->where('c',"安")->count()+$dT->where('d',"安")->count()+$eT->where('e',"安")->count()+$fT->where('f',"安")->count()+$gT->where('g',"安")->count()+$hT->where('h',"安")->count()+$iT->where('i',"安")->count();
                    $twoT = $aT->where('a',"２")->count()+$bT->where('b',"２")->count()+$cT->where('c',"２")->count()+$dT->where('d',"２")->count()+$eT->where('e',"２")->count()+$fT->where('f',"２")->count()+$gT->where('g',"２")->count()+$hT->where('h',"２")->count()+$iT->where('i',"２")->count();
                    $threeT = $aT->where('a',"３")->count()+$bT->where('b',"３")->count()+$cT->where('c',"３")->count()+$dT->where('d',"３")->count()+$eT->where('e',"３")->count()+$fT->where('f',"３")->count()+$gT->where('g',"３")->count()+$hT->where('h',"３")->count()+$iT->where('i',"３")->count();
                    $homerunT = $aT->where('a',"本")->count()+$bT->where('b',"本")->count()+$cT->where('c',"本")->count()+$dT->where('d',"本")->count()+$eT->where('e',"本")->count()+$fT->where('f',"本")->count()+$gT->where('g',"本")->count()+$hT->where('h',"本")->count()+$iT->where('i',"本")->count();
                    $goroT = $aT->where('a',"ゴ")->count()+$bT->where('b',"ゴ")->count()+$cT->where('c',"ゴ")->count()+$dT->where('d',"ゴ")->count()+$eT->where('e',"ゴ")->count()+$fT->where('f',"ゴ")->count()+$gT->where('g',"ゴ")->count()+$hT->where('h',"ゴ")->count()+$iT->where('i',"ゴ")->count();
                    $linerT = $aT->where('a',"直")->count()+$bT->where('b',"直")->count()+$cT->where('c',"直")->count()+$dT->where('d',"直")->count()+$eT->where('e',"直")->count()+$fT->where('f',"直")->count()+$gT->where('g',"直")->count()+$hT->where('h',"直")->count()+$iT->where('i',"直")->count();
                    $flyT = $aT->where('a',"飛")->count()+$bT->where('b',"飛")->count()+$cT->where('c',"飛")->count()+$dT->where('d',"飛")->count()+$eT->where('e',"飛")->count()+$fT->where('f',"飛")->count()+$gT->where('g',"飛")->count()+$hT->where('h',"飛")->count()+$iT->where('i',"飛")->count();
                    $ALLT = $goroT +$linerT +$flyT;
                    $hitsT = $hitT+$twoT+$threeT+$homerunT;
                    $numberofatbatT = $aT->where('a','!==',null)->count()+$bT->where('b','!==',null)->count()+$cT->where('c','!==',null)->count()+$dT->where('d','!==',null)->count()+$eT->where('e','!==',null)->count()+$fT->where('f','!==',null)->count()+$gT->where('g','!==',null)->count()+$hT->where('h','!==',null)->count()+$iT->where('i','!==',null)->count();
                    $fourdeadballT = $aT->where('a',"四球")->count()+$bT->where('b',"四球")->count()+$cT->where('c',"四球")->count()+$dT->where('d',"四球")->count()+$eT->where('e',"四球")->count()+$fT->where('f',"四球")->count()+$gT->where('g',"四球")->count()+$hT->where('h',"四球")->count()+$iT->where('i',"四球")->count()+$aT->where('a',"死球")->count()+$bT->where('b',"死球")->count()+$cT->where('c',"死球")->count()+$dT->where('d',"死球")->count()+$eT->where('e',"死球")->count()+$fT->where('f',"死球")->count()+$gT->where('g',"死球")->count()+$hT->where('h',"死球")->count()+$iT->where('i',"死球")->count();
                  $bantT = $aT->where('a',"犠")->count()+$bT->where('b',"犠")->count()+$cT->where('c',"犠")->count()+$dT->where('d',"犠")->count()+$eT->where('e',"犠")->count()+$fT->where('f',"犠")->count()+$gT->where('g',"犠")->count()+$hT->where('h',"犠")->count()+$iT->where('i',"犠")->count();
                  $sacrificeflyT = $aT->where('a',"犠飛")->count()+$bT->where('b',"犠飛")->count()+$cT->where('c',"犠飛")->count()+$dT->where('d',"犠飛")->count()+$eT->where('e',"犠飛")->count()+$fT->where('f',"犠飛")->count()+$gT->where('g',"犠飛")->count()+$hT->where('h',"犠飛")->count()+$iT->where('i',"犠飛")->count();
                  $atbatT = $numberofatbatT-$fourdeadballT-$bantT-$sacrificeflyT;
                  $kT = $aT->where('a',"三振")->count()+$bT->where('b',"三振")->count()+$cT->where('c',"三振")->count()+$dT->where('d',"三振")->count()+$eT->where('e',"三振")->count()+$fT->where('f',"三振")->count()+$gT->where('g',"三振")->count()+$hT->where('h',"三振")->count()+$iT->where('i',"三振")->count();
                  $stealT = $userresultsT->sum('steal');
                  $pT = $adT->where('ad',"投")->count()+$bdT->where('bd',"投")->count()+$cdT->where('cd',"投")->count()+$ddT->where('dd',"投")->count()+$edT->where('ed',"投")->count()+$fdT->where('fd',"投")->count()+$gdT->where('gd',"投")->count()+$hdT->where('hd',"投")->count()+$i_dT->where('i_d',"投")->count();
                  $cT = $adT->where('ad',"捕")->count()+$bdT->where('bd',"捕")->count()+$cdT->where('cd',"捕")->count()+$ddT->where('dd',"捕")->count()+$edT->where('ed',"捕")->count()+$fdT->where('fd',"捕")->count()+$gdT->where('gd',"捕")->count()+$hdT->where('hd',"捕")->count()+$i_dT->where('i_d',"捕")->count();
                  $fT = $adT->where('ad',"一")->count()+$bdT->where('bd',"一")->count()+$cdT->where('cd',"一")->count()+$ddT->where('dd',"一")->count()+$edT->where('ed',"一")->count()+$fdT->where('fd',"一")->count()+$gdT->where('gd',"一")->count()+$hdT->where('hd',"一")->count()+$i_dT->where('i_d',"一")->count();
                  $seT = $adT->where('ad',"二")->count()+$bdT->where('bd',"二")->count()+$cdT->where('cd',"二")->count()+$ddT->where('dd',"二")->count()+$edT->where('ed',"二")->count()+$fdT->where('fd',"二")->count()+$gdT->where('gd',"二")->count()+$hdT->where('hd',"二")->count()+$i_dT->where('i_d',"二")->count();
                  $thT = $adT->where('ad',"三")->count()+$bdT->where('bd',"三")->count()+$cdT->where('cd',"三")->count()+$ddT->where('dd',"三")->count()+$edT->where('ed',"三")->count()+$fdT->where('fd',"三")->count()+$gdT->where('gd',"三")->count()+$hdT->where('hd',"三")->count()+$i_dT->where('i_d',"三")->count();
                  $sT = $adT->where('ad',"遊")->count()+$bdT->where('bd',"遊")->count()+$cdT->where('cd',"遊")->count()+$ddT->where('dd',"遊")->count()+$edT->where('ed',"遊")->count()+$fdT->where('fd',"遊")->count()+$gdT->where('gd',"遊")->count()+$hdT->where('hd',"遊")->count()+$i_dT->where('i_d',"遊")->count();
                  $lT = $adT->where('ad',"左")->count()+$bdT->where('bd',"左")->count()+$cdT->where('cd',"左")->count()+$ddT->where('dd',"左")->count()+$edT->where('ed',"左")->count()+$fdT->where('fd',"左")->count()+$gdT->where('gd',"左")->count()+$hdT->where('hd',"左")->count()+$i_dT->where('i_d',"左")->count();
                  $ceT = $adT->where('ad',"中")->count()+$bdT->where('bd',"中")->count()+$cdT->where('cd',"中")->count()+$ddT->where('dd',"中")->count()+$edT->where('ed',"中")->count()+$fdT->where('fd',"中")->count()+$gdT->where('gd',"中")->count()+$hdT->where('hd',"中")->count()+$i_dT->where('i_d',"中")->count();
                  $riT = $adT->where('ad',"右")->count()+$bdT->where('bd',"右")->count()+$cdT->where('cd',"右")->count()+$ddT->where('dd',"右")->count()+$edT->where('ed',"右")->count()+$fdT->where('fd',"右")->count()+$gdT->where('gd',"右")->count()+$hdT->where('hd',"右")->count()+$i_dT->where('i_d',"右")->count();
                  $allT = $pT+$cT+$fT+$seT+$thT+$sT+$lT+$ceT+$riT;
                    ?>
              <tr>
                <td><div class="score">{{$userresultsT->count()}}</div></td>
                <td>
                  @if($atbatT)
                  <div class="score">{{number_format($hitsT/$atbatT,3)}}</div>
                  @else
                  <div class="score">0.000</div>
                  @endif
                </td>
                <td><div class="score">{{$rT}}</div></td>
                <td><div class="score">{{$hitsT}}</div></td>
                <td><div class="score">{{$twoT}}</div></td>
                <td><div class="score">{{$threeT}}</div></td>
                <td><div class="score">{{$homerunT}}</div></td>
                <td><div class="score">{{$numberofatbatT}}</div></td>
                <td><div class="score">{{$atbatT}}</div></td>
                <td><div class="score">{{$stealT}}</div></td>
                <td><div class="score">{{$fourdeadballT}}</div></td>
                <td><div class="score">{{$kT}}</div></td>
                <td><div class="score">{{$bantT}}</div></td>
                <td><div class="score">{{$sacrificeflyT}}</div></td>
                <td>
                    @if($numberofatbatT)
                      <div class="score">{{number_format(($hitsT+$fourdeadballT)/$numberofatbatT,3)}}</div>
                    @else
                      <div class="score">0.000</div>
                    @endif
                </td>
                <td>
                    @if($atbatT)
                      <div class="score">{{number_format(($hitT+$twoT*2+$threeT*3+$homerunT*4)/$atbatT,3)}}</div>
                    @else
                      <div class="score">0.000</div>
                    @endif
                </td>
                <td>
                    @if($atbatT)
                      <div class="score">{{number_format(number_format(($hitsT+$fourdeadballT)/$numberofatbatT,3)+number_format(($hitT+$twoT*2+$threeT*3+$homerunT*4)/$atbatT,3),3)}}</div>
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
                @if($pT)
                  <div class="score">{{number_format($pT/$allT,2)*100}}%</div>
                @else
                  <div class="score">0%</div>
                @endif
            </th>
            <th>
              <div class="userresult outrresult position2">捕</div>
                @if($cT)
                  <div class="score">{{number_format($cT/$allT,2)*100}}%</div>
                @else
                  <div class="score">0%</div>
                @endif
            </th>
            <th>
              <div class="userresult outrresult position3">一</div>
                @if($fT)
                  <div class="score">{{number_format($fT/$allT,2)*100}}%</div>
                @else
                  <div class="score">0%</div>
                @endif
            </th>
            <th>
              <div class="userresult outrresult position3">二</div>
                @if($seT)
                  <div class="score">{{number_format($seT/$allT,2)*100}}%</div>
                @else
                  <div class="score">0%</div>
                @endif
            </th>
            <th>
              <div class="userresult outrresult position3">三</div>
                @if($thT)
                  <div class="score">{{number_format($thT/$allT,2)*100}}%</div>
                @else
                  <div class="score">0%</div>
                @endif
            </th>
            <th>
              <div class="userresult outrresult position3">遊</div>
                @if($sT)
                  <div class="score">{{number_format($sT/$allT,2)*100}}%</div>
                @else
                  <div class="score">0%</div>
                @endif
            </th>
            <th>
              <div class="userresult outrresult position4">左</div>
                @if($lT)
                  <div class="score">{{number_format($lT/$allT,2)*100}}%</div>
                @else
                  <div class="score">0%</div>
                @endif
            </th>
            <th>
              <div class="userresult outrresult position4">中</div>
                @if($ceT)
                  <div class="score">{{number_format($ceT/$allT,2)*100}}%</div>
                @else
                  <div class="score">0%</div>
                @endif
            </th>
            <th>
              <div class="userresult outrresult position4">右</div>
                @if($riT)
                  <div class="score">{{number_format($riT/$allT,2)*100}}%</div>
                @else
                  <div class="score">0%</div>
                @endif
            </th>
            <th>
              <div class="userresult outrresult out">ゴ</div>
                @if($goroT)
                  <div class="score">{{number_format($goroT/$ALLT,2)*100}}%</div>
                @else
                  <div class="score">0%</div>
                @endif
            </th>
            <th>
              <div class="userresult outrresult out">直</div>
                @if($linerT)
                  <div class="score">{{number_format($linerT/$ALLT,2)*100}}%</div>
                @else
                  <div class="score">0%</div>
                @endif
            </th>
            <th>
              <div class="userresult outrresult out">飛</div>
                @if($flyT)
                  <div class="score">{{number_format($flyT/$ALLT,2)*100}}%</div>
                @else
                  <div class="score">0%</div>
                @endif
            </th>
        </tr>
      </thead>      
    </table>
  </div>
      <h3 class="resulttitle">PITCHING</h3>
  <div class="table-responsive">
    <table class="table table-sm">
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
            $winT = $winsT->where('wins',"勝")->count();
            $loseT = $winsT->where('wins',"負")->count();
            $saveT = $winsT->where('wins',"Ｓ")->count();
            $inningT = $pitchresultsT->sum('inning')+$pitchresultsT->sum('inningathird')/3;
            $inningsT = floor($inningT);
            $inningathirdT = $inningT-$inningsT;
            $inningsathirdT =floor($inningathirdT*10)/3;
            $earned_runT = $pitchresultsT->sum('earned_run');
            $runs_allowedT = $pitchresultsT->sum('runs_allowed');
            $kT = $pitchresultsT->sum('k');
            $give_four_dead_ballsT = $pitchresultsT->sum('give_four_dead_balls');
            ?>
          <tr>
            <td><div class="score">{{$pitchresultsT->count()}}</div></td>
            <td><div class="score">{{$winT}}</div></td>
            <td><div class="score">{{$loseT}}</div></td>
            <td><div class="score">{{$saveT}}</div></td>
            <td>
              @if($inningT)
                  @if($inningT<0.3 and $earned_runT>0)
                      <div class="score">999.99</div>
                  @else
                      <div class="score">{{number_format($earned_runT*9/$inningT,2)}}</div>
                  @endif
              @else
                <div class="score">0.000</div>
              @endif
            </td>
            <td><div class="score text-nowrap">{{$inningsT}}回{{$inningsathirdT}}/3</div></td>
            <td><div class="score">{{$earned_runT}}</div></td>
            <td><div class="score">{{$runs_allowedT}}</div></td>
            <td><div class="score">{{$kT}}</div></td>
            <td><div class="score">{{$give_four_dead_ballsT}}</div></td>          
          </tr>  
        </tbody>
      </table>
    </div>
  <a href="{{ route('users.index') }}">一覧へ戻る</a>
</div>

@endsection