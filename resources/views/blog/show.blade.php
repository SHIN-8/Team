@extends('layouts.app')

@section('title','show')

@section('content')


<div class="container">
    <div class="col">
        <h2>{{$blog->title}}</h2>
    </div>
    <div class="col text-right">
        <h3>{{$blog->user->FullName}}</h3>
    </div>
    <div class="d-flex align-items-center justify-content-center">
        @if($blog->img ==null)
            <img src="{{ asset('/storage/img/'."cbafa93cd0738ed330edae441fcfc23b_s.jpg")}}"  width="80%" class="thumbnail">
        @else
            <img src="{{ asset('/storage/img/'.$blog->img)}}" width="80%" class="thumbnail">
        @endif
    </div>
    <div class="col">
        {!!$blog->text!!}
    </div>
    <div class="text-right col">
        {{$blog->created_at->format('Y年m月d日H時')}}
    </div>
@guest
@else
    <div class="row">
        @if(Auth::user()->id == $blog->writer)
            <div class="col-sm-6 mt-3">     
                <a href="{{ route('blog.edit',$blog) }}" class="btn btn-info btn-block btn-lg">編集</a>
            </div>
            <div class="col-sm-6 mt-3"> 
                <form method="POST" action="{{ route('blog.destroy',$blog) }}">
                    @method('DELETE')
                    @csrf        
                    <button onclick="return confirm('本当に削除しますか？')" class="btn btn-danger btn-block btn-lg">削除</button>
                </form>
            </div>
        @endif
    </div>
    <a href="{{ route('blog.index') }}">一覧へ戻る</a>
@endguest

</div>
@endsection