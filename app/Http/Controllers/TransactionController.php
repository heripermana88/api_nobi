<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Models\Transaction;
use App\Models\Balance;
use DB;

class TransactionController extends Controller
{
    use ApiResponser;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function withdraw(Request $request){    
        $rules = [
            'trx_id' => 'required',
            'amount' => 'required',
            'user_id' => 'required|integer',
        ];
        $this->validate($request, $rules);

        if($request->amount <= 0.00000001){
            return $this->errorResponse('Transaction decline', Response::HTTP_BAD_REQUEST);
        }

        $user_balance = Balance::where('user_id',$request->user_id)->first();
        if(!$user_balance) return $this->errorResponse('insufficient balance', Response::HTTP_BAD_REQUEST);

        $user_balance->amount_available = $user_balance->amount_available - $request->amount;
        
        if($user_balance->amount_available < $request->amount){
            return $this->errorResponse('insufficient balance', Response::HTTP_BAD_REQUEST);
        }

        $check_transaction = Transaction::where('trx_id',$request->trx_id)->first();
        if($check_transaction) return $this->errorResponse('Transaction decline', Response::HTTP_BAD_REQUEST);

        $store_trx = new Transaction();
        $store_trx->trx_id = $request->trx_id;
        $store_trx->user_id = $request->user_id;
        $store_trx->amount = $request->amount;
        $store_trx->save(); 
        
        // echo json_encode($this->format_amount_with_no_e($store_trx->amount));die();
        sleep(3);
        
        if($store_trx && $user_balance->save()){
            DB::commit();
        }else{
            DB::rollback();
            return $this->errorResponse('Transaction decline', Response::HTTP_BAD_REQUEST);
        }
        
        $response = [
            'transaction' => [
                'trx_id' => $store_trx->trx_id,
                'amount' => $this->format_amount_with_no_e($store_trx->amount),
            ]
        ];

        return $this->successResponse($response, Response::HTTP_BAD_REQUEST);
    }

    private function format_amount_with_no_e($amount) {
        $amount = (string)$amount; 
        $pos = stripos($amount, 'E-'); 
        $there_is_e = $pos !== false; 
    
        if ($there_is_e) {
            $decimals = intval(substr($amount, $pos + 2, strlen($amount))); 
            $amount = number_format($amount, $decimals, '.', ',');
        }
    
        return $amount;
    }
}