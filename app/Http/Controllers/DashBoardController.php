<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Service;
class DashBoardController extends Controller
{
    public function show(){
        $services=Service::all();
        $user=Auth::user();
        return view('admin.dashBoard',compact(
            'user',
            'services',
        ));
    }
}
