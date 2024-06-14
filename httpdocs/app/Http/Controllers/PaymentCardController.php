<?php

namespace App\Http\Controllers;

use App\Models\PaymentCard;
use Illuminate\Http\Request;
use Auth;
use Response;
use Illuminate\Support\Facades\Crypt;
class PaymentCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		$cards=PaymentCard::where("buyer_id",Auth::user()->id)->get();
        return view('buyer.payment-card.index',compact("cards"));
		
    }
	
    public function AjaxGetPaymentCard($id)
    {
        //
		$cards=PaymentCard::where("buyer_id",Auth::user()->id)->where("id",$id)->first();
		if($cards){
        	return response()->json(['status'=>"success", "card_number"=>Crypt::decryptString($cards->card_number), "name_on_card"=>$cards->name_on_card,
									 "month"=> date('m', strtotime($cards->expiration_date)),
									 "year"=> date('Y', strtotime($cards->expiration_date))]);
		}
		else{
		
        return response()->json(['status'=>"error" ]);
		}
		
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		return view('buyer.payment-card.create');
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
		 $request->validate([
            'name_on_card' => 'required',
            'card_number' => 'unique:payment_cards,card_number',
            'card_type' => 'required',
            'card_expiry_month' => 'required',
            'card_expiry_year' => 'required',
        ]);
		$values = array(
			'name_on_card' => $request->name_on_card,
			'card_number' => Crypt::encryptString($request->card_number),
			'status' => 1,
			'buyer_id' => Auth::user()->id,
			'card_type' => $request->card_type,
			'expiration_date' => $request->card_expiry_year.'-'.$request->card_expiry_month.'-1',
		);
		
		 PaymentCard::create($values);
     
        
			$notifications = array(
				'message' => 'Card Added successfully.',
				'alert-type' => 'success'
			);
			return Redirect()->route('cards.index')->with($notifications);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentCard  $paymentCard
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentCard $paymentCard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentCard  $paymentCard
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentCard $paymentCard,$id)
    {
        //
		$card = PaymentCard::find($id);
		 return view('buyer.payment-card.update',compact('card'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaymentCard  $paymentCard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentCard $paymentCard)
    {
      
		 $request->validate([
            'name_on_card' => 'required',
            'card_number' => 'required',
            'card_type' => 'required',
            'card_expiry_month' => 'required',
            'card_expiry_year' => 'required',
        ]);
		$values = array(
			'name_on_card' => $request->name_on_card,
			'card_number' => Crypt::encryptString($request->card_number),
			'card_type' => $request->card_type,
			'expiration_date' => $request->card_expiry_year.'-'.$request->card_expiry_month.'-1',
		);
  
  		PaymentCard::where('id', $request->id)
    		->update($values);
		$notifications = array(
				'message' => 'Card updated successfully.',
				'alert-type' => 'success'
			);
			return Redirect()->route('cards.index')->with($notifications);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentCard  $paymentCard
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentCard $paymentCard, $id)
    {
        //
		 $data = PaymentCard::find($id);
        $data->delete();
		$notifications = array(
				'message' => 'Card deleted successfully.',
				'alert-type' => 'success'
			);
			return Redirect()->route('cards.index')->with($notifications);
    }
}
