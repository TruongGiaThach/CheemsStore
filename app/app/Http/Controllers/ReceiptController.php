<?php

namespace App\Http\Controllers;

use App\Models\Receipt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->json(Receipt::all(),200);
    }
    public function getByCustomerID(Request $request)
    {
         
        error_log($request->customerID);
      //  $receipt = Receipt::where('user_id',"6196655b4e781e6b24412523")->get();
        $receipt = DB::connection('mongodb')->collection('receipt')
                    ->where('user_id',$request->customerID)->get();
        return response()->json([
            'status'=> (bool) $receipt,
            'receipt'=> $receipt,
        ]);
    }

     /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Receipt $receipt
     * @return \Illuminate\Http\Response
     */
    public function getReceipt(Request $request)
    {
        return response()->json(Receipt::where($request->type,$request->condition)->get(),200); 
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
        $receipt = Receipt::create([
            'user_id' => $request -> user_id,
            'createDay' => $request -> createDay,
            'total' => $request -> total,
            'VAT'  => $request -> VAT,
        ]);

        return response()->json($receipt);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Receipt $receipt
     * @return \Illuminate\Http\Response
     */
    public function show(Receipt $receipt)
    {
        //
        return response()->json($receipt,200);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Receipt $receipt
     * @return \Illuminate\Http\Response
     */
    public function edit(Receipt $receipt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Receipt $receipt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $receiptId)
    {
        $receipt = Receipt::findOrFail($receiptId);

        $status = $receipt->update(
            $request->only(['VAT', 'createDay', 'total', 'user_id'])
        );

        return response()->json([
            'contentBefore' => $receipt,
            'status' => $status,
            'message' => $status ? 'receipt Updated!' : 'Error Updating receipt'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Receipt $receipt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receipt $receipt)
    {
        //
        $status = $receipt->delete();

        return response()->json([
            
        ]);
    }
}
