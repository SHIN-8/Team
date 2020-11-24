@extends('layouts.app')

@section('title','edit')

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
    <form method="post" action="{{route('place.update',$place)}}" enctype="multipart/form-data">
      @method('PUT')
      @csrf
        <label for="text4a">球場名</label>
        <input type="text" name="name" class="form-control" id="text4b" placeholder="" value="{{$place->name}}">

        <label for="text4a">住所</label>
        <input type="text" name="adress" class="form-control" id="text4b" placeholder="" value="{{$place->adress}}">

        <div class="row  justify-content-center">
            <div class="col-sm-6 mt-3">        
                <button  type="submit button" class="btn btn-info btn-block btn-lg">更新</button>
            </div>
        </form>
        <div class="col-sm-6 mt-3">        
            <form method="POST" action="{{ route('place.destroy',$place) }}">
                @method('DELETE')
                @csrf
                  <button onclick="return confirm('本当に削除しますか？')" class="btn btn-danger btn-block btn-lg">削除</button>
            </form>
      </div> 
</div>
    <a href="{{ route('place.index')}}">戻る</a>
</body>
</html>
@endsection