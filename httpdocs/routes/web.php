<?php

use App\Http\Controllers\EcoWalletController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\UserSettingController;
use App\Http\Controllers\TermsAndConditionsController;
use App\Http\Controllers\FrontPagesController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\LoginRegisterBannerController;
use App\Http\Controllers\HomePageBannerController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TaxController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Vendor\DishCategoriesController;
use App\Http\Controllers\Vendor\DishController;
use App\Http\Controllers\Vendor\CuisineController;
use App\Http\Controllers\Vendor\SpecialTaxController;
use App\Http\Controllers\Vendor\MenuController;
use App\Http\Controllers\Vendor\MyOrdersController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\MenuItemsController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\CatSinglePageController;
use App\Http\Controllers\BuyerOrdersController;
use App\Models\Cuisine;
use App\Models\Menu;
use App\Models\User;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

use App\Http\Controllers\PaymentCardController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\VendorAvailabilityController;
use App\Http\Controllers\FacebookLoginController;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\Vendor\VendorStripeController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\SocialController;

Route::get('elis', function () {
	$user = DB::table('users')->where('name', "Primo Mercato")->first();
	dd($user);
});



Route::get('home2', function () {
	$msg = "Il seguente ordine e' stato cancellato: ZeepUp-0263";

	$details = [
		'message' => $msg,
		'orderid' =>  317,
		'buyerid' => 128,
		'ordernumber' => 'ZeepUp-0263'
	];
	//send mail to buyer
	Mail::to("info@zeepup.com.com")->send(new \App\Mail\OrderVendorReceipt($details));
	//Mail::to("elisjohnson1!@yahoo.co.uk")->send(new \App\Mail\OrderVendorReceipt($details));
    //return view('home2');
});


Route::get('/', [FrontPagesController::class, 'home'])->name('home');
// Social login
Route::get('auth/google', [SocialController::class, 'googleRedirect']);
Route::get('auth/google/callback', [SocialController::class, 'loginWithGoogle']);
Route::get('auth/facebook', [SocialController::class, 'facebookRedirect']);
Route::get('auth/facebook/callback', [SocialController::class, 'loginWithFacebook']);



Route::get('terms-and-conditions', [FrontPagesController::class, 'terms'])->name('front.page.terms');
Route::get('about-us', [FrontPagesController::class, 'aboutUs'])->name('front.page.about.us');
Route::post('/send-subscription-mail', function (Request $request) {
    $details = [
        'title' => 'Comunicazione da ZeepUp',
        'body' => 'Ti sei iscritto con successo alla newsletter di ZeepUp'
    ];
   $validator=Validator::make($request->all(), [
            'email' => 'required|email|unique:subscriptions,email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                        'error' => $validator->errors()->all()
                    ]);
        }
       $subscription=new Subscription();
		$subscription->email=$request->email;
		$subscription->save();
    Mail::to($request->email)->send(new \App\Mail\SubscriptionMail($details));

	return response()->json(['success' => 'Ti sei iscritto con successo alla newsletter di ZeepUp!']);
})->name("send-subcription-email");
// Super Admin Routes

