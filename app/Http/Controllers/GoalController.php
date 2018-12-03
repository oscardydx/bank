<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Goal;

class GoalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
      public function index()
    {   
        $user= Auth::user();

        $goals= new Goal;
        $goals=$goals->where('user_id',$user->id)->where('state','1')->orderBy('id','ASC')->paginate(5);
        
        return view('board.goals.home')->with(['user'=>$user,'goals'=>$goals]);
        
    }
     public function goalTransaction()
    {   
        return redirect()->route('goalsHome')->with('error','Funcion no disponible!');
        
    }
    public function create(Request $request)
    {   
        $user= Auth::user();
        $goal= new Goal;
        $goal->user_id=$user->id;
        $goal->name=$request['name'];
        $goal->state=1;
        $goal->money_goal=$request['money_goal'];
        $goal->final_date=$request['date'];
        $goal->available_money=0;
        $goal->save();
        return redirect()->route('goalsHome')->with('success','Meta creada satisfactoriamente!');  
        
    }
}
