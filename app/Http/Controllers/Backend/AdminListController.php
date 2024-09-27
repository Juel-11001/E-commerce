<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\AdminListDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Models\vendor;
use Illuminate\Http\Request;

class AdminListController extends Controller
{
    public function index(AdminListDataTable $dataTable)
    {
        return $dataTable->render('backend.admin.admin-list.index');
    }
    public function changeStatus(Request $request)
    {
        $admin=User::findOrFail($request->id);
        $admin->status=$request->status == 'true' ? 'active' : 'inactive'; ;
        $admin->save();

        return response(['message'=>'Status has been Updated!', ]);
    }
    public function destroy(string $id)
    {
        $admin=User::findOrFail($id);
        $products=Product::where('vendor_id', $admin->vendor->id)->get();
        if(count($products)>0){
            return response(['status' => 'error', 'message' => 'Can not delete this user. Because it has products! Please ban this user insted of deleting.']);
        }
        vendor::where('user_id', $admin->id)->delete();
        $admin->delete();
        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }
}
