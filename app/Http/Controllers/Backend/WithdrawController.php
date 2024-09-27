<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\WithdrawRequestDataTable;
use App\Http\Controllers\Controller;
use App\Models\WithdrawRequest;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    public function index(WithdrawRequestDataTable $dataTable)
    {
        return $dataTable->render('backend.admin.withdraw.index');
    }
    public function show(string $id)
    {
        $request = WithdrawRequest::findOrFail($id);
        return view('backend.admin.withdraw.show', compact('request'));
    }
    public function update(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,declined',
        ]);
        $withdraw = WithdrawRequest::findOrFail($id);
        $withdraw->status = $request->status;
        $withdraw->save();
        toastr('Update Successfully!', 'success', 'Success');
        return redirect()->route('admin.withdraw.index');
    }
}
