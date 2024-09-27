<?php

namespace App\Http\Controllers\Frontend;

use App\DataTables\UserProductReviewDataTable;
use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use App\Models\ProductReviewGallery;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(UserProductReviewDataTable $dataTable)
    {
        return $dataTable->render('frontend.dashboard.review.index');
    }
    public function create(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'rating' => 'required',
            'review' => 'required|max:200',
            'image.*' => 'image|max:5120',
        ]);

        $checkReviewExist=ProductReview::where(['user_id'=>auth()->user()->id,'product_id'=>$request->product_id])->first();
        if(!empty($checkReviewExist)){
            toastr()->warning('You have already submitted review for this product');
            return redirect()->back();
        }
        $imagePath=$this->uploadMultiImage($request, 'image', 'uploads/reviews');

        $productReview = new ProductReview();
        $productReview->product_id = $request->product_id;
        $productReview->user_id = auth()->user()->id;
        $productReview->vendor_id =$request->vendor_id;
        $productReview->rating = $request->rating;
        $productReview->review = $request->review;
        $productReview->status=0;
        $productReview->save();

        if(!empty($imagePath)){
            foreach($imagePath as $path){
                $reviewGallery= new ProductReviewGallery();
                $reviewGallery->product_review_id=$productReview->id;
                $reviewGallery->image=$path;
                $reviewGallery->save();
            }
        }
        toastr()->success('Review submitted successfully');
        return redirect()->back();
    }
}
