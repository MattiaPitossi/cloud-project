<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\FileUploaded;


class DeletedFilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDeletedFiles()
    {
        $user_id = Auth::user()->id;
        $file_uploaded =  DB::table('file_uploaded')->where('user_id', $user_id)->where('is_deleted', '!=', 0)->latest()->get();

        return view('deleted_files', compact('file_uploaded'));
    }

    public function search(Request $request)
    {
        $user_id = Auth::user()->id;

        $true = 1;

        $file_uploaded = FileUploaded::where([
            ['name', '!=', Null], ['user_id', '=', $user_id],
            ['is_deleted', '=', $true],
            [function ($query) use ($request) {
                if (($term = $request->term)) {
                    $query->orWhere('name', 'LIKE', '%' . $term . '%')->get();
                }
            }]
        ])->orderBy("id", "desc")->paginate(10);

        return view('deleted_files', compact('file_uploaded'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function restoreFile($id)
    {
        DB::table('file_uploaded')->where('id', $id)->update(['is_deleted' => '0']);
        //return redirect()->back();
        return redirect()->back()->with('message', 'File restored successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //@DeleteMapping("/files/delete_definitely")
    public function deleteAll(Request $request)
    {
        $ids = $request->ids;

        $array_ids = explode(",", $ids);
        foreach ($array_ids as $id) {
            $file_name = DB::table('file_uploaded')->where('id', '=', $id)->pluck('name')->first();
            DB::table("file_uploaded")->where('id', '=', $id)->delete();
            Storage::disk('local')->delete("file_uploaded/" . $file_name);
        }
        return response()->json(['success' => "Files deleted from storage"]);
    }
}
