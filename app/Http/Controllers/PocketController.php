<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Pocket;

class PocketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
     public function index()
    {   
        $user= Auth::user();
        $pockets= new Pocket;
        $pockets=$pockets->where('user_id',$user->id)->orderBy('id','ASC')->paginate(5);
        
        return view('board.pockets.home')->with(['user'=>$user,'pockets'=>$pockets]);
    }
    public function create( Request $request )
    {   
        $user= Auth::user();
        $pocket= new Pocket;
        $pocket->user_id=$user->id;
        $pocket->name=$request['name'];
        $pocket->state=1;
        $pocket->available_money=0;
        $pocket->save();
        return redirect()->route('home')->with('success','Bolsillo creado satisfactoriamente!');      
    }
}
