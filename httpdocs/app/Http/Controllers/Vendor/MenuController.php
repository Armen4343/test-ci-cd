<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus=Menu::where("vendor_id",Auth::user()->id)->get();
        return view('vendor.menu.index',compact("menus"));
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
			'status' => 'required|boolean',
        ]);
  
        if ($validator->fails()) {
            return response()->json([
                        'error' => $validator->errors()->all()
                    ]);
        }
       	$data=new Menu();
        $data->title=$request->title;   
		$data->status=$request->status;
		$data->vendor_id=Auth::user()->id;
		$data->save();
        return response()->json(['success' => 'Menu created successfully!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $data=Menu::where(["id"=>$id,"vendor_id"=>Auth::user()->id])->first();
        return view("vendor.menu.edit",compact("data"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Menu::find($id);
		$validated = $request->validate([
          	'title' => 'required|max:255',   
			'status' => 'required|boolean',
        ]);
       	$data->title=$request->title;
		$data->status=$request->status;
        $data->save();
		return Redirect()->route("menus.index")->with("success","Menu updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Menu::find($id);
        $data->delete();
		return Redirect()->route("menus.index")->with("success","Menu deleted successfully!");
    }
}