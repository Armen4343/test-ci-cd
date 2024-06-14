<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\User;
use App\Models\Items;
use App\Models\Rating;
Use DB;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{

    public function index($id){

		$category=Category::find($id);
		$categories=Category::all();
        $selectedCategories = [$category->id];
		$restaurant_ids=Items::where("category_id",$id)->groupBy("user_id")->select("user_id")->get()->pluck("user_id")->toArray();
		$restaurants=User::whereIn("id",$restaurant_ids)->where("disable_restaurant","=","no")->get();
		return view("front-end.category2",compact("restaurants","category","categories","id","selectedCategories"));
	}
    public function allRestaurants(){
		$category=Category::all();
        $categories = Category::with('user')->get();
        $restaurant_ids = Items::groupBy("user_id")->select("user_id")->get();
        $restaurants = User::where("role", "vendor")
            ->whereIn('id', $restaurant_ids)
            ->where("disable_restaurant", "no")
            ->where("status", "active")
            ->with('ratings', 'items')
            ->get();

		return view("front-end.category2",compact("restaurants","category","categories"));

	}
    public function allCategories(){
		$homePageBanner = DB::table('home_page_banner')->first();
		//$categories=Category::all();
		$nPublish = 1;
		$categories=Category::where('status', $nPublish)->get();
		return view("front-end.view-all-categories",compact("categories","homePageBanner"));

	}
    public function filter(Request $request){
		if(isset($request->resetbtn)){
		 $request->request->remove('ratingfilter');
		 $request->request->remove('categories');
		 $request->request->remove('price');
         $request->request->remove('sort');
		}


        $selectedCategories = $request->categories ?? null;
        $selectedRating = $request->ratingfilter ?? '';
        $selectedPrice = $request->price ?? '';
        $selectedSort = $request->sort ?? 'popularity';

        $category = Category::find($request->categories);
        $categories = Category::all();
        $arr = $request->categories;

        if (isset($selectedCategories)) {
            $restaurant_ids_query = Items::whereIn('category_id', $arr)->groupBy("user_id")->select("user_id");
        } else {
            $restaurant_ids_query = Items::groupBy("user_id")->select("user_id");
        }

        if (isset($request->price)) {
            $restaurant_ids_query->whereBetween('discount', [0, intval($request->price)])
                ->where(DB::raw("if(expire_date is null, CURDATE(), date_format(str_to_date(expire_date, '%Y-%m-%d'), '%Y-%m-%d') )"), ">=", date("Y-m-d"))
                ->where(DB::raw("if(date_range is null, CURDATE(), date_format(str_to_date(SUBSTRING_INDEX(date_range, ' - ', 1), '%m/%d/%Y'), '%Y-%m-%d') )"), "<=", date("Y-m-d"))
                ->where(DB::raw("if(date_range is null, CURDATE(), date_format(str_to_date(SUBSTRING_INDEX(date_range, ' - ', -1), '%m/%d/%Y'), '%Y-%m-%d') )"), ">=", date("Y-m-d"))
                ->where('deleted', 'no');
        }

        $restaurant_ids = $restaurant_ids_query->pluck('user_id');

        if (isset($request->ratingfilter)) {
            $ratingVendor = DB::table('ratings')
                ->select([
                    'vendor_id',
                    DB::raw("SUM(rating) AS rating"),
                    DB::raw("count(rating) AS totalrating"),
                    DB::raw("SUM(rating)/count(rating) AS avg"),
                ])
                ->groupBy('vendor_id')
                ->get()
                ->toArray();

            $vendors = collect($ratingVendor)->where('avg', '>=', $selectedRating)->all();
            $ids = array_map(function($item) {
                return $item->vendor_id;
            }, $vendors);

            $restaurants_query = DB::table('users')
                ->whereIn('users.id', $restaurant_ids)
                ->whereIn('users.id', $ids)
                ->where("disable_restaurant", "=", "no")
                ->distinct();
        } else {
            $restaurants_query = User::whereIn("users.id", $restaurant_ids)
                ->where("disable_restaurant", "=", "no");
        }

        $isPriceSort = $selectedSort == 'price-desc' ||  $selectedSort == 'price';

        if ($selectedSort === 'rating') {
            $restaurants_query = $restaurants_query
                ->leftJoin('ratings', 'users.id', '=', 'ratings.vendor_id')
                ->select('users.*', DB::raw('AVG(ratings.rating) as avg_rating'))
                ->groupBy('users.id')
                ->orderBy('avg_rating', 'desc');
        } elseif ($selectedSort === 'date') {
            $restaurants_query = $restaurants_query->orderBy('users.created_at', 'desc');
        } elseif ($isPriceSort) {
            $restaurants_query = $restaurants_query
                ->join('items', function ($join) {
                    $join->on('users.id', '=', 'items.user_id')
                        ->whereNotNull('items.price')
                        ->whereRaw('items.price = (SELECT MAX(price) FROM items WHERE user_id = users.id)');
                })
                ->select('users.*', 'items.id as item_id', 'items.price as max_price')
                ->groupBy('users.id');
        }elseif ($selectedSort == 'popularity') {
            $restaurants_query = $restaurants_query
                ->leftJoin('ratings', 'users.id', '=', 'ratings.vendor_id')
                ->select('users.*', DB::raw('COUNT(ratings.id) as rating_count'))
                ->groupBy('users.id')
                ->orderByDesc('rating_count');
        }

        $restaurants = $restaurants_query->get();

        if ($isPriceSort) {
            $restaurants = $selectedSort == 'price-desc' ? $restaurants->sortByDesc('max_price') :  $restaurants->sortBy('max_price') ;
        }


        return view("front-end.category2",compact("restaurants","category","categories","selectedCategories","selectedRating","selectedPrice", "selectedSort"));
	}
}
