<?php

namespace App\Http\Controllers;

use App\Models\ReceiptDetail;
use Illuminate\Http\Request;

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
}
