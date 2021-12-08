<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function index()
    {
        //
        return response()->json(History::all(),200);
    }

    public function getStaff($id)
    {
        return response()->json(History::find($id)->staff());
    }
}
