<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Category;
use App\Models\Cuisine;
use App\Models\FrontPageImages;
use App\Models\PopupBanner;
use Illuminate\Support\Facades\Http;
use App\Rules\ImageDimensions;

class FrontPagesController extends Controller
{
    
	 public function home()
	 {
		$frontPageimages = FrontPageImages::firstOrNew();
		$homePageBanner = DB::table('home_page_banner')->first();
		$contactUs = DB::table('contact_us')->first();
		$categories=Category::where("status",1)->inRandomOrder()->limit(10)->get();	
		$totalCategories=Category::where("status",1)->count('id');	
		$cuisines=Cuisine::where("status",1)->get();
		 return view('welcome', compact('homePageBanner','contactUs','categories','cuisines','totalCategories','frontPageimages'));
	 }
	
	 public function terms()
    {
			$terms = DB::table('terms_and_conditions')->first();
			if($terms){
			return view('terms-and-conditions', compact('terms'));
			}
			else{
			return view('terms-and-conditions');
			}
    }
		//
		public function aboutUs()
		{
			$aboutUs = DB::table('about_us')->first();
			if($aboutUs){
			return view('about-us', compact('aboutUs'));
			}
			else{
			return view('about-us');
			}
		}
		public function Category()
		 {
			$categories=Category::where("status",1)->get();	
			 return view('front-end.category2', compact('categories'));
		 }
		public function restaurant()
		{
			return view('front-end.details');
		}
	 public function homesearch(Request $request){
			$location = $request->input('query');
			$radius = $request->input('radius') ?: 2000; // 5km radius by default
			$key='AIzaSyBN92VYtm21-eo6uyzqh9vIGuiTyLloTGM'; // your API key


			// Use Google Maps Geocoding API to get the latitude and longitude of the location
			$response = Http::get('https://maps.googleapis.com/maps/api/geocode/json', [
				'address' => $location,
				'key' => $key,
			]);


			$geocodingResults = $response->json()['results'];

			// If no results were found, return an empty array
			if (empty($geocodingResults)) {
				return response()->json([]);
			}

			$locationData = $geocodingResults[0]['geometry']['location'];
			$latitude = $locationData['lat'];
			$longitude = $locationData['lng'];

			// Parse the address components to get the pincode
			$addressComponents = collect($geocodingResults[0]['address_components']);
			$pincode = $addressComponents->first(function ($component) {
				return in_array('postal_code', $component['types']);
			})['short_name'] ?? null;

			// Use Google Places API to search for nearby restaurants
			$response = Http::get('https://maps.googleapis.com/maps/api/place/nearbysearch/json', [
				'location' => "$latitude,$longitude",
				'radius' => $radius,
				'key' => $key,
			]);



			$results = $response->json()['results'];


			// Extract relevant data for each restaurant
			$restaurants = collect($results)->map(function ($restaurant) use ($pincode) {
				return [
					'name' => $restaurant['name'],
					'address' => $restaurant['vicinity'],
					'latitude' => $restaurant['geometry']['location']['lat'],
					'longitude' => $restaurant['geometry']['location']['lng'],
					'rating' => isset($restaurant['rating']) ? $restaurant['rating'] : null,
					'pincode' => $pincode,
				];
			});


			// Return the list of restaurants
			return response()->json($restaurants);
		 
		 }
		public function FrontPageImagesIndex()
		{
			$images = FrontPageImages::firstOrNew(); // Retrieve the first record or create a new one if none exists
			return view('super-admin/settings/front-page-images', compact('images'));
		}
	
