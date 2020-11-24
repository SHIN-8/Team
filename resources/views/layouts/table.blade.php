<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>
  
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    
    <!-- Navbar --><?php $team = App\Team::first();
 ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-dark bg-dark">
        
      <div class="row">
              <a class="navbar-brand" href="{{ url('/') }}">{{$team->name}}</a>
              <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item col-3">
                        <a class="navi nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item col-3">
                            <a class="navi nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @endif
                </div>
                @else
                <div class="row">
                    <li class="nav-item dropdown col-6">
                        <a id="navbarDropdown" class="navi nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <span>{{ Auth::user()->number }}：{{ Auth::user()->Name }}<span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right col-6" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                  </div>
                @endguest
            </ul>
            </nav>
            <nav class="navbar navbar-expand-lg navbar-light bg-light ">
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                 <span class="navbar-toggler-icon"></span>
                </button>
                 <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="navi nav-link" href="{{ url('/') }}">
                                <img src="{{ asset('/storage/img/'.'home.png')}}" width="30">
                                Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="navi nav-link" href="{{ url('team') }}">
                                <img src="{{ asset('/storage/img/'.'team.png')}}" width="30">
                                Team
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="navi nav-link" href="{{ url('users') }}">
                                <img src="{{ asset('/storage/img/'.'player.png')}}" width="30">
                                Players
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="navi nav-link" href="{{ url('results') }}">
                                <img src="{{ asset('/storage/img/'.'teamresult.png')}}" width="30">
                                Result
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="navi nav-link" href="{{ url('table') }}">
                                <img src="{{ asset('/storage/img/'.'playerresult.png')}}" width="30">
                                Records
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="navi nav-link" href="{{ url('schedules') }}">
                                <img src="{{ asset('/storage/img/'.'schedule.png')}}" width="30">
                                Schedules
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="navi nav-link" href="{{ url('place') }}">
                                <img src="{{ asset('/storage/img/'.'place.png')}}" width="30">
                                Places
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="navi nav-link" href="{{ url('blog') }}">
                                <img src="{{ asset('/storage/img/'.'blog.png')}}" width="30">
                                Blog
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="navi nav-link" href="{{ url('album') }}">
                                <img src="{{ asset('/storage/img/'.'camera.png')}}" width="30">
                                Album
                            </a>
                        </li>
                  @guest
                  @else
                      @if(Auth::user()->admin == 0)
                      @else
                          <li class="nav-item">
                              <a class="navi nav-link" href="{{ route('team.admin') }}">
                                  <img src="{{ asset('/storage/img/'.'admin.png')}}" width="30">
                                  Admin
                              </a>
                          </li>
                      @endif
                  @endguest
                </ul>
              </div>
            </nav>
    <!-- NavbarEnd -->
  <div class="body">
      <div class="container">
        <br>
        <div class="row">
            @if(session('status'))
                <div class="message col-md-11">
                    <div class="card">
                        <div class="card-body">
                            {{ session('status')}}
                        </div>
                    </div>
                </div>
            @endif
        <div class="container">
            <div class="row">
                <div class="col-7 contents">成績一覧</div>
                    <div class="col-5 d-flex align-items-center">
                        <a  href="{{ route('table.pitchera',['year'=>$year,'GAME'=>$GAME]) }}">
                            <div class="btn pitchresultChange text-nowrap ">投手成績</div>
                        </a>
                    </div>
                </div>
          
          @yield('content3')
          
              <div class="table-responsive">
                  <table class="table table-hover table-sm ">

                    @yield('content')
                    
                    @yield('content2')

              <tbody>
                    @foreach($players as $player)
                    @if($player->user)
                        <tr>                              
                          <th scope="row">
                            @if($player->user->position == "投手" && $player->user->SubPosition == null )
                              <a  href="{{ url('users',$player->user->id) }}">
                                <div class="result_userName position1">{{$player->user->Name}}</div>
                              </a>
                            @elseif($player->user->position == "捕手" && $player->user->SubPosition == null )
                              <a  href="{{ url('users',$player->user->id) }}">
                                <div class="result_userName position2">{{$player->user->Name}}</div>
                              </a>
                            @elseif($player->user->position == "外野手" && $player->user->SubPosition == null )
                              <a  href="{{ url('users',$player->user->id) }}">
                                <div class="result_userName position4">{{$player->user->Name}}</div>
                              </a>
                            @elseif($player->user->position == "投手" && $player->user->SubPosition == "捕手" )
                              <a  href="{{ url('users',$player->user->id) }}">
                                <div class="result_userName position5">{{$player->user->Name}}</div>
                              </a>
                            @elseif($player->user->position == "投手" && $player->user->SubPosition == "一塁手" || $player->user->position == "投手" && $player->user->SubPosition == "二塁手" || $player->user->position == "投手" && $player->user->SubPosition == "三塁手" || $player->user->position == "投手" && $player->user->SubPosition == "遊撃手" )
                              <a  href="{{ url('users',$player->user->id) }}">
                                <div class="result_userName position6">{{$player->user->Name}}</div>
                              </a>
                            @elseif($player->user->position == "投手" && $player->user->SubPosition == "外野手" )
                              <a  href="{{ url('users',$player->user->id) }}">
                                <div class="result_userName position7">{{$player->user->Name}}</div>
                              </a>
                            @elseif($player->user->position == "捕手" && $player->user->SubPosition == "投手" )
                              <a  href="{{ url('users',$player->user->id) }}">
                                <div class="result_userName position8">{{$player->user->Name}}</div>
                              </a>
                            @elseif($player->user->position == "捕手" && $player->user->SubPosition == "一塁手" || $player->user->position == "捕手" && $player->user->SubPosition == "二塁手" || $player->user->position == "捕手" && $player->user->SubPosition == "三塁手" || $player->user->position == "捕手" && $player->user->SubPosition == "遊撃手" )
                              <a  href="{{ url('users',$player->user->id) }}">
                                <div class="result_userName position9">{{$player->user->Name}}</div>
                              </a>
                            @elseif($player->user->position == "捕手" && $player->user->SubPosition == "外野手" )
                              <a  href="{{ url('users',$player->user->id) }}">
                                <div class="result_userName position10">{{$player->user->Name}}</div>
                              </a>
                            @elseif($player->user->position == "一塁手" && $player->user->SubPosition == "投手"|| $player->user->position == "二塁手" && $player->user->SubPosition == "投手"|| $player->user->position == "三塁手" && $player->user->SubPosition == "投手"|| $player->user->position == "遊撃手" && $player->user->SubPosition == "投手"  )
                              <a  href="{{ url('users',$player->user->id) }}">
                                <div class="result_userName position11">{{$player->user->Name}}</div>
                              </a>
                            @elseif($player->user->position == "一塁手" && $player->user->SubPosition == "捕手"|| $player->user->position == "二塁手" && $player->user->SubPosition == "捕手"|| $player->user->position == "三塁手" && $player->user->SubPosition == "捕手"|| $player->user->position == "遊撃手" && $player->user->SubPosition == "捕手"  )
                              <a  href="{{ url('users',$player->user->id) }}">
                                <div class="result_userName position12">{{$player->user->Name}}</div>
                              </a>
                            @elseif($player->user->position == "一塁手" && $player->user->SubPosition == "外野手"|| $player->user->position == "二塁手" && $player->user->SubPosition == "外野手"|| $player->user->position == "三塁手" && $player->user->SubPosition == "外野手"|| $player->user->position == "遊撃手" && $player->user->SubPosition == "外野手"  )
                              <a  href="{{ url('users',$player->user->id) }}">
                                <div class="result_userName position13">{{$player->user->Name}}</div>
                              </a>
                            @elseif($player->user->position == "外野手" && $player->user->SubPosition == "投手" )
                              <a  href="{{ url('users',$player->user->id) }}">
                                <div class="result_userName position14">{{$player->user->Name}}</div>
                              </a>
                            @elseif($player->user->position == "外野手" && $player->user->SubPosition == "捕手" )
                              <a  href="{{ url('users',$player->user->id) }}">
                                <div class="result_userName position15">{{$player->user->Name}}</div>
                              </a>
                            @elseif($player->user->position == "外野手" && $player->user->SubPosition == "一塁手" || $player->user->position == "外野手" && $player->user->SubPosition == "二塁手" || $player->user->position == "外野手" && $player->user->SubPosition == "三塁手" || $player->user->position == "外野手" && $player->user->SubPosition == "遊撃手" )
                              <a  href="{{ url('users',$player->user->id) }}">
                                <div class="result_userName position16">{{$player->user->Name}}</div>
                              </a>
                            @elseif($player->user->position == "一塁手"|| $player->user->position == "二塁手"|| $player->user->position == "三塁手"|| $player->user->position == "遊撃手"  )
                              <a  href="{{ url('users',$player->user->id) }}">
                                <div class="result_userName position3">{{$player->user->Name}}</div>
                              </a>
                            @elseif($player->user->position == "マネージャー" || $player->user->SubPosition == "マネージャー" )
                              <a  href="{{ url('users',$player->user->id) }}">
                                <div class="result_userName position17">{{$player->user->Name}}</div>
                              </a>
                            @endif
                          </th>
                              <?php
                                // 試合形式別の結果検索
                                if($GAME == 4){
                                  $UserResult = App\Userresult::where('user_id',$player->user_id)->where('y',$year);
                                }else{
                                  $UserResult = App\Userresult::where('user_id',$player->user_id)->where('y',$year)->where('game',$GAME);
                                }
                                // 各変数の設定
                                  $a = $UserResult->select('a')->get();
                                  $b = $UserResult->select('b')->get();
                                  $c = $UserResult->select('c')->get();
                                  $d = $UserResult->select('d')->get();
                                  $e = $UserResult->select('e')->get();
                                  $f = $UserResult->select('f')->get();
                                  $g = $UserResult->select('g')->get();
                                  $h = $UserResult->select('h')->get();
                                  $i = $UserResult->select('i')->get();
                                  $ad = $UserResult->select('ad')->get();
                                  $bd = $UserResult->select('bd')->get();
                                  $cd = $UserResult->select('cd')->get();
                                  $dd = $UserResult->select('dd')->get();
                                  $ed = $UserResult->select('ed')->get();
                                  $fd = $UserResult->select('fd')->get();
                                  $gd = $UserResult->select('gd')->get();
                                  $hd = $UserResult->select('hd')->get();
                                  $i_d = $UserResult->select('i_d')->get();

                                  $games = $UserResult->count();
                                  $r = $UserResult->select('ar')->sum('ar')+
                                        $UserResult->select('br')->sum('br')+
                                        $UserResult->select('cr')->sum('cr')+
                                        $UserResult->select('dr')->sum('dr')+
                                        $UserResult->select('er')->sum('er')+
                                        $UserResult->select('fr')->sum('fr')+
                                        $UserResult->select('gr')->sum('gr')+
                                        $UserResult->select('hr')->sum('hr')+
                                        $UserResult->select('ir')->sum('ir');

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

                                  $k = $a->where('a',"三振")->count()+$b->where('b',"三振")->count()+$c->where('c',"三振")->count()+$d->where('d',"三振")->count()+$e->where('e',"三振")->count()+$f->where('f',"三振")->count()+$g->where('g',"三振")->count()+$h->where('h',"三振")->count()+$i->where('i',"三振")->count();

                                  if($GAME == 4){
                                      $steal = App\Userresult::where('user_id',$player->user_id)->where('y',$year)->select('steal')->sum('steal');
                                    }else{
                                      $steal = App\Userresult::where('user_id',$player->user_id)->where('y',$year)->where('game',$games)->select('steal')->sum('steal');
                                    }
                                  // 直近5試合の結果
                                  if($GAME == 4){
                                    $USERRESULT = App\Userresult::where('user_id',$player->user_id)->orderBy('y','desc')->orderBy('m','desc')->orderBy('day','desc')->take(5);
                                    }else{
                                      $USERRESULT = App\Userresult::where('user_id',$player->user_id)->orderBy('y','desc')->orderBy('m','desc')->orderBy('day','desc')->take(5)->where('game',$GAME);
                                    }
                                  $aR = $USERRESULT->select('a')->get();
                                  $bR = $USERRESULT->select('b')->get();
                                  $cR = $USERRESULT->select('c')->get();
                                  $dR = $USERRESULT->select('d')->get();
                                  $eR = $USERRESULT->select('e')->get();
                                  $fR = $USERRESULT->select('f')->get();
                                  $gR = $USERRESULT->select('g')->get();
                                  $hR = $USERRESULT->select('h')->get();
                                  $iR = $USERRESULT->select('i')->get();

                                  $hitR = $aR->where('a',"安")->count()+$bR->where('b',"安")->count()+$cR->where('c',"安")->count()+$dR->where('d',"安")->count()+$eR->where('e',"安")->count()+$fR->where('f',"安")->count()+$gR->where('g',"安")->count()+$hR->where('h',"安")->count()+$iR->where('i',"安")->count();

                                  $twoR = $aR->where('a',"２")->count()+$bR->where('b',"２")->count()+$cR->where('c',"２")->count()+$dR->where('d',"２")->count()+$eR->where('e',"２")->count()+$fR->where('f',"２")->count()+$gR->where('g',"２")->count()+$hR->where('h',"２")->count()+$iR->where('i',"２")->count();

                                  $threeR = $aR->where('a',"３")->count()+$bR->where('b',"３")->count()+$cR->where('c',"３")->count()+$dR->where('d',"３")->count()+$eR->where('e',"３")->count()+$fR->where('f',"３")->count()+$gR->where('g',"３")->count()+$hR->where('h',"３")->count()+$iR->where('i',"３")->count();

                                  $homerunR = $aR->where('a',"本")->count()+$bR->where('b',"本")->count()+$cR->where('c',"本")->count()+$dR->where('d',"本")->count()+$eR->where('e',"本")->count()+$fR->where('f',"本")->count()+$gR->where('g',"本")->count()+$hR->where('h',"本")->count()+$iR->where('i',"本")->count();

                                  $hitsR = $hitR+$twoR*2+$threeR*3+$homerunR*4;

                                  $numberofatbatR = $aR->where('a','!==',null)->count()+$bR->where('b','!==',null)->count()+$cR->where('c','!==',null)->count()+$dR->where('d','!==',null)->count()+$eR->where('e','!==',null)->count()+$fR->where('f','!==',null)->count()+$gR->where('g','!==',null)->count()+$hR->where('h','!==',null)->count()+$iR->where('i','!==',null)->count();

                                  $Recentry = $hitsR/$numberofatbatR;
                              ?>
                          <td>
                            
                                @if( $hitsR/$numberofatbatR > 0.8 )
                                  <img src="{{ asset('/storage/img/'.'1.jpg')}}" width="35">
                                @elseif( $hitsR/$numberofatbatR > 0.6 )
                                  <img src="{{ asset('/storage/img/'.'2.jpg')}}" width="35">
                                @elseif( $hitsR/$numberofatbatR > 0.3 )
                                  <img src="{{ asset('/storage/img/'.'3.jpg')}}" width="35">
                                @elseif( $hitsR/$numberofatbatR <=0.3 )
                                  <img src="{{ asset('/storage/img/'.'4.jpg')}}" width="35">
                                @elseif( $hitsR/$numberofatbatR = null )
                                  <img src="{{ asset('/storage/img/'.'3.jpg')}}" width="35">
                                @endif
                            </td>
                            <td>
                              @if( $games==$maxGAMES )
                                <div class="topscore">{{$games}}</div>
                              @elseif( $numberofatbat >= $regular)
                                <div class="score">{{$games}}</div>
                              @else
                                <div class="noscore">{{$games}}</div>
                              @endif
                              </td>
                            <td>
                              @if($atbat)
                                  @if( $numberofatbat >= $regular )
                                      @if( number_format($hits/$atbat,3) == number_format($maxAVE,3) )
                                        <div class="topscore">{{number_format($hits/$atbat,3)}}</div>
                                      @else
                                        <div class="score">{{number_format($hits/$atbat,3)}}</div>
                                      @endif
                                  @else
                                    <div class="noscore">{{number_format($hits/$atbat,3)}}</div>
                                  @endif
                              @else
                                <div class="score">0.000</div>
                              @endif
                            </td>
                            <td>
                              @if( $r==$maxR )
                                <div class="topscore">{{$r}}</div>
                              @elseif( $numberofatbat >= $regular )
                                <div class="score">{{$r}}</div>
                              @else
                                <div class="noscore">{{$r}}</div>
                              @endif
                            </td>
                            <td>
                              @if( $hits==$maxHITS )
                                <div class="topscore">{{$hits}}</div>
                              @elseif( $numberofatbat >= $regular )
                                <div class="score">{{$hits}}</div>
                              @else
                                <div class="noscore">{{$hits}}</div>
                              @endif
                            </td>
                            <td>
                              @if( $two==$maxTWO )
                                <div class="topscore">{{$two}}</div>
                              @elseif( $numberofatbat >= $regular )
                                <div class="score">{{$two}}</div>
                              @else
                                <div class="noscore">{{$two}}</div>
                              @endif
                            </td>
                            <td>
                              @if( $three==$maxTHREE )
                                <div class="topscore">{{$three}}</div>
                              @elseif( $numberofatbat >= $regular )
                                <div class="score">{{$three}}</div>
                              @else
                                <div class="noscore">{{$three}}</div>
                              @endif
                            </td>
                            <td>
                              @if( $homerun==$maxHOMERUN )
                                <div class="topscore">{{$homerun}}</div>
                              @elseif( $numberofatbat >= $regular )
                                <div class="score">{{$homerun}}</div>
                              @else
                                <div class="noscore">{{$homerun}}</div>
                              @endif
                            </td>
                            <td>
                              @if( $numberofatbat==$maxNUMBEROFATBAT )
                                <div class="topscore">{{$numberofatbat}}</div>
                              @elseif( $numberofatbat >= $regular )
                                <div class="score">{{$numberofatbat}}</div>
                              @else
                                <div class="noscore">{{$numberofatbat}}</div>
                              @endif
                            </td>
                            <td>
                              @if( $atbat==$maxATBAT )
                                <div class="topscore">{{$atbat}}</div>
                              @elseif( $numberofatbat >= $regular )
                                <div class="score">{{$atbat}}</div>
                              @else
                                <div class="noscore">{{$atbat}}</div>
                              @endif
                            </td>
                            <td>
                              @if( $steal==$maxSTEAL )
                                <div class="topscore">{{$steal}}</div>
                              @elseif( $numberofatbat >= $regular )
                                <div class="score">{{$steal}}</div>
                              @else
                                <div class="noscore">{{$steal}}</div>
                              @endif
                            </td>
                            <td>
                              @if( $fourdeadball==$maxFOURDEADBALL )
                                <div class="topscore">{{$fourdeadball}}</div>
                              @elseif( $numberofatbat >= $regular )
                                <div class="score">{{$fourdeadball}}</div>
                              @else
                                <div class="noscore">{{$fourdeadball}}</div>
                              @endif
                            </td>
                            <td>
                              @if( $k==$maxK )
                                <div class="topscore"> {{$k}}</div>
                              @elseif( $numberofatbat >= $regular )
                                <div class="score">{{$k}}</div>
                              @else
                                <div class="noscore">{{$k}}</div>
                              @endif
                            </td>
                            <td>
                              @if( $bant==$maxBANT )
                                <div class="topscore">{{$bant}}</div>
                              @elseif( $numberofatbat >= $regular )
                                <div class="score">{{$bant}}</div>
                              @else
                                <div class="noscore">{{$bant}}</div>
                              @endif
                            </td>
                            <td>
                              @if( $sacrificefly==$maxSACRIFICEFLY )
                                <div class="topscore">{{$sacrificefly}}</div>
                              @elseif( $numberofatbat >= $regular )
                                <div class="score">{{$sacrificefly}}</div>
                              @else
                                <div class="noscore">{{$sacrificefly}}</div>
                              @endif
                            </td>
                            <td>
                              @if($numberofatbat)
                                  @if( $numberofatbat >= $regular )
                                    @if( number_format(($hits+$fourdeadball)/$numberofatbat,3) == number_format($maxONBASE,3) )
                                      <div class="topscore">{{number_format(($hits+$fourdeadball)/$numberofatbat,3)}}</div>
                                    @else
                                      <div class="score">{{number_format(($hits+$fourdeadball)/$numberofatbat,3)}}</div>
                                    @endif
                                  @else
                                    <div class="noscore">{{number_format(($hits+$fourdeadball)/$numberofatbat,3)}}</div>
                                  @endif
                              @else
                                <div class="score">0.000</div>
                              @endif
                            </td>
                            <td>
                              @if($atbat)
                                @if( $numberofatbat >= $regular )
                                  @if( number_format(($hit+$two*2+$three*3+$homerun*4)/$atbat,3) == number_format($maxSLUGGING,3) )
                                    <div class="topscore">{{number_format(($hit+$two*2+$three*3+$homerun*4)/$atbat,3)}}</div>
                                  @else
                                    <div class="score">{{number_format(($hit+$two*2+$three*3+$homerun*4)/$atbat,3)}}</div>
                                  @endif
                                @else
                                  <div class="noscore">{{number_format(($hit+$two*2+$three*3+$homerun*4)/$atbat,3)}}</div>
                                @endif
                              @else
                                <div class="score">0.000</div>
                              @endif
                            </td>
                            <td>
                              @if($atbat)
                                @if( $numberofatbat >= $regular )
                                    @if( number_format(($hits+$fourdeadball)/$numberofatbat+($hit+$two*2+$three*3+$homerun*4)/$atbat,3) == number_format($maxOPS,3) )
                                      <div class="topscore"> {{number_format(number_format(($hits+$fourdeadball)/$numberofatbat,3)+number_format(($hit+$two*2+$three*3+$homerun*4)/ $atbat,3),3)}}</div>
                                    @else
                                      <div class="score">{{number_format(number_format(($hits+$fourdeadball)/$numberofatbat,3)+number_format(($hit+$two*2+$three*3+$homerun*4)/$atbat,3),3)}}</div>
                                    @endif
                                @else
                                  <div class="noscore">{{number_format(number_format(($hits+$fourdeadball)/$numberofatbat,3)+number_format(($hit+$two*2+$three*3+$homerun*4)/$atbat,3),3)}}</div>
                                @endif
                              @else
                                <div class="score">0.000</div>
                              @endif
                            </td>
                          </tr>    
                  @endif
              @endforeach 
            </tbody>
          </table>
          <p><b>※規定打席は{{$regular}}打席(試合数{{$game}}×1.2)</b></p>
          <a  href="{{ url('/') }}">Homeへ戻る</a>
        </div>
      </div>
    </div>
  </div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js" integrity="sha384-XEerZL0cuoUbHE4nZReLT7nx9gQrQreJekYhJD9WNWhH8nEW+0c5qq7aIo2Wl30J" crossorigin="anonymous"></script>
</body>
 <!-- FOOTER -->
 <footer class="container">
    <p class="float-right"><a href="#">Back to top</a></p>
    <p>&copy; 2017-2020 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
  </footer>
</main>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="/docs/4.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-FxkQtQ8fW6C3xA7BoW8ocAb2N7U9dCA7ZJXMJlz/37PL6Q6PUGQ5ZeJcaXdYKcdJ" crossorigin="anonymous"></script></body>
</html>
