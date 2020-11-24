@extends('layouts.app')

@section('title','top')

@section('content')
<div class="container-fluid ">
    <div class="imgtext">
        @if($team->img ==null)
            <img class="max" src="{{ asset('/storage/img/'.'4075649_m.jpg')}}">
        @else
            <img class="max" src="{{ asset('/storage/img/'.$team->img)}}">
        @endif
      <p class="teamname text-nowrap">{{$team->name}}</p>
    </div>
<!-- NextGame -->
<div>
    @guest                      
    @else
      <div class="card">
          <h5 class="card-header text-center">INFORMATION</h5>
        <div class="card-body">
            <h5 class="card-title"><b>新着情報</b></h5>
          <div class="card-text">
              <?php
              $today = date("Y-m-d");
              $twoWeeksAgo = date("Y-m-d",strtotime("+2 week"));
              $threedayslate = date("Y-m-d",strtotime("-3 day"));
              $twoWeeksAgoSchedules = App\Schedules::where('date','>=',$today)->where('date','<',$twoWeeksAgo)->orderBy('date','asc')->get();
              $newSchedules = App\Schedules::where('created_at','>',$threedayslate)->get();
              $newPlayers = App\User::where('created_at','>',$threedayslate)->get();
              $newBlogs = App\Blog::where('created_at','>',$threedayslate)->get();
              ?>
          @foreach($twoWeeksAgoSchedules as $twoWeeksAgoSchedule)
                <?PHP
                $Enterd = App\Userschedule::where('schedule_id',$twoWeeksAgoSchedule->id)->where('id',Auth::user()->id)->first();
                ?>
              @if($Enterd)
              @else
                <a  href="{{ url('schedules') }}">
                  <div class="alert alert-danger">
                    <img src="{{ asset('/storage/img/'.'caution.png')}}" width="20">
                    {{$twoWeeksAgoSchedule->date->format('m月d日')}}
                    未登録
                  </div>
                </a>
              @endif
          @endforeach
            @if($newSchedules)
              @foreach($newSchedules as $newSchedule)
                <a  href="{{ url('schedules') }}">
                    <div class="alert alert-primary">
                        <img src="{{ asset('/storage/img/'.'new.png')}}" width="20">
                        新着スケジュール　{{$newSchedule->date->format('m月d日')}}
                    </div>
                </a>
              @endforeach
            @endif
            @if($newPlayers)
              @foreach($newPlayers as $newPlayer)
                <a  href="{{ url('users') }}">
                    <div class="alert alert-success">
                        <img src="{{ asset('/storage/img/'.'new.png')}}" width="20">
                        新着登録選手　{{$newPlayer->Name}}
                    </div>
                </a>
              @endforeach
            @endif
            @if($newBlogs)
              @foreach($newBlogs as $newBlog)
                <a  href="{{ url('blog') }}">
                  <div class="alert alert-warning">
                        <img src="{{ asset('/storage/img/'.'new.png')}}" width="20">
                        新着ブログ　『{{$newBlog->title}}』
                  </div>
                </a>
              @endforeach
            @endif
          </div>
        </div>
      </div>
    @endguest

    <h2 class="contentstitle text-center">NextGame</h2>
  <div class="card">
    <a  href="{{ url('schedules',$schedules->id) }}">
      <div class="card-header">
          <div class="row">
              <div class="col-9 text-nowrap">
                  <h4> {{$schedules->date->format('Y年m月d日')}}</h4>
              </div>
              <div class="col-3 text-center">
                @guest
                @else
                    <?php
                    $user_schedule = App\Userschedule::where([['id',$user->id],['schedule_id',$schedules->id]])->first();
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
    <div class="card-body row">
        <div class="text-center col-lg-6">
            <div class="contentstitle">
              {{$schedules->opponent}}
            </div>
        </div>
          <?php $place = App\Place::where('id',$schedules->place)->first(); ?>
        <div class="col-lg-6">
            <div class="card-text text-center">
                {{$schedules->s_t->format('H:i')}}-{{$schedules->f_t->format('H:i')}}　
                @if($place)
                    {{$place->name}}
                @else
                    会場未定
                @endif
                @if($schedules->game == 1)
                  【公式戦】
                @elseif($schedules->game == 2)
                  【練習試合】
                @else
                  【練習】
                @endif
            </div>
            <div class="col card-text text-center">
                <?php
                  $userschedule = App\Userschedule::where('schedule_id',$schedules->id)->where('participation','1')->count();
                  $nouserschedule = App\Userschedule::where('schedule_id',$schedules->id)->where('participation','2')->count();
                  $undefind = App\Userschedule::where('schedule_id',$schedules->id)->where('participation','3')->count();
                  ?>
                参加{{$userschedule}}人　　
                不参加{{$nouserschedule}}人　　
                未定{{$undefind}}人
            </div>
        </div>
    </div>
  </a>
