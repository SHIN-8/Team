@extends('layouts.app')

@section('title','edit')

@section('content')
<div class="container">
    <h2>編集</h2>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                      <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    <form method="post" action="{{route('schedules.update',$schedule)}}">
      @method('PUT')
      @csrf
    <div class="container">
        <div class="form-group">
            <label for="custom-select-1b">日時</label>
            <input name="date" type="date" value="{{$schedule->date}}">
        </div>
        <table class="table table-borderless">
          <thead>
              <tr>
                  <th>活動時間</th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
              </tr>
          </thead>
          <tbody>
            <tr>
                <th>
                    <input type="time" name="s_t" value="{{$schedule->s_t}}">
                </th>
                <td>～</td>
                <td>
                    <input type="time" name="f_t" value="{{$schedule->f_t}}">
                </td>
            </tr>            
          </tbody>
        </table>
        <div>
            <div class="form-group">
              <label for="custom-select-1b">形式</label>
                  <select name="game" id="custom-select-1b" class="custom-select">
                    @if($schedule->game == 1)
                      <option value="1">公式戦</option>
                    @elseif($schedule->game == 2)
                      <option value="2">練習試合</option>
                    @elseif($schedule->game == 3)
                      <option value="3">紅白戦</option>
                    @endif
                      <option value="1">公式戦</option>
                      <option value="2">練習試合</option>
                      <option value="3">紅白戦</option>
                  </select>
            </div> 
                
            <div class="form-group">
                <label for="text1">対戦相手</label>
                <input name="opponent" type="text" id="text1" class="form-control" value="{{$schedule->opponent}}">
            </div>

            <div class="form-group">
                <label for="custom-select-1b">会場</label>
                  <select name="place" id="custom-select-1b" class="custom-select">
                      <?php $Place = App\Place::where('id',$schedule->place)->first(); ?>
                    @if($Place)
                      <option value="{{$Place->id}}">{{$Place->name}}</option>
                    @endif
                    @foreach($places as $place)
                      <option value="{{$place->id}}">{{$place->name}}</option>
                    @endforeach
                  </select>
            </div>
        </div>
    <div class="row">
        <table class="table table-sm table-borderless col-8">
            <thead class="text-center text-nowrap">
              <tr>
                <th></th>
                <th>POJITION</th>
                <th>　　NAME　　</th>
              </tr>
            </thead>
          <tbody class="text-center">
            <tr>
              <th>1</th>
                <td>
                    <div class="form-group">
                        <select name="a" id="custom-select-1a" class="custom-select custom-select-sm">
                            @if($schedule->a)
                              <option>{{$schedule->a}}</option>
                            @else
                              <option>{{old('a')}}</option>
                            @endif
                              <option>投</option>
                              <option>捕</option>
                              <option>一</option>
                              <option>二</option>
                              <option>三</option>
                              <option>遊</option>
                              <option>左</option>
                              <option>中</option>
                              <option>右</option>
                              <option>DH</option>
                              <option></option>
                        </select>
                    </div>
                </td>
                <td>
                  <div class="form-group">
                      <select name="an" id="custom-select-1a" class="custom-select custom-select-sm">
                            <?php
                            $auser = App\user::where('number',$schedule->an)->first();
                            ?>
                        @if($auser)
                            <option value="{{$schedule->an}}">{{$auser->Name}}</option>
                        @elseif(old('an'))
                            <?php
                            $an = App\user::where('number',old('an'))->first();
                            ?>
                          <option value="{{$an}}">{{$an->Name}}</option>
                        @endif
                          <option value=""></option>
                        @foreach($participationPlayers as $participationPlayer)
                          <option value="{{$participationPlayer->user->number}}">{{$participationPlayer->user->Name}}</option>
                        @endforeach
                      </select>
                  </div>
                </td>
              </tr>
              <tr>
                <th>2</th>
                  <td>
                    <div class="form-group">
                        <select name="b" id="custom-select-1a" class="custom-select custom-select-sm">
                            @if($schedule->b)
                                <option>{{$schedule->b}}</option>
                            @else
                                <option>{{old('b')}}</option>
                            @endif
                                <option>投</option>
                                <option>捕</option>
                                <option>一</option>
                                <option>二</option>
                                <option>三</option>
                                <option>遊</option>
                                <option>左</option>
                                <option>中</option>
                                <option>右</option>
                                <option>DH</option>
                                <option></option>
                          </select>
                    </div>
                  </td>
                  <td>
                      <div class="form-group">
                          <select name="bn" id="custom-select-1a" class="custom-select custom-select-sm">
                              <?php
                              $buser = App\user::where('number',$schedule->bn)->first();
                              ?>
                            @if($buser)
                              <option value="{{$schedule->bn}}">{{$buser->Name}}</option>
                            @elseif(old('bn'))
                              <?php
                                $bn = App\user::where('number',old('bn'))->first();
                              ?>
                              <option value="{{$bn}}">{{$bn->Name}}</option>
                            @endif
                              <option value=""></option>
                            @foreach($participationPlayers as $participationPlayer)
                              <option value="{{$participationPlayer->user->number}}">{{$participationPlayer->user->Name}}</option>
                            @endforeach                  
                          </select>
                      </div>
                  </td>
              </tr>
              <tr>
                <th>3</th>
                  <td>
                      <div class="form-group">
                          <select name="c" id="custom-select-1a" class="custom-select custom-select-sm">
                              @if($schedule->c)
                                <option>{{$schedule->c}}</option>
                              @else
                                <option>{{old('c')}}</option>
                              @endif
                                <option>投</option>
                                <option>捕</option>
                                <option>一</option>
                                <option>二</option>
                                <option>三</option>
                                <option>遊</option>
                                <option>左</option>
                                <option>中</option>
                                <option>右</option>
                                <option>DH</option>
                                <option></option>
                          </select>
                    </div>
                  </td>
                  <td>
                      <div class="form-group">
                            <select name="cn" id="custom-select-1a" class="custom-select custom-select-sm">
                                  <?php
                                  $cuser = App\user::where('number',$schedule->cn)->first();
                                  ?>
                              @if($cuser)
                                  <option value="{{$schedule->cn}}">{{$cuser->Name}}</option>
                              @elseif(old('cn'))
                                  <?php
                                    $cn = App\user::where('number',old('cn'))->first();
                                  ?>
                                  <option value="{{$cn}}">{{$cn->Name}}</option>
                              @endif
                                  <option value=""></option>
                              @foreach($participationPlayers as $participationPlayer)
                                  <option value="{{$participationPlayer->user->number}}">{{$participationPlayer->user->Name}}</option>
                              @endforeach                          
                            </select>
                      </div>
                  </td>
              </tr>
              <tr>
                <th>4</th>
                  <td>
                      <div class="form-group">
                          <select name="d_" id="custom-select-1a" class="custom-select custom-select-sm">
                              @if($schedule->d_)
                                <option>{{$schedule->d_}}</option>
                              @else
                                <option>{{old('d_')}}</option>
                              @endif
                                <option>投</option>
                                <option>捕</option>
                                <option>一</option>
                                <option>二</option>
                                <option>三</option>
                                <option>遊</option>
                                <option>左</option>
                                <option>中</option>
                                <option>右</option>
                                <option>DH</option>
                                <option></option>
                          </select>
                      </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <select name="dn" id="custom-select-1a" class="custom-select custom-select-sm">
                            <?php
                            $duser = App\user::where('number',$schedule->dn)->first();
                            ?>
                        @if($duser)
                          <option value="{{$schedule->dn}}">{{$duser->Name}}</option>
                        @elseif(old('dn'))
                            <?php
                            $dn = App\user::where('number',old('dn'))->first();
                            ?>
                          <option value="{{$dn}}">{{$dn->Name}}</option>
                        @endif
                          <option value=""></option>
                        @foreach($participationPlayers as $participationPlayer)
                          <option value="{{$participationPlayer->user->number}}">{{$participationPlayer->user->Name}}</option>
                        @endforeach                    
                      </select>
                    </div>
                  </td>
              </tr>
              <tr>
                <th>5</th>
                  <td>
                    <div class="form-group">
                        <select name="e" id="custom-select-1a" class="custom-select custom-select-sm">
                            @if($schedule->e)
                              <option>{{$schedule->e}}</option>
                            @else
                              <option>{{old('e')}}</option>
                            @endif
                              <option>投</option>
                              <option>捕</option>
                              <option>一</option>
                              <option>二</option>
                              <option>三</option>
                              <option>遊</option>
                              <option>左</option>
                              <option>中</option>
                              <option>右</option>
                              <option>DH</option>
                              <option></option>
                        </select>
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <select name="en" id="custom-select-1a" class="custom-select custom-select-sm">
                              <?php
                              $euser = App\user::where('number',$schedule->en)->first();
                              ?>
                          @if($euser)
                            <option value="{{$schedule->en}}">{{$euser->Name}}</option>
                          @elseif(old('en'))
                              <?php
                              $en = App\user::where('number',old('en'))->first();
                              ?>
                            <option value="{{$en}}">{{$en->Name}}</option>
                          @endif
                            <option value=""></option>
                          @foreach($participationPlayers as $participationPlayer)
                            <option value="{{$participationPlayer->user->number}}">{{$participationPlayer->user->Name}}</option>
                          @endforeach                  
                      </select>
                  </div>
                </td>
              </tr>
              <tr>
                <th>6</th>
                  <td>
                      <div class="form-group">
                          <select name="f" id="custom-select-1a" class="custom-select custom-select-sm">
                            @if($schedule->f)
                                <option>{{$schedule->f}}</option>
                            @else
                                <option>{{old('f')}}</option>
                            @endif                  
                                <option>投</option>
                                <option>捕</option>
                                <option>一</option>
                                <option>二</option>
                                <option>三</option>
                                <option>遊</option>
                                <option>左</option>
                                <option>中</option>
                                <option>右</option>
                                <option>DH</option>
                                <option></option>
                          </select>
                    </div>
                </td>
                <td>
                  <div class="form-group">
                      <select name="fn" id="custom-select-1a" class="custom-select custom-select-sm">
                              <?php
                              $fuser = App\user::where('number',$schedule->fn)->first();
                              ?>
                        @if($fuser)
                          <option value="{{$schedule->fn}}">{{$fuser->Name}}</option>
                        @elseif(old('fn'))
                              <?php
                              $fn = App\user::where('number',old('fn'))->first();
                              ?>
                          <option value="{{$fn}}">{{$fn->Name}}</option>
                        @endif
                          <option value=""></option>
                        @foreach($participationPlayers as $participationPlayer)
                          <option value="{{$participationPlayer->user->number}}">{{$participationPlayer->user->Name}}</option>
                        @endforeach                    
                      </select>
                  </div>
                </td>
              </tr>
              <tr>
                <th>7</th>
                  <td>
                      <div class="form-group">
                          <select name="g" id="custom-select-1a" class="custom-select custom-select-sm">
                            @if($schedule->g)
                                <option>{{$schedule->g}}</option>
                            @else
                                <option>{{old('g')}}</option>
                            @endif                  
                                <option>投</option>
                                <option>捕</option>
                                <option>一</option>
                                <option>二</option>
                                <option>三</option>
                                <option>遊</option>
                                <option>左</option>
                                <option>中</option>
                                <option>右</option>
                                <option>DH</option>
                                <option></option>
                          </select>
                    </div>
                </td>
                <td>
                  <div class="form-group">
                    <select name="gn" id="custom-select-1a" class="custom-select custom-select-sm">
                          <?php
                          $guser = App\user::where('number',$schedule->gn)->first();
                          ?>
                      @if($guser)
                        <option value="{{$schedule->gn}}">{{$guser->Name}}</option>
                      @elseif(old('gn'))
                          <?php
                            $gn = App\user::where('number',old('gn'))->first();
                          ?>
                        <option value="{{$gn}}">{{$gn->Name}}</option>
                      @endif
                        <option value=""></option>
                      @foreach($participationPlayers as $participationPlayer)
                        <option value="{{$participationPlayer->user->number}}">{{$participationPlayer->user->Name}}</option>
                      @endforeach                  
                    </select>
                  </div>
                </td>
              </tr>
              <tr>
                <th>8</th>
                  <td>
                      <div class="form-group">
                          <select name="h" id="custom-select-1a" class="custom-select custom-select-sm">
                              @if($schedule->h)
                                  <option>{{$schedule->h}}</option>
                              @else
                                <option>{{old('h')}}</option>
                              @endif                  
                                  <option>投</option>
                                  <option>捕</option>
                                  <option>一</option>
                                  <option>二</option>
                                  <option>三</option>
                                  <option>遊</option>
                                  <option>左</option>
                                  <option>中</option>
                                  <option>右</option>
                                  <option>DH</option>
                                  <option></option>
                          </select>
                    </div>
                </td>
                <td>
                  <div class="form-group">
                      <select name="hn" id="custom-select-1a" class="custom-select custom-select-sm">
                            <?php
                            $huser = App\user::where('number',$schedule->hn)->first();
                            ?>
                        @if($huser)
                          <option value="{{$schedule->hn}}">{{$huser->Name}}</option>
                        @elseif(old('hn'))
                            <?php
                              $hn = App\user::where('number',old('hn'))->first();
                            ?>
                          <option value="{{$hn}}">{{$hn->Name}}</option>
                        @endif
                          <option value=""></option>
                        @foreach($participationPlayers as $participationPlayer)
                          <option value="{{$participationPlayer->user->number}}">{{$participationPlayer->user->Name}}</option>
                        @endforeach                    
                      </select>
                  </div>
                </td>
              </tr>
              <tr>
                <th>9</th>
                <td>
                    <div class="form-group">
                        <select name="i" id="custom-select-1a" class="custom-select custom-select-sm">
                            @if($schedule->i)
                              <option>{{$schedule->i}}</option>
                            @else
                              <option>{{old('i')}}</option>
                            @endif                  
                              <option>投</option>
                              <option>捕</option>
                              <option>一</option>
                              <option>二</option>
                              <option>三</option>
                              <option>遊</option>
                              <option>左</option>
                              <option>中</option>
                              <option>右</option>
                              <option>DH</option>
                              <option></option>
                        </select>
                    </div>
                </td>
                <td>
                  <div class="form-group">
                    <select name="i_n" id="custom-select-1a" class="custom-select custom-select-sm">
                          <?php
                          $iuser = App\user::where('number',$schedule->i_n)->first();
                          ?>
                      @if($iuser)
                        <option value="{{$schedule->i_n}}">{{$iuser->Name}}</option>
                      @elseif(old('i_n'))
                          <?php
                          $i_n = App\user::where('number',old('i_n'))->first();
                          ?>
                        <option value="{{$i_n}}">{{$i_n->Name}}</option>
                      @endif
                        <option value=""></option>
                      @foreach($participationPlayers as $participationPlayer)
                        <option value="{{$participationPlayer->user->number}}">{{$participationPlayer->user->Name}}</option>
                      @endforeach                  
                    </select>
                  </div>
                </td>
              </tr>            
            </tbody>
          </table>
        <table class="table table-sm table-borderless col-3">
            <thead>
                <tr>
                    <th>　</th>
                    <th></th>
                </tr>
            </thead>
            <tbody  class="float-right">            
              @foreach($participationPlayers as $participationPlayer) 
              <tr>
                    <?php
                    // 直近5試合の成績
                    $aR = App\Userresult::select('a')->where('user_id',$participationPlayer->user->number)->orderBy('y','desc')->orderBy('m','desc')->orderBy('day','desc')->take(5)->get();

                    $bR = App\Userresult::select('b')->where('user_id',$participationPlayer->user->number)->orderBy('y','desc')->orderBy('m','desc')->orderBy('day','desc')->take(5)->get();

                    $cR = App\Userresult::select('c')->where('user_id',$participationPlayer->user->number)->orderBy('y','desc')->orderBy('m','desc')->orderBy('day','desc')->take(5)->get();

                    $dR = App\Userresult::select('d')->where('user_id',$participationPlayer->user->number)->orderBy('y','desc')->orderBy('m','desc')->orderBy('day','desc')->take(5)->get();

                    $eR = App\Userresult::select('e')->where('user_id',$participationPlayer->user->number)->orderBy('y','desc')->orderBy('m','desc')->orderBy('day','desc')->take(5)->get();

                    $fR = App\Userresult::select('f')->where('user_id',$participationPlayer->user->number)->orderBy('y','desc')->orderBy('m','desc')->orderBy('day','desc')->take(5)->get();

                    $gR = App\Userresult::select('g')->where('user_id',$participationPlayer->user->number)->orderBy('y','desc')->orderBy('m','desc')->orderBy('day','desc')->take(5)->get();

                    $hR = App\Userresult::select('h')->where('user_id',$participationPlayer->user->number)->orderBy('y','desc')->orderBy('m','desc')->orderBy('day','desc')->take(5)->get();

                    $iR = App\Userresult::select('i')->where('user_id',$participationPlayer->user->number)->orderBy('y','desc')->orderBy('m','desc')->orderBy('day','desc')->take(5)->get();
                    
                    $hitR = $aR->where('a',"安")->count()+$bR->where('b',"安")->count()+$cR->where('c',"安")->count()+$dR->where('d',"安")->count()+$eR->where('e',"安")->count()+$fR->where('f',"安")->count()+$gR->where('g',"安")->count()+$hR->where('h',"安")->count()+$iR->where('i',"安")->count();

                    $twoR = $aR->where('a',"２")->count()+$bR->where('b',"２")->count()+$cR->where('c',"２")->count()+$dR->where('d',"２")->count()+$eR->where('e',"２")->count()+$fR->where('f',"２")->count()+$gR->where('g',"２")->count()+$hR->where('h',"２")->count()+$iR->where('i',"２")->count();

                    $threeR = $aR->where('a',"３")->count()+$bR->where('b',"３")->count()+$cR->where('c',"３")->count()+$dR->where('d',"３")->count()+$eR->where('e',"３")->count()+$fR->where('f',"３")->count()+$gR->where('g',"３")->count()+$hR->where('h',"３")->count()+$iR->where('i',"３")->count();

                    $homerunR = $aR->where('a',"本")->count()+$bR->where('b',"本")->count()+$cR->where('c',"本")->count()+$dR->where('d',"本")->count()+$eR->where('e',"本")->count()+$fR->where('f',"本")->count()+$gR->where('g',"本")->count()+$hR->where('h',"本")->count()+$iR->where('i',"本")->count();

                    $hitsR = $hitR+$twoR*2+$threeR*3+$homerunR*4;

                    $numberofatbatR = $aR->where('a','!==',null)->count()+$bR->where('b','!==',null)->count()+$cR->where('c','!==',null)->count()+$dR->where('d','!==',null)->count()+$eR->where('e','!==',null)->count()+$fR->where('f','!==',null)->count()+$gR->where('g','!==',null)->count()+$hR->where('h','!==',null)->count()+$iR->where('i','!==',null)->count();
                    ?>
                @if($participationPlayer->user->position == "投手" && $participationPlayer->user->SubPosition == null )
                  <td class="schedule_userName position1">{{$participationPlayer->user->Name}}</td>
                @elseif($participationPlayer->user->position == "捕手" && $participationPlayer->user->SubPosition == null )
                  <td class="schedule_userName position2">{{$participationPlayer->user->Name}}</td>            
                @elseif($participationPlayer->user->position == "外野手" && $participationPlayer->user->SubPosition == null )
                  <td class="schedule_userName position4">{{$participationPlayer->user->Name}}</td>
                @elseif($participationPlayer->user->position == "投手" && $participationPlayer->user->SubPosition == "捕手" )
                  <td class="schedule_userName position5">{{$participationPlayer->user->Name}}</td>
                @elseif($participationPlayer->user->position == "投手" && $participationPlayer->user->SubPosition == "一塁手" || $participationPlayer->user->position == "投手" && $participationPlayer->user->SubPosition == "二塁手" || $participationPlayer->user->position == "投手" && $participationPlayer->user->SubPosition == "三塁手" || $participationPlayer->user->position == "投手" && $participationPlayer->user->SubPosition == "遊撃手" )
                  <td class="schedule_userName position6">{{$participationPlayer->user->Name}}</td>
                @elseif($participationPlayer->user->position == "投手" && $participationPlayer->user->SubPosition == "外野手" )
                  <td class="schedule_userName position7">{{$participationPlayer->user->Name}}</td>
                @elseif($participationPlayer->user->position == "捕手" && $participationPlayer->user->SubPosition == "投手" )
                  <td class="schedule_userName position8">{{$participationPlayer->user->Name}}</td>
                @elseif($participationPlayer->user->position == "捕手" && $participationPlayer->user->SubPosition == "一塁手" || $participationPlayer->user->position == "捕手" && $participationPlayer->user->SubPosition == "二塁手" || $participationPlayer->user->position == "捕手" && $participationPlayer->user->SubPosition == "三塁手" || $participationPlayer->user->position == "捕手" && $participationPlayer->user->SubPosition == "遊撃手" )
                  <td class="schedule_userName position9">{{$participationPlayer->user->Name}}</td>
                @elseif($participationPlayer->user->position == "捕手" && $participationPlayer->user->SubPosition == "外野手" )
                  <td class="schedule_userName position10">{{$participationPlayer->user->Name}}</td>
                @elseif($participationPlayer->user->position == "一塁手" && $participationPlayer->user->SubPosition == "投手"|| $participationPlayer->user->position == "二塁手" && $participationPlayer->user->SubPosition == "投手"|| $participationPlayer->user->position == "三塁手" && $participationPlayer->user->SubPosition == "投手"|| $participationPlayer->user->position == "遊撃手" && $participationPlayer->user->SubPosition == "投手"  )
                  <td class="schedule_userName position11">{{$participationPlayer->user->Name}}</td>
                @elseif($participationPlayer->user->position == "一塁手" && $participationPlayer->user->SubPosition == "捕手"|| $participationPlayer->user->position == "二塁手" && $participationPlayer->user->SubPosition == "捕手"|| $participationPlayer->user->position == "三塁手" && $participationPlayer->user->SubPosition == "捕手"|| $participationPlayer->user->position == "遊撃手" && $participationPlayer->user->SubPosition == "捕手"  )
                  <td class="schedule_userName position12">{{$participationPlayer->user->Name}}</td>
                @elseif($participationPlayer->user->position == "一塁手" && $participationPlayer->user->SubPosition == "外野手"|| $participationPlayer->user->position == "二塁手" && $participationPlayer->user->SubPosition == "外野手"|| $participationPlayer->user->position == "三塁手" && $participationPlayer->user->SubPosition == "外野手"|| $participationPlayer->user->position == "遊撃手" && $participationPlayer->user->SubPosition == "外野手"  )
                  <td class="schedule_userName position13">{{$participationPlayer->user->Name}}</td>
                @elseif($participationPlayer->user->position == "外野手" && $participationPlayer->user->SubPosition == "投手" )
                  <td class="schedule_userName position14">{{$participationPlayer->user->Name}}</td>
                @elseif($participationPlayer->user->position == "外野手" && $participationPlayer->user->SubPosition == "捕手" )
                  <td class="schedule_userName position15">{{$participationPlayer->user->Name}}</td>
                @elseif($participationPlayer->user->position == "外野手" && $participationPlayer->user->SubPosition == "一塁手" || $participationPlayer->user->position == "外野手" && $participationPlayer->user->SubPosition == "二塁手" || $participationPlayer->user->position == "外野手" && $participationPlayer->user->SubPosition == "三塁手" || $participationPlayer->user->position == "外野手" && $participationPlayer->user->SubPosition == "遊撃手" )
                  <td class="schedule_userName position16">{{$participationPlayer->user->Name}}</td>
                @elseif($participationPlayer->user->position == "一塁手"|| $participationPlayer->user->position == "二塁手"|| $participationPlayer->user->position == "三塁手"|| $participationPlayer->user->position == "遊撃手"  )
                  <td class="schedule_userName position3">{{$participationPlayer->user->Name}}</td>
                @elseif($participationPlayer->user->position == "マネージャー" || $participationPlayer->user->SubPosition == "マネージャー" )
                  <td class="schedule_userName position17">{{$participationPlayer->user->Name}}</td>
                @endif
        
            
                <td>
                  
                  @if($numberofatbatR)
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
                  @else
                    <img src="{{ asset('/storage/img/'.'3.jpg')}}" width="35">
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="row">
            <div class="col-sm-6 mt-3">
                <button  type="submit button" class="btn btn-info btn-lg btn-block">更新</button>
            </div>    
    </form>
    <div class="col-sm-6 mt-3">
      <form method="POST" action="{{ route('schedules.destroy',$schedule) }}">
        @method('DELETE')
        @csrf
          <button onclick="return confirm('本当に削除しますか？')" class="btn btn-danger btn-lg btn-block">削除</button>
      </form>
    </div>
  </div>
</div>
@endsection