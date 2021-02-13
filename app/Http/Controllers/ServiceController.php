<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function addService(){
        return view('admin.addService');
    }
    public function saveService(Request $request){
        Validator::make($request->all(),[
            'title' => 'required|string|max:255',
            'description' => 'required|string ',
            'icon' => 'required|string|max:255',
        ])->validate();
        $service=new service();
        $service->title=$request->title;
        $service->description=$request->description;
        $service->icon=$request->icon;
        $service->user()->associate(1);//Auth::user() 
        $service->save();
        return redirect()->route('dashboard');
    }


    public function editService($id){
        Validator::make(['id'=>$id],[
            'id' => 'exists:services,id',
            
        ])->validate(); // lazem tzid tchof idha hadh l user howa mol service hadhi --ki tkon bzaf l users  (service exist && service->belongeto(thisUser))
        $service=Service::find($id);
         return view('admin.editService',compact([
            'service',
        ]));
    }


    public function updateService(Request $request){
        Validator::make($request->all(),[
            'id' => 'exists:services,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string ',
            'icon' => 'required|string|max:255',
        ])->validate(); // lazem tzid tchof idha hadh l user howa mol service hadhi --ki tkon bzaf l users  (service exist && service->belongeto(thisUser))
        $service=Service::find($request->id);
         $service->title=$request->title;
        $service->description=$request->description;
        $service->icon=$request->icon;
        $service->save();
        return redirect()->route('editService',$service->id);
        
    }
}
