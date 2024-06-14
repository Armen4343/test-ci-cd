<?php

namespace App\Http\Controllers;

use App\Models\MenuItems;
use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Models\Items;
use Auth;
class MenuItemsController extends Controller
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
        $validator=Validator::make($request->all(), [
            //'expire_date_menu' => 'required|max:255',
			'availability' => 'required|max:5',
            'promo' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                        'error' => $validator->errors()->all()
                    ]);
        }
        /*if($request->expire_date_menu!="" && count($request->items)>0)
        {
            $arrExpireErrors = array();
            $strExpireDateMenu = $request->expire_date_menu;
            $items = $request->items;
            foreach($items as $key => $n )
            {
                $nItemID = $items[$key];
                $thisitem = Items::where('id', $nItemID)->first();
                $strItemExpiry = $thisitem->expire_date;
                if(strtotime($strExpireDateMenu)>strtotime($strItemExpiry))
                {
                    //$arrExpireErrors[] = "Menu expiry date is greater than the expiry date of ".$thisitem->name;
                    $arrExpireErrors[] = $thisitem->name;
                }
            }
            if(count($arrExpireErrors)>0)
            {
                array_unshift($arrExpireErrors, "Following items have been expired. Either remove these items or adjust their expiry dates");
                return response()->json([
                        'error' => $arrExpireErrors
                    ]);
            }
        }*/
        $data = Menu::find($request->menu_id);
       	$data->category_id=$request->category_id;
        $data->price_type=$request->price_type;
        $data->price=$request->price;
        $data->tax=$request->tax;
        $data->status = $request->menu_status;
        if($request->has('expire_date_menu'))
        {
            $data->expire_date = $request->expire_date_menu;
        }
        if($request->has('availability'))
        {
            $data->availability = $request->availability;
        }
        if($request->has('promo'))
        {
            $data->promo = $request->promo;
        }
        if($request->has('date_range'))
        {
            $data->date_range = $request->date_range;
        }
        if ($request->has('promo_days')) {
            $data->promo_days = implode(',', $request->input('promo_days'));
        }
        if (isset($request->time_range_from) && isset($request->time_range_to)) {
            $data->time_range = $request->time_range_from . '-' . $request->time_range_to;
        }
        $data->save();

		MenuItems::where('menu_id',$request->menu_id)->delete();
        $items = $request->items;
        $qty = $request->qty;
        $tax = $request->tax;
        $priceItem = $request->price;
        $total = $request->item_total;
		if($items){
        foreach($items as $key => $n )
        {
            MenuItems::insert([
                "menu_id"		=> $request->menu_id,
                "item_id"		=> $items[$key],
                "qty"		=> $qty[$key],
                "total"	=> $total[$key],
            ]);

        }
		}

		//return Redirect()->route("menus.index")->with("success","Menu Items addedd successfully!");
        return response()->json(['success' => 'Menu created successfully!']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MenuItems  $menuItems
     * @return \Illuminate\Http\Response
     */
    public function show(MenuItems $menuItems)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MenuItems  $menuItems
     * @return \Illuminate\Http\Response
     */
    public function edit(MenuItems $menuItems)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MenuItems  $menuItems
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MenuItems $menuItems)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MenuItems  $menuItems
     * @return \Illuminate\Http\Response
     */
    public function destroy(MenuItems $menuItems)
    {
        //
    }


    public function ManageMenuItems($id)
    { $menu=Menu::where("vendor_id",Auth::user()->id)->where("id",$id)->first();
	 //dd($menu);
       return view('vendor.menu.manage-menu-items',compact('menu'));
    }

    public function CheckExpiry(Request $request)
    {
        $strDate = $request->strDate;
        $arrItems = $request->arrItems;
        $allOK = true;
        $strItemName = "";
        for($i=0; $i<count($arrItems); $i++)
        {
            $objItem = Items::find($arrItems[$i])->first();
            $strObjExpiry = $objItem->expire_date;
            if(strtotime($strObjExpiry)<strtotime($strDate))
            {
                $allOK = false;
                $strItemName = $objItem->name;
                break;
            }
        }
        if(!$allOK)
        {
            echo "Expiry date cannot be higher than the individual items expiry date!";
        }
    }
}
