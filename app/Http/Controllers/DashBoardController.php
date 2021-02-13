<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Service;
class DashBoardController extends Controller
{
    public function show(){
        $services=Service::all();
        $user=User::first(); //Auth::user();
        return view('admin.dashBoard',compact(
            'user',
            'services',
        ));
    }
}
