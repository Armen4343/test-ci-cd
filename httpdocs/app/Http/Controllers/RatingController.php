<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Auth;
use DB;
class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ratings = Rating::with('buyer', 'vendor')->get();

        return view('super-admin.ratings.index', compact('ratings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function show(Rating $rating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function edit(Rating $rating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rating $rating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        Rating::destroy($id);
        $notifications = array(
            'message' => 'Rating Deleted Successfully!',
            'alert-type' => 'deleted'
        );
        return Redirect()->back()->with($notifications);
    }

    /**
     * @param string $id
     * @return \Illuminate\Http\Response
     */
    public function hide(string $id)
    {
        Rating::where('id', $id)->update(['is_hide' => true]);

        return Redirect()->back();
    }

    /**
     * @param string $id
     * @return \Illuminate\Http\Response
     */
    public function showRating(string $id)
    {
        Rating::where('id', $id)->update(['is_hide' => false]);

        return Redirect()->back();
    }

	public function reviewstore(Request $request){
        $review = new Rating();
        $review->buyer_id = Auth::user()->id;
        $review->vendor_id = $request->vendor_id;
        $review->rating = $request->rating;
        $review->comment= $request->comment;
        $review->order_number= $request->order_number;
        $review->save();


			$notifications = array(
				'message' => 'Your review has been submitted Successfully.',
				'alert-type' => 'success'
			);
			 return redirect()->back()->with($notifications);
    }


    public function vendorViewRatings()
    {

        //

		$ratings = DB::table('ratings')
            ->select('ratings.*','users.name','users.profile_photo_path')
            ->where('vendor_id','=',Auth::user()->id)
            ->where('is_hide','=','no')
            ->join('users', 'ratings.buyer_id', '=', 'users.id')
			->orderBy('id', 'DESC')
            ->get();
   return view('vendor.rating.index',compact('ratings'));

    }

	public function vendorReplyRatings(Request $request){
       $result = DB::table('ratings')
              ->where('id','=', $request->id)
              ->update(['reply' => $request->reply]);
			$notifications = array(
				'message' => 'Your reply has been submitted Successfully.',
				'alert-type' => 'success'
			);
			 return redirect()->back()->with($notifications);
    }


}
