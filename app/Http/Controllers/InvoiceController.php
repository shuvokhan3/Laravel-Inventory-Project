<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class InvoiceController extends Controller
{

    //create Invoice
    public function InvoiceCreate(Request $request){
        DB::beginTransaction();
        try{
            //get the all the data from input and user_id from header when jwt issue
            $user_id = $request->header('id');
            $total = $request->input('total');
            $discount = $request->input('discount');
            $vat = $request->input('val');
            $payable = $request->input('payable');
            $customer_id = $request->input('customer_id');

            //Run ORM create for create a Invoice table in database
            $invoice = Invoice::create([
                'total'=>$total,
                'discount'=>$discount,
                'vat'=>$vat,
                'payable'=>$payable,
                'user_id'=>$user_id,
                'customer_id'=>$customer_id
            ]);

            //$invoice_id variable store id , which create when Invoice table are create
            $invoice_id = $invoice->id;

            $products = $request->input('products');

            foreach($products as $EachProduct){
                InvoiceProduct::create([
                    'invoice_id'=>$invoice_id,
                    'user_id'=>$user_id,
                    'product_id'=>$EachProduct['product_id'],
                    'qty'=>$EachProduct['qyt'],
                    'sale_price'=>$EachProduct['sale_price']
                ]);
            }

            DB::commit();
            return 1;

        }catch (\Exception $e){
            DB::rollBack();
            return 0;
        }
    }

    //invoice select
    public function InvoiceSelect(Request $request){
        $user_id = $request->header('id');
        return Invoice::where('user_id',$user_id)->with('customer')->get();
    }

    public function InvoiceDetails(Request $request){

        $user_id = $request->header('id');

        $customerDetails = Customer::where('user_id',$user_id)
            ->where('id',$request->input('customer_id'))->first();

        $invoiceProduct = InvoiceProduct::where('invoice_id',$request->input('invoice_id'))
            ->where('user_id',$user_id)
            ->get();

        $invoiceTotal = Invoice::where('user_id',$user_id)->where('id',$request->input('invoice_id'))->first();



        return array(
            'customer'=>$customerDetails,
            'invoice'=>$invoiceTotal,
            'product'=>$invoiceProduct
        );
    }

    public function InvoiceDelete(Request $request){
        DB::beginTransaction();
        try{
            $user_id = $request->header('id');

            //delete operation inside InvoiceProduct model
            InvoiceProduct::where('invoice_id',$request->input('invoice_id'))
                ->where('user_id',$user_id)
                ->delete();
            //delete operation inside Invoice model;
            Invoice::where('id',$request->input('invoice_id'))
                ->delete();

            //at last commit all operation
            DB::commit();
            return 1;

        }catch (\Exception $e){
            DB::rollBack();
            return 0;
        }
    }


}
