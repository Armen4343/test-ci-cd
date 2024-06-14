<?php

namespace App\Http\Controllers;

use App\Models\orders;
use App\Models\orderitems;
use App\Models\Items;
use App\Models\Menu;
use App\Models\MenuItems;
use App\Models\User;
use Stripe;
use Carbon;
use Auth;
use DB;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;

class BuyerOrdersController extends Controller
{
    //
    public function index()
    {
        $orders = DB::select("SELECT 
            tblorder.id,
            tblorder.total,
            tblorder.status,
            tblorder.payment_type, 
            tblorder.creditcardtime,
            tblorder.order_number,
            tblorder.collected,
            tblorder.delivery_date,
            tblorder.delivery_time,
            vendor.name as vendname, 
            COALESCE(SUM(items.co2_avg), 0) as co2_avg ,
            COALESCE(SUM(items.h2o_avg), 0) as h2o_avg
        FROM `tblorder`
        INNER JOIN users vendor ON vendor.id = tblorder.vendorid
        join orderitem ON orderitem.order_id = tblorder.id
        join items ON items.id = orderitem.itemid
        WHERE tblorder.`status`='paid'
        and vendor.id=tblorder.vendorid
        and tblorder.userid=".Auth::user()->id
        ." GROUP BY tblorder.order_number order by tblorder.id DESC");
        /*$orders = DB::select("SELECT tblorder.id, tblorder.total, tblorder.payment_type, tblorder.creditcardtime, tblorder.order_number,
        tblorder.delivery_date, tblorder.delivery_time,cust.name as custname
        FROM `tblorder`, users cust WHERE tblorder.`status`='paid' and cust.id=tblorder.userid");*/
        //print_r($orders);
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
        return view('buyer.myorders.index',compact("orders", "arrItems"));
    }
	 public function OrdersCancelled()
    {

		    $orders = DB::select("SELECT tblorder.id, tblorder.total, tblorder.status, tblorder.payment_type,tblorder.refund_status,tblorder.refund_amount, tblorder.creditcardtime,tblorder.collectiontime, tblorder.order_number,tblorder.name,
        tblorder.collected, tblorder.delivery_date, tblorder.delivery_time, vendor.name as vendname, vendor.state as vendstate FROM `tblorder` INNER JOIN users vendor ON vendor.id = tblorder.vendorid WHERE tblorder.userid=".Auth::user()->id." AND (tblorder.`status`='cancel_client' OR tblorder.`status`='cancel_vendor') GROUP BY tblorder.order_number ORDER BY tblorder.id DESC");
		//dd($orders);
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
        return view('buyer.myorders.cancelled-orders',compact("orders", "arrItems"));
    }

    public function OrderDetails(Request $request)
    {
        $ordernumber =  $request->ordernumber;
        $order = orders::where('order_number', $ordernumber)
            ->where('userid', Auth::user()->id)
            ->first();
        if($order)
        {
            $vendor = User::where('id',$order->vendorid)->first();
            $orderItems = orderitems::where('order_id', $order->id)->get();
            $arrDisplay = array();
            $user = User::find(Auth::user()->id);
            foreach($orderItems as $oitem)
            {
                //print_r($oitem);
                if($oitem->item_type=='single')
                {
                    $thisItem = Items::where('id', $oitem->itemid)->first();
                    if ($thisItem) {
                        $arrDisplay[] = array("Title"=>$thisItem->name, "unit_price"=>$oitem->unit_price, "quantity"=>$oitem->quantity,
                            "total_price"=>$oitem->total_price, "image"=>$thisItem->image);
                    }
                }
                elseif($oitem->item_type=='combo'){
                    $thiscombo = Menu::where('id', $oitem->itemid)->first();
                    $allMenuItems = MenuItems::where('menu_id', $oitem->itemid)->first();
                    $firstitem = Items::where('id', $allMenuItems->item_id)->first();
                    $arrDisplay[] = array("Title"=>$thiscombo->title, "unit_price"=>$oitem->unit_price, "quantity"=>$oitem->quantity,
                        "total_price"=>$oitem->total_price, "image"=>$firstitem->image);
                }

            }

            return view('buyer.myorders.orderdetail', compact('arrDisplay', 'vendor', 'order', 'user'));
        }
        else {
            echo "Invalid order number. Please contact administrator!";
        }
    }

    public function OrderCancel(Request $request)
    {
        $strOrderNumber = $request->ordernumber;
        $order = orders::where('order_number', $strOrderNumber)
            ->where('userid', Auth::user()->id)
            ->where('status', 'paid')
            ->first();

        if($order)
        {
            $strConfirmationTime = $order->creditcardtime;
            $strStripeID = $order->strip_id;
            $strOrderTime = $order->creditcardtime;
            $strTimeNow = date("Y-m-d H:i:s");
            if((strtotime($strTimeNow)-strtotime($strOrderTime))<7200)
            {
                //Perform cancelation
                try {
                    $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

                    if (str_starts_with($strStripeID, 'pi_')) {
                        $objRefund = $stripe->paymentIntents->cancel(
                            $strStripeID,
                            []
                        );
                    } else {
                        $objRefund = $stripe->refunds->create([
                            'charge' => $strStripeID,
                        ]);
                    }

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
                    if((str_starts_with($strStripeID, 'pi_') && $refundstatus === 'canceled') || $refundstatus == "succeeded")
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

                        $arrUpdate = array("status"=>'cancel_client',
                            "refund_id"=>$strRefundID,
                            "refund_time"=>$refundcreatedtime,
                            "refund_amount"=>$nRefundAmount,
                            "refund_status"=>$refundstatus
                        );
                        orders::where('id',$order->id)
                                //->where('order_number', $strOrderNumber)
                                //->where('userid', Auth::user()->id)
                                ->update($arrUpdate);
                        echo trans('payment.order_canceled_successfully');
                        $vendor = User::where('id', $order->vendorid)->first();
                        $msg = "il Cliente ha annullato l'ordine ".$strOrderNumber;



						//Mail::to($vendor->email)->send(new \App\Mail\OrderCancelBuyer($details));


						 $details = [
										'message' => $msg,
										'orderid' =>  $order->id,
										'vendorid' => $order->vendorid,
                                        'ordernumber' => $strOrderNumber
									];
						//send mail to buyer
                        Mail::to(Auth::user()->email)->send(new \App\Mail\OrderCancelVendor($details));

                        //send mail to vendor
                        Mail::to($vendor->email)->send(new \App\Mail\OrderCancelVendor($details));
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
            else {
                echo trans('payment.order_can_cancel_in_2_hours');
            }
        }
    }

	//notification function start

	public function BuyerCollectedOrdersCounter(){
    	$count = orders::where('userid','=',Auth::user()->id)->where('collected', '=', 'yes')->where('status','=','paid')->where('seen_by_buyer', '=', 0)->count();
		return $count;
    }

	public function BuyerOrdersCounterMarkRead(){
    return orders::where('userid','=',Auth::user()->id)->where('status','=','paid')->where('collected', '=', 'yes')->where('seen_by_buyer', '=', 0)->update(['seen_by_buyer'=>1]);
	return 1;
    }


	public function BuyerFetchOrders()
    {
		$orders = orders::where('userid','=',Auth::user()->id)

					->where('status','=','paid')
					->where('collected','=','yes')
			->where('seen_by_buyer', '=', 0)
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
		$tempOrders[$key]['collectiontime_diff'] = Carbon\Carbon::parse($order->collectiontime)->diffForHumans();
		}

		 return response()->json($tempOrders);
    }
	//notification function end


}
