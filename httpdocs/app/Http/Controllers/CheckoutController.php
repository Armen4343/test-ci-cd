<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\orders;
use App\Models\orderitems;
use App\Models\VendorAvailability;
use Auth;
use Stripe;
use App\Models\Items;
use DB;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CheckoutController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		//$cards=PaymentCard::where("buyer_id",Auth::user()->id)->get();

        $thisUser = User::where('id', Auth::user()->id)->first();
        $cartItems = Session::get('cart.items', []);
        $nVendorID = 0;
        foreach($cartItems as $itemkey=>$itemval)
        {
            $nVendorID = $itemval['vendor'];
            break;
        }
        $vendor = null;
        if($nVendorID>0)
        {
            $vendor = User::where('id', $nVendorID)->with('vendorsAvailabilities')->first();
        }

        return view('buyer.checkout.index',compact("cartItems", "thisUser", "vendor"));

    }

    public function show($nVendorID)
    {
        //
		//$cards=PaymentCard::where("buyer_id",Auth::user()->id)->get();

        $thisUser = User::where('id', Auth::user()->id)->first();
        $cartItems = Session::get('cart.items', [])["$nVendorID"];
        foreach($cartItems as $itemkey=>$itemval)
        {
            $nVendorID = $itemval['vendor'];
            break;
        }
        if($nVendorID>0)
        {
            $vendor = User::where('id', $nVendorID)->first();
        }
        $startDate = null;
        $endDate = null;
        $startTime = null;
        $endTime = null;
        $filteredAvailableDays = null;
        if (count($cartItems) > 1){
            $filteredItems = array_filter($cartItems, function($item) {
                return isset($item['dateRange']) && $item['dateRange'] !== null;
            });

            if (count($filteredItems) > 1){

                $dateRanges = Arr::pluck($cartItems,'dateRange');

                $dateRanges = array_map(function ($dates) {
                    return explode(' - ', $dates);
                }, $dateRanges);

                $startDate = Carbon::createFromDate($dateRanges[0][0]);
                $endDate = isset($dateRanges[0][1]) && $dateRanges[0][1] ?  Carbon::createFromDate($dateRanges[0][1]) : null;

                foreach ($dateRanges as $date) {
                    if (Carbon::createFromDate($date[0]) > $startDate) {
                        $startDate = Carbon::createFromDate($date[0]);
                    }

                    if (Carbon::createFromDate($date[1]) < $endDate) {
                        $endDate = Carbon::createFromDate($date[1]);
                    }
                }

                if ($startDate > $endDate) {
                    $startDate = null;
                    $endDate = null;
                }else {
                    $startDate = $startDate->format('d/m/y');
                    $endDate = $endDate->format('d/m/y');
                }

                $promoDaysArray = Arr::pluck($filteredItems, 'promoDays');

                $promoDaysArrays = array_map(function ($days) {
                    return array_map('strtolower', explode(',', $days));
                }, $promoDaysArray);

                $commonPromoDays = array_shift($promoDaysArrays);

                foreach ($promoDaysArrays as $days) {
                    $commonPromoDays = array_intersect($commonPromoDays, $days);
                }

                $filteredAvailableDays = array_values($commonPromoDays);


                $timeRanges = Arr::pluck($cartItems, 'timeRange');
                $filteredTimeRanges = array_filter($timeRanges, fn($timeRange) => str_contains($timeRange, '-'));
                $timeRanges = array_map(fn($timeRange) => explode('-', $timeRange), $filteredTimeRanges);

                $startTime = null;
                $endTime = null;

                foreach ($timeRanges as $index => $time) {
                    if (count($time) != 2) {
                        continue;
                    }

                    try {
                        $currentStartTime = Carbon::createFromTimeString(trim($time[0]));
                        $currentEndTime = Carbon::createFromTimeString(trim($time[1]));
                    } catch (Exception $e) {
                        continue;
                    }

                    if ($index == 0) {
                        $startTime = $currentStartTime;
                        $endTime = $currentEndTime;
                    } else {
                        if ($currentStartTime > $startTime) {
                            $startTime = $currentStartTime;
                        }
                        if ($currentEndTime < $endTime) {
                            $endTime = $currentEndTime;
                        }
                    }
                }

                if ($startTime && $endTime && $startTime > $endTime) {
                    $startTime = null;
                    $endTime = null;
                } else {
                    if ($startTime) {
                        $startTime = $startTime->format('H:i');
                    }
                    if ($endTime) {
                        $endTime = $endTime->format('H:i');
                    }
                }
            }
        }


        return view('buyer.checkout.index',compact("cartItems", "thisUser", "vendor","startDate",
            "endDate","filteredAvailableDays","startTime","endTime"));

    }

    public function SubmitOrder(Request $request)
    {
        date_default_timezone_set("Europe/Rome");
        $strName = $request->username;
        $strEmail = $request->useremail;
        $strAddress = $request->useraddress;
        $strZipCode = $request->userzip;
        $strUserCity = $request->usercity;
        $strUserState = $request->userstate;
        $strUserPhone = $request->userphone;
        $strDeliveryTime = $request->strDeliveryTime;
        $strDeliveryDate = $request->strDeliveryDate;
        $paymentmethod = strtolower($request->paymentmethod);
        $vendorid = $request->nVendor;
        $cartItems = Session::get('cart.items', [])["$vendorid"];
        $total = 0;

        $dateObject = DateTime::createFromFormat('d/m/Y', $strDeliveryDate);
        if ($dateObject !== false) {
            $strDeliveryDate = $dateObject->format('Y-m-d');
        }

        if(strtotime($strDeliveryDate." ".$strDeliveryTime)<=strtotime(date("Y-m-d H:i:s")))
        {
            return back()->with(['status'=>"failed", "message"=>"Data di ritiro gia' passata!"]);
        }
        //$vendorid = 0;
        /*foreach($cartItems as $itemid=>$item)
        {
            $vendorid = $item['vendor'];
            $total = $total + $item['price'];
        }*/
        if(count($cartItems)>0)
        {
            $arrOrderData = array(
                "userid" => Auth::user()->id,
                "vendorid" => $vendorid,
                "total"=>$total,
                "status"=>"no",
                "payment_type"=>$paymentmethod,
                "transactiontime"=>date("Y-m-d H:i:s"),
                "creditcardtime"=>date("Y-m-d H:i:s"),
                "address"=>$strAddress,
                "name"=>$strName,
                "city"=>$strUserCity,
                "state"=>$strUserState,
                "zipcode"=>$strZipCode,
                "phone"=>$strUserPhone,
                "delivery_time"=>$strDeliveryTime,
                "delivery_date"=>$strDeliveryDate
            );

            $order = orders::create($arrOrderData);
            $nOrderID = $order->id;
            $nLoop = 0;
            $strOrderID = $nOrderID;
			$nTotalTax = 0;
            foreach($cartItems as $itemid=>$item)
            {
                if($nLoop==0)
                {
                    $vendorid = $item['vendor'];
                    $nLoop++;
                }
                $arrItem = array(
                    "itemid"=>$itemid,
                    "vendorid"=>$item['vendor'],
                    "unit_price"=>$item['unitprice'],
                    "quantity"=>$item['quantity'],
                    "total_price"=>$item['price'],
                    "item_type"=>$item['item_type'],
                    "order_id"=>$nOrderID);
                $total = $total + $item['price'];
				if(isset($item['tax']) && $item['tax']>0)
				{
					$nTempTotalPrice = $item['unitprice'];
					if(isset($item['discount']) && $item['discount']>0)
					{
						$nTempTotalPrice = $item['unitprice'] - ($item['discount'] / 100) * $item['unitprice'];
					}
					$nTempTotalPrice = $nTempTotalPrice * $item['quantity'];
					$nTaxAmount = $nTempTotalPrice * $item['tax']/100;
					$nTotalTax = $nTotalTax + $nTaxAmount;
				}
                orderitems::create($arrItem);

			}

            while(strlen($strOrderID)<4)
            {
                $strOrderID = "0".$strOrderID;
            }
            $strOrderNumber = "ZeepUp-".$strOrderID;
            $arrUpdate = array("vendorid" => $vendorid, "total"=>$total, "order_number"=>$strOrderNumber);
            orders::where('id',$nOrderID)->update($arrUpdate);
            if($paymentmethod=='Paypal')
            {
                return response()->json(['status'=>"success", "orderid"=>$strOrderNumber, "amount_1"=>$total]);
            }
            else{
                $line_items = [];
                foreach($cartItems as $cartItem) {
                    $line_items[] = [
                        'price_data' => [
                            'currency' => 'EUR',
                            'product_data' => [
                                'name' => $cartItem['name'],
                                'images' => [$cartItem['image']]
                            ],
                            'unit_amount' => $cartItem['unitprice'] * 100
                        ],
                        'quantity' => $cartItem['quantity'],
                    ];
                }

                \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

                $customer = Stripe\Customer::create(array(
                    "address" => [
                        "postal_code" => $strZipCode,
                        "city" => $strUserCity,
                        "state" => $strUserState,
                        "country" => 'United States',
                    ],
                    "email" => $strEmail,
                    "name" => $strName,
                ));

                $vendor = User::where('id', $vendorid)->first();

                $nCommission = 15;

                if($vendor->vendor_commission && $vendor->vendor_commission > 0)
                {
                    $nCommission = $vendor->vendor_commission;
                }
           
                $zeepUpCommission = round($total * $nCommission / 100, 2);
                $vat = round($zeepUpCommission * 22 / 100, 2);
    
                $nAppCommission = $zeepUpCommission + $vat;
                $nAppCommission = round($nAppCommission, 2);

                try {
                    if ($vendor->stripe_account_id) {
                        $session = \Stripe\Checkout\Session::create([
                            'line_items' => $line_items,
                            'mode' => 'payment',
                            'customer' => $customer->id,
                            "payment_intent_data" => [
                                "application_fee_amount" => $nAppCommission * 100,
                                "description" => "Payment for " . $strOrderNumber . " at ZeepUp",
                                "capture_method" => "manual",
                                "shipping" => [
                                    "name" => "Jenny Rosen",
                                    "address" => [
                                        "line1" => \Illuminate\Support\Facades\Auth::user()->address ?? $strAddress ?? $vendor->address,
                                        "postal_code" => $order->zipcode,
                                        "city" => $order->city,
                                        "state" => $order->state,
                                        "country" => \Illuminate\Support\Facades\Auth::user()->country,
                                    ],
                                ],
                                "transfer_data" => [
                                    "destination" => $vendor->stripe_account_id
                                ],
                            ],
                            'allow_promotion_codes' => true,
                            'locale' => 'it',
                            'success_url' => route('buyer.order.submit-success', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
                            'cancel_url' => route('buyer.order.submit-cancel', [], true) . '?vendor_id=' . $vendorid
                        ]);

                    } else {
                        $session = \Stripe\Checkout\Session::create([
                            'line_items' => $line_items,
                            'mode' => 'payment',
                            'customer' => $customer->id,
                            "payment_intent_data" => [
                                "description" => "Payment for ".$strOrderNumber." at ZeepUp" ,
                                "capture_method" => "manual",
                                "shipping" => [
                                    "name" => "Jenny Rosen",
                                    "address" => [
                                        "line1" => \Illuminate\Support\Facades\Auth::user()->address ?? $strAddress ?? $vendor->address,
                                        "postal_code" => $order->zipcode,
                                        "city" => $order->city,
                                        "state" => $order->state,
                                        "country" => \Illuminate\Support\Facades\Auth::user()->country,
                                    ],
                                ],
                            ],
                            'allow_promotion_codes' => true,
//                        'locale' => 'it',
                            'success_url' => route('buyer.order.submit-success', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
                            'cancel_url' => route('buyer.order.submit-cancel', [], true) . '?vendor_id=' . $vendorid
                        ]);
                    }

                    orders::where('id',$nOrderID)->update(['session_id' => $session->id]);
                    //return view('buyer.checkout.stripe',compact('total', 'strOrderNumber'));
                    Session::put('cart.ordernumber', $strOrderNumber);
                    Session::put('cart.totaltax', round($nTotalTax,2));

                    return redirect($session->url);

//                return response()->json(['status'=>"success", "orderid"=>$strOrderNumber, "amount_1"=>$total, "totaltax"=>$nTotalTax]);

                } catch (\Exception $e) {
                    return back()->with(['status'=>"failed", "message" => $e->getMessage()]);
                }
            }
        }
        else {
            return back()->with(['status'=>"failed", "message"=>"Carrello vuoto"]);
        }
    }

    public function SubmitSuccess(Request $request) {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $sessionId = $request->get('session_id');

        try {
            $session = \Stripe\Checkout\Session::retrieve($sessionId);
            if (!$session) {
                throw new NotFoundHttpException();
            }
            $customer = \Stripe\Customer::retrieve($session->customer);
            $order = orders::where('session_id', $session->id)->first();

            if (!$order) {
                throw new NotFoundHttpException();
            }
            if ($order->status === 'no') {
                $order->total = $session->amount_total / 100;

                if ($session->payment_intent) {
                    $order->strip_id = $session->payment_intent;
                }

                $order->status = 'paid';
                $order->creditcardtime = date("Y-m-d H:i:s");
                $order->save();

                $tempOrderItems = DB::table('orderitem')
                    ->where('order_id', '=', $order->id)
                    ->get();

                if (count($tempOrderItems) === 1) {
                    orderitems::where('id', $tempOrderItems[0]->id)->update(['total_price' => $session->amount_total / 100]);
                }

                foreach($tempOrderItems as $tempSingleItem){
                    if($tempSingleItem->item_type=='single'){
                        DB::table('items')->where("id",'=',$tempSingleItem->itemid)->decrement('quantity', $tempSingleItem->quantity);
                    }
                }

                $details = [
                    'orderid' => $order->id,
                    'message' => "Grazie per il tuo ordine",
                    'vendorid' =>  $order->vendorid
                ];

                $user = User::find($order->userid);

                Mail::to($user->email)->send(new \App\Mail\OrderReceipt($details));

                $msg = "Un nuovo ordine e' stato eseguito da ". $user->name. " da ritirarsi in data ".
                    date('d-M-Y', strtotime($order->delivery_date))." ".$order->delivery_time;
                $details = [
                    'orderid' => $order->id,
                    'message' => $msg,
                    'buyerid' =>  $order->userid
                ];
                $vendor = User::find($order->vendorid);
                Mail::to($vendor->email)->send(new \App\Mail\OrderVendorReceipt($details));
            }

            Session::flash('success', 'Pagamento eseguito con successo!');
            Session::flash('strOrderNumber', $order->order_number);

            return $this->StripeConfirm();

        } catch (\Exception $e) {
            dd($e);
            throw new NotFoundHttpException();
        }
    }

    public function SubmitCancel(Request $request) {
        $vendor_id = $request->get('vendor_id');
        return redirect(route('checkout.show', $vendor_id));
    }

    public function StripePay()
    {
        $strOrderNumber = Session::get('cart.ordernumber');
        $order = orders::where('order_number', $strOrderNumber)->first();
        $total = $order->total;
        return view('buyer.checkout.stripe',compact('total', 'strOrderNumber'));
    }

    public function stripePost(Request $request)
    {
        $strOrderNumber = Session::get('cart.ordernumber');
		//$totaltax = Session::get('cart.totaltax');
        $totaltax = 0;
        $order = orders::where('order_number', $strOrderNumber)->first();
        $total = $order->total;
        $stripefee = round(($total * 2.9/100)+0.30, 3);
        $nOrderID = $order->id;

        $nVendorID = $order->vendorid;
        $vendor = User::where('id', $nVendorID)->first();
        $strAccountID = "";
        $nCommission = 1;
        if($vendor->stripe_account_id!="")
        {
            $strAccountID = $vendor->stripe_account_id;
        }
        if($vendor->vendor_commission && $vendor->vendor_commission>0)
        {
            $nCommission = $vendor->vendor_commission;
        }
        $nAppCommission = round(($total-$totaltax) * $nCommission/100, 3);
        $nAppCommission = $nAppCommission + $totaltax + $stripefee;
        $nAppCommission = round($nAppCommission, 2);

       // $nBuyerID = $order->userid;
        $buyer = User::where('id', Auth::user()->id)->first();
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $strErrorMessage = "";
        $status = "";
        try {
            // Use Stripe's library to make requests...
            $customer = Stripe\Customer::create(array(
                "address" => [
                    "postal_code" => $buyer->zipcode,
                    "city" => $buyer->city,
                    "state" => $buyer->state,
                    "country" => $buyer->country,
                ],
                "email" => $buyer->email,
                "name" => $buyer->name,
                "source" => $request->stripeToken
            ));
            if($strAccountID!="")
            {
				$objCharge = Stripe\Charge::create ([
                        "amount" => $total * 100,
                        "currency" => "eur",
                    // "source" => $request->stripeToken,
                        "customer" => $customer->id,
                        "description" => "Pagamento per ".$strOrderNumber." a ZeepUp" ,
						"application_fee_amount" => $nAppCommission * 100,
                        "shipping" => [
                            "name" => "Jenny Rosen",
                            "address" => [
                                "line1" => $order->address,
                                "postal_code" => $order->zipcode,
                                "city" => $order->city,
                                "state" => $order->state,
                                "country" => $buyer->country,
                            ],
                        ],
                        "transfer_data" => [
                            "destination"=>$strAccountID
                        ],
                        /*"payment_method_options" => [
                            "card" => [
                                "capture_method" => "manual",
                            ],
                        ],*/
                        "capture" => false


                        //["stripe_account"=>$strAccountID]

                ]);
            }
            else {
                $objCharge = Stripe\Charge::create ([
                        "amount" => $total * 100,
                        "currency" => "eur",
                    // "source" => $request->stripeToken,
                        "customer" => $customer->id,
                        "description" => "Pagamento per ".$strOrderNumber." a ZeepUp" ,
						"application_fee_amount" => $nAppCommission * 100,
                        "shipping" => [
                            "name" => "Jenny Rosen",
                            "address" => [
                                "line1" => $order->address,
                                "postal_code" => $order->zipcode,
                                "city" => $order->city,
                                "state" => $order->state,
                                "country" => $buyer->country,
                            ],
                        ],
                        "capture"=>false,
                ]);
            }

            if($objCharge->status=="succeeded" || $objCharge->status=="pending")

            {
                $arrUpdate = array("status"=>'paid', "payment_type"=>"stripe",
                    "creditcardtime"=>date("Y-m-d H:i:s"), "card4"=>$objCharge->source->last4,
                    "cardtype"=>$objCharge->source->brand, "strip_id"=>$objCharge->id);
                orders::where('id',$nOrderID)->update($arrUpdate);


				$tempOrderItems = DB::table('orderitem')
				->where('order_id', '=', $nOrderID)
				->get();
				foreach($tempOrderItems as $tempSingleItem){
				DB::table('items')->where("id",'=',$tempSingleItem->itemid)->decrement('quantity', $tempSingleItem->quantity);
				}

						$order = orders::where('id', $nOrderID)->first();
						$vendor = User::where('id', $order->vendorid)->first();
						$buyer = User::where('id', $order->userid)->first();
						  $details = [
							'orderid' => $nOrderID,
							'message' => "Grazie per il tuo ordine",
							'vendorid' =>  $order->vendorid
							];

						Mail::to($buyer->email)->send(new \App\Mail\OrderReceipt($details));

						$msg = "Un nuovo ordine e' stato effettuato da  ".$buyer->name." da ritirarsi il ".
							  date('d-M-Y', strtotime($order->delivery_date)).$order->delivery_time;
						 $details = [
                                        'orderid' => $nOrderID,
										'message' => $msg,
                                        'buyerid' =>  $order->userid
									];
						Mail::to($vendor->email)->send(new \App\Mail\OrderVendorReceipt($details));




                Session::flash('success', 'Pagamento eseguito con successo!');
                Session::flash('strOrderNumber', $strOrderNumber);
                //return view('buyer.checkout.paymentsuccessful');
                $status = "success";
                return response()->json(['status'=>$status, 'message'=>'Pagamento eseguito con successo. Ora sarai reindirizzato, per favore aspetta!']);
            }
        }
        catch(Stripe\Exception\CardException $e) {
            // Since it's a decline, \Stripe\Exception\CardException will be caught
            //echo 'Status is:' . $e->getHttpStatus() . '\n';
            //echo 'Type is:' . $e->getError()->type . '\n';
            //echo 'Code is:' . $e->getError()->code . '\n';
            // param is '' in this case
            //echo 'Param is:' . $e->getError()->param . '\n';
            //echo 'Message is:' . $e->getError()->message . '\n';
            $strErrorMessage = $e->getError()->message;
        }
        catch (Stripe\Exception\RateLimitException $e) {
            // Too many requests made to the API too quickly
            $strErrorMessage = $e->getError()->message;
        }
        catch (Stripe\Exception\InvalidRequestException $e) {
            // Invalid parameters were supplied to Stripe's API
            $strErrorMessage = $e->getError()->message;
        }
        catch (Stripe\Exception\AuthenticationException $e) {
            // Authentication with Stripe's API failed
            // (maybe you changed API keys recently)
            $strErrorMessage = $e->getError()->message;
        }
        catch (Stripe\Exception\ApiConnectionException $e) {
            // Network communication with Stripe failed
            $strErrorMessage = $e->getError()->message;
        }
        catch (Stripe\Exception\ApiErrorException $e) {
            // Display a very generic error to the user, and maybe send
            // yourself an email
            $strErrorMessage = $e->getError()->message;
        }
        catch (Exception $e) {
            // Something else happened, completely unrelated to Stripe
            $strErrorMessage = $e->getError()->message;
        }
        if($strErrorMessage=="")
        {
            $strErrorMessage = "C'e' stato un errore durante il processo di pagamento. Per favore contatta il tuo amministratore!";
        }


        {
            //Session::flash('success', 'Payment successful!');
            //return view('buyer.checkout.paymenterror', compact('strErrorMessage'));
            return response()->json(['status'=>"error", 'message'=>$strErrorMessage]);
        }
        //return back();
    }

    public function PaypalNotify(Request $request)
    {
        $raw_post_data = file_get_contents( 'php://input' );
        $raw_post_array = explode( '&', $raw_post_data );
        $myPost = array();
        foreach( $raw_post_array as $keyval ) {
            $keyval = explode( '=', $keyval );
            if( count( $keyval ) == 2 )
                $myPost[ $keyval[ 0 ] ] = urldecode( $keyval[ 1 ] );
        }

        $req = 'cmd=_notify-validate';

        foreach( $myPost as $key => $value ) {
            /*if( $get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1 ) {
                $value = urlencode( stripslashes( $value ) );
            } else {*/
                $value = urlencode( $value );
            //}
            $req .= "&$key=$value";
        }
        sleep(5);
        // Send validation
        $ch = curl_init( 'https://www.sandbox.paypal.com/cgi-bin/webscr' );

        curl_setopt( $ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1 );
        curl_setopt( $ch, CURLOPT_POST, 1 );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $req );
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 1 );
        curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 2 );
        curl_setopt( $ch, CURLOPT_FORBID_REUSE, 1 );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array( 'Connection: Close' ) );

        if( !($res = curl_exec( $ch )) ) {
            curl_close( $ch );
            exit;
        }
        curl_close( $ch );

        // Inspect IPN validation result
        // Split response headers and payload, a better way for strcmp
        $tokens = explode( "\r\n\r\n", trim( $res ) );
        $res = trim( end( $tokens ) );

        // Handshake verified
        if( strcmp( $res, "VERIFIED" ) == 0 ) {
            // Do some checks with the returned data
            //$check = $this->check_data( $_POST );
            $txn_id = $_POST['txn_id'];
            $invoice = $_POST['invoice'];
            if($invoice>0)
            {
                $arrUpdate = array('paypal_id'=>$txn_id, "creditcardtime"=>date("Y-m-d H:i:s"));
                orders::where('order_number',$invoice)->update($arrUpdate);
            }

        }
        // Handshake denied
        else if( strcmp( $res, "INVALID" ) == 0 ) {

           // error_log( date( '[Y-m-d H:i e] ' ) . "Invalid IPN: $req" . PHP_EOL, 3, IPN_LOG_FILE );
        }
    }

    public function PaypalOrderConfirm(Request $request)
    {
        Session::forget('cart.items');
        return view('buyer.checkout.paypalconfirm');
    }

    public function StripeConfirm()
    {
        $strOrderNumber = Session::get('cart.ordernumber');
        $order = orders::where('order_number',$strOrderNumber)->get();
        $thisOrder = $order[0];
        Session::forget('cart.items');
        return view('buyer.checkout.stripeconfirm', compact('strOrderNumber', 'thisOrder'));
    }

    public function GetVendorTime(Request $request)
    {
        $cartItems = Session::get('cart.items', [])["$request->nVendor"];
        $strMinDate = "";
        if (count($cartItems) > 0) {
            foreach($cartItems as $itemid => $item) {
                if ($strMinDate=="") {
                    if(trim($item['expiry_date'])!="") {
                        $strMinDate = $item['expiry_date'];
                    }
                } else {
                    if(trim($item['expiry_date'])!="" && strtotime($item['expiry_date'])<strtotime($strMinDate)) {
                        $strMinDate = $item['expiry_date'];
                    }
                }
            }
        }
        $strDate = $request->strDate;

        $dateObject = DateTime::createFromFormat('d/m/Y', $strDate);
        if ($dateObject !== false) {
            $strDate = $dateObject->format('Y-m-d');
        }

        if(trim($strMinDate)!="" && strtotime($strMinDate)<strtotime($strDate))
        {
            return response()->json(['Error'=>"La data di ritiro del prodotto non può essere successiva alla scadenza del prodotto stesso. "]);
        }
        else {
            $nVendor = $request->nVendor;
            $strOpenTime = "09:00";
            $strCloseTime = "23:00";
            $strDay = strtolower(date("l", strtotime($strDate)));

            $availability = VendorAvailability::where('vendor_id', $nVendor)->get();

            if(count($availability)>0)
            {
                $vendorData = $availability[0];
                date_default_timezone_set('Europe/Rome');
                $strOpenTime = date("H:i",strtotime($strDate . " " . $vendorData[$strDay.'_open']));
                if(strtotime($strDate." ".$vendorData[$strDay.'_open']) <= strtotime(date("Y-m-d H:i:s")))
                {
                    $strOpenTime = date("H:i",strtotime(date("Y-m-d H:i:s")));
                    $seconds = strtotime($strOpenTime);
                    $rounded_seconds = ceil($seconds / (15 * 60)) * (15 * 60);

                    //echo "Original: " . date('H:i', $seconds) . "\n";
                    //echo "Rounded: " . date('H:i', $rounded_seconds) . "\n";
                    //exit;
                    $strOpenTime = date('H:i', $rounded_seconds) . "\n";
                    //exit;
                }
                $strCloseTime = date("H:i",strtotime($strDate." ".$vendorData[$strDay.'_close']));
            }
            return response()->json(['strOpenTime'=>$strOpenTime, 'strCloseTime'=>$strCloseTime]);
        }

    }
}