Route::middleware(['auth', 'superadmin'])->group(function () {

    Route::get('super-admin/dashboard/', function () {return view('super-admin.index');})->name('super.admin.dashboard');
	// setting start
	Route::get('super-admin/settings/terms-and-conditions', [TermsAndConditionsController::class, 'index'])->name('super.admin.terms.and.conditions');
    Route::post('super-admin/settings/terms-and-conditions/save', [TermsAndConditionsController::class, 'save'])->name('super.admin.terms.and.conditions.save');

    Route::get('super-admin/settings/about-us', [AboutUsController::class, 'index'])->name('super.admin.about.us');
    Route::post('super-admin/settings/about-us/save', [AboutUsController::class, 'save'])->name('super.admin.about.us.save');

    Route::get('super-admin/settings/login-register-banner', [LoginRegisterBannerController::class, 'index'])->name('super.admin.login.register.banner');
    Route::post('super-admin/settings/login-register-banner/save', [LoginRegisterBannerController::class, 'save'])->name('super.admin.login.register.banner.save');

    Route::get('super-admin/settings/home-page-banner', [HomePageBannerController::class, 'index'])->name('super.admin.home.page.banner');
    Route::post('super-admin/settings/home-page-banner/save', [HomePageBannerController::class, 'save'])->name('super.admin.home.page.banner.save');

    Route::get('super-admin/settings/contact-us', [ContactUsController::class, 'index'])->name('super.admin.contact.us');
    Route::post('super-admin/settings/contact-us/save', [ContactUsController::class, 'save'])->name('super.admin.contact.us.save');
    Route::get('super-admin/settings/front-page-images', [FrontPagesController::class, 'FrontPageImagesIndex'])->name('super.admin.front.page.images');
	Route::post('super-admin/settings/front-page-images/save', [FrontPagesController::class, 'FrontPageImagesUpdate'])->name('super.admin.front.page.images.save');
    Route::get('super-admin/settings/popup-banner', [FrontPagesController::class, 'PopupBannerIndex'])->name('super.admin.popup.banner');
	Route::post('super-admin/settings/popup-banner/save', [FrontPagesController::class, 'PopupBannerUpdate'])->name('super.admin.popup.banner.save');

	// setting end

    Route::get("super-admin/ratings", [RatingController::class, 'index'])->name('super.admin.ratings.index');
    Route::post("super-admin/ratings/hide/{id}", [RatingController::class, 'hide'])->name('super.admin.ratings.hide');
    Route::post("super-admin/ratings/show/{id}", [RatingController::class, 'showRating'])->name('super.admin.ratings.show');
    Route::delete("super-admin/ratings/{id}", [RatingController::class, 'destroy'])->name('super.admin.ratings.destroy');

    // Account users start
    Route::get('super-admin/user/manage', [SuperAdminController::class, 'SuperUserIndex'])->name('super.user.index');
    Route::get('super-admin/customer/manage', [SuperAdminController::class, 'CustomerUserIndex'])->name('customer.user.index');
    Route::get('super-admin/{role}/add', [SuperAdminController::class, 'AddUser'])->name('add.user');
    Route::post('super-admin/user/store', [SuperAdminController::class, 'StoreUser'])->name('store.user');
    Route::get('super-admin/user/edit/{id}', [SuperAdminController::class, 'EditUser']);
    Route::get('super-admin/customer/edit/{id}', [SuperAdminController::class, 'EditCustomer']);
    Route::post('super-admin/super-user/update/{id}', [SuperAdminController::class, 'UpdateSuperUser']);
    Route::post('super-admin/customer/update/{id}', [SuperAdminController::class, 'UpdateCustomerUser']);
    Route::delete('super-admin/user/delete/{id}', [SuperAdminController::class, 'DeleteUser']);


		// Vendor

    Route::get('super-admin/vendor/manage', [SuperAdminController::class, 'VendorUserIndex'])->name('vendor.user.index');
    Route::get('super-admin/vendor/edit/{id}', [SuperAdminController::class, 'EditVendor'])->name('super.admin.edit.vendor');
    Route::post('super-admin/vendor/update/{id}', [SuperAdminController::class, 'UpdateVendor']);
    // Account users end

    // Eco wallet start
    Route::prefix('super-admin/eco-wallet')->group(function () {
        Route::get('/', [EcoWalletController::class, 'index'])->name('super.admin.eco-wallet.index');
        Route::get('/{itemId}', [EcoWalletController::class, 'edit'])->name('super.admin.eco-wallet.edit');
        Route::put('/{itemId}', [EcoWalletController::class, 'update'])->name('super.admin.eco-wallet.update');
    });
    // Eco wallet end

	//category
	Route::resource("categories",CategoryController::class);
	Route::resource("taxes",TaxController::class);
	Route::resource("subscriptions",SubscriptionController::class);

    Route::get('orders/cancelled', [OrdersController::class, 'OrdersCancelled'])->name('super.admin.orders.cancelled');
    Route::resource("orders",OrdersController::class);

});

// Super Admin Routes End



// Buyer Routes

