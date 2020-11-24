@extends('layouts.app')

@section('title','create')

@section('content')
<div class="container">
    <h2>新規登録</h2>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    <form method="post" action="{{route('schedules.store')}}">
    @csrf
    <div class="container">
        <div class="form-group">
            <label for="custom-select-1b">日時</label>
                <input name="date" type="date" value="{{old('date')}}">
        </div>
        <table class="table table-borderless">
            <thead>
                <tr>
                    <th>活動時間</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">
                    <div class="form-group">
                        <input type="time" name="s_t" value="{{old('s_t')}}">
                    </div>
                </th>
                <td>～</td>
                <td>
                    <div class="form-group">
                        <div class="form-group">
                            <input type="time" name="f_t" value="{{old('f_t')}}">
                        </div>
                    </div>
                </td>
            </tr>            
        </tbody>
        </table>
        <div class="form-group">
            <label for="custom-select-1b">試合</label>
                <select name="game" id="custom-select-1b" class="custom-select">
                        @if(old('game') == 1)
                        <option value="1">公式戦</option>
                        @elseif(old('game') == 2)
                        <option value="2">練習試合</option>
                        @elseif(old('game') == 3)
                        <option value="3">紅白戦</option>
                        @endif
                        <option value="1">公式戦</option>
                        <option value="2">練習試合</option>
                        <option value="3">紅白戦</option>
                </select>
        </div>
        
        <div class="form-group">
            <label for="text1">対戦相手</label>
                <input name="opponent" type="text" id="text1" class="form-control" value="{{old('opponent')}}">
        </div>

            <div class="form-group">
                <label for="custom-select-1b">会場</label>
                    <select name="place" id="custom-select-1b" class="custom-select">
                        @if(old('place'))
                            <?php
                            $oldPlace = old('place');
                            $Place = App\Place::where('id',$oldPlace)->first();
                            ?>
                            <option value="{{old('place')}}">{{$Place->name}}</option>
                        @endif
                        @foreach($places as $place)
                            <option value="{{$place->id}}">{{$place->name}}</option>
                        @endforeach
                    </select>
            </div>
        </div>
    </div>
</div>

        <div class="row  justify-content-center">
            <div class="col-sm-6 mt-3">
                <button  type="submit button" class="btn btn-info btn-lg btn-block">登録</button>
            </div>
        </div>
        </form>
    </div>
</div>
@endsection