@extends('layouts.app')

@section('title','buildedit')

@section('content')

<div class="container">
    <div>
        <h2>試合結果(選手登録){{$result->id}}</h2>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    <form method="post" action="{{route('userresults.store')}}">
        @csrf
        <input type="hidden" name="game_id" class="form-control" id="text4b" value="{{$result->id}}">
        <input type="hidden" name="y" class="form-control" id="text4b" value="{{$result->y}}">
        <input type="hidden" name="m" class="form-control" id="text4b" value="{{$result->m}}">
        <input type="hidden" name="day"" class="form-control" id="text4b" value="{{$result->d}}">
        <input type="hidden" name="game"" class="form-control" id="text4b" value="{{$result->game}}">
        
        <div class="form-row text-right">
                <div class="form-group col-lg-3 col-6 text-nowrap">
                    <label for="custom-select-1a">打順</label>
                        <select name="ord" id="custom-select-1a" class="custom-select custom-select" style="width:6rem">
                            <option>{{$userresult->ord}}</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                            <option>9</option>
                            <option>10</option>
                            <option>11</option>
                            <option>12</option>
                            <option>13</option>
                            <option>14</option>
                            <option>15</option>
                            <option>16</option>
                            <option>17</option>
                            <option>18</option>
                            <option>19</option>
                            <option>20</option>
                        </select>
                </div>          
                <div class="form-group col-lg-3 col-6 text-nowrap">
                    <label for="custom-select-1a">　</label>
                        <select name="generation" id="custom-select-1a" class="custom-select custom-select" style="width:6rem">
                            @if($userresult->generation == "1")
                            <option value="{{$userresult->generation}}">番打者</option>
                            @elseif($userresult->generation == "2")
                            <option value="{{$userresult->generation}}">代打</option>
                            @else
                            <option value="{{$userresult->generation}}">代走</option>
                            @endif
                            <option value="1">番打者</option>
                            <option value="2">代打</option>
                            <option value="3">代走</option>
                        </select>
                </div>              
                <div class="form-group col-lg-3 col-6 text-nowrap">
                    <label for="custom-select-1a">ポジション</label>
                        <select name="position" id="custom-select-1a" class="custom-select custom-select" style="width:6rem">
                            <option>{{$userresult->position}}</option>
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
                            <option>打</option>
                            <option>走</option>
                        </select>
                </div>
            
              
            <div class="form-group col-lg-3 col-6 text-nowrap">
                <label for="custom-select-1a">選手名</label>
                    <select name="user_id" id="custom-select-1a" class="custom-select custom-select" style="width:6rem">
                            <?php
                                $User = App\user::where('number',$userresult->user_id)->first();
                            ?>
                            <option value="{{$userresult->user_id}}">{{$User->Name}}</option>
                        @foreach($users as $user)
                            <option value="{{$user->number}}">{{$user->Name}}</option>
                        @endforeach
                    </select>
            </div>              
            <div class="table-responsive">
                <table class="table table-hover table-lg table-striped">
                    <thead class="thead-dark text-center">
                        <tr>
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
                        </tr>
                    </thead>
                <tbody>
                    <tr>
                    <td>
                        <div class="form-group">                      
                            <select name="ad" id="custom-select-1a" class="custom-select custom-select" style="padding-left:0; width:3.7rem;">
                                <option>{{$userresult->ad}}</option>
                                <option>投</option>
                                <option>捕</option>
                                <option>一</option>
                                <option>二</option>
                                <option>三</option>
                                <option>遊</option>
                                <option>左</option>
                                <option>中</option>
                                <option>右</option>
                            </select>
                        </div>
                        <div class="form-group">                      
                            <select name="a" id="custom-select-1a" class="custom-select custom-select" style="padding-left:0; width:3.7rem;">
                                <option>{{$userresult->a}}</option>
                                <option>安</option>
                                <option>２</option>
                                <option>３</option>
                                <option>本</option>
                                <option>ゴ</option>
                                <option>飛</option>
                                <option>直</option>
                                <option>三振</option>
                                <option>犠</option>
                                <option>犠飛</option>
                                <option>四球</option>
                                <option>死球</option>
                                <option>他</option>
                            </select>
                        </div>                      
                        <div class="form-group">
                            <select name="ar" id="custom-select-1a" class="custom-select custom-select" style="padding-left:0; width:3.7rem;">
                                <option>{{$userresult->ar}}</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                            </select>
                        </div>                    
                    </td>
                    <td>
                    <div class="form-group">                      
                        <select name="bd" id="custom-select-1a" class="custom-select custom-select" style="padding-left:0; width:3.7rem;">
                            <option>{{$userresult->bd}}</option>
                            <option>投</option>
                            <option>捕</option>
                            <option>一</option>
                            <option>二</option>
                            <option>三</option>
                            <option>遊</option>
                            <option>左</option>
                            <option>中</option>
                            <option>右</option>
                        </select>
                        </div>
                        <div class="form-group">                      
                            <select name="b" id="custom-select-1a" class="custom-select custom-select" style="padding-left:0; width:3.7rem;">
                                <option>{{$userresult->b}}</option>
                                <option>安</option>
                                <option>２</option>
                                <option>３</option>
                                <option>本</option>
                                <option>ゴ</option>
                                <option>飛</option>
                                <option>直</option>
                                <option>三振</option>
                                <option>犠</option>
                                <option>犠飛</option>
                                <option>四球</option>
                                <option>死球</option>
                                <option>他</option>
                            </select>
                        </div>
                        <div class="form-group">                        
                            <select name="br" id="custom-select-1a" class="custom-select custom-select" style="padding-left:0; width:3.7rem;">
                                <option>{{$userresult->br}}</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                            </select> 
                        </div>
                    </td>
                    <td>
                    <div class="form-group">                      
                        <select name="cd" id="custom-select-1a" class="custom-select custom-select" style="padding-left:0; width:3.7rem;">
                            <option>{{$userresult->cd}}</option>
                            <option>投</option>
                            <option>捕</option>
                            <option>一</option>
                            <option>二</option>
                            <option>三</option>
                            <option>遊</option>
                            <option>左</option>
                            <option>中</option>
                            <option>右</option>
                        </select>
                        </div>
                        <div class="form-group">                      
                            <select name="c" id="custom-select-1a" class="custom-select custom-select" style="padding-left:0; width:3.7rem;">
                                <option>{{$userresult->c}}</option>
                                <option>安</option>
                                <option>２</option>
                                <option>３</option>
                                <option>本</option>
                                <option>ゴ</option>
                                <option>飛</option>
                                <option>直</option>
                                <option>三振</option>
                                <option>犠</option>
                                <option>犠飛</option>
                                <option>四球</option>
                                <option>死球</option>
                                <option>他</option>
                            </select>
                        </div>
                        <div class="form-group">                        
                            <select name="cr" id="custom-select-1a" class="custom-select custom-select" style="padding-left:0; width:3.7rem;">
                                <option>{{$userresult->cr}}</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                            </select> 
                        </div>
                    </td>
                    <td>
                    <div class="form-group">                      
                            <select name="dd" id="custom-select-1a" class="custom-select custom-select" style="padding-left:0; width:3.7rem;">
                                <option>{{$userresult->dd}}</option>
                                <option>投</option>
                                <option>捕</option>
                                <option>一</option>
                                <option>二</option>
                                <option>三</option>
                                <option>遊</option>
                                <option>左</option>
                                <option>中</option>
                                <option>右</option>
                            </select>
                        </div>
                        <div class="form-group">                      
                            <select name="d" id="custom-select-1a" class="custom-select custom-select" style="padding-left:0; width:3.7rem;">
                                <option>{{$userresult->d}}</option>
                                <option>安</option>
                                <option>２</option>
                                <option>３</option>
                                <option>本</option>
                                <option>ゴ</option>
                                <option>飛</option>
                                <option>直</option>
                                <option>三振</option>
                                <option>犠</option>
                                <option>犠飛</option>
                                <option>四球</option>
                                <option>死球</option>
                                <option>他</option>
                            </select>
                        </div>
                        <div class="form-group">                      
                            <select name="dr" id="custom-select-1a" class="custom-select custom-select" style="padding-left:0; width:3.7rem;">
                                <option>{{$userresult->dr}}</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                            </select>         
                        </div>
                    </td>
                    <td>
                    <div class="form-group">                      
                        <select name="ed" id="custom-select-1a" class="custom-select custom-select" style="padding-left:0; width:3.7rem;">
                            <option>{{$userresult->ed}}</option>
                            <option>投</option>
                            <option>捕</option>
                            <option>一</option>
                            <option>二</option>
                            <option>三</option>
                            <option>遊</option>
                            <option>左</option>
                            <option>中</option>
                            <option>右</option>
                        </select>
                        </div>
                        <div class="form-group">                      
                            <select name="e" id="custom-select-1a" class="custom-select custom-select" style="padding-left:0; width:3.7rem;">
                                <option>{{$userresult->e}}</option>
                                <option>安</option>
                                <option>２</option>
                                <option>３</option>
                                <option>本</option>
                                <option>ゴ</option>
                                <option>飛</option>
                                <option>直</option>
                                <option>三振</option>
                                <option>犠</option>
                                <option>犠飛</option>
                                <option>四球</option>
                                <option>死球</option>
                                <option>他</option>
                            </select>
                        </div>
                        <div class="form-group">                        
                            <select name="er" id="custom-select-1a" class="custom-select custom-select" style="padding-left:0; width:3.7rem;">
                                <option>{{$userresult->er}}</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                            </select>          
                        </div>
                    </td>
                    <td>
                    <div class="form-group">                      
                        <select name="fd" id="custom-select-1a" class="custom-select custom-select" style="padding-left:0; width:3.7rem;">
                            <option>{{$userresult->fd}}</option>
                            <option>投</option>
                            <option>捕</option>
                            <option>一</option>
                            <option>二</option>
                            <option>三</option>
                            <option>遊</option>
                            <option>左</option>
                            <option>中</option>
                            <option>右</option>
                        </select>
                    </div>
                    <div class="form-group">                      
                        <select name="f" id="custom-select-1a" class="custom-select custom-select" style="padding-left:0; width:3.7rem;">
                                <option>{{$userresult->f}}</option>
                                <option>安</option>
                                <option>２</option>
                                <option>３</option>
                                <option>本</option>
                                <option>ゴ</option>
                                <option>飛</option>
                                <option>直</option>
                                <option>三振</option>
                                <option>犠</option>
                                <option>犠飛</option>
                                <option>四球</option>
                                <option>死球</option>
                                <option>他</option>
                            </select>
                        </div>
                        <div class="form-group">                        
                            <select name="fr" id="custom-select-1a" class="custom-select custom-select" style="padding-left:0; width:3.7rem;">
                                <option>{{$userresult->fr}}</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                            </select>         
                        </div>
                    </td>
                    <td>
                    <div class="form-group">                      
                        <select name="gd" id="custom-select-1a" class="custom-select custom-select" style="padding-left:0; width:3.7rem;">
                            <option>{{$userresult->gd}}</option>
                            <option>投</option>
                            <option>捕</option>
                            <option>一</option>
                            <option>二</option>
                            <option>三</option>
                            <option>遊</option>
                            <option>左</option>
                            <option>中</option>
                            <option>右</option>
                        </select>
                        </div>
                        <div class="form-group">                      
                            <select name="g" id="custom-select-1a" class="custom-select custom-select" style="padding-left:0; width:3.7rem;">
                                <option>{{$userresult->g}}</option>
                                <option>安</option>
                                <option>２</option>
                                <option>３</option>
                                <option>本</option>
                                <option>ゴ</option>
                                <option>飛</option>
                                <option>直</option>
                                <option>三振</option>
                                <option>犠</option>
                                <option>犠飛</option>
                                <option>四球</option>
                                <option>死球</option>
                                <option>他</option>
                            </select>
                        </div>
                        <div class="form-group">                        
                            <select name="gr" id="custom-select-1a" class="custom-select custom-select" style="padding-left:0; width:3.7rem;">
                                <option>{{$userresult->gr}}</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                            </select>          
                        </div>
                    </td>
                    <td>
                    <div class="form-group">                      
                        <select name="hd" id="custom-select-1a" class="custom-select custom-select" style="padding-left:0; width:3.7rem;">
                            <option>{{$userresult->hd}}</option>
                            <option>投</option>
                            <option>捕</option>
                            <option>一</option>
                            <option>二</option>
                            <option>三</option>
                            <option>遊</option>
                            <option>左</option>
                            <option>中</option>
                            <option>右</option>
                        </select>
                    </div>
                    <div class="form-group">                      
                        <select name="h" id="custom-select-1a" class="custom-select custom-select" style="padding-left:0; width:3.7rem;">
                                <option>{{$userresult->h}}</option>
                                <option>安</option>
                                <option>２</option>
                                <option>３</option>
                                <option>本</option>
                                <option>ゴ</option>
                                <option>飛</option>
                                <option>直</option>
                                <option>三振</option>
                                <option>犠</option>
                                <option>犠飛</option>
                                <option>四球</option>
                                <option>死球</option>
                                <option>他</option>
                            </select>
                        </div>
                        <div class="form-group">                        
                            <select name="hr" id="custom-select-1a" class="custom-select custom-select" style="padding-left:0; width:3.7rem;">
                                <option>{{$userresult->hr}}</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                            </select>          
                        </div>
                    </td>
                    <td>
                    <div class="form-group">                      
                        <select name="i_d" id="custom-select-1a" class="custom-select custom-select" style="padding-left:0; width:3.7rem;">
                            <option>{{$userresult->i_d}}</option>
                            <option>投</option>
                            <option>捕</option>
                            <option>一</option>
                            <option>二</option>
                            <option>三</option>
                            <option>遊</option>
                            <option>左</option>
                            <option>中</option>
                            <option>右</option>
                        </select>
                    </div>
                        <div class="form-group">                      
                            <select name="i" id="custom-select-1a" class="custom-select custom-select" style="padding-left:0; width:3.7rem;">
                                <option>{{$userresult->i}}</option>
                                <option>安</option>
                                <option>２</option>
                                <option>３</option>
                                <option>本</option>
                                <option>ゴ</option>
                                <option>飛</option>
                                <option>直</option>
                                <option>三振</option>
                                <option>犠</option>
                                <option>犠飛</option>
                                <option>四球</option>
                                <option>死球</option>
                                <option>他</option>
                            </select>
                        </div>
                        <div class="form-group">                        
                            <select name="ir" id="custom-select-1a" class="custom-select custom-select" style="padding-left:0; width:3.7rem;">
                                <option>{{$userresult->ir}}</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                            </select>          
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input name="steal" class="form-control form-control-sm score"  id="text6c" value="0" style="width:3.7rem;">
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
<div>
    <button  type="submit button" class="btn btn-success btn-lg">登録</button>
        <a href="{{ route('results.edit',$result->id )}}">戻る</a>
</form>
</div>

@endsection