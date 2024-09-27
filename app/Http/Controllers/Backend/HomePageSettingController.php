<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\HomePageSetting;
use Illuminate\Http\Request;

class HomePageSettingController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', 1)->get();
        $popularCategorySection=HomePageSetting::where('key','popular_category_section')->first();
        $sliderSectionOne=HomePageSetting::where('key','product_slider_section_one')->first();
        $sliderSectionTwo=HomePageSetting::where('key','product_slider_section_two')->first();
        $sliderSectionThree=HomePageSetting::where('key','product_slider_section_three')->first();
        return view('backend.admin.home-page-setting.index', compact('categories', 'popularCategorySection', 'sliderSectionOne', 'sliderSectionTwo', 'sliderSectionThree'));
    }
    /**
     * Popular category section
     */
    public function updatePopularCategorySection(Request $request)
    {
        // dd($request->all());
        $validated=$request->validate([
            'cat_one'=> 'required',
            'cat_two'=> 'required',
            'cat_three'=> 'required',
            'cat_four'=> 'required',
        ],
        [
            'cat_one.required' => 'The category one field is required.',
            'cat_two.required' => 'The category two field is required.',
            'cat_three.required' => 'The category three field is required.',
            'cat_four.required' => 'The category four field is required.',
        ]);
        $data=[
            [
                'category'=>$request->cat_one,
                'sub_category'=>$request->sub_cat_one,
                'child_category'=>$request->child_cat_one
            ],
            [
                'category'=>$request->cat_two,
                'sub_category'=>$request->sub_cat_two,
                'child_category'=>$request->child_cat_two
            ],
            [
                'category'=>$request->cat_three,
                'sub_category'=>$request->sub_cat_three,
                'child_category'=>$request->child_cat_three
            ],
            [
                'category'=>$request->cat_four,
                'sub_category'=>$request->sub_cat_four,
                'child_category'=>$request->child_cat_four
            ]
        ];
        HomePageSetting::updateOrCreate([
            'key'=>'popular_category_section',
        ],
        [
            'value'=>json_encode($data),
        ]);
        toastr('Update Successfully!', 'success', 'success');
        return redirect()->back();
    }
    /**
     * Product slider section one
     */
    public function updateProductSliderSectionOne(Request $request)
    {
        $validated=$request->validate([
            'cat_one'=> 'required',
        ],
        [
            'cat_one.required' => 'The category field is required.',
        ]);
        // dd($request->all());
        $data=[
                'category'=>$request->cat_one,
                'sub_category'=>$request->sub_cat_one,
                'child_category'=>$request->child_cat_one
        ];

        HomePageSetting::updateOrCreate([
            'key'=>'product_slider_section_one',
        ],
        [
            'value'=>json_encode($data),
        ]);
        toastr('Product Slider Section Update Successfully!', 'success', 'success');
        return redirect()->back();
    }
    /**
     * Product slider section two
     */
    public function updateProductSliderSectionTwo(Request $request)
    {
        $validated=$request->validate([
            'cat_one'=> 'required',
        ],
        [
            'cat_one.required' => 'The category field is required.',
        ]);
        // dd($request->all());
        $data=[
                'category'=>$request->cat_one,
                'sub_category'=>$request->sub_cat_one,
                'child_category'=>$request->child_cat_one
        ];

        HomePageSetting::updateOrCreate([
            'key'=>'product_slider_section_two',
        ],
        [
            'value'=>json_encode($data),
        ]);
        toastr('Product Slider Section Update Successfully!', 'success', 'success');
        return redirect()->back();
    }
    /**
     * Product slider section three
     */
    public function updateProductSliderSectionThree(Request $request)
    {
        // dd($request->all());
         $validated=$request->validate([
            'cat_one'=> 'required',
            'cat_two'=> 'required',
        ],
        [
            'cat_one.required' => 'The category one field is required.',
            'cat_two.required' => 'The category two field is required.',
        ]);
        $data=[
            [
                'category'=>$request->cat_one,
                'sub_category'=>$request->sub_cat_one,
                'child_category'=>$request->child_cat_one
            ],
            [
                'category'=>$request->cat_two,
                'sub_category'=>$request->sub_cat_two,
                'child_category'=>$request->child_cat_two
            ],
        ];
        HomePageSetting::updateOrCreate([
            'key'=>'product_slider_section_three',
        ],
        [
            'value'=>json_encode($data),
        ]);
        toastr('Update Successfully!', 'success', 'success');
        return redirect()->back();
    }
}
