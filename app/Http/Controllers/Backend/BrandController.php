<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\BrandDataTable;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Str;

class BrandController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(BrandDataTable $dataTable)
    {
        return $dataTable->render('backend.admin.brand.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validated=$request->validate([
            'logo'=>'required|image|max:5120',
            'name' =>'required|unique:brands,name',
            'status' =>'required',
            'is_featured'=>'required'
        ]);
        $logoPath=$this->uploadImage($request, 'logo','uploads');
        $brand= new Brand();
        $brand->logo=$logoPath;
        $brand->name=$request->name;
        $brand->slug=Str::slug($request->name);
        $brand->is_featured=$request->is_featured;
        $brand->status=$request->status;
        $brand->save();
        toastr('Created Successfully!', 'success');
        return redirect()->route('admin.brand.index');

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
        $brand=Brand::findOrFail($id);
        return view('backend.admin.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated=$request->validate([
            'logo'=>'image|max:5120',
            'name' =>'required|unique:brands,name,'.$id,
            'status' =>'required',
            'is_featured'=>'required'
        ]);
        $brand= Brand::findOrFail($id);
        $logoPath=$this->updateImage($request, 'logo','uploads', $brand->logo);
        $brand->logo=empty(!$logoPath) ? $logoPath : $brand->logo;
        $brand->name=$request->name;
        $brand->slug=Str::slug($request->name);
        $brand->is_featured=$request->is_featured;
        $brand->status=$request->status;
        $brand->save();
        toastr('Update Successfully!', 'success');
        return redirect()->route('admin.brand.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $brand= Brand::findOrFail($id);

        if(Product::where('brand_id', $brand->id)->count() > 0){
            return response(['status'=>'error', 'message'=>'Brand have products! Can not be deleted']);
        }
        $this->deleteImage($brand->logo);
        $brand->delete();
        toastr('Deleted Successfully!','success');
        return response(['status'=>'success', 'message'=>'Deleted Successfully!']);
    }
    public function changeStatus(Request $request){
        $brand=Brand::findOrFail($request->id);
        $brand->status=$request->status == 'true' ? 1 : 0 ;
        $brand->save();

        return response(['message'=>'Status has been Updated!', ]);
    }
}
