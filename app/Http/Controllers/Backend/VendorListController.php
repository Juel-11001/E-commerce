<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorListDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\vendor;
use Illuminate\Http\Request;

class VendorListController extends Controller
{
    public function index(VendorListDataTable $dataTable)
    {
        return $dataTable->render('backend.admin.vendor-list.index');
    }
    public function changeStatus(Request $request)
    {
        $vendor=User::findOrFail($request->id);
        $vendor->status=$request->status == 'true' ? 'active' : 'inactive'; ;
        $vendor->save();

        return response(['message'=>'Status has been Updated!', ]);
    }
}
