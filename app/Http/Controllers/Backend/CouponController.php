<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CouponDataTable;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CouponDataTable $dataTable)
    {
        return $dataTable->render('backend.admin.coupon.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validation=$request->validate([
            'name' => 'required|max:200',
            'code' => 'required|max:200',
            'qty'=>'required|integer',
            'max_use'=>'required|integer',
            'start_date'=>'required',
            'end_date'=>'required',
            'discount_type'=>'required',
            'discount'=>'required|integer',
            'status'=>'required',

        ]);
        $coupon= new Coupon();
        $coupon->name=$request->name;
        $coupon->code=$request->code;
        $coupon->quantity=$request->qty;
        $coupon->max_use=$request->max_use;
        $coupon->start_date=$request->start_date;
        $coupon->end_date=$request->end_date;
        $coupon->discount_type=$request->discount_type;
        $coupon->discount=$request->discount;
        $coupon->status=$request->status;
        $coupon->total_used=0;
        $coupon->save();
        toastr('Coupon Created Successfully','success', 'Success');
        return redirect()->route('admin.coupons.index');
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
        $coupon=Coupon::findOrFail($id);
        return view('backend.admin.coupon.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $validation=$request->validate([
            'name' => 'required|max:200',
            'code' => 'required|max:200',
            'qty'=>'required|integer',
            'max_use'=>'required|integer',
            'start_date'=>'required',
            'end_date'=>'required',
            'discount_type'=>'required',
            'discount'=>'required|integer',
            'status'=>'required',

        ]);
        $coupon=Coupon::findOrFail($id);
        $coupon->name=$request->name;
        $coupon->code=$request->code;
        $coupon->quantity=$request->qty;
        $coupon->max_use=$request->max_use;
        $coupon->start_date=$request->start_date;
        $coupon->end_date=$request->end_date;
        $coupon->discount_type=$request->discount_type;
        $coupon->discount=$request->discount;
        $coupon->status=$request->status;
        $coupon->save();
        toastr('Coupon Updated Successfully','success', 'Success');
        return redirect()->route('admin.coupons.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $coupon=Coupon::findOrFail($id);
        $coupon->delete();
        return response(['status'=> 'success', 'message'=> 'Coupon Deleted Successfully!']);
    }
    function changeStatus(Request $request) {
        $coupon=Coupon::findOrFail($request->id);
        $coupon->status=$request->status == 'true' ? 1 : 0 ;
        $coupon->save();

        return response(['message'=>'Coupon Status has been Updated!', ]);
    }
}
