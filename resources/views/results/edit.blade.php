@extends('layouts.app')

@section('title','edit')

@section('content')

<div class="container">
    <div>
      <h2>試合結果</h2>
       <form method="post" action="{{route('results.update',$result)}}">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label for="custom-select-1b">形式</label>
                <select name="game" id="custom-select-1b" class="custom-select">
                    <option value="1">公式戦</option>
                    <option value="2">練習試合</option>
                    <option value="3">紅白戦</option>
                </select>
        </div>
      
        <select name="y"> 
            <option value="{{$result->y}}">{{$result->y}}</option><option value="2020">2020</option> <option value="2021">2021</option> <option value="2022">2022</option> <option value="2023">2023</option> <option value="2024">2024</option> <option value="2025">2025</option> <option value="2026">2026</option> <option value="2027">2027</option> <option value="2028">2028</option> <option value="2029">2029</option> <option value="2030">2030</option> 
        </select>　年

        <select name="m"> 
            <option value="{{$result->m}}">{{$result->m}}</option> <option value="1">1</option> <option value="2">2</option> <option value="3">3</option> <option value="4">4</option> <option value="5">5</option> <option value="6">6</option> <option value="7">7</option> <option value="8">8</option> <option value="9">9</option> <option value="10">10</option> <option value="11">11</option> <option value="12">12</option> 
        </select>　月

        <select name="d"> 
            <option value="{{$result->d}}">{{$result->d}}</option> <option value="1">1</option> <option value="2">2</option> <option value="3">3</option> <option value="4">4</option> <option value="5">5</option> <option value="6">6</option> <option value="7">7</option> <option value="8">8</option> <option value="9">9</option> <option value="10">10</option> <option value="11">11</option> <option value="12">12</option> <option value="13">13</option> <option value="14">14</option> <option value="15">15</option> <option value="16">16</option> <option value="17">17</option> <option value="18">18</option> <option value="19">19</option> <option value="20">20</option> <option value="21">21</option> <option value="22">22</option> <option value="23">23</option> <option value="24">24</option> <option value="25">25</option> <option value="26">26</option> <option value="27">27</option> <option value="28">28</option> <option value="29">29</option> <option value="30">30</option> <option value="31">31</option> 
        </select>　日

          <div class="form-group">
              <label for="custom-select-1b">会場</label>
                  <select id="custom-select-1b" class="custom-select" name="place">
                      <?php $Place = App\Place::where('id',$result->place)->first(); ?>
                    @if($Place)
                      <option value="{{$Place->id}}">{{$Place->name}}</option>
                    @endif      
                    @foreach($places as $place)
                      <option value="{{$place->id}}">{{$place->name}}</option>
                    @endforeach
                  </select>
          </div>

          <div class="row">
              <div class="table-responsive">
                <table class="table table-responsive table-dark">
                  <thead>
                    <tr class="text-center text-nowrap">
                        <th>TEAM NAME</th>
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
                    <td>
                        <input type="text" id="text1" class="form-control" name="S_name" value="{{$result->S_name}}">
                    </td>
                  <td>           
                        <input class="form-control form-control-sm score" type="tel" id="text6c" value="{{$result->S1}}" name="S1">
                  </td>
                  <td>            
                        <input class="form-control form-control-sm score" type="tel" id="text6c" value="{{$result->S2}}" name="S2">
                  </td>
                  <td>            
                        <input class="form-control form-control-sm score" type="tel" id="text6c" value="{{$result->S3}}" name="S3">
                  </td>
                  <td>            
                        <input class="form-control form-control-sm score" type="tel" id="text6c" value="{{$result->S4}}" name="S4">
                  </td>
                  <td>            
                        <input class="form-control form-control-sm score" type="tel" id="text6c" value="{{$result->S5}}" name="S5">
                  </td>
                  <td>            
                        <input class="form-control form-control-sm score" type="tel" id="text6c" value="{{$result->S6}}" name="S6">
                  </td>
                  <td>            
                        <input class="form-control form-control-sm score" type="tel" id="text6c" value="{{$result->S7}}" name="S7">
                  </td>
                  <td>            
                        <input class="form-control form-control-sm score" type="tel" id="text6c" value="{{$result->S8}}" name="S8">
                  </td>
                  <td>            
                        <input class="form-control form-control-sm score" type="tel" id="text6c" value="{{$result->S9}}" name="S9">
                  </td>
                  <td>            
                        <?php
                          $S_score = $result->S1+$result->S2+$result->S3+$result->S4+$result->S5+$result->S6+$result->S7+$result->S8+$result->S9;
                        ?>
                    <div class="score">{{$S_score}}</div>
                  </td>
                </tr>
                <tr>
                  <td>         
                    <input type="text" id="text1" class="form-control" name="K_name" value="{{$result->K_name}}">
                  </th>
                  <td>            
                        <input class="form-control form-control-sm score" type="tel" id="text6c" value="{{$result->K1}}" name="K1">
                  </td>
                  <td>            
                        <input class="form-control form-control-sm score" type="tel" id="text6c" value="{{$result->K2}}" name="K2">
                  </td>
                  <td>            
                        <input class="form-control form-control-sm score" type="tel" id="text6c" value="{{$result->K3}}" name="K3">
                  </td>
                  <td>            
                        <input class="form-control form-control-sm score" type="tel" id="text6c" value="{{$result->K4}}" name="K4">
                  </td>
                  <td>            
                        <input class="form-control form-control-sm score" type="tel" id="text6c" value="{{$result->K5}}" name="K5">
                  </td>
                  <td>            
                        <input class="form-control form-control-sm score" type="tel" id="text6c" value="{{$result->K6}}" name="K6">
                  </td>
                  <td>            
                        <input class="form-control form-control-sm score" type="tel" id="text6c" value="{{$result->K7}}" name="K7">
                  </td>
                  <td>            
                        <input class="form-control form-control-sm score" type="tel" id="text6c" value="{{$result->K8}}" name="K8">
                  </td>
                  <td>            
                        <input class="form-control form-control-sm score" type="tel" id="text6c" value="{{$result->K9}}" name="K9">
                  </td>
                  <td>
                        <?php
                            $K_score = $result->K1+$result->K2+$result->K3+$result->K4+$result->K5+$result->K6+$result->K7+$result->K8+$result->K9;
                        ?>
                    <div class="score">{{$K_score}}</div>
                  </td>
                </tr>                
              </tbody>
            </table>
          </div>
        </div>
          <div class="form-group">
              <label for="custom-select-1b">勝敗</label>
                <select id="custom-select-1b" class="custom-select" name="wl">
                    <option>{{$result->wl}}</option>
                    <option>勝</option>
                    <option>負</option>
                    <option>引分け</option>
                </select>
          </div>  
          <div class="row">
            <div class="col-sm-6 mt-3">
                <button  type="submit button" class="btn btn-info btn-lg btn-block">試合結果を更新</button>
            </div>
            <div class="col-sm-6 mt-3">
              </form> 
              <form method="POST" action="{{ route('results.destroy',$result) }}">
                @method('DELETE')
                @csrf
                  <button onclick="return confirm('本当に削除しますか？')" class="btn btn-danger btn-lg btn-block">試合結果を削除</button>
              </form>
            </div>
          </div>
            <br>
              <h2 class="yearresult text-nowrap">選手成績</h2>
              <div class="row">
                  <div class="table-responsive">
                    <table class="table table-responsivetable-hover table-striped">
                        thead class="text-center text-nowrap">
                          <tr>
                              <th></th>
                              <th></th>
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
                              <th>盗</th>
                              <th></th>
                          </tr>
                        </thead>
                      <tbody class="text-center text-nowrap"> 
                        @foreach($userresults as $userresult)
                          @if($userresult->user)
                          <tr>                            
                            <td>
                              @if($userresult->generation == 2)
                                代打
                              @elseif($userresult->generation == 3)
                                代走
                              @else
                                {{$userresult->ord}}
                              @endif
                            </td>                            
                            <td>
                              {{$userresult->position}}
                            </td>
                            <td>
                              <a href="{{ url('results/buildEdit',$userresult->id )}}">        
                                <div class="btn btn-outline-info">
                                    {{$userresult->user->Name}}
                                </div>
                              </a>
                            </td>                          
                            <td>
                                <div class="form-group">
                                    {{$userresult->ad}}
                                    {{$userresult->a}}
                                    {{$userresult->ar}}
                                </div>     
                            </td>                          
                            <td>
                                <div class="form-group">
                                    {{$userresult->bd}}
                                    {{$userresult->b}}
                                    {{$userresult->br}}
                                </div>     
                            </td>                          
                            <td>
                                <div class="form-group">
                                    {{$userresult->cd}}
                                    {{$userresult->c}}
                                    {{$userresult->cr}}
                                </div>     
                            </td>                          
                            <td>
                                <div class="form-group">
                                    {{$userresult->dd}}
                                    {{$userresult->d}}
                                    {{$userresult->dr}}
                                </div>     
                            </td>                          
                            <td>
                                <div class="form-group">
                                    {{$userresult->ed}}
                                    {{$userresult->e}}
                                    {{$userresult->er}}
                                </div>     
                            </td>                          
                            <td>
                                <div class="form-group">
                                    {{$userresult->fd}}
                                    {{$userresult->f}}
                                    {{$userresult->fr}}
                                </div>     
                            </td>                          
                            <td>
                                <div class="form-group">
                                    {{$userresult->gd}}
                                    {{$userresult->g}}
                                    {{$userresult->gr}}
                                </div>     
                            </td>                          
                            <td>
                                <div class="form-group">
                                    {{$userresult->hd}}
                                    {{$userresult->h}}
                                    {{$userresult->hr}}
                                </div>     
                            </td>                          
                            <td>
                                <div class="form-group">
                                    {{$userresult->i_d}}
                                    {{$userresult->i}}
                                    {{$userresult->ir}}
                                </div>     
                            </td>                          
                            <td>
                                <div class="form-group">
                                    {{$userresult->steal}}  
                                </div>     
                            </td>                        
                            <td>                            
                              <form method="POST" action="{{ route('userresults.destroy',$userresult) }}">
                                @method('DELETE')
                                @csrf
                                  <button onclick="return confirm('本当に削除しますか？')" class="btn btn-outline-danger">削除</button>
                              </form>                                  
                            </td>                                                  
                          </tr>
                        @endif
                      @endforeach 
                    </tbody>
                  </table>
                </div>
                <div class="row  justify-content-center">
                    <div class="col-sm-6 mt-3">
                        <a href="{{ url('results/build',$result->id )}}"><button type="button" class="btn btn-info btn-lg btn-block">野手成績の追加</button></a>
                    </div>
                </div>
              </div>
            <br>
              <div class="row">
                  <div class="table-responsive">
                      <table class="table table-hover table-striped">
                        <thead>
                          <tr class="text-center text-nowrap">
                              <th></th>
                              <th>イニング数</th>
                              <th>自責点</th>
                              <th>失点</th>
                              <th>奪三振</th>
                              <th>四死球</th>
                              <th>勝敗</th>
                              <th></th>                            
                          </tr>
                        </thead>
                      <tbody class="text-center text-nowrap">
                        <tr>
                          @foreach($pitchresults as $pitchresult)
                          @if($pitchresult->user)
                            <td>
                              <a href="{{ url('results/pitchBuildEdit',$pitchresult->id )}}">        
                                  <div class="btn btn-outline-info">
                                    {{$pitchresult->user->Name}}
                                  </div>
                              </a>                              
                            </td>
                            <td>
                              {{$pitchresult->inning}}回{{$pitchresult->inningathird}}/3
                            </td>
                            <td>
                              {{$pitchresult->earned_run}}
                            </td>
                            <td>
                              {{$pitchresult->runs_allowed}}
                            </td>
                            <td>
                              {{$pitchresult->k}}
                            </td>
                            <td>
                              {{$pitchresult->give_four_dead_balls}}
                            </td>
                            <td>
                              {{$pitchresult->wins}}
                            </td>
                            <td>
                              <form method="POST" action="{{ route('pitchresults.destroy',$pitchresult) }}">
                                @method('DELETE')
                                @csrf
                                  <button onclick="return confirm('本当に削除しますか？')" class="btn btn-outline-success">削除</button>
                              </form>
                            </td>                            
                          </tr>
                        @endif
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <div class="row  justify-content-center">
                    <div class="col-sm-6 mt-3">
                        <a href="{{ url('results/pitchBuild',$result->id )}}"><button type="button" class="btn btn-info btn-lg btn-block">投手成績の追加</button></a>
                    </div>
                </div>
          </div>  
</div>

@endsection