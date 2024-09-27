<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\FlashSaleItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\Product;
use Illuminate\Http\Request;

class FlashSaleController extends Controller
{
    public function index(FlashSaleItemDataTable $dataTable)
    {
        $flash_sale = FlashSale::first();
        $products=Product::where('is_approved', 1)->where('status', 1)->get();
        return $dataTable->render('backend.admin.flash-sale.index', compact('flash_sale', 'products'));
    }
    public function update(Request $request){
       $validation=$request->validate([
        'end_date'=>'required',
       ]);
       FlashSale::updateOrCreate([
        'id'=>1
    ],
       [
        'end_date'=>$request->end_date
       ]
       );
       toastr('Updated Successfully!','success', 'Success');
       return redirect()->back();
    }
    public function addProduct(Request $request){
        // dd($request->all());
        $validation=$request->validate([
            'product'=>'required|unique:flash_sale_items,product_id',
            'show_at_home'=>'required',
            'status'=>'required'
        ], [
            'product.unique'=> "This Product already exists Flash Sale!"
        ]);
        $flashSaleData = FlashSale::first();
        $flashSaleItem= new FlashSaleItem();
        $flashSaleItem->product_id=$request->product;
        $flashSaleItem->flash_sale_id=$flashSaleData->id;
        $flashSaleItem->show_at_home=$request->show_at_home;
        $flashSaleItem->status=$request->status;
        $flashSaleItem->save();
        toastr('Added Successfully!','success', 'Success');
        return redirect()->back();
    }
    public function changeStatus(Request $request){
        $flashSaleItem=FlashSaleItem::findOrFail($request->id);
        $flashSaleItem->status=$request->status == 'true' ? 1 : 0 ;
        $flashSaleItem->save();

        return response(['message'=>'Status has been Updated!', ]);
    }
    public function ShowAtHomeChangeStatus(Request $request){
        $flashSaleItem=FlashSaleItem::findOrFail($request->id);
        $flashSaleItem->show_at_home=$request->show_at_home == 'true' ? 1 : 0 ;
        $flashSaleItem->save();
        return response(['message'=>'Status has been Updated!', ]);
    }

    public function destroy(string $id){
        $flashSaleItem=FlashSaleItem::findOrFail($id);
        $flashSaleItem->delete();
        return response(['status' => 'success', 'message' => 'Deleted Successfully Product Form Flash Sale !']);

    }
}
