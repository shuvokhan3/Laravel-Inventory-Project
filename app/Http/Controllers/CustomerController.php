<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //customer page view
    public function viewCustomer(){
        return view('pages.dashboard.customer-page');
    }

    //create customer
    public function CustomerStore(Request $request){
        try{
            $user_id = $request->header('id');
            Customer::create([
                'name'=>$request->input('name'),
                'email'=>$request->input('email'),
                'mobile'=>$request->input('mobile'),
                'user_id'=>$user_id
            ]);
            return response()->json([
                'status'=>'success',
                'message'=>'Customer Added Successfully'
            ],201);
        }catch (\Exception $e){
            return response()->json([
                'status'=>'error',
                'message'=>'Customer Create Error'
            ]);
        }
    }

    //customers display
    public function CustomerList(Request $request){
        try{
            $user_id = $request->header('id');
            return Customer::where('user_id','=',$user_id)->get();
        }catch (\Exception $e){
            return response()->json([
                'status'=>'error',
                'message'=>'Customer List Error'
            ]);
        }
    }

    //Customers Delete
    public function CustomerDelete(Request $request){
        try{
            $customer_id = $request->input('id');
            $user_id = $request->header('id');
            Customer::where('user_id', '=', $user_id)
                ->where('id', '=', $customer_id)
                ->delete();
            return response()->json([
                'status'=>'success',
                'message'=>'Customer Delete Successfully'
            ]);
        }catch (\Exception $e){
            return response()->json([
                'status'=>'Error',
                'message'=>'Customer Delete Error'
            ]);
        }
    }

    //customer By id
    public function CustomerById(Request $request){
        try{
            $customer_id = $request->input('id');
            $user_id = $request->header('id');
            return Customer::where('user_id', '=',$user_id)
                ->where('id', '=' ,$customer_id)->first();
        }catch (\Exception $e){
            return response()->json([
                'status'=>'error',
                'message'=>'Customer Select Error'
            ]);

        }
    }

    //customer update
    public function CustomerUpdate(Request $request){
        try{
            $customer_id = $request->input('id');
            $user_id = $request->header('id');
            Customer::where('user_id', '=', $user_id)
                ->where('id', '=', $customer_id)
                ->update([
                    'name'=> $request->input('name'),
                    'email'=>$request->input('email'),
                    'mobile'=>$request->input('mobile')
                ]);
            return response()->json([
                'status'=>'success',
                'message'=>'Customer Update Successfully'
            ]);
        }catch (\Exception $e){
            return response()->json([
                'status'=>'error',
                'message'=> $e->getMessage()
            ]);
        }

    }

}
