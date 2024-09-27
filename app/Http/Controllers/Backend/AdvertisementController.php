<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    use ImageUploadTrait;
    public function index()
    {
        $homepage_banner_section_one=Advertisement::where('key', 'homepage_banner_section_one')->first();
        $homepage_banner_section_one=json_decode($homepage_banner_section_one->value);
        $homepage_banner_section_two=Advertisement::where('key', 'homepage_banner_section_two')->first();
        $homepage_banner_section_two=json_decode($homepage_banner_section_two?->value);
        $homepage_banner_section_three=Advertisement::where('key', 'homepage_banner_section_three')->first();
        $homepage_banner_section_three=json_decode($homepage_banner_section_three?->value);
        $homepage_banner_section_four=Advertisement::where('key', 'homepage_banner_section_four')->first();
        $homepage_banner_section_four=json_decode($homepage_banner_section_four?->value);
        $productpage_banner_section=Advertisement::where('key', 'productpage_banner_section')->first();
        $productpage_banner_section=json_decode($productpage_banner_section?->value);
        $cartpage_banner_section=Advertisement::where('key', 'cartpage_banner_section')->first();
        $cartpage_banner_section=json_decode($cartpage_banner_section?->value);
        return view('backend.admin.advertisement.index', compact('homepage_banner_section_one', 'homepage_banner_section_two','homepage_banner_section_three','homepage_banner_section_four','productpage_banner_section','cartpage_banner_section'));
    }
    public function homepageBannerSectionOne(Request $request)
    {
        // dd($request->all());
        $validation = $request->validate([
           'banner_url' => 'required',
           'banner_image'=> 'image',
        ]);

        //handle image upload
        $imagePath=$this->uploadImage($request, 'banner_image', 'uploads/advertisement');

        $value=[
            'banner_one'=>[
                'banner_url'=>$request->banner_url,
                'status' => $request->status == 'on' ? 1 : 0,
            ]
        ];
        if(!empty($imagePath)){
            $value['banner_one']['banner_image'] = $imagePath;
        }else{
            $value['banner_one']['banner_image'] = $request->banner_old_image;
        }
        $value = json_encode($value);

        Advertisement::updateOrCreate(
           ['key' => 'homepage_banner_section_one'],
           ['value' => $value]
        );
        toastr()->success('Created Advertisement Successfully!');
        return redirect()->back();
    }
    public function homepageBannerSectionTwo(Request $request)
    {
        //  dd($request->all());
         $validation = $request->validate([
            'banner_one_url' => 'required',
            'banner_one_image'=> 'image',
            'banner_two_url' => 'required',
            'banner_two_image'=> 'image',
         ]);

         //handle image upload
         $imagePath=$this->uploadImage($request, 'banner_one_image', 'uploads/advertisement');
         $imagePathTwo=$this->uploadImage($request, 'banner_two_image', 'uploads/advertisement');

         $value=[
             'banner_one'=>[
                 'banner_one_url'=>$request->banner_one_url,
                 'banner_one_status' => $request->banner_one_status == 'on' ? 1 : 0,
             ],
             'banner_two'=>[
                 'banner_two_url'=>$request->banner_two_url,
                 'banner_two_status' => $request->banner_two_status == 'on' ? 1 : 0,
             ]
         ];
         if(!empty($imagePath)){
             $value['banner_one']['banner_one_image'] = $imagePath;
         }else{
             $value['banner_one']['banner_one_image'] = $request->banner_one_old_image;
         }
         if(!empty($imagePathTwo)){
             $value['banner_two']['banner_two_image'] = $imagePathTwo;
         }else{
             $value['banner_two']['banner_two_image'] = $request->banner_two_old_image;
         }
         $value = json_encode($value);

         Advertisement::updateOrCreate(
            ['key' => 'homepage_banner_section_two'],
            ['value' => $value]
         );
         toastr()->success('Created Advertisement Successfully!');
         return redirect()->back();
    }
    public function homepageBannerSectionThree(Request $request)
    {
         //  dd($request->all());
         $validation = $request->validate([
            'banner_one_url' => 'required',
            'banner_one_image'=> 'image',
            'banner_two_url' => 'required',
            'banner_two_image'=> 'image',
            'banner_three_url' => 'required',
            'banner_three_image'=> 'image',
         ]);

         //handle image upload
         $imagePath=$this->uploadImage($request, 'banner_one_image', 'uploads/advertisement');
         $imagePathTwo=$this->uploadImage($request, 'banner_two_image', 'uploads/advertisement');
         $imagePathThree=$this->uploadImage($request, 'banner_three_image', 'uploads/advertisement');

         $value=[
             'banner_one'=>[
                 'banner_one_url'=>$request->banner_one_url,
                 'banner_one_status' => $request->banner_one_status == 'on' ? 1 : 0,
             ],
             'banner_two'=>[
                 'banner_two_url'=>$request->banner_two_url,
                 'banner_two_status' => $request->banner_two_status == 'on' ? 1 : 0,
             ],
             'banner_three'=>[
                 'banner_three_url'=>$request->banner_three_url,
                 'banner_three_status' => $request->banner_three_status == 'on' ? 1 : 0,
             ]
         ];
         if(!empty($imagePath)){
             $value['banner_one']['banner_one_image'] = $imagePath;
         }else{
             $value['banner_one']['banner_one_image'] = $request->banner_one_old_image;
         }
         if(!empty($imagePathTwo)){
             $value['banner_two']['banner_two_image'] = $imagePathTwo;
         }else{
             $value['banner_two']['banner_two_image'] = $request->banner_two_old_image;
         }
         if(!empty($imagePathThree)){
             $value['banner_three']['banner_three_image'] = $imagePathThree;
         }else{
             $value['banner_three']['banner_three_image'] = $request->banner_three_old_image;
         }
         $value = json_encode($value);

         Advertisement::updateOrCreate(
            ['key' => 'homepage_banner_section_three'],
            ['value' => $value]
         );
         toastr()->success('Created Advertisement Successfully!');
         return redirect()->back();
    }
    public function homepageBannerSectionFour(Request $request)
    {
        //  dd($request->all());
         $validation = $request->validate([
            'banner_one_url' => 'required',
            'banner_one_image'=> 'image',
         ]);

         //handle image upload
         $imagePath=$this->uploadImage($request, 'banner_one_image', 'uploads/advertisement');

         $value=[
             'banner_one'=>[
                 'banner_one_url'=>$request->banner_one_url,
                 'banner_one_status' => $request->banner_one_status == 'on' ? 1 : 0,
             ]
         ];
         if(!empty($imagePath)){
             $value['banner_one']['banner_one_image'] = $imagePath;
         }else{
             $value['banner_one']['banner_one_image'] = $request->banner_one_old_image;
         }
         $value = json_encode($value);

         Advertisement::updateOrCreate(
            ['key' => 'homepage_banner_section_four'],
            ['value' => $value]
         );
         toastr()->success('Created Advertisement Successfully!');
         return redirect()->back();
    }
    public function productPageBanner(Request $request)
    {
        $validation = $request->validate([
            'banner_url' => 'required',
            'banner_image'=> 'image',
         ]);

         //handle image upload
         $imagePath=$this->uploadImage($request, 'banner_image', 'uploads/advertisement');

         $value=[
             'banner_one'=>[
                 'banner_url'=>$request->banner_url,
                 'status' => $request->status == 'on' ? 1 : 0,
             ]
         ];
         if(!empty($imagePath)){
             $value['banner_one']['banner_image'] = $imagePath;
         }else{
             $value['banner_one']['banner_image'] = $request->banner_old_image;
         }
         $value = json_encode($value);

         Advertisement::updateOrCreate(
            ['key' => 'productpage_banner_section'],
            ['value' => $value]
         );
         toastr()->success('Created Advertisement Successfully!');
         return redirect()->back();
    }
    public function cartpageBannerSection(Request $request)
    {
        //  dd($request->all());
        $validation = $request->validate([
            'banner_one_url' => 'required',
            'banner_one_image'=> 'image',
            'banner_two_url' => 'required',
            'banner_two_image'=> 'image',
         ]);

         //handle image upload
         $imagePath=$this->uploadImage($request, 'banner_one_image', 'uploads/advertisement');
         $imagePathTwo=$this->uploadImage($request, 'banner_two_image', 'uploads/advertisement');

         $value=[
             'banner_one'=>[
                 'banner_one_url'=>$request->banner_one_url,
                 'banner_one_status' => $request->banner_one_status == 'on' ? 1 : 0,
             ],
             'banner_two'=>[
                 'banner_two_url'=>$request->banner_two_url,
                 'banner_two_status' => $request->banner_two_status == 'on' ? 1 : 0,
             ]
         ];
         if(!empty($imagePath)){
             $value['banner_one']['banner_one_image'] = $imagePath;
         }else{
             $value['banner_one']['banner_one_image'] = $request->banner_one_old_image;
         }
         if(!empty($imagePathTwo)){
             $value['banner_two']['banner_two_image'] = $imagePathTwo;
         }else{
             $value['banner_two']['banner_two_image'] = $request->banner_two_old_image;
         }
         $value = json_encode($value);

         Advertisement::updateOrCreate(
            ['key' => 'cartpage_banner_section'],
            ['value' => $value]
         );
         toastr()->success('Created Advertisement Successfully!');
         return redirect()->back();
    }
}
