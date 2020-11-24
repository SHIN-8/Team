@extends('layouts.app')

@section('title','place')

@section('content')

<div class="container">
    <h2>管理者画面</h2>
        <div class="row  justify-content-center">
            <div class="col-sm-6 mt-3">
                <a href="{{ route('place.create') }}" class="btn btn-info btn-lg btn-block">球場情報新規登録</a>
            </div>
        </div>
        <br>
        <div class="row text-center">
            @foreach($places as $place)
                <div class="col-md-4 card cel" >
                    <a href="{{ route('place.edit',$place) }}">
                        <h3>{{$place->name}}</h3>  
                    </a>
                </div>
            @endforeach
    </div>
</div>
    <a  href="{{ route('team.admin') }}">一覧へ戻る</a>
@endsection