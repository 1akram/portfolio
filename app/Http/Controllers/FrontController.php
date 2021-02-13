<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
 class FrontController extends Controller
{
    //
    public function profileShow(){
        $user=User::all()->first();
         return view('index',compact([
            'user',
            
        ]));

    }
     
    // public function show() id 
    // edit id
    // update id 
}
