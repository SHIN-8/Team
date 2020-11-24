@extends('layouts.app')

@section('title','show')

@section('content')

<div class="container">
    <div>
        <div class="contents">試合結果</div>
            <div class="card-header">
                <div class="row">
                    <div class="col-4 text-nowrap">
                        <h6>{{$result->y}}年{{$result->m}}月{{$result->d}}日</h6>
                    </div>
                        <?php
                          $S_score = $result->S1+$result->S2+$result->S3+$result->S4+$result->S5+$result->S6+$result->S7+$result->S8+$result->S9;
                          $K_score = $result->K1+$result->K2+$result->K3+$result->K4+$result->K5+$result->K6+$result->K7+$result->K8+$result->K9;
                          ?>
                    <div class="col-4 text-center text-nowrap">
                          <?php $place = App\Place::where('id',$result->place)->first(); ?>
                      <h6>
                        @if($place)
                          {{$place->name}}
                        @else
                        @endif         
                      </h6>
                    </div>

                  <div class="col-4  text-nowrap text-right">
                    <h6>
                        @if($result->game == 1)
                          【公式戦】
                        @elseif($result->game == 2)
                          【練習試合】
                        @else
                          【練習】
                        @endif
                    </h6> 
                  </div>
              </div>
            <div class="row">
                <div class="col text-center text-nowrap">
                    <h5>{{$result->S_name}}{{$S_score}}-{{$K_score}}{{$result->K_name}}({{$result->wl}})</h5>
                </div>
          </div>
      </div>
  </div>

  <div class="card-body table-responsive">
    <table class="table  table-dark">
      <thead>
        <tr>
            <th></th>
            <th>1</th>
            <th>2</th>
            <th>3</th>
            <th>4</th>
            <th>5</th>
            <th>6</th>
            <th>7</th>
            <th>8</th>
            <th>9</th>
            <th>計</th>
        </tr>
      </thead>
    <tbody>
        <tr>
          <th class="text-nowrap">{{$result->S_name}}</th>
          <td>{{$result->S1}}</td>
          <td>{{$result->S2}}</td>
          <td>{{$result->S3}}</td>
          <td>{{$result->S4}}</td>
          <td>{{$result->S5}}</td>
          <td>{{$result->S6}}</td>
          <td>{{$result->S7}}</td>
          <td>{{$result->S8}}</td>
          <td>{{$result->S9}}</td>
          <td>{{$S_score}}</td>
        </tr>
        <tr>
          <th class="text-nowrap">{{$result->K_name}}</th>
          <td>{{$result->K1}}</td>
          <td>{{$result->K2}}</td>
          <td>{{$result->K3}}</td>
          <td>{{$result->K4}}</td>
          <td>{{$result->K5}}</td>
          <td>{{$result->K6}}</td>
          <td>{{$result->K7}}</td>
          <td>{{$result->K8}}</td>
          <td>{{$result->K9}}</td>
          <td>{{$K_score}}</td>
        </tr>      
      </tbody>
    </table>
  </div>

  <div class="row">
    <div class="col table-responsive">
      <table class="table table-hover table-striped" >
      <thead>
        <tr>
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
        @if($userresult->user)
            <tr>
              <td>
                  @if($userresult->generation == 2||$userresult->generation == 3)
                  @else
                    <div class="score">{{$userresult->ord}}</div>
                  @endif
              </td>
              <td>
                  @if($userresult->position == "投" )
                    <div class="position position1">{{$userresult->position}}</div>
                  @elseif($userresult->position == "捕" )
                    <div class="position position2">{{$userresult->position}}</div>
                  @elseif($userresult->position == "一"|| $userresult->position == "二"||$userresult->position == "三"||$userresult->position == "遊")
                    <div class="position position3">{{$userresult->position}}</div>
                  @elseif($userresult->position == "左"||$userresult->position == "中"||$userresult->position == "右")
                    <div class="position position4">{{$userresult->position}}</div>
                  @elseif($userresult->position == "DH")
                    <div class="position position17">{{$userresult->position}}</div>
                  @elseif($userresult->position == "打"||$userresult->position == "走")
                    <div class="position position18">{{$userresult->position}}</div>
                  @endif
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
              </td>   
            
              <td>
                <div class="form-group">
                  <div class="score">{{$userresult->steal}}</div>
                </div>     
              </td>          
            </tr>
        @endif
      @endforeach           
      </tbody>
    </table>
  </div>
</div>

  <div class="row">
      <div class="col table-responsive">
        <table class="table  table-hover table-striped" >
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
                @if($pitchresult->user)
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
                </tr>
              @endif
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
    <a href="{{ route('results.index') }}">一覧へ戻る</a>
</div>

@endsection