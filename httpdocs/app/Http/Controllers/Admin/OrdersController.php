<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\orders;
use App\Models\Tax;
use DB;

class OrdersController extends Controller
{
    //
    public function index()
    {


        $orders = DB::select("SELECT tblorder.id, tblorder.total, tblorder.status, tblorder.payment_type, 
            tblorder.creditcardtime,tblorder.collectiontime, tblorder.order_number,tblorder.name,
            tblorder.collected, tblorder.delivery_date, tblorder.delivery_time, vendor.state, vendor.name as vendname, 
            vendor.state as vendstate, COALESCE(SUM(items.co2_avg), 0) as co2_avg , COALESCE(SUM(items.h2o_avg), 0) as h2o_avg
                FROM `tblorder`
                INNER JOIN users vendor ON vendor.id = tblorder.vendorid
                join orderitem ON orderitem.order_id = tblorder.id
                join items ON items.id = orderitem.itemid
                WHERE tblorder.`status`='paid'
                GROUP BY tblorder.order_number
                ORDER BY tblorder.id DESC");
		$Tax = TAX::all();
        $arrTax = array();
        foreach($Tax as $thisTax)
        {
            $strState = strtolower($thisTax->state);
            $nTax = $thisTax->tax;
            $arrTax["$strState"] = $nTax;
        }

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

        return view('super-admin.orders.index',compact("orders", "arrTax", "arrItems"));
    }
    public function OrdersCancelled()
    {

        $orders = DB::select("SELECT tblorder.id, tblorder.total, tblorder.status, tblorder.payment_type,tblorder.refund_status,tblorder.refund_amount, tblorder.creditcardtime,tblorder.collectiontime, tblorder.order_number,tblorder.name,
        tblorder.collected, tblorder.delivery_date, tblorder.delivery_time, vendor.state, vendor.name as vendname, vendor.state as vendstate FROM `tblorder` INNER JOIN users vendor ON vendor.id = tblorder.vendorid WHERE tblorder.`status`='cancel_client' OR tblorder.`status`='cancel_vendor' GROUP BY tblorder.order_number ORDER BY tblorder.id DESC");
	//	dd($orders);
        $Tax = TAX::all();
        $arrTax = array();
        foreach($Tax as $thisTax)
        {
            $strState = strtolower($thisTax->state);
            $nTax = $thisTax->tax;
            $arrTax["$strState"] = $nTax;
        }

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

        return view('super-admin.orders.cancelled-orders',compact("orders", "arrTax", "arrItems"));
    }
}
