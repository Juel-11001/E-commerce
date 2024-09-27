<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\FooterGridTwoDataTable;
use App\Http\Controllers\Controller;
use App\Models\FooterGridTwo;
use App\Models\FooterTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FooterGridTwoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FooterGridTwoDataTable $dataTable)
    {
        $footerGridTwoTitle=FooterTitle::first();
        return $dataTable->render('backend.admin.footer.footer-grid-two.index', compact('footerGridTwoTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.footer.footer-grid-two.create');
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

        $footerGridTwo = new FooterGridTwo();
        $footerGridTwo->name = $request->name;
        $footerGridTwo->url = $request->url;
        $footerGridTwo->status = $request->status;
        $footerGridTwo->save();

        Cache::forget('footer_grid_two');

        toastr('Footer Grid Two Added Successfully', 'success', 'Success');
        return redirect()->route('admin.footer-grid-two.index');
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
        $footerGridTwo=FooterGridTwo::find($id);
        return view('backend.admin.footer.footer-grid-two.edit', compact('footerGridTwo'));
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
        $footerGridTwo=FooterGridTwo::find($id);
        $footerGridTwo->name = $request->name;
        $footerGridTwo->url = $request->url;
        $footerGridTwo->status = $request->status;
        $footerGridTwo->save();

        Cache::forget('footer_grid_two');

        toastr('Footer Grid Two Updated Successfully', 'success', 'Success');
        return redirect()->route('admin.footer-grid-two.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $footerGridTwo=FooterGridTwo::find($id);
        $footerGridTwo->delete();

        Cache::forget('footer_grid_two');

        return response(['status'=>'success', 'message'=>'Delete Successfully!']);
    }

    /**
     * Change status Grid Two
     */
    public function changeStatus(Request $request){
        $footerGridTwo=FooterGridTwo::findOrFail($request->id);
        $footerGridTwo->status=$request->status == 'true' ? 1 : 0 ;
        $footerGridTwo->save();

        Cache::forget('footer_grid_two');

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
            'footer_grid_two_title'=>$request->title
        ]);

        toastr('Footer Grid Two Title Updated Successfully', 'success', 'Success');
        return redirect()->back();
    }
}
