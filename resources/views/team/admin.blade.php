@extends('layouts.app')

@section('title','admin')

@section('content')

<div>
    <h2>管理者画面</h2>
    <div class="row">
        <div class="col-6 col-md-4 col-lg-2 imgtext">
            <a class="btn-img" href="{{ route('team.edit',$team) }}">
                <img src="{{ asset('/storage/img/'.'team.png')}}" width="100%"> 
                <p class="navi nav-link contentstitle text-center" >TEAM</p>
            </a>
        </div>
        <div class="col-6 col-md-4 col-lg-2 imgtext"> 
            <a class="btn-img" href="{{ route('team.user') }}">
                <img src="{{ asset('/storage/img/'.'player.png')}}" width="100%">
                <p class="navi nav-link contentstitle text-center">PLAYER</p>
            </a>
        </div>
        <div class="col-6 col-md-4 col-lg-2 imgtext">
            <a class="btn-img" href="{{ route('team.result') }}">
                <img src="{{ asset('/storage/img/'.'teamresult.png')}}" width="100%">
                <p class="navi nav-link contentstitle text-center">RESULT</p>
            </a>      
        </div>
        <div class="col-6 col-md-4 col-lg-2 imgtext">
            <a class="btn-img" href="{{ route('team.schedule') }}">
                <img src="{{ asset('/storage/img/'.'schedule.png')}}" width="100%">
                <p class="navi nav-link contentstitle text-center">SCHEDULE</p>
            </a>
        </div>
        <div class="col-6 col-md-4 col-lg-2 imgtext">
            <a class="btn-img" href="{{ route('team.place') }}">
                <img src="{{ asset('/storage/img/'.'place.png')}}" width="100%">
                <p class="navi nav-link contentstitle text-center">PLACE</p>
            </a>
        </div>
    </div>
</div>
    <a  href="{{ url('/') }}">Homeへ戻る</a>
@endsection