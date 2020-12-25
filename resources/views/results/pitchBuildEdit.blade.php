@extends('layouts.app')

@section('title','pitchbuildedit')

@section('content')

<div class="container">
    <div>
      <h2>試合結果(選手登録)</h2>
          @if($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach($errors->all() as $error)
                  <li>{{$error}}</li>
                @endforeach
              </ul>
            </div>
          @endif
          <form method="post" action="{{route('pitchresults.store')}}">
          @csrf

            <input type="hidden" name="game_id" class="form-control" id="text4b" value="{{$result->id}}">
            <input type="hidden" name="y" class="form-control" id="text4b" value="{{$result->y}}">
            <input type="hidden" name="m" class="form-control" id="text4b" value="{{$result->m}}">
            <input type="hidden" name="d"" class="form-control" id="text4b" value="{{$result->d}}">
            <input type="hidden" name="pitch_games"" class="form-control" id="text4b" value="{{$result->game}}">
            
            <div class="form-row">
                <div class="form-group col-6 text-nowrap">
                  <label for="custom-select-1a">継投</label>
                    <select name="pitch_order" id="custom-select-1a" class="custom-select custom-select-sm" style="width:6rem">
                        <option>{{$pitchresults->pitch_order}}</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                        <option>9</option>
                    </select>                
                </div>

                <div class="form-group col-6 text-nowrap">
                    <label for="custom-select-1a">選手名</label>
                        <select name="user_id" id="custom-select-1a" class="custom-select custom-select-sm" style="width:6rem">
                              <option value="{{$pitchresults->user->number}}">{{$pitchresults->user->Name}}</option>
                            @foreach($users as $user)
                              <option value="{{$user->number}}">{{$user->Name}}</option>
                            @endforeach
                        </select>
                </div>            

            <div class="table-responsive">
                <table class="table table-hover table-lg table-striped">
                  <thead class="thead-dark text-center text-nowrap">
                  <tr>
                      <th>イニング数</th>
                      <th>自責点</th>
                      <th>失点</th>
                      <th>奪三振</th>
                      <th>四死球</th>
                      <th>勝敗</th>                  
                  </tr>
                </thead>
              <tbody>
                <tr>                  
                  <td>
                    <div class="form-row" style="width:12rem;">                    
                      <div class="form-group col-3 ">
                        <select name="inning" id="custom-select-1a" class="custom-select" style="width:4rem">
                            <option>{{$pitchresults->inning}}</option>
                            <option>0</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                            <option>9</option>
                        </select>
                      </div>
                      <div class="form-group col-3"style="padding:1rem 1.5rem;">
                          <h5>回</h5>
                      </div>
                      <div class="form-group col-3">
                          <select name="inningathird" id="custom-select-1a" class="custom-select custom-select" style="width:4rem">
                              <option>{{$pitchresults->inningathird}}</option>
                              <option>0</option>
                              <option>1</option>
                              <option>2</option>
                          </select>
                      </div>
                      <div class="form-group col-3"style="padding:1rem 1.5rem;">
                          <h5>/3</h5>
                      </div>
                    </div>
                  </td>                
                  <td>
                    <div class="form-group">
                        <input name="earned_run" class="form-control form-control-sm score" type="tel" id="text6c" value="{{$pitchresults->earned_run}}">
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                        <input name="runs_allowed" class="form-control form-control-sm score" type="tel" id="text6c" value="{{$pitchresults->runs_allowed}}">
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                        <input name="k" class="form-control form-control-sm score" type="tel" id="text6c" value="{{$pitchresults->k}}">
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                        <input name="give_four_dead_balls" class="form-control form-control-sm score" type="tel" id="text6c" value="{{$pitchresults->give_four_dead_balls}}">
                    </div>
                  </td>                  
                  <td>
                    <div class="form-group">
                        <select name="wins" id="custom-select-1a" class="custom-select custom-select" style="padding-left:0; width:3.7rem;">
                            <option>{{$pitchresults->wins}}</option>
                            <option>勝</option>
                            <option>負</option>
                            <option>Ｓ</option>
                            <option></option>
                        </select>
                    </div>
                  </td>
                </tr>
            </tbody>
          </table>
</div>
    <button  type="submit button" class="btn btn-success btn-lg">登録</button>
      <a href="{{ route('results.edit',$result->id )}}">戻る</a>
  </form>
@endsection