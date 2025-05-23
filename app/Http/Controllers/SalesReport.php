<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;

class SalesReport extends Controller
{
    public function SalesReport()
    {
        return view('pages.dashboard.sale-report-page');
    }

    public function SalesReportData(Request $request){

        try{

            $user_id=$request->header('id');
            $FormDate=date('Y-m-d',strtotime($request->FormDate));
            $ToDate=date('Y-m-d',strtotime($request->ToDate));

        $total=Invoice::where('user_id',$user_id)
            ->whereDate('created_at', '>=', $FormDate)
            ->whereDate('created_at', '<=', $ToDate)
            ->sum('total');


        $vat=Invoice::where('user_id',$user_id)
            ->whereDate('created_at', '>=', $FormDate)
            ->whereDate('created_at', '<=', $ToDate)
            ->sum('vat');
        $payable=Invoice::where('user_id',$user_id)
            ->whereDate('created_at', '>=', $FormDate)
            ->whereDate('created_at', '<=', $ToDate)
            ->sum('payable');
        $discount=Invoice::where('user_id',$user_id)
            ->whereDate('created_at', '>=', $FormDate)
            ->whereDate('created_at', '<=', $ToDate)
            ->sum('discount');



        $list=Invoice::where('user_id',$user_id)
            ->whereDate('created_at', '>=', $FormDate)
            ->whereDate('created_at', '<=', $ToDate)
            ->with('customer')
            ->get();


        $data=[
            'payable'=> $payable,
            'discount'=>$discount,
            'total'=> $total,
            'vat'=> $vat,
            'list'=>$list,
            'FormDate'=>$request->FormDate,
            'ToDate'=>$request->ToDate
        ];



        //install Dompdf pakages

        $pdf = Pdf::loadView('report.SalesReport',$data);

        return $pdf->download('SaleReport.pdf');



        }catch (\Exception $exception){
            return response()->json([
                'status' => 'Error',
                'message' => $exception->getMessage()
            ]);
        }

    }




}
