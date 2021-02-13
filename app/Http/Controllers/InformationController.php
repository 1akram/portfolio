<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use App\Models\User;

class InformationController extends Controller
{
    public function update(Request $request){
   
        Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'birthDay' => 'required|before:'.Carbon::now()->format('Y-m-d'),
            'email'=>'required|email',
            'phone'=>'required|regex:/^(\+)\d{1,3}(\s(\d{3})){3}$/',
            'address'=> 'required|string|max:255',
            'skillName'=> 'array|required_with:skillProgress',
            'skillProgress'=>'array|required_with:skillName|lte:skillName|gte:skillName',
            'skillName.*'=>'string|max:255',
            'skillProgress.*'=>'integer|min:0|max:100',
            'networkUrl'=> 'array|required_with:networkIcon',
            'networkIcon'=>'array|required_with:networkUrl|lte:networkUrl|gte:networkUrl',
            'networkUrl.*'=>'url|max:255',
            'networkIcon.*'=>'string|min:0|max:100',
            'avatar'=>'nullable|mimes:jpeg,png,jpg|max:2050', 
        ])->validate();
        
        $user=User::first(); //Auth::user()
        if($request->hasFile('avatar'))
            $user->uploadAvatar($request->avatar);
        $user->updateInfo($request->all());
        
 
        return redirect()->route('dashboard') ;      
      
            



    }
}
