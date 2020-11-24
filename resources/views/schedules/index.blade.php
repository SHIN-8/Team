@extends('layouts.app')

@section('title','index')

@section('content')

<div class="container">
    <div class="contents">日程一覧</div>
        <div class="row">
          @foreach($schedules as $schedule)
            <div class="col-lg-6">
                <div class="card">
                    <a href="{{ url('schedules',$schedule->id) }}">
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
                              <?php $place = App\Place::where('id',$schedule->place)->first(); ?>
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
                        <div class="col card-text text-center">
                              <?php
                              $userschedule = App\Userschedule::where('schedule_id',$schedule->id)->where('participation','1')->count();
                              $nouserschedule = App\Userschedule::where('schedule_id',$schedule->id)->where('participation','2')->count();
                              $undefind = App\Userschedule::where('schedule_id',$schedule->id)->where('participation','3')->count();
                              ?>
                            参加{{$userschedule}}人　　
                            不参加{{$nouserschedule}}人　　
                            未定{{$undefind}}人
                        </div>
                      </div>
                    </a>
                </div>
            </div>
          @endforeach
      </div>
</div>
<a  href="{{ url('/') }}">Homeへ戻る</a>


@endsection