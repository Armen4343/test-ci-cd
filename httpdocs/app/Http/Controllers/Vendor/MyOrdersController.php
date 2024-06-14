<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\orders;
use App\Models\orderitems;
use App\Models\Items;
use App\Models\Menu;
use App\Models\MenuItems;
use App\Models\User;
use App\Models\Tax;
use Auth;
use DB;
use Carbon;
use Illuminate\Support\Facades\Mail;
use Stripe\Charge; // Import the Stripe Charge class
use Stripe\Stripe;

class MyOrdersController extends Controller
{
    //
    public function index()
    {
        $orders = DB::select("SELECT tblorder.id, tblorder.total, tblorder.status, tblorder.payment_type, tblorder.creditcardtime,tblorder.collectiontime, tblorder.order_number, tblorder.name,
        tblorder.collected, tblorder.delivery_date, tblorder.delivery_time, COALESCE(SUM(items.co2_avg), 0) as co2_avg , COALESCE(SUM(items.h2o_avg), 0) as h2o_avg
        FROM `tblorder`
        JOIN  users cust ON cust.id = tblorder.userid
        LEFT JOIN orderitem ON orderitem.order_id = tblorder.id
        LEFT JOIN items ON items.id = orderitem.itemid    
        WHERE tblorder.`status`='paid'
        and cust.id=tblorder.userid
        and tblorder.vendorid=".Auth::user()->id
        ." GROUP BY tblorder.order_number order by tblorder.id DESC");
       // ." order by tblorder.delivery_date DESC");
       $vendor = User::where('id',Auth::user()->id)->first();

       $objTax = Tax::where('state', $vendor->state)->first();

        $arrItems = array();
        foreach($orders as $thisorder)
        {
            $nOrderID = $thisorder->id;
            $orderItems = DB::select("Select items.name from items where items.id in (select itemid from orderitem where order_id=".$nOrderID.")");
            $strItems = "";
            $nCount = 0;
            foreach($orderItems as $thisitem)
            {
                if($nCount>0)
                {
                    $strItems = $strItems.", ";
                }
                $strItems = $strItems.$thisitem->name;
                $nCount++;
            }
/*            if(strlen($strItems)>10)
            {
                $strItems = substr($strItems, 0, 10)."...";
            }*/
            $arrItems["$nOrderID"] = $strItems;

        }


		return view('vendor.myorders.index',compact("orders", "objTax", "arrItems"));
    }

