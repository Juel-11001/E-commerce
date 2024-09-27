<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\FooterGridThreeDataTable;
use App\DataTables\FooterGridTwoDataTable;
use App\Http\Controllers\Controller;
use App\Models\FooterGridThree;
use App\Models\FooterGridTwo;
use App\Models\FooterTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FooterGridThreeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FooterGridThreeDataTable $dataTable)
    {
        $footerGridThreeTitle=FooterTitle::first();
        return $dataTable->render('backend.admin.footer.footer-grid-three.index', compact('footerGridThreeTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.footer.footer-grid-three.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required|max:200',
            'url' => 'required|url',
            'status' => 'required',
        ]);

        $footerGridThree = new FooterGridThree();
        $footerGridThree->name = $request->name;
        $footerGridThree->url = $request->url;
        $footerGridThree->status = $request->status;
        $footerGridThree->save();

        Cache::forget('footer_grid_three');

        toastr('Footer Grid Three Added Successfully', 'success', 'Success');
        return redirect()->route('admin.footer-grid-three.index');
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
        $footerGridThree=FooterGridThree::find($id);
        return view('backend.admin.footer.footer-grid-three.edit', compact('footerGridThree'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validation = $request->validate([
            'name' => 'required|max:200',
            'url' => 'required|url',
            'status' => 'required',
        ]);
        $footerGridThree=FooterGridThree::find($id);
        $footerGridThree->name = $request->name;
        $footerGridThree->url = $request->url;
        $footerGridThree->status = $request->status;
        $footerGridThree->save();
        Cache::forget('footer_grid_three');
        toastr('Footer Grid Two Updated Successfully', 'success', 'Success');
        return redirect()->route('admin.footer-grid-three.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $footerGridThree=FooterGridThree::find($id);
        $footerGridThree->delete();
        Cache::forget('footer_grid_three');
        return response(['status'=>'success', 'message'=>'Delete Successfully!']);
    }

    /**
     * Change status Grid Two
     */
    public function changeStatus(Request $request){
        $footerGridThree=FooterGridThree::findOrFail($request->id);
        $footerGridThree->status=$request->status == 'true' ? 1 : 0 ;
        $footerGridThree->save();

        Cache::forget('footer_grid_three');

        return response(['message'=>'Status has been Updated!', ]);
    }
    /**
     * change footer grid title
     */
    public function changeTitle(Request $request)
    {
        $validation = $request->validate([
            'title' => 'required|max:200',
        ]);
        FooterTitle::updateOrCreate([
            'id'=>1
        ],
        [
            'footer_grid_three_title'=>$request->title
        ]);

        toastr('Footer Grid Three Title Updated Successfully', 'success', 'Success');
        return redirect()->back();
    }
}
