<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorProductDataTable;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\ProductImageGallery;
use App\Models\ProductVariant;
use App\Models\SubCategory;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Str;

class VendorProductController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(VendorProductDataTable $dataTable)
    {
        return $dataTable->render('backend.vendor.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Category::where('status',1)->get();
        $brands=Brand::all();
        return view('backend.vendor.product.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'image'=>'required|image|max:5248',
            'name' => 'required|max:200',
            'category'=>'required',
            'brand'=>'required',
            'price'=>'required',
            'qty'=>'required',
            'short_description'=>'required|max:600',
            'long_description'=>'required',
            'status'=>'required',
            'seo_title'=>'nullable|max:200',
            'seo_description'=>'nullable|max:250',

        ]);
        /** handle image */
        $imagePath=$this->uploadImage($request, 'image', 'uploads/products');

        $product = new Product();
        $product->thumb_image = $imagePath;
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->vendor_id=Auth::user()->vendor->id;
        $product->category_id = $request->category;
        $product->sub_category_id = $request->sub_category;
        $product->child_category_id = $request->child_category;
        $product->brand_id = $request->brand;
        $product->qty = $request->qty;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->video_link=$request->video_link;
        $product->sku=$request->sku;
        $product->price = $request->price;
        $product->offer_price=$request->offer_price;
        $product->offer_start_date=$request->offer_start_date;
        $product->offer_end_date=$request->offer_end_date;
        $product->product_type=$request->product_type;
        $product->status = $request->status;
        $product->is_approved=0;
        $product->seo_title=$request->seo_title;
        $product->seo_description=$request->seo_description;
        $product->save();
        toastr('Created Successfully!', 'success');
        return redirect()->route('vendor.products.index');
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
        $product=Product::find($id);
        /** check if product belongs to vendor */
        if($product->vendor_id != Auth::user()->vendor->id){
            toastr('You are not authorized to update this product', 'error');
            return redirect()->route('vendor.products.index');
        }

        $subCategories=SubCategory::where('category_id', $product->category_id)->get();
        $childCategories=ChildCategory::where('sub_category_id', $product->sub_category_id)->get();
        $categories=Category::where('status',1)->get();
        $brands=Brand::all();
        return view('backend.vendor.product.edit', compact('categories', 'brands','product', 'subCategories', 'childCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validation = $request->validate([
            'image'=>'image|max:5248',
            'name' => 'required|max:200',
            'category'=>'required',
            'brand'=>'required',
            'price'=>'required',
            'qty'=>'required',
            'short_description'=>'required|max:600',
            'long_description'=>'required',
            'status'=>'required',
            'seo_title'=>'nullable|max:200',
            'seo_description'=>'nullable|max:250',

        ]);
        $product = Product::find($id);

        /** check if product belongs to vendor */
        if($product->vendor_id != Auth::user()->vendor->id){
            toastr('You are not authorized to update this product', 'error');
            return redirect()->route('vendor.products.index');
            // abort(404);
        }

        /** handle image update*/
        $imagePath=$this->updateImage($request, 'image', 'uploads/products', $product->thumb_image);
        $product->thumb_image = empty(!$imagePath)? $imagePath : $product->thumb_image;

        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->vendor_id=Auth::user()->vendor->id;
        $product->category_id = $request->category;
        $product->sub_category_id = $request->sub_category;
        $product->child_category_id = $request->child_category;
        $product->brand_id = $request->brand;
        $product->qty = $request->qty;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->video_link=$request->video_link;
        $product->sku=$request->sku;
        $product->price = $request->price;
        $product->offer_price=$request->offer_price;
        $product->offer_start_date=$request->offer_start_date;
        $product->offer_end_date=$request->offer_end_date;
        $product->product_type=$request->product_type;
        $product->status = $request->status;
        $product->is_approved=$product->is_approved;
        $product->seo_title=$request->seo_title;
        $product->seo_description=$request->seo_description;
        $product->save();
        toastr('Updated Successfully!', 'success');
        return redirect()->route('vendor.products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product=Product::findOrFail($id);
        /** check if product belongs to vendor */
        if($product->vendor_id != Auth::user()->vendor->id){
            toastr('You are not authorized to delete this product', 'error');
            return redirect()->route('vendor.products.index');
        }
        /**Delete main product image */
        $this->deleteImage($product->thumb_image);

        /** delete product gallery images */
        $galleryImages=ProductImageGallery::where('product_id', $product->id)->get();
        foreach ($galleryImages as $image){
            $this->deleteImage($image->image);
            $image->delete();
        }
        /** delete variant and variant item also together */
        $variants=ProductVariant::where('product_id', $product->id)->get();
        foreach ($variants as $variant){
            // dd($variant->productVariantItems);
            $variant->productVariantItems()->delete();
            $variant->delete();
        }
        $product->delete();
        // toastr('Deleted Successfully!','success');
        // return redirect()->route('admin.products.index');
        return response(['status'=>'success', 'message'=>'Deleted Successfully!']);
    }
     /**
     * Get all sub categories
     */
    public function getSubCategories(Request $request)
    {
        $subCategories = SubCategory::where('category_id', $request->id)->get();
        return $subCategories;

    }
    /**
     * Get all child categories
     */
    public function getChildCategories(Request $request)
    {
        $childCategories = ChildCategory::where('sub_category_id', $request->id)->get();
        return $childCategories;
    }
    function changeStatus(Request $request) {
        $product=Product::findOrFail($request->id);
        $product->status=$request->status == 'true' ? 1 : 0 ;
        $product->save();

        return response(['message'=>'Status has been Updated!', ]);
    }

}
