<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SubCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Str;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SubCategoryDataTable $dataTable)
    {
        return $dataTable->render('backend.admin.sub-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Category::all();
        return view('backend.admin.sub-category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated=$request->validate([
            'category_id'=>'required',
            'name'=>'required|max:100|unique:sub_categories,name',
            'status'=>'required'
        ]);
        $subCategory= new SubCategory();
        $subCategory->category_id=$request->category_id;
        $subCategory->name=$request->name;
        $subCategory->slug=Str::slug($request->name);
        $subCategory->status=$request->status;
        $subCategory->save();
        toastr('Create Successfully!', 'success');
        return redirect()->route('admin.sub-category.index');
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
        $categories=Category::all();
        $subCategory=SubCategory::findOrFail($id);
        return view('backend.admin.sub-category.edit', compact('categories', 'subCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'category_id' => 'required',
            'name' => ['required', 'max:100', 'unique:sub_categories,name,' . $id],
            'status' => 'required'
        ]);


        $subCategory=SubCategory::findOrFail($id);
        $subCategory->category_id=$request->category_id;
        $subCategory->name=$request->name;
        $subCategory->slug=Str::slug($request->name);
        $subCategory->status=$request->status;
        $subCategory->save();
        toastr('Update Successfully!','success');
        return redirect()->route('admin.sub-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subCategory=SubCategory::findOrFail($id);
        $childCategory=ChildCategory::where('sub_category_id', $subCategory->id)->count();
        if($childCategory > 0){
            return response(['status'=>'error','message'=>"You can't delete this Sub Category because it has child category!"]);
        }
        $subCategory->delete();
        return response(['status'=>'success', 'message'=>"Delete Successfully!"]);

    }
    public function changeStatus(Request $request){
        $subCategory=SubCategory::findOrFail($request->id);
        $subCategory->status=$request->status == 'true' ? 1 : 0 ;
        $subCategory->save();

        return response(['message'=>'Status has been Updated!', ]);
    }
}
