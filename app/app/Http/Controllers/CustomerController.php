<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->json(Customer::all(),200);
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
        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'number' => $request->number,
        ]);

        return response()->json([
            'status' => (bool) $customer,
            'data'   => $customer,
            'message' => $customer ? 'Customer Created!' : 'Error Creating Customer'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
        return response()->json($customer,200); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
        $status = $customer->update(
            $request->only(['name', 'email', 'number'])
        );

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Customer Updated!' : 'Error Updating Customer'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
        $status = $customer->delete();

            return response()->json([
                'status' => $status,
                'message' => $status ? 'Customer Deleted!' : 'Error Deleting Customer'
            ]);
    }
}