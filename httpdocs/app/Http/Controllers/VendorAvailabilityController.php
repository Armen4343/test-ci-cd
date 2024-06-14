<?php

namespace App\Http\Controllers;

use App\Models\VendorAvailability;
use Illuminate\Http\Request;
use Auth;
class VendorAvailabilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
		//dd($request->all());
		VendorAvailability::where('vendor_id',Auth::User()->id)->delete();
		VendorAvailability::create($request->post());
		$notifications = array(
				'message' => 'Orario modificato con successo.',
				'alert-type' => 'success'
			);
			 return redirect()->back()->with($notifications);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VendorAvailability  $vendorAvailability
     * @return \Illuminate\Http\Response
     */
    public function show(VendorAvailability $vendorAvailability)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VendorAvailability  $vendorAvailability
     * @return \Illuminate\Http\Response
     */
    public function edit(VendorAvailability $vendorAvailability)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VendorAvailability  $vendorAvailability
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VendorAvailability $vendorAvailability)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VendorAvailability  $vendorAvailability
     * @return \Illuminate\Http\Response
     */
    public function destroy(VendorAvailability $vendorAvailability)
    {
        //
    }
}
