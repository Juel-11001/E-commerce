<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductVariantDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProductVariantDataTable $dataTable, Request $request)
    {
        $product=Product::findOrFail($request->product);
        return $dataTable->render('backend.admin.product.product-variant.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.product.product-variant.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validation=$request->validate([
            'product_id' => 'integer|required',
            'name' => 'required|max:200',
            'status'=>'required',
        ]);
        $variant= new ProductVariant();
        $variant->product_id=$request->product_id;
        $variant->name=$request->name;
        $variant->status=$request->status;
        $variant->save();
        toastr('Product Variant Added Successfully', 'success', 'Success');
        return redirect()->route('admin.product-variant.index', ['product' =>$request->product_id]);
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
        $variant=ProductVariant::findOrFail($id);
        return view('backend.admin.product.product-variant.edit', compact('variant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validation=$request->validate([
            'name' => 'required|max:200',
            'status'=>'required',
        ]);
        $variant=ProductVariant::findOrFail($id);
        $variant->name=$request->name;
        $variant->status=$request->status;
        $variant->save();
        toastr('Product Variant Updated Successfully', 'success', 'Success');
        return redirect()->route('admin.product-variant.index', ['product' => $variant->product_id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $variant=ProductVariant::findOrFail($id);
        $variantItemCheck=ProductVariantItem::where('product_variant_id', $variant->id)->count();
        if($variantItemCheck>0){
          return response(['status'=>'error', 'message'=>'You can not delete this Variant because it has Variant Item! ', ]);
        }
        $variant->delete();

        return response(['status'=>'success', 'message'=>'Delete Successfully!', ]);
    }
    public function changeStatus(Request $request){
        $variant=ProductVariant::findOrFail($request->id);
        $variant->status=$request->status == 'true' ? 1 : 0 ;
        $variant->save();

        return response(['message'=>'Status has been Updated!', ]);
    }
}
