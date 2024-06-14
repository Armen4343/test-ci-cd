<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Items;
use App\Models\Menu;
use App\Models\MenuItems;
use App\Models\Category;
use App\Models\Cuisine;
use App\Models\User;
use App\Models\Tax;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;
use App\Models\orders;
use App\Models\orderitems;

use Illuminate\Support\Facades\Session;
use DB;
use Auth;
class CatSinglePageController extends Controller
{
    public function index(Request $request){

        $id=$request->id;
        $items=Items::with('cuisine')
            ->where('user_id', $id)
            ->get();
        //dd($items);

        // Group items by cuisine
        $groupedItems = $items->groupBy('cuisine.title');

        $vendorimage=User::where('id',$id)->first();
        return view('front-end.cat_singlepage',compact('items','groupedItems','vendorimage'));
    }

    public function cuisineItems(Request $request){
        $items=Items::with('cuisine')
            ->where('cuisine_id', $request->cuisine)
            ->where('user_id', $request->vendor_id)
            ->where(DB::raw("date_format(str_to_date(expire_date, '%Y-%m-%d'), '%Y-%m-%d')"), ">=", date("Y-m-d"))
            ->get();
        $arrReturn = array();
        foreach($items as $item)
        {
            $arrEntry = array();
            $arrEntry['name'] = $item->name;
            $arrEntry['image'] = $item->image;
            $arrEntry['alergen_info'] = $item->alergen_info;
            $arrEntry['expire_date'] = date("d-m-Y", strtotime($item->expire_date));
            $arrEntry['discount'] = $item->discount;
            $arrEntry['price'] = $item->price;
            $arrEntry['id'] = $item->id;
            $arrReturn[] = $arrEntry;
        }
        return response()->json(['items'=>$arrReturn]);
    }

