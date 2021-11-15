<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Storage;
use File;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->json(Product::all(),200);
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
        $product = Product::create([
            'name' => $request->name,
            'amount' => $request->amount,
            'importPrice' => $request->importPrice,
            'outportPrice' => $request->outportPrice,
            'manufacture' => $request->manufacture,
            'warrantyPeriod' => $request->warrantyPeriod,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'tag' => $request->tag,
        ]);

        if ($request->image){
            $image = $request->image;
            $extension = $image->getClientOriginalExtension();
            $name = $image->getClientOriginalName();
            Storage::disk('public')-> put($name, File::get($image));
            $product->image = $name;
        }
        else{
            $product->image = 'default.png';
        }

        $product -> save();

        return response()->json($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
        return response()->json($product,200); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
        $status = $product->update(
            $request->only([
        'name','amount','importPrice','outportPrice','manufacture','warrantyPeriod',
        'category_id','description','tag'
            ])
        );

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Product Updated!' : 'Error Updating Product'
        ]);
    }

    public function updateUnits(Request $request, Product $product)
    {
        $product->units = $product->units + $request->get('units');
        $status = $product->save();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Units Added!' : 'Error Adding Product Units'
        ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($product_id)
    {
        //
        $product = Product::where('_id', $product_id)->forceDelete();

            return response()->json([
                'status' => $product,
                'message' => $product ? 'Product Deleted!' : 'Error Deleting Product'
            ]);
    }
}
