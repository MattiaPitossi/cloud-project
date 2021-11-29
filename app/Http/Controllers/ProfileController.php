<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function getUserProfile()
    {
        $user_id = Auth::user()->id;


        $user_data = DB::table('users')->where('id','=',$user_id)->get();
        return view('profile', compact('user_data'));
    }

    public function update(Request $request, $name, $email, $phone = null, $mobile = null, $address = null)
    {
        dd($email);


        $user_id = Auth::user()->id;

        return redirect()->route('index')
            ->with('success', 'Profile updated successfully');
    }
}
