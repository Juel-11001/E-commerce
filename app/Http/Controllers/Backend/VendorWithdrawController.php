<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorWithdrawDataTable;
use App\Http\Controllers\Controller;
use App\Models\OrderProduct;
use App\Models\WithdrawMethod;
use App\Models\WithdrawRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException as ValidationValidationException;
use DB;

class VendorWithdrawController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(VendorWithdrawDataTable $dataTable)
    {
        $totalEarnings=OrderProduct::where('vendor_id', auth()->user()->id)->whereHas('order', function($query){
            $query->where('payment_status', 1)->where('order_status', 'delivered');
        })
        ->sum(DB::raw('unit_price * qty + variants_total'));
        // dd($currenctBalance);
        $totalWithdraw=WithdrawRequest::where('status', 'paid')->sum('total_amount');
        $pendingWithdraw=WithdrawRequest::where('status', 'pending')->sum('total_amount');
        $currenctBalance=$totalEarnings-$totalWithdraw;
        return $dataTable->render('backend.vendor.withdraw.index', compact('currenctBalance', 'pendingWithdraw', 'totalWithdraw'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $methods= WithdrawMethod::all();
        return view('backend.vendor.withdraw.create', compact('methods'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
           'method' => 'required|integer',
           'withdraw_amount' => 'required|numeric',
           'account_info' => 'required|max:2000',
        ]);
        $method=WithdrawMethod::findOrFail($request->method);
        if($request->withdraw_amount < $method->minimum_amount || $request->withdraw_amount > $method->maximum_amount){
            throw ValidationValidationException::withMessages([
                'withdraw_amount' => "The withdraw amount have to be getter than $method->minimum_amount and less than $method->maximum_amount"
            ]);
        }
            $totalEarnings=OrderProduct::where('vendor_id', auth()->user()->id)->whereHas('order', function($query){
                $query->where('payment_status', 1)->where('order_status', 'delivered');
            })
            ->sum(DB::raw('unit_price * qty + variants_total'));
            $totalWithdraw=WithdrawRequest::where('status', 'paid')->sum('total_amount');
           $currenctBalance=$totalEarnings-$totalWithdraw;
           if($request->withdraw_amount>$currenctBalance){
               throw ValidationValidationException::withMessages([
                   'withdraw_amount' => "insufficient balance!"
               ]);
           }
           //check is there any pending request
           $pendingRequest=WithdrawRequest::where('status', 'pending')->where('vendor_id', auth()->user()->id)->exists();
           if($pendingRequest){
               throw ValidationValidationException::withMessages([
                  "You have a already pending withdraw request!"
               ]);
           }


            $withdraw= new WithdrawRequest();
            $withdraw->vendor_id=auth()->user()->id;
            $withdraw->method=$method->name;
            $withdraw->total_amount=$request->withdraw_amount;
            $withdraw->withdraw_amount=$request->withdraw_amount-($method->withdraw_charge/100)*$request->withdraw_amount;
            $withdraw->withdraw_charge=($method->withdraw_charge/100)*$request->withdraw_amount;
            $withdraw->account_info=$request->account_info;
            $withdraw->save();
            toastr('Withdraw request created Successfully!', 'success', 'Success');
            return redirect()->route('vendor.withdraw.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $methodInfo=WithdrawMethod::findOrFail($id);
        return response($methodInfo);
    }

    public function withdrawRequest(string $id)
    {
        $requestInfo=WithdrawRequest::where('vendor_id', auth()->user()->id)->findOrFail($id);
        return view('backend.vendor.withdraw.show', compact('requestInfo'));
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
        //
    }
}
