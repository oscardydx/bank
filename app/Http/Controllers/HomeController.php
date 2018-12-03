<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $user= Auth::user();
        $transactions= new Transaction;
        $transactions=$transactions->where('origin_user_id',$user->id)->orderBy('id','DSC')->paginate(5);

        return view('board.dashboard')->with(['user'=>$user,'transactions'=>$transactions]);
    }
}
