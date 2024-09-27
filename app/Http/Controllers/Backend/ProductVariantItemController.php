<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductVariantItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;

class ProductVariantItemController extends Controller
{
    public function index(ProductVariantItemDataTable $dataTable, $productId, $variantId)
    {
        $product=Product::findOrFail($productId);
        $variant=ProductVariant::findOrFail($variantId);
        return $dataTable->render('backend.admin.product.product-variant-item.index', compact('product', 'variant'));
    }
    public function create(string $ProductId, string $variantId)
    {
        $variant=ProductVariant::findOrFail($variantId);
        $product=Product::findOrFail($ProductId);
        return view('backend.admin.product.product-variant-item.create', compact('variant', 'product'));
    }
    public function store(Request $request)
    {
        $validation=$request->validate([
           'variant_id'=>'required|integer',
           'name'=>'required|max:255',
           'price'=>'required|numeric',
           'is_default'=>'required',
           'status'=>'required',
        ]);
        $variant= new ProductVariantItem();
        $variant->product_variant_id=$request->variant_id;
        $variant->name=$request->name;
        $variant->price=$request->price;
        $variant->is_default=$request->is_default;
        $variant->status=$request->status;
        $variant->save();
        toastr('Created Successfully!', 'success', 'success');

        return redirect()->route('admin.products-variant-item.index', ['productId' => $request->product_id, 'variantId' => $request->variant_id]);


    }
    public function edit(string $variantItemId)
    {

        $variantItem=ProductVariantItem::findOrFail($variantItemId);
        return view('backend.admin.product.product-variant-item.edit', compact('variantItem'));
    }
    public function update(Request $request, string $variantItemId){
        // dd($variantItemId);

        // dd($request->all());
        $validation=$request->validate([
            'name'=>'required|max:255',
            'price'=>'required|numeric',
            'is_default'=>'required',
            'status'=>'required',
         ]);
         $variantItem=ProductVariantItem::findOrFail($variantItemId);
         $variantItem->name=$request->name;
         $variantItem->price=$request->price;
         $variantItem->is_default=$request->is_default;
         $variantItem->status=$request->status;
         $variantItem->save();
         toastr('Updated Successfully!','success','success');
         return redirect()->route('admin.products-variant-item.index', ['productId' => $variantItem->productVariant->product_id, 'variantId' => $variantItem->product_variant_id]);
    }
    public function destroy(string $variantItemId){
        $variantItem=ProductVariantItem::findOrFail($variantItemId);
        $variantItem->delete();
        return response(['status'=>'success', 'message'=>'Deleted Successfully!']);
    }
    public function changeStatus(Request $request){
        $variantItem=ProductVariantItem::findOrFail($request->id);
        $variantItem->status=$request->status == 'true' ? 1 : 0 ;
        $variantItem->save();

        return response(['message'=>'Status has been Updated!', ]);
    }
}
