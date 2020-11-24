@extends('layouts.app')

@section('title','schedule')

@section('content')

<div class="container">
    <h2>管理者画面</h2>
        <div class="row  justify-content-center">
            <div class="col-sm-6 mt-3">
                <a href="{{ route('schedules.create') }}" class="btn btn-info btn-lg btn-block">スケジュール新規登録</a>
            </div>
        </div>
    <br>

    <div class="row text-center">
        @foreach($schedules as $schedule)
            <div class="col-md-6 card cel">
                <a href="{{ route('schedules.edit',$schedule) }}">
                    <h2>{{$schedule->date->format('Y年m月d日')}}</h2>
                    <h4>vs　{{$schedule->opponent}}</h4>
                </a>
            </div>
        @endforeach
    </div>
</div>
    <a  href="{{ route('team.admin') }}">一覧へ戻る</a>
@endsection