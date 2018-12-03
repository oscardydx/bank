<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Pocket;
use App\Transaction;
use App\User;
use App\Beneficiary;

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
        $pockets=$pockets->where('user_id',$user->id)->where('state','1')->orderBy('id','ASC')->paginate(5);
        
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
        return redirect()->route('pocketsHome')->with('success','Bolsillo creado satisfactoriamente!');      
    }
    public function addRequest( $id )
    {   
        $user= Auth::user();
        
            }
    public function pocketTransaction( Request $request )
    {       
        $user= Auth::user();

            if (isset($request['delete'])) {
                $user= Auth::user();
                $pocket= new Pocket;
                $pocket=$pocket->find($request['delete']);

                $user->available_money= $user->available_money+$pocket->available_money;
                $user->save();

                $pocket->state=0;
                $pocket->save();
                $transaction= new Transaction;
                $transaction->type_id=6;
                $transaction->value=$pocket->available_money;
                $transaction->origin_user_id=$user->id;
                $transaction->save();
                return redirect()->route('pocketsHome')->with('error','Bolsillo eliminado satisfactoriamente!');
            }

            elseif (isset($request['add'])) {
                
                return view('board.pockets.add')->with(['id'=>$request['add'],'user'=>$user]);
            }

            elseif (isset($request['addRequest'])) {
                if ($request['value']<=$user->available_money) {
                    $user->available_money=$user->available_money-$request['value'];
                    $user->save();
                    $pocket= new Pocket;
                    $pocket=$pocket->find($request['pocketId']);
                    $pocket->available_money=$pocket->available_money+$request['value'];
                    $pocket->save();
                    $transaction= new Transaction;
                    $transaction->type_id=5;
                    $transaction->value=$request['value'];
                    $transaction->origin_user_id=$user->id;
                    $transaction->save();
                    return redirect()->route('pocketsHome')->with('success','Bolsillo recargado satisfactoriamente!');

                }else{
                    return redirect()->route('pocketsHome')->with('error','Dinero disponible no suficiente para la transacción');
                }
                           }
               elseif ($request['remove']) {
                   return view('board.pockets.remove')->with(['id'=>$request['remove'],'user'=>$user]);
               }elseif ($request['removeRequest']) {
                    $pocket= new Pocket;
                    $pocket=$pocket->find($request['pocketId']);
                    if ($request['value']<=$pocket->available_money) {

                        $user->available_money=$user->available_money+$request['value'];
                        $user->save();
                       
                        $pocket->available_money=$pocket->available_money-$request['value'];
                        $pocket->save();
                        $transaction= new Transaction;
                        $transaction->type_id=7;
                        $transaction->value=$request['value'];
                        $transaction->origin_user_id=$user->id;
                        $transaction->save();
                        return redirect()->route('pocketsHome')->with('success','Bolsillo recargado satisfactoriamente!');
                    }else{
                        return redirect()->route('pocketsHome')->with('error','Monto de dinero no disponible!');
                    }

                    
               }elseif ($request['send']) {
                   return view('board.pockets.send')->with(['id'=>$request['send'],'user'=>$user]);
               }

               elseif ($request['sendRequest']) {
                    $destinationUser= new User;
                    $destinationUser=$destinationUser->where('email','=', $request['email'])->first();
                    $pocket= new Pocket;
                    $pocket=$pocket->find($request['pocketId']);
                if ($destinationUser!=null && $pocket->available_money>=$request['value']) {
                    $destinationUser->available_money=$destinationUser->available_money+$request['value'];
                    $pocket->available_money=$pocket->available_money-$request['value'];
                    $pocket->save();
                    $destinationUser->save();
                    $transaction= new Transaction;
                    $transaction->type_id=8;
                    $transaction->value=$request['value'];
                    $transaction->origin_user_id=$user->id;
                    $transaction->save();
                    $beneficiary= new Beneficiary;
                    $beneficiary->transaction_id=$transaction->id;
                    $beneficiary->user_id=$destinationUser->id;
                    $beneficiary->save();
                    return redirect()->route('pocketsHome')->with('success','El dinero fue enviado Exitosamente!');

                }elseif ($destinationUser==null) {
                    return redirect()->route('pocketsHome')->with('error','Usuario de destino no encontrado!');
                }elseif ($destinationUser!=null && $pocket->available_money<$request['value']) {
                    return redirect()->route('pocketsHome')->with('error','Fondos insuficientes!');
                }
               }
                
                else{
                dd($request);
            }
            
            
    }
}
