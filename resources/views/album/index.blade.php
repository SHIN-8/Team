@extends('layouts.app')

@section('title','index')

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

  <div class="contents">ALBUM</div>

  {{-- ログインユーザーのみ画像投稿機能表示 --}}
  <form method="post" action="{{route('album.store')}}" enctype="multipart/form-data">
    @csrf
  <div class="form-row">
    @guest
    @else
      <div class="custom-file col-sm-10">
          <input type="file" name="img">
      </div>
      <div class="row  justify-content-center">
          <div class="col-sm-6 mt-3">        
              <button  type="submit button" class="btn btn-info btn-block btn-lg">登録</button>
          </div>
      </div>
    @endguest       
  </form>
  </div>

  <div class="row">
      @foreach($albums as $album)
        <div class="card col-md-4">
            <a href="{{ url('album',$album->id) }}">
              <div class="card-body ">
                  <div class=" d-flex align-items-center justify-content-center">
                      <img src="{{ asset('/storage/img/'.$album->img)}}" width="100%" class="thumbnail">
                  </div>
                  <div class="text-nowrap">
                      {{$album->created_at->format('Y年m月d日')}}
                  </div>
              </div>
            </a>
        </div>
      @endforeach
  </div>

  <a  href="{{ url('/') }}">Homeへ戻る</a>


  @endsection