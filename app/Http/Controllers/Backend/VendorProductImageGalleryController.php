<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorProductDataTable;
use App\DataTables\VendorProductImageGalleryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImageGallery;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorProductImageGalleryController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(VendorProductImageGalleryDataTable $dataTable, Request $request)
    {
        $product=Product::findOrFail($request->product);

        /** check if product belongs to this vendor */
        if($product->vendor_id != Auth::user()->vendor->id){
            abort(404);
        }
        return $dataTable->render('backend.vendor.product.image-gallery.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'image.*'=>'required|image|max:5248',
        ]);

        /**handle image upload */
        $imagePaths=$this->uploadMultiImage($request, 'image', 'uploads/image-gallery');

        /**save image path to database */
        foreach($imagePaths as $path){
            $vendorImageGallery= new ProductImageGallery();
            $vendorImageGallery->image=$path;
            $vendorImageGallery->product_id=$request->product_id;
            $vendorImageGallery->save();
        }
        toastr('Uploaded Successfully', 'success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $productImage=ProductImageGallery::findOrFail($id);

        /**check if image belongs to this product */
        if($productImage->product->vendor_id != Auth::user()->vendor->id){
            abort(404);
        }
        $this->deleteImage($productImage->image);
        $productImage->delete();
        return response(['status'=>'success', 'message'=>'Deleted Successfully']);
    }
}
