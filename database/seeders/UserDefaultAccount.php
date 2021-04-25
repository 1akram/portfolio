<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;
class UserDefaultAccount extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()

    { 
       $user= new User([
           
            'email'=>env('INITIAL_EMAIL'),
            'password'=>Hash::make(env('INITIAL_PASSWORD')) ,
        ]) ;
        $user->save();
    }
}
