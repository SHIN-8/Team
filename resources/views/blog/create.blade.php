@extends('layouts.app')

@section('title','create')

@section('content')

<div class="container">
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form method="post" action="{{route('blog.store')}}" enctype="multipart/form-data">
    @csrf
        <input type="hidden" name="writer"" class="form-control" id="text4b" value="{{$user->id}}">
            <label for="text4a"><h2>タイトル</h2></label>
                <input type="text" name="title" class="form-control" id="text4b" value="{{old('title')}}">

            <label for="text4a"><h2>本文</h2></label>
                <textarea id="editor" name="text">{{old('text')}}</textarea>

        <div class="form-row">
            <div class="col-sm-2">
                <h2>サムネイル</h2>
            </div>
            <div class="custom-file col-sm-10">
                <input type="file" name="img" value="{{old('img')}}">
            </div>
        </div>

        <label for="custom-select-1b"><h2>公開範囲</h2></label>
            <select name="release" id="custom-select-1b" class="custom-select">
                <option value="1">メンバーのみ公開</option>
                <option value="2">全体に公開</option>
            </select>

        <div class="row  justify-content-center">
            <div class="col-sm-6 mt-3">     
                <button  type="submit button" class="btn btn-info btn-block btn-lg">登録</button>
            </div>
        </div>
    </form>

    <a href="{{ route('blog.index')}}">戻る</a>
      
<script src="https://cdn.ckeditor.com/4.5.6/standard/ckeditor.js"></script>
<script>
    // エディタへの設定を適用する
    CKEDITOR.replace('editor', {
        uiColor: '#EEEEEE',      height: 400,
      // エディタ内に適用するCSS
        contentsCss: [
        "./css/sample.css",
    ],
      // スペルチェック機能OFF
        scayt_autoStartup: false,
      // Enterを押した際に改行タグを挿入
        enterMode: CKEDITOR.ENTER_BR,
      // Shift+Enterを押した際に段落タグを挿入
        shiftEnterMode: CKEDITOR.ENTER_P,
      // idやclassを指定可能にする
        allowedContent: true,
      // preコード挿入時
        format_pre: { element: 'pre', attributes: { 'class': 'code' } },
      // タグのパンくずリストを削除
        removePlugins: 'elementspath,image,table,link,unlink,ancor',
      // webからコピペした際でもプレーンテキストを貼り付けるようにする
        forcePasteAsPlainText: true,
      // 自動で空白を挿入しないようにする
        fillEmptyBlocks: false,
      // タブの入力を無効にする
        tabSpaces: 0,
    });
</script>
</body>
</html>
@endsection