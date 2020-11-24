@extends('layouts.app')

@section('title','index')

@section('content')


<div class="container">
    <div class="contents">Blog</div>
            @guest
                <?php
                $blogs = App\Blog::where('release','2')->paginate(10);
                ?>
            @else
                <div class="row  justify-content-center">
                    <div class="col-sm-6 mt-3">        
                            <a href="{{ route('blog.create') }}" class="btn btn-info btn-block btn-lg">新しい記事を書く</a>
                    </div>
                </div>
            @endguest
    <br>
    @foreach($blogs as $blog)
        <div class="card">
            <a href="{{ url('blog',$blog->id) }}" >
                <div class="card-header">
                    <div class="row">
                        <div class="col-7 text-center text-nowrap">
                            <h4><strong>{{$blog->title}}</strong></h4>
                        </div>
                        <div class="col-5 text-right text-nowrap">
                            <h5>投稿：{{$blog->user->Name}}</h5>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-4 d-flex align-items-center justify-content-center">
                            @if($blog->img ==null)
                                    <img src="{{ asset('/storage/img/'."cbafa93cd0738ed330edae441fcfc23b_s.jpg")}}" width="100%" class="thumbnail">
                            @else
                                    <img src="{{ asset('/storage/img/'.$blog->img)}}" width="100%" class="thumbnail">
                            @endif
                        </div>
                        <div class="col-8">
                            <?php
                            $limit = 200;
                            $text = $blog->text; 
                            $longtext = mb_substr($text,0,$limit);
                            ?>
                            @if(mb_strlen($text) > $limit)
                                <p class="card-text">{!!$longtext!!}...</p>
                                <div class="btn btn-primary">ReadMore</div>
                            @else
                                <p class="card-text">{!!$text!!}...</p>
                                <div class="btn btn-primary">ReadMore</div>
                            @endif
                        </div>
                        @if($blog->created_at)
                            <div class="text-right">
                                {{$blog->created_at->format('Y年m月d日H時')}}
                            </div>
                        @endif
                    </div>
                </div>
            </a>
        </div>
    @endforeach
    <div class="d-flex justify-content-center">
        {{$blogs->links()}}
    </div>
    <a  href="{{ url('/') }}">Homeへ戻る</a>
</div>
@endsection