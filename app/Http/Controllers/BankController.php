<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;
use App\Transfers;
use Validator;

class BankController extends Controller
{
    public function index()
    {   
        $gettodayhistory = Transfers::where('created_at','LIKE','%' .date("Y-m-d") . '%')->get();
        $getcustomer = Customer::all();
        $gethistory = Transfers::all();
        return view('index',compact('getcustomer','gethistory','gettodayhistory'));
    }

    public function customer()
    {
        $getcustomer = Customer::all();
        return view('customer',compact('getcustomer'));
    }

    public function transfer()
    {
        $gettransfers = Transfers::all();
        $getcustomer = Customer::all();
        return view('transfer_amount',compact('gettransfers','getcustomer'));
    }

    public function transactionhistorys()
    {
        $gettransfers = Transfers::all();
        return view('transactionhistory',compact('gettransfers'));
    }

    public function transferamount(Request $request)
    {
            $validation = Validator::make($request->all(),[
              'from_name' => 'required',
              'to_name' => 'required',
              'amount' => 'required',
            ]);
            $error_array = array();
            $success_output = '';
            if ($validation->fails())
            {
                foreach($validation->messages()->getMessages() as $field_name => $messages)
                {
                    $error_array[] = $messages;
                }
            }
            else
            {   
                $from_name = htmlspecialchars($request->from_name, ENT_QUOTES, 'UTF-8');
                $to_name = htmlspecialchars($request->to_name, ENT_QUOTES, 'UTF-8');
                $amount = htmlspecialchars($request->amount, ENT_QUOTES, 'UTF-8');
    
                $item = new Transfers;
                $item->from_user_id = $from_name;
                $item->to_user_id = $to_name;
                $item->amount_recived = $amount;
                $item->save();

                $get_from_user = Customer::where('name','=',$from_name)->first();
                $id_from_user = $get_from_user->id;
                $available_balance = $get_from_user->available_balance - $amount;
                $total_transfer_amount = $get_from_user->total_transfer_amount + $amount;


                $itemm = new Customer;
                $itemm->exists = true;
                $itemm->id = $id_from_user;
                $itemm->available_balance = $available_balance;
                $itemm->total_transfer_amount = $total_transfer_amount;
                $itemm->save(); 

                $get_to_user = Customer::where('name','=',$to_name)->first();
                $available_balance = $get_to_user->available_balance + $amount;
                $id_to_user = $get_to_user->id;

                $itemmm = new Customer;
                $itemmm->exists = true;
                $itemmm->id = $id_to_user;
                $itemmm->available_balance = $available_balance;
                $itemmm->save(); 


                $success_output = 'transaction successful !';
            }
            $output = array(
                'error'     =>  $error_array,
                'success'   =>  $success_output
            );
            echo json_encode($output);
    }

}
