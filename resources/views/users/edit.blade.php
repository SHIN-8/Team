@extends('layouts.app')

@section('title','edit')

@section('content')

<div class="container">
    <h2>プロフィール入力画面</h2>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                      <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    <form method="POST" action="{{route('users.update',$user)}}" enctype="multipart/form-data">
      @method('PUT')
      @csrf
        <div class="form-row">
            <label for="text4a">イメージ①(縦長)※変更がある場合は選択</label>
              <div class="custom-file col-lg-4">
                  <input type="file" name="user_image" value="{{$user->user_image}}">
              </div>
        </div>
        <div class="form-row">
          <label for="text4a">イメージ②(横長)※変更がある場合は選択</label>
              <div class="custom-file col-lg-4">
                  <input type="file" name="user_img" value="{{$user->user_img}}">
              </div>
        </div>
      
    <div class="form-row">
        <div class="form-group col-sm-6">
            <label for="text4a">登録名</label>
              <input type="text" name="Name" class="form-control" id="text4b" placeholder="登録名" value="{{$user->Name}}">
        </div>

        <div class="form-group col-sm-6">
            <label for="text4b">フルネーム</label>
              <input type="text" name="FullName" class="form-control" id="text4b" placeholder="フルネーム" value="{{$user->FullName}}">
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-sm-6">
            <label for="text4b">背番号</label>
              <input type="text" name="number" class="form-control" id="text4b" placeholder="背番号" value="{{$user->number}}">
        </div>

        <div class="form-group col-sm-6">
            <label for="text4b">パスワード(再設定)</label>
              <input type="text" name="password" class="form-control" id="text4b" placeholder="パスワード" value="">
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-sm-6">
            <label for="custom-select-1b">ポジション</label>
                <select name="position" id="custom-select-1b" class="custom-select">
                    <option>{{$user->position}}</option>
                    <option>投手</option>
                    <option>捕手</option>
                    <option>一塁手</option>
                    <option>二塁手</option>
                    <option>三塁手</option>
                    <option>遊撃手</option>
                    <option>外野手</option>
                    <option>マネージャー</option>
                </select>
        </div>
  
        <div class="form-group col-sm-6">
            <label for="custom-select-1b">サブポジション</label>
                <select name="SubPosition" id="custom-select-1b" class="custom-select">
                    <option>{{$user->SubPosition}}</option>
                    <option>投手</option>
                    <option>捕手</option>
                    <option>一塁手</option>
                    <option>二塁手</option>
                    <option>三塁手</option>
                    <option>遊撃手</option>
                    <option>外野手</option>
                    <option>マネージャー</option>
                </select>
        </div>
    </div>

  <div class="row">
        <div class="form-group col">
            <label for="custom-select-1b">生年月日</label>
                  <select name="Birthday_y">
                    <option value="{{$user->Birthday_y}}">{{$user->Birthday_y}}</option>  <option value="1946">1946</option> <option value="1947">1947</option> <option value="1948">1948</option> <option value="1949">1949</option> <option value="1950">1950</option> <option value="1951">1951</option> <option value="1952">1952</option> <option value="1953">1953</option> <option value="1954">1954</option> <option value="1955">1955</option> <option value="1956">1956</option> <option value="1957">1957</option> <option value="1958">1958</option> <option value="1959">1959</option> <option value="1960">1960</option> <option value="1961">1961</option> <option value="1962">1962</option> <option value="1963">1963</option> <option value="1964">1964</option> <option value="1965">1965</option> <option value="1966">1966</option> <option value="1967">1967</option> <option value="1968">1968</option> <option value="1969">1969</option> <option value="1970">1970</option> <option value="1971">1971</option> <option value="1972">1972</option> <option value="1973">1973</option> <option value="1974">1974</option> <option value="1975">1975</option> <option value="1976">1976</option> <option value="1977">1977</option> <option value="1978">1978</option> <option value="1979">1979</option> <option value="1980">1980</option> <option value="1981">1981</option> <option value="1982">1982</option> <option value="1983">1983</option> <option value="1984">1984</option> <option value="1985">1985</option> <option value="1986">1986</option> <option value="1987">1987</option> <option value="1988">1988</option> <option value="1989">1989</option> <option value="1990">1990</option> <option value="1991">1991</option> <option value="1992">1992</option> <option value="1993">1993</option> <option value="1994">1994</option> <option value="1995">1995</option> <option value="1996">1996</option> <option value="1997">1997</option> <option value="1998">1998</option> <option value="1999">1999</option> <option value="2000">2000</option> <option value="2001">2001</option> <option value="2002">2002</option> <option value="2003">2003</option> <option value="2004">2004</option> <option value="2005">2005</option> <option value="2006">2006</option> <option value="2007">2007</option> <option value="2008">2008</option> <option value="2009">2009</option> <option value="2010">2010</option> <option value="2011">2011</option> <option value="2012">2012</option> <option value="2013">2013</option> <option value="2014">2014</option> <option value="2015">2015</option> <option value="2016">2016</option> <option value="2017">2017</option> <option value="2018">2018</option> <option value="2019">2019</option> <option value="2020">2020</option>  
                  </select>　年
                  <select name="Birthday_m">
                    <option value="{{$user->Birthday_m}}">{{$user->Birthday_m}}</option> <option value="1">1</option> <option value="2">2</option> <option value="3">3</option> <option value="4">4</option> <option value="5">5</option> <option value="6">6</option> <option value="7">7</option> <option value="8">8</option> <option value="9">9</option> <option value="10">10</option> <option value="11">11</option> <option value="12">12</option> 
                  </select>　月
                  <select name="Birthday_d"> 
                    <option value="{{$user->Birthday_d}}">{{$user->Birthday_d}}</option> <option value="1">1</option> <option value="2">2</option> <option value="3">3</option> <option value="4">4</option> <option value="5">5</option> <option value="6">6</option> <option value="7">7</option> <option value="8">8</option> <option value="9">9</option> <option value="10">10</option> <option value="11">11</option> <option value="12">12</option> <option value="13">13</option> <option value="14">14</option> <option value="15">15</option> <option value="16">16</option> <option value="17">17</option> <option value="18">18</option> <option value="19">19</option> <option value="20">20</option> <option value="21">21</option> <option value="22">22</option> <option value="23">23</option> <option value="24">24</option> <option value="25">25</option> <option value="26">26</option> <option value="27">27</option> <option value="28">28</option> <option value="29">29</option> <option value="30">30</option> <option value="31">31</option>
                  </select>　日
        </div>
  </div>
    
  <div class="row">
      <div class="form-group col-sm-4">
          <label for="custom-select-1b">投打</label>
              <select name="dominant_hand" id="custom-select-1b" class="custom-select">
                  <option>{{$user->dominant_hand}}</option>
                  <option>右投右打</option>
                  <option>右投右打</option>
                  <option>右投左打</option>
                  <option>右投両打</option>
                  <option>左投右打</option>
                  <option>左投左打</option>
                  <option>左投両打</option>
                  <option>両投右打</option>
                  <option>両投左打</option>
                  <option>両投両打</option>
              </select>
      </div>

    
      <div class="form-group col-sm-4">
          <label for="text4a">身長(cm)</label>
            <input name="height" type="text" class="form-control" id="text4a" placeholder="身長" value="{{$user->height}}">
      </div>
      <div class="form-group col-sm-4">
          <label for="text4b">体重(kg)</label>
            <input name="weight" type="text" class="form-control" id="text4b" placeholder="体重" value="{{$user->weight}}">
      </div>
  </div>

  <div class="form-row">
      <div class="form-group col-sm-6">
          <label for="text1">出身校</label>
            <input name="alma_mater" type="text" id="text1" class="form-control" value="{{$user->alma_mater}}">
      </div>

      @if(Auth::user()->admin == 1)
        <div class="form-group col-sm-6">
            <label for="custom-select-1b">管理者設定</label>
              <select name="admin" id="custom-select-1b" class="custom-select">
                  @if($user->admin == 0)
                    <option value="0">一般ユーザー</option>
                  @else
                    <option value="1">管理者</option>
                  @endif
                    <option value="0">一般ユーザー</option>
                    <option value="1">管理者</option>
              </select>
        </div>
      @else
      @endif
  </div>
  <div class="row">
      <div class="col-sm-6 mt-3">
          <button  type="submit button" class="btn btn-info btn-lg btn-block">更新</button>
      </div>
    </form>
  
      <div class="col-sm-6 mt-3">
        <form method="POST" action="{{ route('users.destroy',$user) }}">
        @method('DELETE')
        @csrf
          <button onclick="return confirm('本当に削除しますか？')" class="btn btn-danger btn-lg btn-block">削除</button>
        </form>
      </div>
  </div>
</div>

@endsection