    public function addItem(Request $request)
    {
        $itemtype = $request->input('itemtype');
        $itemId = $request->input('id');
        if($itemtype=='single')
        {
            $maxQTY = Items::select('quantity', 'user_id')
                ->where("id",$itemId)
                ->first();
            $nVendorID = $maxQTY->user_id;
        }
        else {
            $maxQTY = menu::where('id', $itemId)->first();
            $nVendorID = $maxQTY->vendor_id;
        }


       /*$quantity = $request->input('quantity');
        $price = str_replace("$", "", $request->input('price'));
        $name = $request->input('name');
        $itemimage = $request->input('itemimage');*/
        $itemtype = $request->input('itemtype');
        $additionalitems = $request->input('additionalitems');
        $quantity = 1;
        //$arrReturn = array();

        // Retrieve the current cart items from the session
        $cartItems = Session::get('cart.items', []);
        // If the item already exists in the cart, increase the quantity
        if (array_key_exists($nVendorID, $cartItems) && array_key_exists($itemId, $cartItems["$nVendorID"])) {
            $bAllowIncrement = true;
            if($itemtype=='single')
            {
                if($maxQTY->quantity <= $cartItems["$nVendorID"][$itemId]['quantity']){
                    //max qty limit over
                    $bAllowIncrement = false;
                }
            }

			if($bAllowIncrement){
				$itemPrice = $cartItems["$nVendorID"][$itemId]['unitprice'];
				$cartItems["$nVendorID"][$itemId]['quantity'] += $quantity;
				$cartItems["$nVendorID"][$itemId]['price'] = number_format($itemPrice * $cartItems["$nVendorID"][$itemId]['quantity'], 2);
			}
        }
        else {
            if($itemtype=='single')
            {
                $mainitem = Items::with('cuisine')
                    ->where("id",$itemId)
                    ->first();

				$OrgQty = $mainitem->quantity;
                $price = $mainitem->price;
                $discount = $mainitem->discount;
                $tax = $mainitem->tax;
                $totalPrice = $price - ($discount / 100) * $price;
                //$salePrice = $totalPrice + ($tax / 100) * $totalPrice;
                $salePrice = $totalPrice;
                $price = number_format($salePrice, 2);
                $name = $mainitem->name;

                if($mainitem->image)
                {
                    $itemimage = $mainitem->image;
                }
                else
                {
                    $itemimage = asset('food.png');
                }

                // Otherwise, add a new item to the cart
                $tax = 0;
                $cartItems["$nVendorID"][$itemId] = [
                    'id' => $itemId,
                    'baseprice'=>$mainitem->price,
                    'discount'=>$discount,
                    'tax'=>$tax,
                    'quantity' => $quantity,
                    'orgqty' => $OrgQty,
                    'unitprice' => $price,
                    'price'=>$price,
                    'name'=>$name,
                    'image'=>$itemimage,
                    'vendor'=>$mainitem->user_id,
                    'expiry_date'=>date("d-m-Y", strtotime($mainitem->expire_date)),
                    'item_type'=>'single'
                ];
            }
            else {
                $menu = menu::where('id', $itemId)->first();
                $nVendorID = $menu->vendor_id;
                $vendor=User::where('id',$nVendorID)->first();
                $strState = $vendor->state;
                $ObjTax = Tax::where('state', $strState)->first();
                $tax = 0;
                if($ObjTax)
                {
                    $tax = $ObjTax->tax;
                }
                //$menuitems = MenuItems::where('menu_id',  $itemId)->get();
                $menuitems = DB::table('items')
                    ->select('items.*')
                    ->leftJoin('menu_items','items.id','=','menu_items.item_id')
                    ->where('menu_items.menu_id', $itemId)
                    ->get();
                $strImage = asset('food.png');
                $strItemNames = "";
                $strExpiryDate = "";
                foreach($menuitems as $item)
                {
                    if($item->image)
                    {
                        $strImage = $item->image;
                    }
                    $strItemNames = $strItemNames.$item->name.", ";
                    if($strExpiryDate=="")
                    {
                        $strExpiryDate = $item->expire_date;
                    }
                    else {
                        if(strtotime($item->expire_date)<strtotime($strExpiryDate))
                        {
                            $strExpiryDate = $item->expire_date;
                        }
                    }
                }
                $strItemNames = rtrim($strItemNames, ", ");
                $tax = 0;
                $cartItems["$nVendorID"][$itemId] = [
                    'id' => $itemId,
                    'baseprice' => $menu->price,
                    'quantity' => $quantity,
					'orgqty' => $menu->quantity,
                    //'unitprice' => round($menu->price+($menu->price*$tax/100),2),
                    'unitprice' => round($menu->price,2),
                    //'price'=>round($menu->price+($menu->price*$tax/100),2),
                    'price'=>round($menu->price,2),
                    'tax'=>$tax,
                    'name'=>$menu->title,
                    'items'=>$strItemNames,
                    'image'=>$strImage,
                    'vendor'=>$menu->vendor_id,
                    'expiry_date'=>date("d-m-Y", strtotime($strExpiryDate)),
                    'item_type'=>'combo'
                ];
            }
        }
        //$arrReturn[] = $cartItems[$itemId];//array("itemid"=>$itemId, "itemname"=>$name, "itemimage"=>$itemimage, "quantity"=>$quantity, "price"=>$price);
        if($request->has('additionalitems') && count($additionalitems)>0)
        {
            for($i=0; $i<count($additionalitems); $i++)
            {
                $quantity = 1;
                $nThisItemId = $additionalitems[$i];

                if($nThisItemId>0)
                {
                    $mainitem = Items::with('cuisine')
                        ->where("id",$nThisItemId)
                        ->first();


                    $price = $mainitem->price;
                    $discount = $mainitem->discount;
                    $tax = $mainitem->tax;
                    $totalPrice = $price - ($discount / 100) * $price;
                    //$salePrice = $totalPrice + ($tax / 100) * $totalPrice;
                    $salePrice = $totalPrice;
                    $price = number_format($salePrice, 2);
                    $name = $mainitem->name;
                    $name = $mainitem->name;
					$OrgQty = $mainitem->quantity;

                    if($mainitem->image)
                    {
                        $itemimage = $mainitem->image;
                    }
                    else
                    {
                        $itemimage = asset('food.png');
                    }


                    if (array_key_exists($nThisItemId, $cartItems["$nVendorID"])) {

						if($maxQTY->quantity <= $cartItems["$nVendorID"][$nThisItemId]['quantity']){
							//max qty limit over
						}
						else{
							  $itemPrice = $cartItems["$nVendorID"][$nThisItemId]['unitprice'];
								$cartItems["$nVendorID"][$nThisItemId]['quantity'] += $quantity;
								$cartItems["$nVendorID"][$nThisItemId]['price'] = number_format($itemPrice * $cartItems["$nVendorID"][$nThisItemId]['quantity'], 2);
						}

                    } else {
                        // Otherwise, add a new item to the cart
                        $tax = 0;
                        $cartItems["$nVendorID"][$nThisItemId] = [
                            'id' => $nThisItemId,
                            'baseprice'=>$mainitem->price,
                            'discount'=>$discount,
                            'tax'=>$tax,
                            'quantity' => $quantity,
							'orgqty' => $OrgQty,
                            'unitprice' => $price,
                            'price'=>$price,
                            'name'=>$name,
                            'image'=>$itemimage,
                            'vendor'=>$mainitem->user_id,
                            'expiry_date'=>date("d-m-Y", strtotime($mainitem->expire_date)),
                            'item_type'=>'single'
                        ];
                    }
                    //$arrReturn[] = $cartItems[$nThisItemId];//array("itemid"=>$nThisItemId, "itemname"=>$name, "itemimage"=>$itemimage, "quantity"=>$quantity, "price"=>$price);
                }
            }
        }

        // Save the updated cart items to the session
        Session::put('cart.items', $cartItems);

        $arrReturn = $this->returncartitems($nVendorID);
        //return response()->json(['success' => true]);
        return response()->json(['items'=>$arrReturn]);
    }

