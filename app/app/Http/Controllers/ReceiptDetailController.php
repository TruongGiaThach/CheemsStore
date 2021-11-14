<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReceiptDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->json(ReceiptDetail::with(['receipt_detail'])->get(),200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $receipt_detail = ReceiptDetail::create([
            'receipt_id' => $request->receipt_id,
            'product_id' => $request->product_id,
            'unitPrice' => $request->unitPrice,
            'amount' => $request->amount,
        ]);

        return response()->json([
            'status' => (bool) $receipt_detail,
            'data'   => $receipt_detail,
            'message' => $receipt_detail ? 'Receipt Detail Created!' : 'Error Creating Receipt Detail'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReceiptDetail $receipt_detail
     * @return \Illuminate\Http\Response
     */
    public function show(ReceiptDetail $receipt_detail)
    {
        //
        return response()->json($receipt_detail,200);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReceiptDetail $receipt_detail
     * @return \Illuminate\Http\Response
     */
    public function edit(ReceiptDetail $receipt_detail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReceiptDetail $receipt_detail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReceiptDetail $receipt_detail)
    {
        //
        $status = $receipt_detail->update(
            $request->only(['receipt_id', 'product_id', 'unitPrice', 'amount'])
        );

        return response()->json([
            'status' => $status,
            'message' => $status ? 'ReceiptDetail Updated!' : 'Error Updating ReceiptDetail'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReceiptDetail $receipt_detail
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReceiptDetail $receipt_detail)
    {
        //
        $status = $receipt_detail->delete();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'ReceiptDetail Deleted!' : 'Error Deleting ReceiptDetail'
        ]);
    }
}
