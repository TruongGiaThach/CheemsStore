<?php

namespace App\Http\Controllers;

use App\Models\Receipt;
use Illuminate\Http\Request;

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
        return response()->json(Receipt::with(['receipt'])->get(),200);
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

        return response()->json([
        ]);
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
    public function update(Request $request, Receipt $receipt)
    {
        //
        $status = $receipt->update(
            
        );

        return response()->json([
          
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
