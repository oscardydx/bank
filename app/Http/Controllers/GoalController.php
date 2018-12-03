<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Goal;
use App\Transaction;

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
     public function goalTransaction(Request $request)
    {       
        $user= Auth::user();
        if (isset($request['delete'])) {
                $user= Auth::user();
                $pocket= new Goal;
                $pocket=$pocket->find($request['delete']);

                $user->available_money= $user->available_money+$pocket->available_money;
                $user->save();

                $pocket->state=0;
                $pocket->save();
                $transaction= new Transaction;
                $transaction->type_id=9;
                $transaction->value=$pocket->available_money;
                $transaction->origin_user_id=$user->id;
                $transaction->save();
                return redirect()->route('goalsHome')->with('success','Bolsillo eliminado satisfactoriamente!');
            }elseif (isset($request['add'])) {
                
                return view('board.goals.add')->with(['id'=>$request['add'],'user'=>$user]);
            }

            elseif (isset($request['addRequest'])) {
                if ($request['value']<=$user->available_money) {
                    $user->available_money=$user->available_money-$request['value'];
                    $user->save();
                    $goal= new Goal;
                    $goal=$goal->find($request['pocketId']);
                    $goal->available_money=$goal->available_money+$request['value'];
                    $goal->save();
                    $transaction= new Transaction;
                    $transaction->type_id=10;
                    $transaction->value=$request['value'];
                    $transaction->origin_user_id=$user->id;
                    $transaction->save();
                    return redirect()->route('goalsHome')->with('success','Meta recargado satisfactoriamente!');

                }else{
                return redirect()->route('goalsHome')->with('error','Funcion no disponible!');
            }
        
        }
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
