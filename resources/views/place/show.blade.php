@extends('layouts.app')

@section('title','show')

@section('content')


<div class="container">
    <h2>{{$place->name}}</h2>
    <p>住所：{{$place->adress}}</p>
    <a href="{{ route('place.index') }}">一覧へ戻る</a>
</div>
@endsection