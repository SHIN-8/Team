@extends('layouts.app')

@section('title','user')

@section('content')

<div class="container">
    <h2>管理者画面</h2>
        <div class="row  justify-content-center">
            <div class="col-sm-6 mt-3">
                <a href="{{ route('users.create') }}" class="btn btn-info btn-lg btn-block">選手新規登録</a>
            </div>
        </div>
    <br>
    <div class="row text-center">
        @foreach($users as $user)
            <div class="col-md-3 col-sm-4 card cel">
                <a href="{{ route('users.edit',$user) }}">
                    <h2>{{$user->number}}{{$user->Name}}</h2> 
                </a>
            </div>
        @endforeach
    </div>
</div>
    <a  href="{{ route('team.admin') }}">一覧へ戻る</a>
@endsection