	 public function OrdersCancelled()
    {

		    $orders = DB::select("SELECT tblorder.id, tblorder.total, tblorder.status, tblorder.payment_type,tblorder.refund_status,tblorder.refund_amount, tblorder.creditcardtime,tblorder.collectiontime, tblorder.order_number,tblorder.name,
        tblorder.collected, tblorder.delivery_date, tblorder.delivery_time, vendor.name as vendname, vendor.state as vendstate FROM `tblorder` INNER JOIN users vendor ON vendor.id = tblorder.vendorid WHERE tblorder.vendorid=".Auth::user()->id." AND (tblorder.`status`='cancel_client' OR tblorder.`status`='cancel_vendor') GROUP BY tblorder.order_number ORDER BY tblorder.id DESC");
	//	dd($orders);
    $vendor = User::where('id',Auth::user()->id)->first();

    $objTax = Tax::where('state', $vendor->state)->first();

        $arrItems = array();
        foreach($orders as $thisorder)
        {
            $nOrderID = $thisorder->id;
            $orderItems = DB::select("Select items.name from items where items.id in (select itemid from orderitem where order_id=".$nOrderID.")");
            $strItems = "";
            $nCount = 0;
            foreach($orderItems as $thisitem)
            {
                if($nCount>0)
                {
                    $strItems = $strItems.", ";
                }
                $strItems = $strItems.$thisitem->name;
                $nCount++;
            }
//            if(strlen($strItems)>10)
//            {
//                $strItems = substr($strItems, 0, 10)."...";
//            }
            $arrItems["$nOrderID"] = $strItems;

        }
        return view('vendor.myorders.cancelled-orders',compact("orders", "objTax", "arrItems"));
    }

    public function OrderDetails(Request $request)
    {
        $ordernumber =  $request->ordernumber;
        $order = orders::where('order_number', $ordernumber)
            ->where('vendorid', Auth::user()->id)
            ->first();
        if($order)
        {
            $buyer = User::where('id',$order->userid)->first();
            $orderItems = orderitems::where('order_id', $order->id)->get();
            $arrDisplay = array();
            foreach($orderItems as $oitem)
            {
                //print_r($oitem);
                if($oitem->item_type=='single')
                {
                    $thisItem = Items::where('id', $oitem->itemid)->first();
                    $arrDisplay[] = array("Title"=>$thisItem->name, "unit_price"=>$oitem->unit_price, "quantity"=>$oitem->quantity,
                        "total_price"=>$oitem->total_price, "image"=>$thisItem->image);
                }
                elseif($oitem->item_type=='combo'){
                    $thiscombo = Menu::where('id', $oitem->itemid)->first();
                    $allMenuItems = MenuItems::where('menu_id', $oitem->itemid)->first();
                    $firstitem = Items::where('id', $allMenuItems->item_id)->first();
                    $arrDisplay[] = array("Title"=>$thiscombo->title, "unit_price"=>$oitem->unit_price, "quantity"=>$oitem->quantity,
                        "total_price"=>$oitem->total_price, "image"=>$firstitem->image);
                }

            }

            return view('vendor.myorders.orderdetail', compact('arrDisplay', 'buyer', 'order'));
        }
        else {
            echo "Invalid order number. Please contact administrator!";
        }
    }

    public function ChangeStatus(Request $request)
    {
        $id = $request->id;
        $checkedval = $request->checkedval;

        //$arrUpdate = array('collected'=>$checkedval, "collectiontime"=>date("Y-m-d H:i:s"));
        $strTime = date("Y-m-d H:i:s");
        $thisOrder = orders::find($id);
        $thisOrder->collected = $checkedval;
        $thisOrder->collectiontime = date("Y-m-d H:i:s");

       $thisOrder->save();
       echo $strTime;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function VendorFetchOrders(Request $request): \Illuminate\Http\JsonResponse
    {
	/*	$orders = orders::where('vendorid', Auth::user()->id)
						->where('status', '=', 'paid')
						->where('transactiontime', '>', Carbon\Carbon::now()->subHours(24)->toDateTimeString())
						->orderby('id','desc')->get(); */
        $withFilledItems = $request->get('withFilledItems',false);

		$orders = orders::where('vendorid','=',Auth::user()->id)

					->where('status','=','paid')
					->where('collected','=','no')
					->orderby('id','desc')->get();
		$tempOrders = array();
		foreach($orders as $key => $order){
		$tempOrders[$key]['id'] = $order->id;
		$tempOrders[$key]['order_number'] = $order->order_number;
		$tempOrders[$key]['transactiontime'] = $order->transactiontime;
		$tempOrders[$key]['order_placed'] = Carbon\Carbon::parse($order->transactiontime)->diffForHumans();
		$tempOrders[$key]['collected'] = $order->collected;
		$tempOrders[$key]['name'] = $order->name;
		$tempOrders[$key]['phone'] = $order->phone;
		$tempOrders[$key]['total'] = $order->total;
		$tempOrders[$key]['collectiontime'] = $order->collectiontime;
		$tempOrders[$key]['delivery_time'] = $order->delivery_time;
		$tempOrders[$key]['delivery_date'] = Carbon\Carbon::parse($order->delivery_date)->format('d-m-Y');
		$tempOrders[$key]['collectiontime_diff'] = Carbon\Carbon::parse($order->collectiontime)->diffForHumans();
		}

        if ($withFilledItems) {
            $data['items'] = items::where('user_id','=',Auth::user()->id)
                ->where('calculate_owner','superadmin')
                ->whereNotNull('co2_avg')
                ->whereNotNull('h2o_avg')
                ->orderByRaw("CASE WHEN seen_by_vendor IS NULL THEN 0 WHEN seen_by_vendor = false THEN 1 ELSE 2 END")
                ->orderby('id','desc')
                ->get();

            $data['tempOrders'] = $tempOrders;
        }else {
            $data = $tempOrders;
        }

		 return response()->json($data);
    }


	public function MarkOrderCollected($id)
    {
        $strTime = date("Y-m-d H:i:s");
        $thisOrder = orders::find($id);
        $thisOrder->collected = 'yes';
        $thisOrder->collectiontime = date("Y-m-d H:i:s");
       $thisOrder->save();
       //echo $strTime;
		$order = orders::where('id', $id)->first();
		$buyer = User::where('id', $order->userid)->first();
		$vendor = User::where('id', $order->vendorid)->first();
		  $details = [
        'orderid' => $id,
        'vendorid' =>  $order->vendorid
    ];


	    //Mail::to("elisjohnson1@yahoo.co.uk")->send(new \App\Mail\OrderCollected($details));
	    Mail::to($buyer->email)->send(new \App\Mail\OrderCollected($details));
	    Mail::to($vendor->email)->send(new \App\Mail\OrderCollected($details));
    }
	public function ViewOrder($id)
    {
		$order = orders::where('id', $id)->first();
		$vendor = User::where('id', $order->vendorid)->first();
        $objTax = Tax::where('state', $vendor->state)->first();
		return view('vendor.myorders.view-order', compact('order','vendor', 'objTax'));
    }
	public function DownloadOrder($id)
    {
		$order = orders::where('id', $id)->first();
		$vendor = User::where('id', $order->vendorid)->first();
        $objTax = Tax::where('state', $vendor->state)->first();
		return view('vendor.myorders.download-order', compact('order','vendor', 'objTax'));
    }
	public function VendorReports(){

		return view('vendor.myorders.report');
    }
	public function VendorOrdersReportsFilter(Request $request)
	{
		$start = $request->startdate;
		$end = $request->enddate;

		$orders = DB::select("SELECT tblorder.id, tblorder.total, tblorder.payment_type, tblorder.creditcardtime, tblorder.order_number,
        tblorder.collected, tblorder.delivery_date, tblorder.delivery_time,cust.name as custname
        FROM `tblorder`, users cust
        WHERE tblorder.`status`='paid' AND
         (tblorder.transactiontime BETWEEN '$start' AND '$end')
        and cust.id=tblorder.userid
        and tblorder.vendorid=".Auth::user()->id." order by tblorder.delivery_date");

        /*$orders = DB::select("SELECT tblorder.id, tblorder.total, tblorder.payment_type, tblorder.creditcardtime, tblorder.order_number,
        tblorder.collected, tblorder.delivery_date, tblorder.delivery_time,cust.name as custname
        FROM `tblorder`, users cust WHERE tblorder.`status`='paid' and cust.id=tblorder.userid  order by tblorder.delivery_date");*/
        return view('vendor.myorders.report',compact("orders"));
	}

	public function VendorNewOrdersCounter(){
    	$count = orders::where('vendorid','=',Auth::user()->id)->where('seen_by_vendor', '=', '0')->where('status','=','paid')->count();
		return $count;
    }
	public function VendorNewOrdersCounterMarkRead(){
    	orders::where('vendorid','=',Auth::user()->id)->where('status','=','paid')->where('seen_by_vendor', '=', '0')->update(['seen_by_vendor'=>'1']);
		return 1;
    }

    public function OrderCancel(Request $request)
    {
        $strOrderNumber = $request->ordernumber;
        $order = orders::where('order_number', $strOrderNumber)
            ->when(Auth::user()->role != 'superadmin', function($query){
                return $query->where('vendorid', Auth::user()->id);
            })
            ->where('status', 'paid')
            ->first();

        if($order)
        {
            $strStripeID = $order->strip_id;
            $strOrderTime = $order->creditcardtime;
            $strTimeNow = date("Y-m-d H:i:s");
            if ((strtotime($strTimeNow) - strtotime($strOrderTime)) < 7200000) {

                $refundStatus = 'Not refunded';
                $isFullyRefunded = false;

                try {
                    Stripe::setApiKey(env('STRIPE_SECRET'));

                    $paymentIntent = \Stripe\PaymentIntent::retrieve($strStripeID);


                    if (in_array($paymentIntent->status, ['requires_payment_method', 'requires_confirmation', 'requires_action', 'requires_capture'])) {
                        $paymentIntent->cancel();

                        $isFullyRefunded = true;
                        $refundStatus=="succeeded";

                        $arrUpdate = array(
                            "status" => 'cancel_vendor',
                            "refund_time" => date("Y-m-d H:i:s"),
                            "refund_amount" => $paymentIntent->amount / 100,
                            "refund_status" => $paymentIntent->status
                        );


                        orders::where('id', $order->id)->update($arrUpdate);

                        $buyer = User::where('id', $order->userid)->first();
                        $msg = "Il venditore ha annullato l'ordine " . $strOrderNumber;

                        $details = [
                            'message' => $msg,
                            'orderid' => $order->id,
                            'vendorid' => $order->vendorid,
                            'ordernumber' => $strOrderNumber
                        ];

                        Mail::to($buyer->email)->send(new \App\Mail\OrderCancelVendor($details));
                        Mail::to(Auth::user()->email)->send(new \App\Mail\OrderCancelVendor($details));

                        echo trans('payment.order_canceled_successfully');
                    } elseif ($paymentIntent->status === 'succeeded') {
                        $refund = \Stripe\Refund::create([
                            'payment_intent' => $strStripeID,
                        ]);

                        $refundStatus=="succeeded";

                        $arrUpdate = array(
                            "status" => 'cancel_vendor',
                            "refund_time" => date("Y-m-d H:i:s"),
                            "refund_amount" => $refund->amount / 100,
                            "refund_status" => 'refunded'
                        );

                        $isFullyRefunded = $refund->amount / 100 == $paymentIntent->amount / 100;
                        orders::where('id', $order->id)->update($arrUpdate);

                        $buyer = User::where('id', $order->userid)->first();
                        $msg = "Il venditore ha annullato l'ordine " . $strOrderNumber . " e ha emesso un rimborso.";

                        $details = [
                            'message' => $msg,
                            'orderid' => $order->id,
                            'vendorid' => $order->vendorid,
                            'ordernumber' => $strOrderNumber
                        ];

                        Mail::to($buyer->email)->send(new \App\Mail\OrderCancelVendor($details));
                        Mail::to(Auth::user()->email)->send(new \App\Mail\OrderCancelVendor($details));

                        echo trans('payment.order_canceled_successfully');
                    }else if($paymentIntent->status === 'canceled') {
                        $arrUpdate = array(
                            "status" => 'cancel_vendor',
                            "refund_time" => date("Y-m-d H:i:s"),
                            "refund_amount" => $paymentIntent->amount / 100,
                            "refund_status" => $paymentIntent->status
                        );

                        $isFullyRefunded = true;
                        $refundStatus=="succeeded";

                        orders::where('id', $order->id)->update($arrUpdate);

                        $buyer = User::where('id', $order->userid)->first();
                        $msg = "Il venditore ha annullato l'ordine " . $strOrderNumber . " e ha emesso un rimborso.";

                        $details = [
                            'message' => $msg,
                            'orderid' => $order->id,
                            'vendorid' => $order->vendorid,
                            'ordernumber' => $strOrderNumber
                        ];

                        Mail::to($buyer->email)->send(new \App\Mail\OrderCancelVendor($details));
                        Mail::to(Auth::user()->email)->send(new \App\Mail\OrderCancelVendor($details));

                        echo trans('payment.order_canceled_successfully');
                    }


					} catch (\Exception $e) {
						// Handle any exceptions (e.g., payment not found)
						//return view('payment.status', ['status' => 'error']);

					return $e->getMessage();
					}
				//If already refunded end


				if (!($isFullyRefunded)) {
                //Perform cancelation
                try {
                    $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
                    $objRefund = $stripe->refunds->create([
                        'charge' => $strStripeID,
                    ]);
                    /*echo "<pre>";
                    print_r($objRefund);
                    echo "</pre><br>";*/
                    $strRefundID = $objRefund->id;
                    $nRefundAmount = $objRefund->amount;
                    $nRefundAmount = $nRefundAmount/100;
                    $refundcreatedtime = $objRefund->created;
                    $refundstatus = $objRefund->status;
                    /*echo "Refund ID: ".$strRefundID."<br>";
                    echo "Refund Amount: ".$nRefundAmount."<br>";
                    echo "Refund Time: ".$refundcreatedtime."<br>";
                    echo "Refund Status: ".$refundstatus."<br>";*/
                    if($refundstatus=="succeeded")
                    {

                        $tempOrderItems = DB::table('orderitem')
                            ->where('order_id', '=', $order->id)
                            ->get();
                        foreach($tempOrderItems as $tempSingleItem){
                            if($tempSingleItem->item_type=='single')
                            {
                                DB::table('items')->where("id",'=',$tempSingleItem->itemid)->increment('quantity', $tempSingleItem->quantity);
                            }
                        }

                        $arrUpdate = array("status"=>'cancel_vendor',
                            "refund_id"=>$strRefundID,
                            "refund_time"=>$refundcreatedtime,
                            "refund_amount"=>$nRefundAmount,
                            "refund_status"=>$refundstatus
                        );
                        orders::where('id',$order->id)
                                //->where('order_number', $strOrderNumber)
                                //->where('userid', Auth::user()->id)
                                ->update($arrUpdate);
                        $buyer = User::where('id', $order->userid)->first();
                        $msg = "Il venditore ha annullato l'ordine ".$strOrderNumber;

						 $details = [
										'message' => $msg,
										'orderid' =>  $order->id,
										'vendorid' => $order->vendorid,
                                        'ordernumber' => $strOrderNumber
									];
						//send mail to buyer
						Mail::to($buyer->email)->send(new \App\Mail\OrderCancelVendor($details));

						//send mail to vendor
						Mail::to(Auth::user()->email)->send(new \App\Mail\OrderCancelVendor($details));

                        echo trans('payment.order_canceled_successfully');
                    }
                    else {
                        echo "Your order could not be canceled at this time. Please try again later or contact administrator!";
                    }

                }
                catch(Stripe\Exception\InvalidRequestException  $e)
                {
                    //$strErrorMessage = $e->getError()->message;
                    $strErrorMessage = "This order has already been canceled and refunded";
                    echo $strErrorMessage;
                }
                catch (Exception $e) {
                    // Something else happened, completely unrelated to Stripe
                    $strErrorMessage = $e->getError()->message;
                    echo $strErrorMessage;
                }
			}
            }
            else {
                echo trans('payment.order_can_be_cancel_in_2_hours');
            }
        }
    }
}