    public function viewCart(){
        $cartItems = Session::get('cart.items', []);
        // dd($cartItems);

        $total = 0;
        foreach ($cartItems as $cartItem) {
            //$total += $cartItem['price'] * $cartItem['quantity'];
            $total += $cartItem['price'];
        }
        return view('front-end.cart', compact('cartItems','total'));
    }


    public function removeItem(Request $request)
    {
        $vendorid = $request->vendorid;
        $cart = session()->get('cart.items');
        $itemId = $request->id;

        if (isset($cart["$vendorid"][$itemId])) {
            unset($cart["$vendorid"][$itemId]);
            session()->put('cart.items', $cart);

            /*return response()->json([
                'success' => true,
            ]);*/
        }

        /*return response()->json([
            'success' => false,
        ]);*/
        $arrReturn = $this->returncartitems($vendorid);
        //return response()->json(['success' => true]);
        return response()->json(['items'=>$arrReturn]);
    }

    public function decrement(Request $request)
    {
        $vendorid = $request->input('vendorid');

        $id = $request->input('id');
        $cart = session()->get('cart.items');

        if (isset($cart["$vendorid"][$id])) {

            $cart["$vendorid"][$id]['quantity']--;
            if($cart["$vendorid"][$id]['quantity']==0)
            {
                unset($cart["$vendorid"][$id]);
            }
            else{
                $itemPrice = $cart["$vendorid"][$id]['unitprice'];
                $cart["$vendorid"][$id]['price'] = number_format($itemPrice * $cart["$vendorid"][$id]['quantity'], 2);
            }
            session()->put('cart.items', $cart);

        }
        /*else {
            $response = [
                'success' => false,
                'message' => 'Product not found in cart',
            ];
        }*/

        //return response()->json($response);
        $arrReturn = $this->returncartitems($vendorid);
        //return response()->json(['success' => true]);
        return response()->json(['items'=>$arrReturn]);
    }

    public function increment(Request $request)
    {
        $id = $request->input('id');
        $vendorid = $request->input('vendorid');
        $maxQTY = $request->input('maxqty');
        $currentQTY = $request->input('currentqty');

        $cart = session()->get('cart.items');


        if (isset($cart["$vendorid"][$id])) {
            $bPerformIncrement = true;
            if($cart["$vendorid"][$id]['item_type']=='single')
            {
                $maxQTY = Items::select('quantity')
                    ->where("id",$id)
                    ->first();
                if($maxQTY->quantity <= $cart["$vendorid"][$id]['quantity']){
                        //max qty limit over
                    $bPerformIncrement = false;
                }
            }


            if($bPerformIncrement){
                $cart["$vendorid"][$id]['quantity']++;

                $itemPrice = $cart["$vendorid"][$id]['unitprice'];
                $cart["$vendorid"][$id]['price'] = number_format($itemPrice * $cart["$vendorid"][$id]['quantity'], 2);

                session()->put('cart.items', $cart);
			}
            /*$subtotal = $cart[$id]['quantity'] * $cart[$id]['price'];
            $cartTotal = $this->calculateCartTotal($cart);
            $itemCount = $this->getItemCount($cart);
            $total = $this->calculateTotal($cart);

            $response = [
                'success' => true,
                'quantity' => $cart[$id]['quantity'],
                'subtotal' => $subtotal,
                'cartTotal' => $cartTotal,
                'itemCount' => $itemCount,
                'total' => $total,
            ];*/

        }
        /*else {
            $response = [
                'success' => false,
                'message' => 'Product not found in cart',
            ];
        }*/

        //return response()->json($response);
        $arrReturn = $this->returncartitems($vendorid);
        //return response()->json(['success' => true]);
        return response()->json(['items'=>$arrReturn]);
    }

