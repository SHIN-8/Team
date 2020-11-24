@extends('layouts.app')

@section('title','index')

@section('content')

@section('content')

{{-- エラーメッセージ --}}
@if (count($errors) > 0)
<ul class="alert alert-danger" role="alert">
    @foreach ($errors->all() as $error)
    <li class="ml-4">{{ $error }}</li>
    @endforeach
</ul>
@endif

{{-- 本体 --}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-8">
            <h1>お問い合わせ</h1>
            <p class="pl-2">お問い合わせ内容をご入力ください。</p>

            {{ Form::open(['route' => 'contact.confirm']) }}
            <div class="container">
                <div class="row form-group">
                    {!! Form::label('name', 'お名前:', ['class' => 'col']) !!}
                    <div class="col-12">
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="row form-group">
                    {!! Form::label('email', 'メールアドレス :', ['class' => 'col']) !!}
                    <div class="col-12">
                        {!! Form::email('email', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="row form-group">
                    {!! Form::label('body', '内容 :', ['class' => 'col']) !!}
                    <div class="col-12">
                        {!! Form::textarea('body', null, ['class' => 'form-control', 'rows' => '6']) !!}
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row  justify-content-center">
                    <div class="col-sm-6 mt-3">
                        {!! Form::submit('確認', ['class' => 'btn btn-info btn-block']) !!}
                    </div>
                </div>
            </div>
            {{ Form::close() }}

        </div>
    </div>
</div>
@endsection