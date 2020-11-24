@extends('layouts.app')

@section('title','index')

@section('content')

<div class="container">
    <h2 class="contents text-nowrap">選手紹介</h2>
        <div class="row">
            @if($users)
            @foreach($users as $user)
                <div class="col-sm-12 col-md-6 col-lg-4">
                  <a  href="{{ url('users',$user->id) }}">
                  <div class="row">
                    <div class="col-6">
                        @if($user->position == "投手" && $user->SubPosition == null )
                          <div class="userName position1">{{$user->Name}}</div>
                        @elseif($user->position == "捕手" && $user->SubPosition == null )
                          <div class="userName position2">{{$user->Name}}</div>
                        @elseif($user->position == "一塁手" && $user->SubPosition == null||$user->position == "一塁手" && $user->SubPosition == "二塁手"||$user->position == "一塁手" && $user->SubPosition == "三塁手"||$user->position == "一塁手" && $user->SubPosition == "遊撃手"|| $user->position == "二塁手" && $user->SubPosition == null||$user->position == "二塁手" && $user->SubPosition == "一塁手"||$user->position == "二塁手" && $user->SubPosition == "三塁手"||$user->position == "二塁手" && $user->SubPosition == "遊撃手"|| $user->position == "三塁手" && $user->SubPosition == null||$user->position == "三塁手" && $user->SubPosition == "一塁手"||$user->position == "三塁手" && $user->SubPosition == "二塁手"||$user->position == "三塁手" && $user->SubPosition == "遊撃手"|| $user->position == "遊撃手" && $user->SubPosition == null||$user->position == "遊撃手" && $user->SubPosition == "一塁手"||$user->position == "遊撃手" && $user->SubPosition == "二塁手"||$user->position == "遊撃手" && $user->SubPosition == "三塁手" )
                          <div class="userName position3">{{$user->Name}}</div>
                        @elseif($user->position == "外野手" && $user->SubPosition == null )
                          <div class="userName position4">{{$user->Name}}</div>
                        @elseif($user->position == "投手" && $user->SubPosition == "捕手")
                          <div class="userName position5">{{$user->Name}}</div>
                        @elseif($user->position == "投手" && $user->SubPosition == "一塁手" || $user->position == "投手" && $user->SubPosition == "二塁手" || $user->position == "投手" && $user->SubPosition == "三塁手" || $user->position == "投手" && $user->SubPosition == "遊撃手")
                          <div class="userName position6">{{$user->Name}}</div>
                        @elseif($user->position == "投手" && $user->SubPosition == "外野手")
                          <div class="userName position7">{{$user->Name}}</div>
                        @elseif($user->position == "捕手" && $user->SubPosition == "投手")
                          <div class="userName position8">{{$user->Name}}</div>
                        @elseif($user->position == "捕手" && $user->SubPosition == "一塁手" || $user->position == "捕手" && $user->SubPosition == "二塁手" || $user->position == "捕手" && $user->SubPosition == "三塁手" || $user->position == "捕手" && $user->SubPosition == "遊撃手")
                          <div class="userName position9">{{$user->Name}}</div>
                        @elseif($user->position == "捕手" && $user->SubPosition == "外野手")
                          <div class="userName position10">{{$user->Name}}</div>
                        @elseif($user->position == "一塁手" && $user->SubPosition == "投手" || $user->position == "二塁手" && $user->SubPosition == "投手" || $user->position == "三塁手" && $user->SubPosition == "投手" || $user->position == "遊撃手" && $user->SubPosition == "投手")
                          <div class="userName position11">{{$user->Name}}</div>
                        @elseif($user->SubPosition == "捕手" && $user->position == "一塁手" || $user->SubPosition == "捕手" && $user->position == "二塁手" || $user->SubPosition == "捕手" && $user->position == "三塁手" || $user->SubPosition == "捕手" && $user->position == "遊撃手")
                          <div class="userName position12">{{$user->Name}}</div>
                        @elseif($user->position == "一塁手" && $user->SubPosition == "外野手" || $user->position == "二塁手" && $user->SubPosition == "外野手" || $user->position == "三塁手" && $user->SubPosition == "外野手" || $user->position == "遊撃手" && $user->SubPosition == "外野手")
                          <div class="userName position13">{{$user->Name}}</div>
                        @elseif($user->position == "外野手" && $user->SubPosition == "投手")
                          <div class="userName position14">{{$user->Name}}</div>
                        @elseif($user->position == "外野手" && $user->SubPosition == "捕手")
                          <div class="userName position15">{{$user->Name}}</div>
                        @elseif($user->position == "外野手" && $user->SubPosition == "一塁手" || $user->position == "外野手" && $user->SubPosition == "二塁手" || $user->position == "外野手" && $user->SubPosition == "三塁手" || $user->position == "外野手" && $user->SubPosition == "遊撃手")
                          <div class="userName position16">{{$user->Name}}</div>
                        @else
                          <div class="userName position17">{{$user->Name}}</div>
                        @endif                      
                    </div>
                    <div class="col-6">
                      <p class="no center">{{$user->number}}</p>
                    </div>
                </div>
                <div class="row">
                  <div class="col-6 center">
                      @if($user->user_image == null)
                        <img src="{{ asset('/storage/img/'.'icon.png')}}" style="width:70%;">
                      @else
                        <img src="{{ asset('/storage/img/'.$user->user_image)}}" style="width:70%;">
                      @endif
                  </div>
                  <div class="col-6">
                  <table class="table table-sm table-dark">
                    <tbody>                      
                        <tr>
                          <th>{{$user->position}} 
                              @if($user->SubPosition)
                                / {{$user->SubPosition}}
                              @endif
                          </th>
                        </tr>                        
                        <tr>
                            <?php $today = date("Y"); ?>
                          <th>{{$today-$user->Birthday_y}}歳</th>
                        </tr>
                        <tr>
                          <th>{{$user->dominant_hand}}</th>
                        </tr>
                        <tr>
                          <th> {{$user->height}}cm/{{$user->weight}}kg</th>
                        </tr>
                      </tbody>
                    </table>
                    </div>
                </div>
              </a>
          </div>
        @endforeach          
      </div>
    @endif
</div>
  <a  href="{{ url('/') }}">Homeへ戻る</a>
@endsection