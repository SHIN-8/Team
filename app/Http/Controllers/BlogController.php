<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Blog;
use Illuminate\Support\Facades\Auth;


class BlogController extends Controller
{
    public function index(){
        $blogs = Blog::orderByDesc('created_at')->paginate(10);
        $user = User::get();

        return view('blog.index',compact('blogs','user'));
    }

    public function show($id){
        $blog = Blog::findOrFail($id);
        $user = User::get();

        return view('blog.show',compact('blog','user'));
        
    }

    public function create(){
        $user = Auth::user();
        return view('blog.create',compact('user'));
    }

    public function store(Request $request,User $user, Blog $blog){
        $user = Auth::user();
        $rules = [
            'title' => ['required'],
            'text' => ['required'],
            'writer' => ['required'],
            'img' =>['nullable','image'],
            'release' =>['required'],
        ];
        $this->validate($request,$rules);

        if($request->hasFile('img')){
            Blog::create([
                'title' => $request['title'],
                'text' => $request['text'],
                'writer' => $request['writer'],
                'release' => $request['release'],
                'img' => $name = $request->file('img')->getClientOriginalName(),
            ]);
            $request->file('img')->storeAs('public/img',$name);
        }else{
            Blog::create([
                'title' => $request['title'],
                'text' => $request['text'],
                'writer' => $request['writer'],
                'release' => $request['release'],
            ]);
        }
        return redirect()
        ->route('blog.index',compact('user','blog'))
        ->with('status','登録しました。');

    }

    public function edit($id){
        $user = Auth::user();
        $blog = Blog::findOrFail($id);
        return view('blog.edit',compact('blog','user'));
    }

    public function update(Request $request,Blog $blog)
    {
        $rules = [
            'title' => ['required'],
            'text' => ['required'],
            'writer' => ['required'],
            'img' =>['nullable','image'],
            'release' =>['required'],
        ];
        $this->validate($request,$rules);

        $blog->update($request->all());
        if($request->hasFile('img')){
            $blog->img = $request->file('img')->getClientOriginalName();
            $blog->save();
            $name = $blog->img;
            $request->file('img')->storeAs('public/img',$name);
        }
        
        return redirect()
        ->route('blog.show',compact('blog'))
        ->with('status','更新しました。');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();

        return redirect()
        ->route('blog.index',compact('blog'))
        ->with('status','削除しました。');
    }
}
