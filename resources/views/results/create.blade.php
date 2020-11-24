@extends('layouts.app')

@section('title','create')

@section('content')

<div class="container">
    <div>
        <h2>試合結果</h2>
            @if($errors->any())
                <div class="alert alert-danger">
                  <ul>
                      @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                      @endforeach
                  </ul>
                </div>
            @endif
  <form method="post" action="{{route('results.store')}}">
    @csrf
        <div class="form-group">
          <label for="custom-select-1b">形式</label>
              <select name="game" id="custom-select-1b" class="custom-select">
                @if(old('game') == 1)
                  <option value="1">公式戦</option>
                @elseif(old('game') == 2)
                  <option value="2">練習試合</option>
                @elseif(old('game') == 3)
                  <option value="3">紅白戦</option>
                @endif
                  <option value="1">公式戦</option>
                  <option value="2">練習試合</option>
                  <option value="3">紅白戦</option>
              </select>
        </div>
        
        <select name="y"> 
          <option value="{{old('y')}}">{{old('y')}}</option><option value="2020">2020</option> <option value="2021">2021</option> <option value="2022">2022</option> <option value="2023">2023</option> <option value="2024">2024</option> <option value="2025">2025</option> <option value="2026">2026</option> <option value="2027">2027</option> <option value="2028">2028</option> <option value="2029">2029</option> <option value="2030">2030</option> 
        </select>　年

        <select name="m">
           <option value="{{old('m')}}">{{old('m')}}</option> <option value="1">1</option> <option value="2">2</option> <option value="3">3</option> <option value="4">4</option> <option value="5">5</option> <option value="6">6</option> <option value="7">7</option> <option value="8">8</option> <option value="9">9</option> <option value="10">10</option> <option value="11">11</option> <option value="12">12</option> 
        </select>　月

        <select name="d">
          <option value="{{old('d')}}">{{old('d')}}</option> <option value="1">1</option> <option value="2">2</option> <option value="3">3</option> <option value="4">4</option> <option value="5">5</option> <option value="6">6</option> <option value="7">7</option> <option value="8">8</option> <option value="9">9</option> <option value="10">10</option> <option value="11">11</option> <option value="12">12</option> <option value="13">13</option> <option value="14">14</option> <option value="15">15</option> <option value="16">16</option> <option value="17">17</option> <option value="18">18</option> <option value="19">19</option> <option value="20">20</option> <option value="21">21</option> <option value="22">22</option> <option value="23">23</option> <option value="24">24</option> <option value="25">25</option> <option value="26">26</option> <option value="27">27</option> <option value="28">28</option> <option value="29">29</option> <option value="30">30</option> <option value="31">31</option> 
        </select>　日

          <div class="form-group">
              <label for="custom-select-1b">会場</label>
                <select id="custom-select-1b" class="custom-select" name="place">
                  @if(old('place'))
                      <?php
                      $oldPlace = old('place');
                      $Place = App\Place::where('id',$oldPlace)->first();
                      ?>
                    <option value="{{old('place')}}">{{$Place->name}}</option>
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
                          <input type="text" id="text1" class="form-control" name="S_name" value="{{old('->S_name')}}">
                    </td>
                    <td>           
                          <input class="form-control form-control-sm score" type="tel" id="text6c" value="{{old('->S1')}}" name="S1">
                    </td>
                    <td>            
                          <input class="form-control form-control-sm score" type="tel" id="text6c" value="{{old('->S2')}}" name="S2">
                    </td>
                    <td>            
                          <input class="form-control form-control-sm score" type="tel" id="text6c" value="{{old('->S3')}}" name="S3">
                    </td>
                    <td>            
                          <input class="form-control form-control-sm score" type="tel" id="text6c" value="{{old('->S4')}}" name="S4">
                    </td>
                    <td>            
                          <input class="form-control form-control-sm score" type="tel" id="text6c" value="{{old('->S5')}}" name="S5">
                    </td>
                    <td>            
                          <input class="form-control form-control-sm score" type="tel" id="text6c" value="{{old('->S6')}}" name="S6">
                    </td>
                    <td>            
                          <input class="form-control form-control-sm score" type="tel" id="text6c" value="{{old('->S7')}}" name="S7">
                    </td>
                    <td>            
                          <input class="form-control form-control-sm score" type="tel" id="text6c" value="{{old('->S8')}}" name="S8">
                    </td>
                    <td>            
                          <input class="form-control form-control-sm score" type="tel" id="text6c" value="{{old('->S9')}}" name="S9">
                    </td>
                    <td>                                      
                      <div class="score">
                    </td>                    
                  </tr>
                  <tr>
                    <td>         
                      <input type="text" id="text1" class="form-control" name="K_name" value="{{old('->K_name')}}">
                    </th>
                    <td>            
                          <input class="form-control form-control-sm score" type="tel" id="text6c" value="{{old('->K1')}}" name="K1">
                    </td>
                    <td>            
                          <input class="form-control form-control-sm score" type="tel" id="text6c" value="{{old('->K2')}}" name="K2">
                    </td>
                    <td>            
                          <input class="form-control form-control-sm score" type="tel" id="text6c" value="{{old('->K3')}}" name="K3">
                    </td>
                    <td>            
                          <input class="form-control form-control-sm score" type="tel" id="text6c" value="{{old('->K4')}}" name="K4">
                    </td>
                    <td>            
                          <input class="form-control form-control-sm score" type="tel" id="text6c" value="{{old('->K5')}}" name="K5">
                    </td>
                    <td>            
                          <input class="form-control form-control-sm score" type="tel" id="text6c" value="{{old('->K6')}}" name="K6">
                    </td>
                    <td>            
                          <input class="form-control form-control-sm score" type="tel" id="text6c" value="{{old('->K7')}}" name="K7">
                    </td>
                    <td>            
                          <input class="form-control form-control-sm score" type="tel" id="text6c" value="{{old('->K8')}}" name="K8">
                    </td>
                    <td>            
                          <input class="form-control form-control-sm score" type="tel" id="text6c" value="{{old('->K9')}}" name="K9">
                    </td>
                    <td>                          
                      <div class="score">
                    </td>
                  </tr>              
                </tbody>
              </table>
            </div>
          </div>
          <div class="form-group">
              <label for="custom-select-1b">勝敗</label>
                  <select id="custom-select-1b" class="custom-select" name="wl">
                      <option>{{old('wl')}}</option>
                      <option>勝</option>
                      <option>負</option>
                      <option>引分け</option>
                  </select>
          </div>
          <div class="row  justify-content-center">
              <div class="col-sm-6 mt-3">
                  <button  type="submit button" class="btn btn-info btn-lg btn-block">登録</button>
              </div>
          </div>

@endsection