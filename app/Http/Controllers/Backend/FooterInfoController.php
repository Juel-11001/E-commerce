<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\FooterInfo;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FooterInfoController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $footerInfo = FooterInfo::first();
        return view('backend.admin.footer.footer-info.index', compact('footerInfo'));
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
        //
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
        $request->validate([
            'footer_logo' => ['nullable', 'image', 'max:3000'],
            'phone' => ['max:100'],
            'email' => ['max:100'],
            'address' => ['max:300'],
            'copyright' => ['max:200']
        ]);

        $footerInfo = FooterInfo::find($id);
        /** Handle file upload */
        $imagePath = $this->updateImage($request, 'footer_logo', 'uploads', $footerInfo?->logo);

        FooterInfo::updateOrCreate(
            ['id' => $id],
            [
                'logo' => empty(!$imagePath) ? $imagePath : $footerInfo->logo,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'copyright' => $request->copyright

            ]
        );
        Cache::forget('footer_info');
        toastr('Footer Info Updated Successfully', 'success', 'Success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
