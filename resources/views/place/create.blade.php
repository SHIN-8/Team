@extends('layouts.app')

@section('title','create')

@section('content')

<div class="container">
  @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
  @endif
  <form method="post" action="{{route('place.store')}}" enctype="multipart/form-data">
    @csrf
      <label for="text4a">球場名</label>
      <input type="text" name="name" class="form-control" id="text4b" value="{{old('name')}}">

      <label for="text4a">住所</label>
      <input type="text" name="adress" class="form-control" id="text4b" value="{{old('adress')}}">

      <div class="row  justify-content-center">
          <div class="col-sm-6 mt-3">        
              <button  type="submit button" class="btn btn-info btn-block btn-lg">登録</button>
          </div>
      </div>
      <a href="{{ route('place.index')}}">戻る</a>
      </form>
  
</body>
</html>
@endsection