    private function calculateCartTotal($cart)
    {
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['quantity'] * $item['price'];
        }
        return $total;
    }

    private function getItemCount($cart)
    {
        $count = 0;
        foreach ($cart as $item) {
            $count += $item['quantity'];
        }
        return $count;
    }

    private function calculateTotal($cart)
    {
        $cartTotal = $this->calculateCartTotal($cart);
        $shippingFee = 10;
        $total = $cartTotal + $shippingFee;

        return $total;
    }

    public function countcart(Request $request)
    {
        $id = $request->input('id');
        $quantity = $request->input('quantity');
        $price = $request->input('price');
        $name = $request->input('name');
        $cart = session()->get('cart.items', []);

        // Check if the item is already in the cart
        $itemExists = false;
        foreach ($cart as $item) {
            if ($item['id'] == $id) {
                $itemExists = true;
                break;
            }
        }

        // Add the item to the cart if it doesn't already exist
        if (!$itemExists) {
            $item = [
                'id' => $id,
                'quantity' => $quantity,
                'price'=>$price,
                'name'=>$name,
                // Add other properties of the item here
            ];
            $cart[] = $item;
            session()->put('cart.items', $cart);
        }

        $itemCount = count($cart);

        $response = [
            'success' => true,
            'itemCount' => $itemCount,
        ];

        return response()->json($response);
    }

    public function singleitems(Request $request){
        //$this->returncartitems();
        //exit;
        /*$cartItems = Session::get('cart.items', []);
        echo "<pre>";
        print_r($cartItems);
        echo "</pre>";
        exit;*/
		//Session::forget('cart.items');
        $id=$request->id;
        $id = decrypt($id);
        $cuisines=Cuisine::where('vendor_id',$id)->get();
        $items = Items::with('cuisine')
            ->where('user_id', $id)
            //->where(DB::raw("date_format(str_to_date(expire_date, '%Y-%m-%d'), '%Y-%m-%d')"), ">=", date("Y-m-d"))
            ->where(DB::raw("if(expire_date is null, CURDATE(), date_format(str_to_date(expire_date, '%Y-%m-%d'), '%Y-%m-%d') )"), ">=", date("Y-m-d"))
            ->get();
        $allitems = Items::with('cuisine')
            ->where('user_id', $id)
            //->where(DB::raw("date_format(str_to_date(expire_date, '%Y-%m-%d'), '%Y-%m-%d')"), ">=", date("Y-m-d"))
            ->where(DB::raw("if(expire_date is null, CURDATE(), date_format(str_to_date(expire_date, '%Y-%m-%d'), '%Y-%m-%d') )"), ">=", date("Y-m-d"))
            ->get();





        // Group items by cuisine
        $groupedItems = $items->groupBy('cuisine.title');

        $vendor=User::where('id',$id)->first();
		if($vendor->status == 'disable')
		{
		return redirect()->route('all.restaurants') ;
		}

        $menus = Menu::where('vendor_id', $id)
            ->leftJoin('menu_items', 'menus.id', '=', 'menu_items.menu_id')
            ->leftJoin('items', 'menu_items.item_id', '=', 'items.id')
            ->select('menus.title', 'menus.id as menuid', 'items.id as itemid','items.*','menus.price as menu_price')
            ->get();

        $menu_array=[];
        foreach($menus as $menu){

            $strKey = $menu->menuid."--".$menu->title;
            $menu_array[$strKey]['menuid'] = $menu->menuid;
            $menu_array[$strKey]['menutitle'] = $menu->title;
            $menu_array[$strKey]['menu_price'] = $menu->menu_price;
            if(!isset($menu_array[$strKey]['orig_price']))
            {
                $menu_array[$strKey]['orig_price'] = $menu->price;
            }
            else {
                $menu_array[$strKey]['orig_price'] =  $menu_array[$strKey]['orig_price'] + $menu->price;
            }
            if(!isset($menu_array[$strKey]['expiry_date']))
            {
                $menu_array[$strKey]['expiry_date'] = $menu->expire_date;
            }
            else {
                if(strtotime($menu->expire_date) < strtotime($menu_array[$strKey]['expiry_date']))
                    $menu_array[$strKey]['expiry_date'] =  $menu->expire_date;
            }


            $menu_array[$strKey]['items'][] = [
                'id' => $menu->itemid,
                'name' => $menu->name,
                'menu_price'=>$menu->price,
                'image'=>$menu->image,
//                'expire_date'=>$menu->expire_date,
                'item_description'=>$menu->description,
            ];
        }

        foreach($menu_array as $id=>$val)
        {
            if(isset($val['expiry_date']) && trim($val['expiry_date'])!="" && strtotime($val['expiry_date'])<strtotime(date("Y-m-d")))
            {
                unset($menu_array[$id]);
            }
        }
        //exit;
        //echo "<pre>";
        //print_r($menu_array);
        //echo "</pre>";
        //exit;

		$ratings = DB::table('ratings')
            ->select('ratings.*','users.name','users.profile_photo_path')
            ->where('vendor_id','=',decrypt($request->id))
            ->where('is_hide', '=', 0)
            ->join('users', 'ratings.buyer_id', '=', 'users.id')
            ->get();
		$orders = null;
		if(Auth::user()){
		$orders = DB::table('tblorder')
			->select('tblorder.order_number')
			->where('tblorder.userid', Auth::user()->id)
			->where('tblorder.status', '=' ,'paid')
			->whereNotIn('order_number', DB::table('ratings')->pluck('order_number'))
			->get();
		}

   return view('front-end.cat_singlepage_new',compact('items','groupedItems','vendor','cuisines','menus','menu_array','allitems','ratings','orders'));
    }

    public function search_vendor(Request $request) {
        // Get the location from the request
        $location = $request->vendor_location;

        // Call the Google Maps Geocoding API to get the address components of the location
        $response = Http::get('https://maps.googleapis.com/maps/api/geocode/json', [
            'address' => $location,
            'key' => 'AIzaSyBN92VYtm21-eo6uyzqh9vIGuiTyLloTGM',
        ]);

        $geocodingResults = $response->json()['results'];

        // If no results were found, return an error message
        if (empty($geocodingResults)) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Location not found geo'
                ]);
            }
        }

        // Get the zip code and city from the address components
        $addressComponents = $geocodingResults[0]['address_components'];
        $zipCode = null;
        $city = null;
        foreach ($addressComponents as $component) {
            if (in_array('postal_code', $component['types'])) {
                $zipCode = $component['long_name'];
            }
            elseif (in_array('locality', $component['types'])) {
                $city = $component['long_name'];
            }
        }

        // Search the database for vendors matching the zip code or city
        if ($zipCode === null) {
		$restaurants = User::
			where('disable_restaurant','='.'no')
			->where('city', 'LIKE', '%' . $city . '%')

			->get();
        }
        else {
		$restaurants = User::
			where('disbale_restaurant','=','no')
			->where('zipcode', $zipCode)

			->get();
        }


        // If no vendors were found, return a message
        if ($restaurants->isEmpty()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No vendors found'
                ]);
            }
            else {
                return view('front-end.searchvendor', ['message' => 'No vendors found']);
            }
        }

        // Return the list of vendors
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'vendors' => $restaurants
            ]);
        }
	else {
		dd($restaurants);
			$category=Category::all();
		$categories=Category::all();
		//$restaurants=User::where("role","=","vendor")->where("disable_restaurant","=","no")->get();

		return view("front-end.category2",compact("restaurants","category","categories"));
         //   return view('front-end.category2',compact('categories','vendors'));
        }
    }

    private function returncartitems($nVendorID)
    {
        $cartItems = Session::get('cart.items', []);
        $arrReturn = array();
        foreach($cartItems["$nVendorID"] as $key=>$item)
        {
            $arrReturn[] = $item;
        }
        return $arrReturn;
    }
}
