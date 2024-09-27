<?php

 namespace App\Traits;

use Illuminate\Http\Request;
use File;

 trait ImageUploadTrait{
    /** handle single image file */
    public function uploadImage(Request $request, $inputName, $path) {
        if($request->hasFile($inputName)){
            $image=$request->{$inputName};
            $ext=$image->getClientOriginalExtension();
            $imageName='media_'.uniqid().'.'.$ext;
            $image->move(public_path($path),$imageName);
            return $path.'/'.$imageName;
        }
    }

    /** handle multi image file */
    public function uploadMultiImage(Request $request, $inputName, $path) {
        $imagepaths=[];
        if($request->hasFile($inputName)){
            $images=$request->{$inputName};
            foreach ($images as $image) {
                $ext=$image->getClientOriginalExtension();
                $imageName='media_'.uniqid().'.'.$ext;
                $image->move(public_path($path),$imageName);
                $imagepaths[]= $path.'/'.$imageName;
            }
            return $imagepaths;

        }
    }
    /** handle single image update file  */
    public function updateImage(Request $request, $inputName, $path, $oldPath=null) {
        if($request->hasFile($inputName)){
            if(File::exists(public_path($oldPath))){
                File::delete(public_path($oldPath));
            }
            $image=$request->{$inputName};
            $ext=$image->getClientOriginalExtension();
            $imageName='media_'.uniqid().'.'.$ext;
            $image->move(public_path($path),$imageName);
            return $path.'/'.$imageName;


        }
    }
    /** handle delete file */
    public function deleteImage(string $path) {
        if(File::exists(public_path($path))){
            File::delete(public_path($path));
        }
    }


 }