	   public function FrontPageImagesUpdate(Request $request)
		{
				$images = FrontPageImages::firstOrNew(); // Retrieve the first record or create a new one if none exists

				// Define the path to the default placeholder image
				$defaultImage = 'assets/media/blank.jpg';

				// Define the validation rules for each image field (optional)
				$validationRules = [
					'image1' => ['image', 'mimes:jpeg,png,jpg,gif', 'dimensions:width=1000,height=1171'],
					'image2' => ['image', 'mimes:jpeg,png,jpg,gif', 'dimensions:width=1000,height=664'],
					'image3' => ['image', 'mimes:jpeg,png,jpg,gif',  'dimensions:width=1366,height=405'],
					'image4' => ['image', 'mimes:jpeg,png,jpg,gif',  'dimensions:width=1366,height=470'],
				];
		    $customMessages = [
        	'image1.dimensions' => 'The dimensions in the image1 you have uploaded does not meet the requirements of the size in this section. Please upload an image in size 1000 x 1171 in Pixels',
        	'image2.dimensions' => 'The dimensions in the image2 you have uploaded does not meet the requirements of the size in this section. Please upload an image in size 1000 x 664 in Pixels',
        	'image3.dimensions' => 'The dimensions in the image3 you have uploaded does not meet the requirements of the size in this section. Please upload an image in size 1366 x 405 in Pixels',
        	'image4.dimensions' => 'The dimensions in the image4 you have uploaded does not meet the requirements of the size in this section. Please upload an image in size 1366 x 470 in Pixels'
    ];

				// Validate the request data based on the defined rules
				$request->validate($validationRules,$customMessages);

				// Process and update the images if they are provided in the request
				if ($request->hasFile('image1')) {
					$image = $request->file('image1');
					$image_name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
					$image->move(public_path('assets/media/front-page-images'),$image_name);
					$images->image1 = "/assets/media/front-page-images/" . $image_name;
				}

				if ($request->hasFile('image2')) {
					$image = $request->file('image2');
					$image_name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
					$image->move(public_path('assets/media/front-page-images'),$image_name);
					$images->image2 = "/assets/media/front-page-images/" . $image_name;
				}

				if ($request->hasFile('image3')) {
					$image = $request->file('image3');
					$image_name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
					$image->move(public_path('assets/media/front-page-images'),$image_name);
					$images->image3 = "/assets/media/front-page-images/" . $image_name;
				}

				if ($request->hasFile('image4')) {
					$image = $request->file('image4');
					$image_name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
					$image->move(public_path('assets/media/front-page-images'),$image_name);
					$images->image4 = "/assets/media/front-page-images/" . $image_name;
				}

				// Save the changes to the database
				$images->save();

			return redirect('super-admin/settings/front-page-images')->with('success', 'Images updated successfully');
		}
	
	// Popup Banner start
		public function PopupBannerIndex()
		{
			$PopupBanner = PopupBanner::firstOrNew(); // Retrieve the first record or create a new one if none exists
			return view('super-admin/settings/popup-banner', compact('PopupBanner'));
		}
	
	   public function PopupBannerUpdate(Request $request)
		{
				$PopupBanner = PopupBanner::firstOrNew(); // Retrieve the first record or create a new one if none exists

				// Define the path to the default placeholder image
				$defaultImage = 'assets/media/blank.jpg';

				// Define the validation rules for each image field (optional)
				$validationRules = [
					'title' => 'required|string|max:255',
					'description' => 'required|string',
					'url' => 'required|url',
					'image' => ['image', 'mimes:jpeg,png,jpg,gif', 'dimensions:width=733,height=853'],
					'discount_code' => 'nullable|string|max:255',
				];
		    $customMessages = [
        	'image.dimensions' => 'The dimensions in the image you have uploaded does not meet the requirements of the size in this section. Please upload an image in size 733 x 853 in Pixels'
    ];
				// Validate the request data based on the defined rules
				$request->validate($validationRules,$customMessages);

				// Process and update the images if they are provided in the request
				if ($request->hasFile('image')) {
					$image = $request->file('image');
					$image_name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
					$image->move(public_path('assets/media/front-page-images'),$image_name);
					$PopupBanner->image = "/assets/media/front-page-images/" . $image_name;
				}
		   		// Update the attributes with values from the request
				$PopupBanner->title = $request->input('title');
				$PopupBanner->description = $request->input('description');
				$PopupBanner->url = $request->input('url');
				$PopupBanner->discount_code = $request->input('discount_code');
				$PopupBanner->is_active = $request->input('is_active');
				// Save the changes to the database
				$PopupBanner->save();

			return redirect('super-admin/settings/popup-banner')->with('success', 'Popup Banner updated successfully');
		}
	// Popup Banner end
}