Route::group(['prefix' => 'buyer', 'middleware' => 'auth:sanctum'], function () {

	//Payment Cards

    Route::get('cards/fetch/{id}', [PaymentCardController::class, 'AjaxGetPaymentCard'])->name('buyer.fetch.payment.card');
	Route::resource("cards",PaymentCardController::class);
    Route::resource("checkout",CheckoutController::class);
    Route::post('/submitorder', [CheckoutController::class, 'SubmitOrder'])->name('buyer.order.submit');
    Route::get('/submitsuccess', [CheckoutController::class, 'SubmitSuccess'])->name('buyer.order.submit-success');
    Route::get('/submitcancel', [CheckoutController::class, 'SubmitCancel'])->name('buyer.order.submit-cancel');

    Route::get('/stripepay', [CheckoutController::class, 'StripePay'])->name('buyer.stripe.form');
    /*Route::get('/stripepay', function () {
        return view('buyer.checkout.stripe');
    })->name('buyer.stripe.form');*/
    Route::post('/stripepost', [CheckoutController::class, 'stripePost'])->name('buyer.stripe.post');
    Route::post('/paypalnotify',[CheckoutController::class, 'PaypalNotify']);
    Route::get('/paypalconfirm',[CheckoutController::class, 'PaypalOrderConfirm']);
    Route::get('/stripeconfirm',[CheckoutController::class, 'StripeConfirm'])->name('buyer.stripe.confirm');
    Route::post('/getvendortime',[CheckoutController::class, 'GetVendorTime'])->name('buyer.get.vendor.time');


	#Manage Review
	Route::post('/review-store',[RatingController::class, 'reviewstore'])->name('review.store');
    Route::get('/review', function () {
        return view('buyer.review-test');
    });
    Route::get('/myorders', [BuyerOrdersController::class, 'index'])->name('buyer.orders');
    Route::post('myorders/detail', [BuyerOrdersController::class, 'OrderDetails'])->name('buyer.myorder.detail');
    Route::post('myorders/cancel', [BuyerOrdersController::class, 'OrderCancel'])->name('buyer.myorder.cancel');
	#Buyer order notifications
	Route::get('buyerfetchorderscollected', [BuyerOrdersController::class, 'BuyerCollectedOrdersCounter'])->name('buyer.fetch.orders.collected');

	Route::get('buyerneworderscountermarkread', [BuyerOrdersController::class, 'BuyerOrdersCounterMarkRead'])->name('buyer.orders.counter.mark.read');

	Route::post('buyerfetchorders', [BuyerOrdersController::class, 'BuyerFetchOrders'])->name('buyer.fetch.orders');
	 Route::get('myorders/cancelled', [BuyerOrdersController::class, 'OrdersCancelled'])->name('buyer.orders.cancelled');

});

// Buyer Routes End





Route::get('get-locations', [FrontPagesController::class, 'homesearch'])->name('homesearch');

Route::post('search-vendor', [CatSinglePageController::class, 'search_vendor'])->name('search_vendor');
Route::get('/get-items/{cuisine_id}', [CatSinglePageController::class, 'getItems'])->name('getItems');

Route::post('/cart/count', [CatSinglePageController::class, 'countcart'])->name('cart.count');
Route::post('/cart/decrement', [CatSinglePageController::class, 'decrement'])->name('cart.decrement');
Route::post('/cart/increment', [CatSinglePageController::class, 'increment'])->name('cart.increment');
Route::post('/cart/remove', [CatSinglePageController::class, 'removeItem'])->name('cart.remove');
Route::get('/cart', [CatSinglePageController::class, 'viewCart'])->name('cart.view');

Route::post('/cart/add',[CatSinglePageController::class, 'addItem'])->name('cart.add');
Route::get('items',[CatSinglePageController::class, 'index'])->name('cat_items');

Route::get('singleitems',[CatSinglePageController::class, 'singleitems'])->name('cat_singleitems');
Route::get('cuisine_items',[CatSinglePageController::class, 'cuisineItems'])->name('cat_cuisineItems');
Route::get('category',[FrontPagesController::class, 'category']);
Route::get('category2', function () {
    return view('front-end/category');
});