</div>
<!-- NextGameEnd -->

<!-- Contents -->

<div>
  <h2 class="contentstitle text-center">Contents</h2>
      <div class="row">      
          <div class="col-sm-6 col-md-4 col-lg-3 imgtext">
              <a class="btn-img" href="{{ url('team') }}">
                <img src="{{ asset('/storage/img/'.'f_f_event_9_s512_f_event_9_0bg.png')}}" width="100%"> 
                <p class="navi nav-link contentstitle text-center" >TEAM</p>
              </a>
          </div>
          <div class="col-sm-6 col-md-4 col-lg-3 imgtext"> 
              <a class="btn-img" href="{{ url('users') }}">
                <img src="{{ asset('/storage/img/'.'user.png')}}" width="100%">
                <p class="navi nav-link contentstitle text-center">PLAYER</p>
              </a>
          </div>
          <div class="col-sm-6 col-md-4 col-lg-3 imgtext">
              <a class="btn-img" href="{{ url('results') }}">
                <img src="{{ asset('/storage/img/'.'f_f_business_20_s512_f_business_20_0bg.png')}}" width="100%">
                <p class="navi nav-link contentstitle text-center">RESULTS</p>
              </a>      
          </div>
          <div class="col-sm-6 col-md-4 col-lg-3 imgtext">
              <a class="btn-img" href="{{ url('table') }}">
                <img src="{{ asset('/storage/img/'.'f_f_object_124_s512_f_object_124_2bg.png')}}" width="100%">
                <p class="navi nav-link contentstitle text-center">RECORDS</p>
              </a>
          </div>
          <div class="col-sm-6 col-md-4 col-lg-3 imgtext">
              <a class="btn-img" href="{{ url('schedules') }}">
                <img src="{{ asset('/storage/img/'.'f_f_business_23_s512_f_business_23_0bg.png')}}" width="100%">
                <p class="navi nav-link contentstitle text-center">SCHEDULES</p>
              </a>
          </div>
          <div class="col-sm-6 col-md-4 col-lg-3 imgtext">
              <a class="btn-img" href="{{ url('blog') }}">
                <img src="{{ asset('/storage/img/'.'f_f_object_24_s512_f_object_24_2bg.png')}}" width="100%"> 
                <p class="navi nav-link contentstitle text-center">BLOG</p>
              </a>
          </div>
          <div class="col-sm-6 col-md-4 col-lg-3 imgtext">
              <a class="btn-img" href="{{ url('album') }}">
                <img src="{{ asset('/storage/img/'.'f_f_business_5_s512_f_business_5_0bg.png')}}" width="100%">
                <p class="navi nav-link contentstitle text-center">ALBUM</p>
              </a>
          </div>
          <div class="col-sm-6 col-md-4 col-lg-3 imgtext">
              <a class="btn-img" href="{{ url('contact') }}">
                <img src="{{ asset('/storage/img/'.'f_f_business_12_s512_f_business_12_0bg.png')}}" width="100%">
                <p class="navi nav-link contentstitle text-center">CONTACTS</p>
              </a>
          </div>
      </div>
    </div>
</div>
<!-- ContentsEnd -->
@endsection