<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaffController extends Controller
{
    //
    public function index()
    {
        return Staff::all();
    }

    

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
        //'email', 'name', 'cmnd', 'numOfDayOff','salary','dateBegin'
        $staff = Staff::create([
            'name' => $request->name,
            'email' => $request->email,
            'cmnd' => $request->cmnd,
            'numOfDayOff' => $request->numOfDayOff,
            'salary' => $request->salary,
            'dateBegin'=>$request->dateBegin
        ]);

        return response()->json([
            'status' => (bool) $staff,
            'data'   => $staff,
            'message' => $staff ? 'Staff Created!' : 'Error Creating Staff'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show(Staff $staff)
    {
        //
        return response()->json($staff,200); 
    }

   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function edit(Staff $staff)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Staff  $Staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Staff $staff)
    {
        //
        $status = $staff->update(
            $request->only(['email', 'name', 'cmnd', 'numOfDayOff','salary','dateBegin'])
        );

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Staff Updated!' : 'Error Updating Staff'
        ]);
    }

  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staff $staff)
    {
        //
        $status = $staff->delete();

            return response()->json([
                'status' => $status,
                'message' => $status ? 'Staff Deleted!' : 'Error Deleting Staff'
            ]);
    }
}
