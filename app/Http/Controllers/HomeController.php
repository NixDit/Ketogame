<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Tournament;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth', ['except' => ['home.show']]);
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::check()){
            if(Auth::user()->hasRole(['superadmin','moderator'])){
                return redirect()->route('admin.index');
            } else {
                $data                       = (object)[];
                $today                      = Carbon::now()->format('Y-m-d');
                $data->tournament           = Tournament::where('active', 1)->where('start_date', '>=', $today )->orderBy('start_date', 'asc')->first();
                $data->latest_tournaments   = Tournament::whereNotNull('champion_id')->where('start_date', '<=', $today)->take(3)->get();
                return view('index')->with('data' , $data);
            }
        } else {
            return back();
        }
    }

    public function show(){
        $data                       = (object)[];
        $today                      = Carbon::now()->format('Y-m-d');
        $data->tournament           = Tournament::where('active', 1)->where('start_date', '>=', $today )->orderBy('start_date', 'asc')->first();
        $data->latest_tournaments   = Tournament::whereNotNull('champion_id')->where('start_date', '<=', $today)->take(3)->get();
        return view('index')->with('data' , $data);
    }
}
