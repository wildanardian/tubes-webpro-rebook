<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rating_input' => 'required',
            'review' => 'required',
        ]);

        if ($validator->fails()) {
            toastr()->error('Rating and Review are required');
            return redirect()->back()->withErrors($validator->errors());
        }

        $review = new Review();
        $review->restaurant_id = $request->restaurant_id;
        $review->user_id = auth()->user()->id;
        $review->rating = $request->rating_input;
        $review->review = $request->review;
        $review->save();

        if($review){
            toastr()->success('Review successfully added');
            return redirect()->back();
        }else {
            toastr()->error('Review failed to add');
            return redirect()->back();
        }
    }

}