Route::get('view/all/categories', [RestaurantController::class,"allCategories"])->name("all.categories");
Route::get('category/{id}/restaurants', [RestaurantController::class,"index"])->name("category-restaurants");
Route::get('category/view/all/restaurants', [RestaurantController::class,"allRestaurants"])->name("all.restaurants");
Route::post('category/restaurants/filter', [RestaurantController::class,"filter"])->name("filter.category.restaurants");

Route::middleware(['auth:sanctum',config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
		 if (Auth::user()->email_verified_at == null) {
			  //auth()->logout();
    		  Session()->flush();
		  return redirect()->route('login')->with('message', 'Il tuo indirizzo email non è ancora stato verificato!');
		 }

		 if (Auth::user()->role == 'superadmin') {
		 return redirect('super-admin/dashboard/');
		 }
		else if (Auth::user()->role == 'vendor') {
			$cuisines=Cuisine::where(["vendor_id"=>Auth::user()->id,"status"=>1])->get();
			$menus=Menu::where(["vendor_id"=>Auth::user()->id,"status"=>1])->get();

			$data = App\Models\orders::select(DB::raw('count(id) as `orders`'), DB::raw("DATE_FORMAT(transactiontime, '%m-%Y') new_date"),  DB::raw('YEAR(transactiontime) year, MONTH(transactiontime) month'))
			->where('vendorid','=',Auth::user()->id)
			->where('status','=','paid')
->groupby('year','month')
->get();
		 $monthWiseArray = '';
        $monthWiseDateArray = '';
        foreach($data as $row){
            $monthWiseArray = $monthWiseArray.'"'.$row->orders.'",';
            $monthWiseDateArray = $monthWiseDateArray.'"'.$row->new_date.'",';
        }

		 return view('vendor.index',compact("cuisines","menus","monthWiseArray","monthWiseDateArray"));
		 }
		else{

			//return redirect(session('links')[2]);
			$cartItems = Session::get('cart.items', []);
			if(count($cartItems)){
			//	return redirect()->back();
			//return redirect()->route('checkout.index');
            return redirect()->intended();
			}
			 return redirect()->route('all.restaurants');
		 }
		//else{
		//	 return redirect('/');
		//}
        // return view('dashboard');
        //return view('vendor.index');
    })->name('dashboard');
	  Route::get('/buyer/dashboard', function () {
		return view('buyer.index');
    })->name('buyer.dashboard');
});

// Vendor Routes
Route::get('/vendor', function () {
    return view('vendor.index');
})->name('vendor.index');



Route::post('register',[UsersController::class, 'store']);
Route::post('verify-email',[UsersController::class, 'verifyEmail'])->name('verifyEmail');
Route::post('resend-code',[UsersController::class, 'resendCode'])->name('resendCode');
Route::post('register/vendor/ajax',[UsersController::class, 'storeVendorAjax'])->name('register.vendor.ajax');
Route::post('register/vendor/check/email/ajax',[UsersController::class, 'checkVendorAjaxEmail'])->name('check.vendor.ajax.email');
Route::get('logout', function ()
{
    auth()->logout();
    Session()->flush();

    return Redirect::to('/');
})->name('logout');
//Reset password
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('forgot.password');


// User Settings Start
Route::get('user/change/profile', [UserSettingController::class, 'ChangeImageIndex'])->name('change.profile.image');
Route::post('user/Update/profile', [UserSettingController::class, 'ChangeProfileImage'])->name('update.profile.image');
Route::get('user/settings', [UserSettingController::class, 'UserSettings'])->name('user.settings');
Route::get('vendor/profile/setting', [UserSettingController::class, 'VendorProfileSettings'])->name('vendor.profile.settings');
Route::post('vendor/profile/update', [UserSettingController::class, 'VendorProfileUpdate'])->name('vendor.profile.update');
Route::get('vendor/profile/image/remove/{key}', [UserSettingController::class, 'VendorProfileImageRemove'])->name('vendor.profile.image.remove');

