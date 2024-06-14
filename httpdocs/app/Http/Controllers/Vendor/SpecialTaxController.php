<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\SpecialTax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
class SpecialTaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $specialTaxes=SpecialTax::where("vendor_id",Auth::user()->id)->get();
        return view('vendor.special-tax.index',compact("specialTaxes"));
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
            'title' => 'required|max:255',            
		   	'value' => 'required|numeric',
			'status' => 'required|boolean',
        ]);
  
        if ($validator->fails()) {
            return response()->json([
                        'error' => $validator->errors()->all()
                    ]);
        }
       	$data=new SpecialTax();
        $data->title=$request->title;        
		$data->value=$request->value;
		$data->status=$request->status;
		$data->vendor_id=Auth::user()->id;
		$data->save();
        return response()->json(['success' => 'Special Tax created successfully!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SpecialTax  $specialTax
     * @return \Illuminate\Http\Response
     */
    public function show(SpecialTax $specialTax)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SpecialTax  $specialTax
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=SpecialTax::where(["id"=>$id,"vendor_id"=>Auth::user()->id])->first();
        return view("vendor.special-tax.edit",compact("data"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SpecialTax  $specialTax
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = SpecialTax::find($id);
		$validated = $request->validate([
          	'title' => 'required|max:255',            
		   	'value' => 'required|numeric',
			'status' => 'required|boolean',
        ]);
       $data->title=$request->title;     
        $data->value=$request->value;
		$data->status=$request->status;
        $data->save();
		return Redirect()->route("special-taxes.index")->with("success","Special Tax updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SpecialTax  $specialTax
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = SpecialTax::find($id);
        $data->delete();
		return Redirect()->route("special-taxes.index")->with("success","Special Tax deleted successfully!");
    }
}
