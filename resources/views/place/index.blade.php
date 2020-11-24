@extends('layouts.app')

@section('title','index')

@section('content')

<div class="container">
    <h1>球場一覧</h1>
  <div class="row">
    @foreach($places as $place)
        <div class="card col-md-6 col-lg-4">
            <a href="{{ url('place',$place->id) }}">
                <div class="card-body text-center">
                    <h2>{{$place->name}}</h2>
                    <p>{{$place->adress}}</p>
                </div>
            </a>
        </div>
    @endforeach
  </div>
    <a  href="{{ url('/') }}">Homeへ戻る</a>
</div>
  @endsection