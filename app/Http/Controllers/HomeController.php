<?php

namespace App\Http\Controllers;

use App\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function subscription($name)
    {

//        $now_str = \Carbon\Carbon::now()->format('Y-m-d');
        $subcribe=new Subscription;
        if($name=='annual'){
            $now_str =Carbon::now()->addYear()->format('Y-m-d');
            $subcribe->annual=$now_str;
        }elseif ($name=='monthly'){
            $now_str =Carbon::now()->addMonth()->format('Y-m-d');
            $subcribe->monthly=$now_str;


        }elseif($name=='free'){
            $now_str =Carbon::now()->addDays(14)->format('Y-m-d');
            $subcribe->free=$now_str;


        }else{
            return redirect('/login');
        }
        $subcribe->user_id=auth()->user()->id;
        $subcribe->save();
        return redirect('/dashbord/database');
        // return view('home');
    }
}
