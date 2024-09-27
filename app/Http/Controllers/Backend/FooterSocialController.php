<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\FooterSocialDataTable;
use App\Http\Controllers\Controller;
use App\Models\FooterSocial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FooterSocialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FooterSocialDataTable $dataTable)
    {
        return $dataTable->render('backend.admin.footer.footer-socials.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.footer.footer-socials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validated=$request->validate([
            'name' => 'required|max:200',
            'icon' => 'required|not_in:empty',
            'url' => 'required|url',
            'status' => 'required'
        ]);

        // $footerSocial= new FooterSocial();
        // $footerSocial->name=$request->name;
        // $footerSocial->icon=$request->icon;
        // $footerSocial->url=$request->url;
        // $footerSocial->status=$request->status;
        // $footerSocial->save();
        FooterSocial::create([
            'name' => $request->name,
            'icon' => $request->icon,
            'url' => $request->url,
            'status' => $request->status
        ]);

        Cache::forget('footer_social');
        toastr('Create Successfully!', 'success', 'Success');
        return redirect()->route('admin.footer-socials.index');
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
        $footerSocial=FooterSocial::find($id);
        return view('backend.admin.footer.footer-socials.edit',compact('footerSocial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated=$request->validate([
            'name' => 'required|max:200',
            'icon' => 'required|not_in:empty',
            'url' => 'required|url',
            'status' => 'required'
        ]);
        $footerSocial = FooterSocial::findOrFail($id);
        $footerSocial->icon=$request->icon;
        $footerSocial->name=$request->name;
        $footerSocial->url=$request->url;
        $footerSocial->status=$request->status;
        $footerSocial->save();

        Cache::forget('footer_social');
        toastr('Update Successfully!', 'success', 'Success');
        return redirect()->route('admin.footer-socials.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $footerSocial=FooterSocial::find($id);
        $footerSocial->delete();
        Cache::forget('footer_social');
        return response(['status'=>'success', 'message'=>'Delete Successfully!']);
    }

    /**
     * Change status social link
     */
    public function changeStatus(Request $request){
        $footer=FooterSocial::findOrFail($request->id);
        $footer->status=$request->status == 'true' ? 1 : 0 ;
        $footer->save();
        Cache::forget('footer_social');
        return response(['message'=>'Status has been Updated!', ]);
    }
}
