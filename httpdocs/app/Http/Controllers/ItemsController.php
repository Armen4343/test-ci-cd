<?php

namespace App\Http\Controllers;

use App\Mail\NotifyVendorFilledCalculateData;
use App\Models\Items;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Mail;
use Image;
use Storage;
use DB;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Validator;
class ItemsController extends Controller
{
    const NAMESPACES = [
        'superadmin' => 'super-admin'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $namespace = self::NAMESPACES[$user->role] ?? Auth::user()->role;
        $items = Items::query()
            ->when($user->role != 'superadmin', fn ($q) => $q->where('user_id', Auth::user()->id))
            ->where('deleted', 'no')
            ->get();

        return view("$namespace.item.index",compact("items"));
    }
    public function FetchAjaxItems(Request $request)
    {

        //
         $search = $request->items_add;
        $response = DB::table('items')->where('user_id', Auth::user()->id)->where('id','=', $search)->first();

        return response()->json($response);


        DB::table('users')
             ->select(DB::raw('count(*) as user_count, status'))
             ->where('status', '<>', 1)
             ->groupBy('status')
             ->get();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { DB::table('users')
             ->select(DB::raw('count(*) as user_count, status'))
             ->where('status', '<>', 1)
             ->groupBy('status')
             ->get();
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

	   //dd($request->all());

    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'category' => 'required',
//        'cuisine_type' => 'required',
        'description' => 'required|string',
        'price' => 'required',
        'quantity' => 'required|numeric',
        'promo' => 'required',
        //'expire_date' => 'required|date',
        'availability' => 'required',
        'date_range' => 'required',
        'menu_status' => 'required|boolean',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'error' => $validator->errors()->all(),
        ]);
    }

    if (isset($request->time_range_from) && !isset($request->time_range_to)) {
        return response()->json([
            'error' => [
                'time_range_to' => "L'intervallo di tempo fino a è obbligatorio"
            ],
        ]);
    }

    if (!isset($request->time_range_from) && isset($request->time_range_to)) {
        return response()->json([
            'error' => [
                'time_range_from' => "L'intervallo di tempo da è obbligatorio"
            ],
        ]);
    }

    if (isset($request->expire_date) && !empty($request->expire_date)) {
        $request->merge([
            'expire_date' => date('Y-m-d', strtotime($request->expire_date)),
            'is_exists_expire_date' => true
        ]);
    } elseif (empty($request->expire_date)) {
        $request->merge([
            'expire_date' => date('Y-m-d', strtotime(explode(' - ', $request->date_range)[1])),
        ]);
    }

    $request->merge([
        'user_id' => Auth::user()->id,
    ]);

    if ($request->has('image')) {
        $originalImage = $request->file('image');
        //$name_gen = hexdec(uniqid()) . '.' . ($originalImage->getClientOriginalExtension());

        // Upload the image to OVH




		 $path = Storage::disk('s3')->put('items', $originalImage, 'public');




$last_img = Storage::disk('s3')->url($path); // Get the URL from S3.
    } else {
        $last_img = null;
    }

    $request->merge([
        'user_id' => Auth::user()->id,
        'alergen_info' => ($request->input('alergen_info') ? (implode(',', $request->input('alergen_info'))) : null),
        'promo_days' => ($request->input('promo_days') ? (implode(',', $request->input('promo_days'))) : null),
        'cuisine_id' => $request->cuisine_type,
        'category_id' => $request->category,
        'sale_price' => $request->sale_price,
    ]);

    $requestData = $request->except(['category', 'cuisine_type']);
    $requestData['sale_price'] = $request->sale_price;
    if (isset($request->time_range_from) && isset($request->time_range_to)) {
        $requestData['time_range'] = $request->time_range_from . '-' . $request->time_range_to;
    }
    $requestData['image'] = $last_img;

    $item = Items::create($requestData);

    return response()->json([
        'success' => 'Prodotto creato con successo!',
    ]);
}


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function show(Items $items)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = Auth::user();
        $namespace = self::NAMESPACES[$user->role] ?? Auth::user()->role;
        $data=Items::find($id);
        return view("$namespace.item.edit",compact("data"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		$validated = $request->validate([
            'name' => 'required|string|max:255',
		   	'category' => 'required',
//			'cuisine_type' => 'required',
			'description' => 'required|string',
			'price' => 'required',
		   	'quantity' => 'required|numeric',
			'promo' => 'required',
			//'expire_date' => 'required|date',
		   	'availability' => 'required',
			'date_range' => 'required',
			'menu_status' => 'required|boolean',
        ]);

        $isSuperAdmin = Auth::user()->role == 'superadmin';
        $canUpdateCalculateData = ($request->has('co2_avg') || $request->has('h2o_avg')) && $isSuperAdmin;
        $item = Items::where(["id"=>$id])
            ->when(!$isSuperAdmin,fn($q) => $q->where(["user_id"=>Auth::user()->id]))->first();
        $vendor = $item->user ?? null;

        if($request->has('image')) {
            $originalImage= $request->file('image');


        //$name_gen = hexdec(uniqid()) . '.' . ($originalImage->getClientOriginalExtension());

        // Upload the image to OVH




		 $path = Storage::disk('s3')->put('items', $originalImage, 'public');




$last_img = Storage::disk('s3')->url($path); // Get the URL from S3.

            /*$name_gen = hexdec(uniqid()).".".($originalImage->getClientOriginalExtension());
            Image::make($originalImage)->resize(500,500)->save(public_path().'/uploads/vendor/items/'.$name_gen );
            $last_img = "uploads/vendor/items/".$name_gen;*/
			$request->merge([
				'alergen_info' => ($request->input('alergen_info') ? (implode(",",$request->input('alergen_info'))) : null),
                'promo_days' => ($request->input('promo_days') ? (implode(',', $request->input('promo_days'))) : null),
				"cuisine_id"=>$request->cuisine_type,
				"category_id"=>$request->category,
				 'sale_price' => $request->sale_price,
			]);

			$requestData = $request->except(['_token','_method','tax_type','local-tax','tax1','category','cuisine_type', 'time_range_to', 'time_range_from']);
            if ($isSuperAdmin){
                if ($request->has('co2_avg')){
                    $requestData['co2_avg'] = $request->get('co2_avg');
                }
                if ($request->has('h2o_avg')){
                    $requestData['h2o_avg'] = $request->get('h2o_avg');
                }
            }
			$requestData['sale_price'] = $request->sale_price;
			$requestData['image'] = $last_img;
            if (isset($request->time_range_from) && isset($request->time_range_to)) {
                $requestData['time_range'] = $request->time_range_from . '-' . $request->time_range_to;
            }

            $item->update($requestData);

            if ($canUpdateCalculateData && $vendor){
                Mail::to($vendor->email)->send(new NotifyVendorFilledCalculateData($item));
            }

			$notifications = array(
				'message' => 'Prodotto aggiornato con successo!',
				'alert-type' => 'success'
			);
			return Redirect()->route('items.index')->with($notifications);
        }

        $request->merge([
            'alergen_info' => ($request->input('alergen_info') ? (implode(",",$request->input('alergen_info'))) : null),
            'promo_days' => ($request->input('promo_days') ? (implode(',', $request->input('promo_days'))) : null),
			"cuisine_id"=>$request->cuisine_type,
			"category_id"=>$request->category,
        ]);
        $requestData = $request->except(['_token','_method','tax_type','local-tax','tax1','category','cuisine_type', 'time_range_from', 'time_range_to']);
        if (isset($request->time_range_from) && isset($request->time_range_to)) {
            $requestData['time_range'] = $request->time_range_from . '-' . $request->time_range_to;
        }

        if ($isSuperAdmin){
            if ($request->has('co2_avg')){
                $requestData['co2_avg'] = $request->get('co2_avg');
            }
            if ($request->has('h2o_avg')){
                $requestData['h2o_avg'] = $request->get('h2o_avg');
            }
        }

        $item->update($requestData);

        if ($canUpdateCalculateData && $vendor){
            Mail::to($vendor->email)->send(new NotifyVendorFilledCalculateData($item));
        }

        $notifications = array(
            'message' => 'Prodotto Aggiornato!',
            'alert-type' => 'success'
        );
        return Redirect()->route('items.index')->with($notifications);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $data = Items::find($id);
        //$data->delete();
        $nPublish = 0;
        $arrUpdate = array('menu_status'=>$nPublish, 'deleted'=>'yes');
        Items::where(["id"=>$id,"user_id"=>Auth::user()->id])->update($arrUpdate);
        $notifications = array(
            'message' => 'Prodotto cancellato con successo!',
            'alert-type' => 'success'
        );
        return Redirect()->route('items.index')->with($notifications);
    }
	   public function RemoveMenuItemImage($id)
    {
        //
        $requestData['image'] = null;
			Items::where(["id"=>$id,"user_id"=>Auth::user()->id])->update($requestData);
        $notifications = array(
            'message' => 'Immagine cancellata con successo!',
            'alert-type' => 'success'
        );
        return Redirect()->route('items.index')->with($notifications);
    }


    /**
     * @return mixed
     */
    public function VendorFilledItemsCounterMarkRead(): mixed
    {

        $updated = Items::where('user_id','=',Auth::user()->id)
            ->where('calculate_owner','=','superadmin')
            ->where(function ($query) {
                $query->whereNull('seen_by_vendor')
                    ->orWhere('seen_by_vendor', '=', false);
            })
            ->update(['seen_by_vendor'=> true]);

        return $updated;
    }


    /**
     * @return mixed
     */
    public function VendorFilledItemsCounter(): mixed
    {
        $count = Items::where('user_id','=',Auth::user()->id)
            ->where('calculate_owner','=','superadmin')
            ->where(function ($query) {
                    $query->whereNull('seen_by_vendor')
                        ->orWhere('seen_by_vendor', '=', false);
                    })
                ->count();
        return $count;
    }
}
