<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CancelledOrderDataTable;
use App\DataTables\DeliveredOrderDataTable;
use App\DataTables\DroppedOffOrderDataTable;
use App\DataTables\OrderDataTable;
use App\DataTables\OutForDeliveryOrderDataTable;
use App\DataTables\PendingOrderDataTable;
use App\DataTables\ProcessedOrderDataTable;
use App\DataTables\ShippedOrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(OrderDataTable $dataTable)
    {

        return $dataTable->render('backend.admin.order.index');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order=Order::findOrFail($id);
        return view('backend.admin.order.show', compact('order'));
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
        $order=Order::findOrFail($id);
        // delete order product :
        $order->orderProducts()->delete();
        //delete transaction :
        $order->transaction()->delete();
        $order->delete();
        return response(['status'=>'success', 'message'=>'Order Deleted Successfully!']);
    }
    /**
     * change order status
     */
    public function changeOrderStatus(Request $request)
    {
        $order= Order::findOrFail($request->id);
        $order->order_status=$request->status;
        $order->save();
        return response(['status'=>'success', 'message'=>'Updated Order Status Successfully']);
    }

    public function changePaymentStatus(Request $request)
    {
        $order= Order::findOrFail($request->id);
        $order->payment_status=$request->status;
        $order->save();
        return response(['status'=>'success', 'message'=>'Updated Payment Status Successfully']);
    }

    public function pendingOrders(PendingOrderDataTable $dataTable)
    {
        return $dataTable->render('backend.admin.order.pending-order');
    }
    public function processedOrders(ProcessedOrderDataTable $dataTable)
    {
        return $dataTable->render('backend.admin.order.processed-order');
    }
    public function droppedOffOrders(DroppedOffOrderDataTable $dataTable)
    {
        return $dataTable->render('backend.admin.order.dropped-off-order');
    }
    public function shippedOrders(ShippedOrderDataTable $dataTable)
    {
        return $dataTable->render('backend.admin.order.shipped-order');
    }
    public function outDeliveryOrders(OutForDeliveryOrderDataTable $dataTable)
    {
        return $dataTable->render('backend.admin.order.outfor-delivery-order');
    }
    public function deliveredOrders(DeliveredOrderDataTable $dataTable)
    {
        return $dataTable->render('backend.admin.order.delivered-order');
    }
    public function cancelledOrders(CancelledOrderDataTable $dataTable)
    {
        return $dataTable->render('backend.admin.order.cancelled-order');
    }

}
