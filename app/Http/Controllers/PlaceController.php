<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Place;
use Illuminate\Support\Facades\Auth;


class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $places = Place::get()->all();

        return view('place.index',compact('places'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $places = Place::get()->all();
        if(Auth::check()){
            if(Auth::user()->admin ==1){
                return view('place.create');
            }else{
                return view('place.index',compact('places'))->with('message','管理者としてログインして下さい');
            }
            }else{
                return redirect()->route('login')->withInput()->with('message','ログインして下さい');
            }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Place $place)
    {
        $rules = [
            'name'=>['required'],
            'adress'=>['nullable'],
        ];
        $this->validate($request,$rules);
        Place::create([
            'name' => $request['name'],
            'adress' => $request['adress'],
            ]);
    
        return redirect()
            ->route('place.index',compact('place'))
            ->with('status','登録しました。');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $place = Place::findOrFail($id);

        return view('place.show',compact('place'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $place = Place::findOrFail($id);
        $places = Place::get()->all();
        if(Auth::check()){
            if(Auth::user()->admin ==1){
                return view('place.edit',compact('place'));
            }else{
                return view('place.index',compact('places'))->with('message','管理者としてログインして下さい');
            }
            }else{
                return redirect()->route('login')->withInput()->with('message','ログインして下さい');
            }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Place $place)
    {
        $rules = [
            'name'=>['required'],
            'adress'=>['nullable'],
            'img'=>['nullable','image'],
        ];
        $this->validate($request,$rules);
        $place->update($request->all());
        $place->img = $request->file('img')->getClientOriginalName();
        $place->save();
        $name = $place->img;
        $request->file('img')->storeAs('public/img',$name);

        return redirect()
        ->route('place.show',compact('place'))
        ->with('status','更新しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Place $place)
    {
        $place->delete();

        return redirect()
        ->route('place.index',compact('place'))
        ->with('status','削除しました。');
    }
}
