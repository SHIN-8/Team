<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Album;

class AlbumController extends Controller
{
    public function index(){
        $albums = Album::get()->all();

        return view('album.index',compact('albums'));
    }

    public function show($id){
        $album = Album::findOrFail($id);
        return view('album.show',compact('album'));
        
    }

    public function store(Request $request, album $album){
        $rules = [
            'img' => ['required','image'],
        ];
        $this->validate($request,$rules);
        album::create([
            'img' => $name = $request->file('img')->getClientOriginalName(),
            ]);
            $request->file('img')->storeAs('public/img',$name);

        return redirect()
        ->route('album.index',compact('album'))
        ->with('status','登録しました。');
    }

    public function destroy(album $album)
    {
        $album->delete();

        return redirect()
        ->route('album.index',compact('album'))
        ->with('status','削除しました。');
    }
}
