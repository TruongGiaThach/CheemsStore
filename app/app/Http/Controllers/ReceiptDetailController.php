<?php

namespace App\Http\Controllers;

use App\Models\ReceiptDetail;
use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ReceiptDetailController extends Controller
{
    //

    public function index()
    {
        //
        return response()->json(ReceiptDetail::all(),200);
    }

    public function find(Request $request)
    {
        return response()->json(ReceiptDetail::where($request->type,$request->condition)->get(),200); 
    }

    public function store(Request $request)
    {
        //
        $receiptDetail = ReceiptDetail::create([
            'receipt_id'=> $request -> receipt_id,
            'product_id' => $request -> product_id,
            'amount' => $request ->amount,
            'unitPrice' => $request -> unitPrice,
        ]);

        return response()->json($receiptDetail);
    }

    public function updateAmount(Request $request, $receiptDetailId)
    {
        //
        $receiptDetail = ReceiptDetail::findOrFail($receiptDetailId);

        $receiptDetail->amount = $request->amount;
         $receiptDetail -> save();
         return response()->json($receiptDetail);
    }

    public function destroy($receiptDetailId)
    {   
        $receiptDetail = ReceiptDetail::findOrFail($receiptDetailId);

        $status = $receiptDetail->forceDelete();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'receipt Detail deleted' : 'Error delete receipt Detail'
        ]);
    }
    
    public function getByReceiptId(Request $request)
    {
        $receiptDetail = DB::connection('mongodb')->collection('receipt_detail')
        ->where('receipt_id',$request->receiptID)
        ->get();
        $result = [];
        if ($receiptDetail != []) 
            {
                        //61a23b83d664c812a133ef06
                foreach ($receiptDetail as $value){
                    $value = (array)$value;
                    $product =Product::findOrFail($value['product_id']);
                    
                    
                    $value['product_name'] = $product->name;
                    $result[] = (object)$value;

                }
            }        
        
        return response()->json([
            'status'=> (bool) $receiptDetail,
            'receipt_details'=> $result,
        ]);
    }
}
