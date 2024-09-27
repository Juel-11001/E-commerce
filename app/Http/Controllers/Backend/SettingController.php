<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\EmailConfiguration;
use App\Models\GeneralSetting;
use App\Models\LogoSetting;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    use ImageUploadTrait;
    public function index(){
        $generalSetting=GeneralSetting::first();
        $emailConfiguration=EmailConfiguration::first();
        $logoSetting=LogoSetting::first();
        return view('backend.admin.settings.index', compact('generalSetting','emailConfiguration','logoSetting'));
    }
    public function generalSettingUpdate(Request $request){
        // dd($request->all());
        $validation=$request->validate([
           'site_name'=>'required|max:200',
           'layout'=>'required',
            'contact_email'=>'required|email',
            'currency_name'=>'required|max:200',
            'currency_icon'=>'required|max:200',
            'timezone'=>'required',

        ]);
        GeneralSetting::updateOrCreate(['id'=>1], [
            'site_name'=>$request->site_name,
            'layout'=>$request->layout,
            'contact_email'=>$request->contact_email,
            'contact_phone'=>$request->contact_phone,
            'contact_address'=>$request->contact_address,
            'currency_name'=>$request->currency_name,
            'currency_icon'=>$request->currency_icon,
            'time_zone'=>$request->timezone,
            'map'=>$request->map
        ]);
        Cache::forget('general_setting');
        toastr('Settings Updated Successfully','success', 'Success');
        return redirect()->back();
    }

    /** email configuration setting update */
    public function emailConfigurationUpdate(Request $request)
    {
        // dd($request->all());
        $validation = $request->validate([
            'email' => 'required|email',
            'mail_host' => 'required|max:200',
            'smtp_username' => 'required|max:200',
            'smtp_password' => 'required|max:200',
            'smtp_port' => 'required|max:200',
            'email_encryption' => 'required|max:200',
        ]);
        EmailConfiguration::updateOrCreate(
            ['id' => 1],
            [
                'email' => $request->email,
                'host' => $request->mail_host,
                'username' => $request->smtp_username,
                'password' => $request->smtp_password,
                'port' => $request->smtp_port,
                'encryption' => $request->email_encryption
            ]);
        toastr('Settings Updated Successfully', 'success', 'Success');
        return redirect()->back();
    }

    public function logSettingUpdate(Request $request)
    {
        $validation=$request->validate([
            'logo' =>'image|max:3072',
            'favicon' => 'image|max:3072'
         ]);
         $logoPath=$this->updateImage($request, 'logo', 'uploads/logo', $request->old_logo);
         $favicon=$this->updateImage($request, 'favicon', 'uploads/logo', $request->old_favicon);
         LogoSetting::updateOrCreate([
            'id'=>1
         ],[
            'logo'=>!empty($logoPath) ? $logoPath : $request->old_logo,
            'favicon'=>!empty($favicon) ? $favicon : $request->old_favicon,
         ]);
         toastr('Logo setting Updated Successfully!', 'success', 'Success');
         return redirect()->back();

    }

}
