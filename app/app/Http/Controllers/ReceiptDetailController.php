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
                    $product =Product::findOrFail("61a23b83d664c812a133ef06");
                    
                    
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
