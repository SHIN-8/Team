@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                            <div class="card-body">
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf

                                    <h2>プロフィール入力画面</h2>
                                    @if($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                            @foreach($errors->all() as $error)
                                                <li>{{$error}}</li>
                                            @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                        <div class="form-group  row">
                                            <label class="col-md-4 col-form-label text-md-right" for="text4a">登録名</label>
                                                <div class="col-md-6">
                                                    <input type="text" name="Name" class="form-control" id="text4b" placeholder="登録名" value="{{old('Name')}}">
                                                </div>
                                        </div>

                                        <div class="form-group  row">
                                            <label class="col-md-4 col-form-label text-md-right" for="text4b">背番号</label>
                                                <div class="col-md-6">
                                                    <input type="text" name="number" class="form-control" id="text4b" placeholder="背番号" value="{{old('number')}}">
                                                </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                                                <div class="col-md-6">
                                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">パスワード確認</label>
                                                <div class="col-md-6">
                                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                                </div>
                                        </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Register') }}
                                            </button>
                                        </div>
                                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
