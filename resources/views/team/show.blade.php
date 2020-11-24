@extends('layouts.app')

@section('title','show')

@section('content')

<div class="container-fluid ">
    <div class="imgtext">
        @if($team->img ==null)
            <img class="max" src="{{ asset('/storage/img/'.'4075649_m.jpg')}}">
        @else
            <img class="max" src="{{ asset('/storage/img/'.$team->img)}}">
        @endif
    </div>
    <div class="jumbotron">
        <h1 class="display-4">{{$team->name}}</h1>
            <p>{{$team->place}}</p>
            <p class="lead">{{$team->comment}}</p>
        <hr class="my-4">
            <p>{{$team->Recruitment}}</p>
        <a class="btn btn-primary btn-lg" href="{{ url('contact') }}" role="button">CONTACT</a>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-5 center">
                @if($team->user->user_image)
                    <img src="{{ asset('/storage/img/'.$team->user->user_image)}}" width="70%">
                @endif
            </div>
            <div class="col-7">
                <h2>{{$team->manager}}:{{$team->manager_name}}</h2>
                <p>{{$team->manager_comment}}</p>
            </div>
        </div>
    </div>
</div>
    <a  href="{{ url('/') }}">Homeへ戻る</a>
@endsection