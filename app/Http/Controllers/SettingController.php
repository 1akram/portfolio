<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Setting;
class SettingController extends Controller
{
    public function updateSetting(Request $request){
        Validator::make($request->all(),[
            'title' => 'required|string|max:255',
            'KeyWords' => 'required|string ',
            'logo'=>'nullable|mimes:png|max:2050'
        ])->validate();
        $setting=Setting::all()->first();
        $setting->siteTitle=$request->title;
        $setting->keyWord=$request->KeyWords;
        if(!empty($request->logo)){
            if ($request->logo->isValid()) {
                Storage::disk('public')->delete($setting->logo);
                $setting->logo=$request->logo->store('logo', 'public' );
            }   
            
        }
        $setting->save();
        return redirect()->back();


    }
}
