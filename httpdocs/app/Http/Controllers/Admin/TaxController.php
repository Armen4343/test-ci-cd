<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $taxes=Tax::all();
        return view('super-admin.tax.index',compact("taxes"));
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
       $validator=Validator::make($request->all(), [
            'state' => 'required|unique:taxes,state|max:255',        
			'tax' => 'required|numeric',
        ]);
  
        if ($validator->fails()) {
            return response()->json([
                        'error' => $validator->errors()->all()
                    ]);
        }
       $tax=new Tax();
        $tax->state=$request->state;
		$tax->tax=$request->tax;
		if($request->special_tax){
		$tax->special_tax=$request->special_tax;
		}
		$tax->save();
       
  
        return response()->json(['success' => 'Tax created successfully!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function show(Tax $tax)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=Tax::find($id);
        return view("super-admin.tax.edit",compact("data"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Tax::find($id);
		$validated = $request->validate([
            'state' => 'required|max:255|unique:taxes,state,'.$id,        
			'tax' => 'required|numeric',
        ]);
       
        $data->state=$request->state;
		$data->tax=$request->tax;		
		if($request->special_tax){
		$data->special_tax=$request->special_tax;
		}
        $data->save();
		return Redirect()->route("taxes.index")->with("success","Tax updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Tax::find($id);
        $data->delete();
		return Redirect()->route("taxes.index")->with("success","Tax deleted successfully!");
    }
}
