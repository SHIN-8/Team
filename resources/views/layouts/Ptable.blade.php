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
      <br>
        <div class="row">
            <div class="col-7 contents">成績一覧</div>
                <div class="col-5  d-flex align-items-center">
                  <a  href="{{ route('table.index',['year'=>$year,'GAME'=>$GAME]) }}">
                      <div class="btn yearresult text-nowrap">
                        野手成績
                      </div>
                  </a>
                </div>
            </div>
      
      @yield('content3')
      
      <div class="table-responsive">
          <table class="table table-hover table-sm">

            @yield('content')

          <tbody>
            <tr>
                @foreach($players as $player) 
                    @if($player->user)
                        <?php
                        // 各変数の設定
                        if($GAME == 4){
                          $pitchresult = App\Pitchresult::where('user_id',$player->user->number)->where('y',$year);
                        }else{
                          $pitchresult = App\Pitchresult::where('user_id',$player->user->number)->where('y',$year)->where('pitch_games',$GAME);
                        }
                        $games = $pitchresult->count();
                        if($GAME == 4){
                          $wins= App\Pitchresult::where('user_id',$player->user->number)->where('y',$year)->select('wins')->get();
                        }else{
                          $wins = App\Pitchresult::where('user_id',$player->user->number)->where('y',$year)->where('pitch_games',$GAME)->select('wins')->get();
                        }
                        $win = $wins->where('wins',"勝")->count();
                        $lose = $wins->where('wins',"負")->count();
                        $save = $wins->where('wins',"Ｓ")->count();
                        $inning = $pitchresult->sum('inning')+$pitchresult->sum('inningathird')/3;
                        $innings = floor($inning);
                        $inningathird = abs($innings-$inning);
                        $inningsathird =floor($inningathird*10/3);
                        $earned_run = $pitchresult->sum('earned_run');
                        $runs_allowed = $pitchresult->sum('runs_allowed');
                        $k = $pitchresult->sum('k');
                        $give_four_dead_balls = $pitchresult->sum('give_four_dead_balls');

                        // 試合形式別の結果検索
                        if($GAME == 4){
                          $pitchresultR= App\Pitchresult::where('user_id',$player->user->number)->orderBy('y','desc')->orderBy('m','desc')->orderBy('d','desc')->take(5)->get();
                        }else{
                          $pitchresultR = App\Pitchresult::where('user_id',$player->user->number)->where('pitch_games',$GAME)->orderBy('y','desc')->orderBy('m','desc')->orderBy('d','desc')->take(5)->get();
                        }

                        // 直近5試合の結果
                        $pitchresultR = App\Pitchresult::where('user_id',$player->user->number)->orderBy('y','desc')->orderBy('m','desc')->orderBy('d','desc')->take(5)->get();
                        $inningR = $pitchresultR->sum('inning')*3+$pitchresultR->sum('inningathird');
                        $earned_runR = $pitchresultR->sum('earned_run');
                        ?>

                    @if(!empty($inning) || !empty($earned_run))
                        <th>
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
                        <td>
                          @if($inningR)
                              @if( $earned_runR*9/$inningR <1 )
                                <img src="{{ asset('/storage/img/'.'1.jpg')}}" width="35">
                              @elseif( $earned_runR*9/$inningR <3 )
                                <img src="{{ asset('/storage/img/'.'2.jpg')}}" width="35">
                              @elseif( $earned_runR*9/$inningR <4 )
                                <img src="{{ asset('/storage/img/'.'3.jpg')}}" width="35">
                              @elseif( $earned_runR*9/$inningR >=4 )
                                <img src="{{ asset('/storage/img/'.'4.jpg')}}" width="35">
                              @endif
                          @else
                            <img src="{{ asset('/storage/img/'.'3.jpg')}}" width="35">
                          @endif
                        </td>
                        <td>
                          @if( $games==$maxGAMES )
                            <div class="topscore">{{$games}}</div>      
                          @elseif( $inning >= $game )
                            <div class="score">{{$games}}</div>      
                          @else
                            <div class="noscore">{{$games}}</div>
                          @endif
                        </td>
                        <td>
                          @if( $win==$maxWIN )
                            <div class="topscore">{{$win}}</div>      
                          @elseif( $inning >= $game )
                            <div class="score">{{$win}}</div>      
                          @else
                            <div class="noscore">{{$win}}</div>      
                          @endif
                        </td>
                        <td>
                          @if( $lose==$maxLOSE )
                            <div class="topscore">{{$lose}}</div>      
                          @elseif( $inning >= $game )
                            <div class="score">{{$lose}}</div>      
                          @else
                            <div class="noscore">{{$lose}}</div>      
                          @endif
                        </td>
                        <td>
                          @if( $save==$maxSAVE )
                            <div class="topscore">{{$save}}</div>      
                          @elseif( $inning >= $game )
                            <div class="score">{{$save}}</div>      
                          @else
                            <div class="noscore">{{$save}}</div>      
                          @endif
                        </td>
                        <td>
                          @if($inning)
                              @if( $inning >= $game )
                                  @if( $earned_run*9/$inning == $minERA )
                                    <div class="topscore">{{number_format($earned_run*9/$inning,2)}}</div>
                                  @else
                                    <div class="score">{{number_format($earned_run*9/$inning,2)}}</div>
                                  @endif
                              @else
                                <div class="noscore">{{number_format($earned_run*9/$inning,2)}}</div>
                              @endif
                          @elseif($earned_run>0)
                              <div class="noscore">999.99</div>
                          @else
                              <div class="noscore">0.000</div>
                          @endif
                        </td>
                        <td>
                          @if( $innings+($inningsathird/3) == $maxINNING )
                            <div class="topscore text-nowrap">{{$innings}}回{{$inningsathird}}/3</div>      
                          @elseif( $inning >= $game )
                            <div class="score text-nowrap">{{$innings}}回{{$inningsathird}}/3</div>      
                          @else
                            <div class="noscore text-nowrap">{{$innings}}回{{$inningsathird}}/3</div>      
                          @endif
                        </td>
                        <td>
                          @if( $earned_run==$maxEARNEDRUN )
                            <div class="topscore">{{$earned_run}}</div>      
                          @elseif( $inning >= $game )
                            <div class="score">{{$earned_run}}</div>      
                          @else
                            <div class="noscore">{{$earned_run}}</div>      
                          @endif
                        </td>
                        <td>
                          @if( $runs_allowed==$maxRUNSALLOWED )
                            <div class="topscore">{{$runs_allowed}}</div>      
                          @elseif( $inning >= $game )
                            <div class="score">{{$runs_allowed}}</div>      
                          @else
                            <div class="noscore">{{$runs_allowed}}</div>      
                          @endif
                        </td>
                        <td>
                          @if( $k==$maxK )
                            <div class="topscore">{{$k}}</div>      
                          @elseif( $inning >= $game )
                            <div class="score">{{$k}}</div>      
                          @else
                            <div class="noscore">{{$k}}</div>      
                          @endif
                        </td>
                        <td>
                          @if( $give_four_dead_balls==$maxFOURBALL )
                            <div class="topscore">{{$give_four_dead_balls}}</div>      
                          @elseif( $inning >= $game )
                            <div class="score">{{$give_four_dead_balls}}</div>      
                          @else
                            <div class="noscore">{{$give_four_dead_balls}}</div>      
                          @endif
                        </td>
                  </tr>
                @endif
              @endif
            @endforeach
      </tbody>
    </table>
      <p><b>※規定投球回数は{{$game}}回(試合数{{$game}}×1.0)</b></p>
      <a  href="{{ url('/') }}">Homeへ戻る</a>
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
  </footer>
</main>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="/docs/4.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-FxkQtQ8fW6C3xA7BoW8ocAb2N7U9dCA7ZJXMJlz/37PL6Q6PUGQ5ZeJcaXdYKcdJ" crossorigin="anonymous"></script></body>
</html>
