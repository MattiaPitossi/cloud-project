<?php

namespace App\Http\Controllers;

use App\Models\FileUploaded;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecentlyAddedFilesController extends Controller
{
    public function search(Request $request)
    {
        $user_id = Auth::user()->id;

        $file_uploaded = FileUploaded::where([
            ['name', '!=', Null], ['user_id', '=', $user_id],
            ['is_deleted', '=', 0],
            [function ($query) use ($request) {
                if (($term = $request->term)) {
                    $query->orWhere('name', 'LIKE', '%' . $term . '%')->get();
                }
            }]
        ])->orderBy("id", "desc")->paginate(10);

        return view('recently_added', compact('file_uploaded'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
