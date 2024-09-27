<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\AdminReviewDataTable;
use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use App\Models\ProductReviewGallery;
use Illuminate\Http\Request;

class AdminReviewController extends Controller
{
    public function index(AdminReviewDataTable $dataTable)
    {
        return $dataTable->render('backend.admin.product.review.index');
    }
    /**
     * change status
     */
    public function changeStatus(Request $request){
        $review=ProductReview::findOrFail($request->id);
        $review->status=$request->status == 'true' ? 1 : 0 ;
        $review->save();

        return response(['message'=>'Review Status has been Updated!', ]);
    }
    public function destroy($id)
    {
        $review=ProductReview::findOrFail($id);
        $reviewImage=ProductReviewGallery::where('product_review_id',$review->id)->get();
        if(!empty($reviewImage)){
            foreach($reviewImage as $image){
                $image->delete();
            }
        }
        $review->delete();
        return response(['status' => 'success', 'message' => 'Deleted Successfully Product Review !']);
    }
}
