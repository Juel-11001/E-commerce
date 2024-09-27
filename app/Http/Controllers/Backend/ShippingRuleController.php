<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ShippingRuleDataTable;
use App\Http\Controllers\Controller;
use App\Models\ShippingRule;
use Illuminate\Http\Request;

class ShippingRuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ShippingRuleDataTable $dataTable)
    {
        return $dataTable->render('backend.admin.shipping-rule.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.shipping-rule.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validation = $request->validate([
            'name' => 'required|max:200',
            'type' => 'required',
            'min_cost'=>'nullable|integer',
            'cost'=>'required|integer',
            'status'=>'required',
        ]);
        $shipping= new ShippingRule();
        $shipping->name=$request->name;
        $shipping->type=$request->type;
        $shipping->min_cost=$request->min_cost;
        $shipping->cost=$request->cost;
        $shipping->status=$request->status;
        $shipping->save();
        toastr('Shipping Rule Added Successfully','success', 'Success');
        return redirect()->route('admin.shipping-rule.index');
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
        $shipping_rule=ShippingRule::findOrFail($id);
        return view('backend.admin.shipping-rule.edit', compact('shipping_rule'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $validation = $request->validate([
            'name' => 'required|max:200',
            'type' => 'required',
            'min_cost'=>'nullable|integer',
            'cost'=>'required|integer',
            'status'=>'required',
        ]);
        $shipping= ShippingRule::findOrFail($id);
        $shipping->name=$request->name;
        $shipping->type=$request->type;
        $shipping->min_cost=$request->min_cost;
        $shipping->cost=$request->cost;
        $shipping->status=$request->status;
        $shipping->save();
        toastr('Shipping Rule Updated Successfully','success', 'Success');
        return redirect()->route('admin.shipping-rule.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $shipping= ShippingRule::findOrFail($id);
        $shipping->delete();
        return response(['status'=>'success','message'=>'Shipping Rule Deleted Successfully!']);
    }
    function changeStatus(Request $request) {
        $shiping=ShippingRule::findOrFail($request->id);
        $shiping->status=$request->status == 'true' ? 1 : 0 ;
        $shiping->save();

        return response(['message'=>'Shipping Rule Status has been Updated!', ]);
    }

}
