<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    public function getUserProfile()
    {
        $user_id = Auth::user()->id;


        $user_data = DB::table('users')->where('id', '=', $user_id)->get();
        return view('profile', compact('user_data'));
    }

    public function update(Request $request, $id)
    {


        User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'mobile' => $request->mobile,
            'address' => $request->address,
        ]);

        return redirect()->back();
    }

    public function delete()
    {
        $user_id = Auth::user()->id;

        Auth::logout();
        $file_ids = DB::table('file_uploaded')->where('user_id', '=', $user_id)->pluck('id')->all();

        foreach ($file_ids as $id) {
            $file_name = DB::table('file_uploaded')->where('id', '=', $id)->pluck('name')->first();
            DB::table("file_uploaded")->where('id', '=', $id)->delete();
            Storage::disk('local')->delete("file_uploaded/" . $file_name);
        }

        DB::table('users')->where('id', '=', $user_id)->delete();

        return Redirect::route('login')->with('global', 'Your account has been deleted!');
    }
}
