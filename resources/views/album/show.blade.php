@extends('layouts.app')

@section('title','show')

@section('content')


<div class="container">
    <div class="row">
        <img src="{{ asset('/storage/img/'.$album->img)}}" width="100%">
        <p>投稿日:{{$album->created_at->format('Y年m月d日')}}</p>
    </div>
    <form method="POST" action="{{ route('album.destroy',$album) }}">
    @method('DELETE')
    @csrf
        <div class="row  justify-content-center">
            <div class="col-sm-6 mt-3">        
                <button onclick="return confirm('本当に削除しますか？')" class="btn btn-danger btn-block btn-lg">削除</button>
            </div>
        </div>
    </form>
<a href="{{ route('album.index') }}">一覧へ戻る</a>
</div>
@endsection