// User Settings End
//vendor
Route::group(['prefix' => 'dashboard', 'middleware' => 'auth:sanctum'], function () {
Route::resource("dishes",DishController::class);
Route::resource("dish-categories",DishCategoriesController::class);
Route::resource("items",ItemsController::class);
Route::resource("cuisines",CuisineController::class);
Route::resource("special-taxes",SpecialTaxController::class);
Route::resource("menus",MenuController::class);
Route::post('myorders/detail', [MyOrdersController::class, 'OrderDetails'])->name('vendor.myorder.detail');
Route::post('myorders/changestatus', [MyOrdersController::class, 'ChangeStatus'])->name('vendor.myorder.changestatus');
Route::get('myorders/order/view/{id}', [MyOrdersController::class, 'ViewOrder'])->name('vendor.myorder.view.order');
Route::get('myorders/order/download/{id}', [MyOrdersController::class, 'DownloadOrder'])->name('vendor.myorder.download.order');
Route::get('myorders/reports', [MyOrdersController::class, 'VendorReports'])->name('vendor.myorder.reports');
Route::post('myorders/reports/filter', [MyOrdersController::class, 'VendorOrdersReportsFilter'])->name('vendor.myorder.reports.filters');
Route::post('myorders/cancel', [MyOrdersController::class, 'OrderCancel'])->name('vendor.myorder.cancel');

 Route::get('orders/canceled', [MyOrdersController::class, 'OrdersCancelled'])->name('vendor.orders.cancelled');

Route::resource("myorders",MyOrdersController::class);
Route::resource("menu-items",MenuItemsController::class);
Route::post('menu-items/checkepiry',[MenuItemsController::class, 'CheckExpiry'])->name('menu-items.checkexpiry');
Route::resource("availability",VendorAvailabilityController::class);
Route::get('vendorstripe/thankyou', [VendorStripeController::class, 'thankyou'])->name('vendorstripe.thankyou');

Route::get('vendorstripe/validation/{code}', [VendorStripeController::class, 'vendorValidation'])->name('vendorstripe.validation');

Route::resource("vendorstripe",VendorStripeController::class);

Route::post('update/payment/password', [UserSettingController::class, 'updateVendorPaymentPassword'])->name('update.vendor.payment.password');




Route::post('vendorfetchorders', [MyOrdersController::class, 'VendorFetchOrders'])->name('vendor.fetch.orders');
Route::get('vendorfetchneworderscounter', [MyOrdersController::class, 'VendorNewOrdersCounter'])->name('vendor.fetch.new.orders.counter');
Route::get('vendorneworderscountermarkread', [MyOrdersController::class, 'VendorNewOrdersCounterMarkRead'])->name('vendor.new.orders.counter.mark.read');
Route::get('mark/order/collected/{id}', [MyOrdersController::class, 'MarkOrderCollected'])->name('mark.order.collected');


Route::get('manage/menu-items/remove/{id}', [ItemsController::class, 'RemoveMenuItemImage'])->name('remove.menu.item.image');

Route::get('manage/menu-items/{id}', [MenuItemsController::class, 'ManageMenuItems'])->name('manage.menu.items');

Route::get('items/fetch/ajax',[ItemsController::class,'FetchAjaxItems'])->name('fetch.items.ajax');
Route::post('vendor/filled-items/counter/mark-read', [ItemsController::class, 'VendorFilledItemsCounterMarkRead'])->name('vendor.filled.items.counter.mark.read');
Route::get('vendor/filled-items/counter/counter', [ItemsController::class, 'VendorFilledItemsCounter'])->name('vendor.filled.items.counter');


	//Ratings

	Route::get('/ratings',[RatingController::class, 'vendorViewRatings'])->name('vendor.view.ratings');
	Route::get('/ratings/reply',[RatingController::class, 'vendorReplyRatings'])->name('vendor.reply.ratings');

});


Route::get('/terms-and-conditions-pdf', function () {
    $terms = DB::table('terms_and_conditions')->first();
		if($terms){
		return view('super-admin.settings.terms-and-conditions-pdf', compact('terms'));
		}
		else{
		return view('super-admin.settings.terms-and-conditions-pdf');
		}
})->name('terms.and.conditions.pdf');

