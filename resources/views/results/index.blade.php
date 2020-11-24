@extends('layouts.app')

@section('title','index')

@section('content')

<div class="container-fluid">
    <div class="contents">試合結果</div>
      <form action="{{ url('results') }}" method="get">
        <div class="row">
            <div class="col-6">
                <label for="custom-select-1b">年度　　</label>
                  <input type="text" name="year" class="col-5" value="{{$year}}">
            </div>
              <div class="col-6">
                  <label for="custom-select-1b">月　</label>
                    <select name="month"  class="custom-select col-5" value="{{$month}}">
                        @if($month)
                          <option value="{{$month}}">{{$month}}</option>
                        @endif
                          <option value="">全て</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                          <option value="7">7</option>
                          <option value="8">8</option>
                          <option value="9">9</option>
                          <option value="10">10</option>
                          <option value="11">11</option>
                          <option value="12">12</option>
                    </select>
              </div>
            </div>
          <div class="row">
              <div class="col-6">
                <label for="custom-select-1b">対戦相手</label>
                  <input type="text" name="opponent" class="col-5" value="{{$opponent}}">
              </div>
              <div class="col-6">
                  <label for="custom-select-1b">試合</label>
                    <select name="game" id="custom-select-1b" class="custom-select col-5" value="{{$game}}">
                        @if($game == 4)
                          <option value="4">全て</option>
                        @elseif($game == 1)
                          <option value="1">公式試合</option>
                        @elseif($game == 2)
                          <option value="2">練習試合</option>
                        @elseif($game == 3)
                          <option value="3">練習</option>
                        @else
                          <option></option>
                        @endif
                          <option value="1">公式試合</option>
                          <option value="2">練習試合</option>
                          <option value="3">練習</option>
                          <option value="4">全て</option>
                    </select>
              </div>
          </div>
              <div class="text-right">
                  <input type="submit" class="btn-lg" value="検索">
              </div>
      </div>
        <div class="container">
            <?php
            // 検索条件から試合結果をピックアップ
              $totalgames = App\Result::where('y',$year)->count();              
              $win = App\Result::where('y',$year)->where('wl','勝')->count();              
              $lose = App\Result::where('y',$year)->where('wl','負')->count();              
              $draw = App\Result::where('y',$year)->where('wl','引き分け')->count(); 
              if(empty($month)){
                    if($game == 4){
                        if(empty($opponent)){
                          $results = App\Result::where('y',$year)->orderByDesc('m')->orderByDesc('d')->paginate(5);
                        }else{
                          $results = App\Result::where('y',$year)->where('S_name',$opponent)->orWhere('K_name',$opponent)->orderByDesc('m')->orderByDesc('d')->paginate(5);
                        }           
                    }else{
                        if(empty($opponent)){
                          $results = App\Result::where('y',$year)->where('game',$game)->orderByDesc('m')->orderByDesc('d')->paginate(5);
                        }else{
                          $results = App\Result::where('y',$year)->where('S_name',$opponent)->where('game',$game)->orWhere('K_name',$opponent)->where('game',$game)->orderByDesc('m')->orderByDesc('d')->paginate(5);
                        }
                    }
              }else{
                    if($game == 4){
                        if(empty($opponent)){
                          $results = App\Result::where('y',$year)->where('m',$month)->orderByDesc('m')->orderByDesc('d')->paginate(5);
                        }else{
                          $results = App\Result::where('y',$year)->where('S_name',$opponent)->where('m',$month)->orWhere('K_name',$opponent)->where('m',$month)->orderByDesc('m')->orderByDesc('d')->paginate(5);
                        }
                    }else{
                      if(empty($opponent)){
                          $results = App\Result::where('y',$year)->where('m',$month)->where('game',$game)->orderByDesc('m')->orderByDesc('d')->paginate(5);
                        }else{
                          $results = App\Result::where('y',$year)->where('S_name',$opponent)->where('game',$game)->where('m',$month)->orWhere('K_name',$opponent)->where('game',$game)->where('m',$month)->orderByDesc('m')->orderByDesc('d')->paginate(5);
                        }
                    }
                  }             
            ?>
            <div class="text-center">
              <h3>{{$year}}年度成績  {{$totalgames}}戦{{$win}}勝{{$lose}}敗{{$draw}}分</h3>
            </div>

            @foreach($results as $result)
              <div class="card">
                <a href="{{ url('results',$result->id) }}">
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
            <div class="card-body">
                <div class="table-responsive">
                    <table class="col table table-dark">
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
                </a>
              </div>
            @endforeach
          </div>
        </div>          
          <div class="d-flex justify-content-center">{{$results->appends(['year' => $year,'month' => $month,'opponent' => $opponent,'game' => $game])->links()}}</div>
      </div>
</div>
  <a  href="{{ url('/') }}">Homeへ戻る</a>
@endsection