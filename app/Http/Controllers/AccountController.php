<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Transaction;
use App\Beneficiary;
use App\User;

class AccountController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function startTransaction(Request $request)
    {   
    	$user= Auth::user();
    	switch ($request['submit']) {
    		case 'Enviar':
    			return view('board.transactions.send')->with(['user'=>$user]);
    			break;
    		case 'Recargar':
    			return view('board.transactions.recharge')->with(['user'=>$user]);
    			break;
    		case 'Agregar':
    			return view('board.transactions.add')->with(['user'=>$user]);
    			break;
    		case 'Retirar':
    			return view('board.transactions.remove')->with(['user'=>$user]);
    			break;
    		
    		default:
    			# code...
    			break;
    	}
        
        
    }

    public function transactionRequest(Request $request)
    {   
    	$user= Auth::user();
    	
    	switch ($request['submit']) {
    		case 'Enviar':
    			$destinationUser= new User;
    			$destinationUser=$destinationUser->where('email','=', $request['email'])->first();
    			if ($destinationUser!=null && $user->available_money>=$request['value']) {
    				$destinationUser->available_money=$destinationUser->available_money+$request['value'];
    				$user->available_money=$user->available_money-$request['value'];
    				$user->save();
    				$destinationUser->save();
    				$transaction= new Transaction;
    				$transaction->type=2;
    				$transaction->value=$request['value'];
    				$transaction->origin_user_id=$user->id;
    				$transaction->save();
    				$beneficiary= new Beneficiary;
    				$beneficiary->transaction_id=$transaction->id;
    				$beneficiary->user_id=$destinationUser->id;
    				$beneficiary->save();
    				return redirect()->route('home')->with('success','El dinero fue enviado Exitosamente!');

    			}elseif ($destinationUser==null) {
    				return redirect()->route('home')->with('error','Usuario de destino no encontrado!');
    			}elseif ($destinationUser!=null && $user->available_money<$request['value']) {
    				return redirect()->route('home')->with('error','Fondos insuficientes!');
    			}

    			//return view('board.transactions.send')->with(['user'=>$user]);
    			break;
    		case 'Recargar':
    			$user->available_money=$user->available_money+$request['value'];
    			$user->save();
    			$transaction= new Transaction;
    			$transaction->type=1;
    			$transaction->value=$request['value'];
    			$transaction->origin_user_id=$user->id;
    			$transaction->save();
    			return redirect()->route('home')->with('success','El dinero fue recargado Exitosamente!');
    			
    			
    			break;
    		case 'Agregar':
    		if ($request['value']<=$user->available_money) {
    			$user->available_money=$user->available_money-$request['value'];
    			$user->mattress_money=$user->mattress_money+$request['value'];
    			$user->save();
    			$transaction= new Transaction;
    			$transaction->type=3;
    			$transaction->value=$request['value'];
    			$transaction->origin_user_id=$user->id;
    			$transaction->save();
    			return redirect()->route('home')->with('success','El dinero fue agregado al colchón Exitosamente!');
    		}else{
    			return redirect()->route('home')->with('error','No tiene fondos suficientes para esta transacción!');
    		}
    			
    			break;
    		case 'Retirar':
				if ($request['value']<=$user->mattress_money) {
					$user->mattress_money=$user->mattress_money-$request['value'];
    				$user->available_money=$user->available_money+$request['value'];
    				$transaction= new Transaction;
	    			$transaction->type=4;
	    			$transaction->value=$request['value'];
	    			$transaction->origin_user_id=$user->id;
	    			$transaction->save();
    				$user->save();
    			return redirect()->route('home')->with('success','El dinero fue retirado de tu colchon y ahora esta disponible!');
    		}else{
    			return redirect()->route('home')->with('error','No tiene fondos suficientes para esta transacción!');
    		}
    			break;
    		
    		default:
    			# code...
    			break;
    	}
        
        
    }
}