//verify Account
Route::get('account/verify/{token}', [UsersController::class, 'verifyAccount'])->name('user.verify');
// Send support ticket mail
Route::post('/support-ticket', function (Request $request) {

	$typeofrequest = ($request->input('typeofrequest') ? (implode(',', $request->input('typeofrequest'))) : null);
	$imageName = 'no image';
	if(isset($request->image)){
		 $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
		$imageName = 'images/support-ticket/'.time().'.'.$request->image->extension();
		$request->image->move(public_path('images/support-ticket'), $imageName);
	}
    $details = [
        'typeofrequest' => $typeofrequest,
        'other' =>  $request->other,
        'id' => Auth::user()->id,
        'name' => Auth::user()->name,
        'business_description' => Auth::user()->business_description,
        'email' => Auth::user()->email,
        'phone' => Auth::user()->phone,
        'country' => Auth::user()->country,
        'state' => Auth::user()->state,
        'city' => Auth::user()->city,
        'zipcode' => Auth::user()->zipcode,
        'details' =>  $request->details,
		'selectedorder' => $request->selectedorder,
        'file' =>  $imageName
    ];

    \Mail::to('customerservice@zeepup.com')->send(new \App\Mail\SupportTicket($details));
  // \Mail::to('nomanali7788459@gmail.com')->send(new \App\Mail\SupportTicket($details));
	$notifications = array(
				'message' => 'Ticket di supporto creato con successo',
				'alert-type' => 'success'
			);
			 return redirect()->back()->with($notifications);
})->name("support-ticket");


// Send support ticket of buyer to super admin mail start
Route::post('/buyer-support-ticket', function (Request $request) {
	if($request->has('image')) {
	  $request->validate([
				'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
			]);

	$imageName = 'images/support-ticket/'.time().'.'.$request->image->extension();
        $request->image->move(public_path('images/support-ticket'), $imageName);
	}
	else{
	$imageName = null;
	}

	$typeofrequest =  $request->input('typeofrequest');
    $details = [
        'typeofrequest' => $typeofrequest,
        'selectedoption' =>  $request->selectedoption,
        'id' => Auth::user()->id,
        'name' => Auth::user()->name,
        'email' => Auth::user()->email,
        'phone' => Auth::user()->phone,
        'country' => Auth::user()->country,
        'state' => Auth::user()->state,
        'city' => Auth::user()->city,
        'details' =>  $request->details,
        'file' =>  $imageName
    ];

     \Mail::to('customerservice@zeepup.com')->send(new \App\Mail\BuyerSupportTicket($details));
   // \Mail::to('nomanali7788459@gmail.com')->send(new \App\Mail\BuyerSupportTicket($details));
	$notifications = array(
				'message' => 'Ticket di supporto creato con successo.',
				'alert-type' => 'success'
			);
			 return redirect()->back()->with($notifications);
})->name("buyer.support.ticket");



// Send support ticket of buyer to super admin mail end





// Send Contact us to super admin mail start
Route::post('/contact-us', function (Request $request) {

    $details = [
        'name' => $request->name,
        'email' => $request->email,
        'subject' => $request->subject,
        'message' =>  $request->message
    ];

     \Mail::to('info@zeepup.com')->send(new \App\Mail\ContactUs($details));
  //  \Mail::to('nomanali7788459@gmail.com')->send(new \App\Mail\ContactUs($details));
	$notifications = array(
				'message' => 'Messaggio inviato con successo.',
				'alert-type' => 'success'
			);
			 return redirect()->back()->with($notifications);
})->name("contact.us");



// Send Contact us to super admin mail end



// Clear Route Cache from Browser

 Route::get('/route-cache', function() {
     $exitCode = Artisan::call('route:cache');
     return 'Routes cache cleared';
 });
// Clear Config Cache from Browser

 Route::get('/config-cache', function() {
     $exitCode = Artisan::call('config:cache');
     return 'Config cache cleared';
 });
// Clear Application Cache from Browser

 Route::get('/clear-cache', function() {
     $exitCode = Artisan::call('cache:clear');
     return 'Application cache cleared';
 });
// Clear View Cache from Browser

 Route::get('/view-clear', function() {
     $exitCode = Artisan::call('view:clear');
     return 'View cache cleared';
 });
