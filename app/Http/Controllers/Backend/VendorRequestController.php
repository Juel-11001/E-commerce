<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorRequestDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\vendor;
use Illuminate\Http\Request;

class VendorRequestController extends Controller
{
    public function index(VendorRequestDataTable $dataTable)
    {
        return $dataTable->render('backend.admin.vendor-request.index');
    }
    public function show(string $id)
    {
        $vendor=vendor::findOrFail($id);
        return view('backend.admin.vendor-request.show', compact('vendor'));
    }
    public function changeStatus(Request $request, string $id)
    {
        $vendor= vendor::findOrFail($id);
        $vendor->status = $request->status;
        $vendor->save();

        $user=User::findOrFail($vendor->user_id);
        $user->role='vendor';
        $user->save();

        toastr('Updated Successfully!', 'success', 'Success');
        return redirect()->route('admin.vendor-request.index');
    }
}
