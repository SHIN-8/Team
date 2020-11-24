@extends('layouts.app')

@section('title','edit')

@section('content')

<div class="container">
    <div>
        <h2>チーム詳細編集</h2>
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        <form method="POST" action="{{route('team.update',$team)}}" enctype="multipart/form-data">
        @method('PUT')
        @csrf
            <div class="form-group">
                <label for="text4a">チーム名</label>
                    <input type="text" name="name" class="form-control" id="text4a" value="{{$team->name}}">
            </div>
            <div class="form-row">
                <div class="custom-file col">
                    <label for="text4a">チームイメージ(横長)※変更がある場合は選択</label>
                    <input type="file" name="img"  value="{{$team->img}}">
                </div>
            </div>          
            <div class="form-group">
                <label for="textarea1">活動場所</label>
                <textarea id="textarea1" name="place" class="form-control col" >{{$team->place}}</textarea>
            </div>
            <div class="form-group">
                <label for="textarea1">チームコメント</label>
                <textarea id="textarea1" name="comment" class="form-control col" >{{$team->comment}}</textarea>
            </div>

            <div class="form-row">
                <div class="form-group col-sm-6">
                    <label for="custom-select-1b">代表者</label>
                        <select name="manager" id="custom-select-1b" class="custom-select" value="{{$team->manager}}">
                            <option>監督</option>
                            <option>キャプテン</option>
                        </select>
                </div>
                <div class="form-group col-sm-6">
                    <label for="custom-select-1b">代表者名</label>
                    <select name="manager_name" id="custom-select-1b" class="custom-select" value="{{$team->manager_name}}">
                        @foreach($users as $user)
                            <option>{{$user->Name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="textarea1">代表者コメント</label>
                <textarea id="textarea1" name="manager_comment" class="form-control" >{{$team->manager_comment}}</textarea>
            </div>


            <div class="form-group">
                <label for="textarea1">選手・対戦相手募集について</label>
                <textarea id="textarea1" name="Recruitment" class="form-control" >{{$team->Recruitment}}</textarea>
            </div>
            <div class="row  justify-content-center">
                <div class="col-sm-6 mt-3">        
                    <button  type="submit button" class="btn btn-info btn-block btn-lg">更新</button> 
                </div>
            </div>
        </div>
            <a  href="{{ route('team.admin') }}">一覧へ戻る</a>
    </div>
</div>
@endsection