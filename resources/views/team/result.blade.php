@extends('layouts.app')

@section('title','result')

@section('content')

<div class="container">
    <h2>管理者画面</h2>
        <div class="row  justify-content-center">
            <div class="col-sm-6 mt-3">
                <a href="{{ route('results.create') }}" class="btn btn-info btn-lg btn-block">試合結果新規登録</a>
            </div>
        </div>
        <br>
        <div class="row text-center">
            @foreach($results as $result)
                <div class="col-md-6 card cel">
                    <a href="{{ route('results.edit',$result) }}">
                        <h2>{{$result->y}}年{{$result->m}}月{{$result->d}}日</h2>
                        <h4>{{$result->S_name}}　vs　{{$result->K_name}}</h4>
                    </a>
                </div>
            @endforeach
        </div>
</div>
    <a  href="{{ route('team.admin') }}">一覧へ戻る</a>
@endsection