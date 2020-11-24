<?php

namespace App\Http\Controllers;

use App\Team;
use App\Schedules;
use App\Place;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $team = Team::findOrFail(1);
        $today = date("Y-m-d");
        $schedules = Schedules::where('date','>=',$today)->orderBy('date','asc')->first();
        $place = Place::where('id',$schedules->place)->first();
        $user = Auth::user();

        return view('index',compact('team','schedules','place','user'));
    }
}
