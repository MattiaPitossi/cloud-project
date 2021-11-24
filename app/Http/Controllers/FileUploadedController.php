<?php

namespace App\Http\Controllers;

use App\Models\FileUploaded;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FileUploadedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {


        $user_id = Auth::user()->id;

        $file_uploaded = FileUploaded::where([
            ['name', '!=', Null], ['user_id', '=', $user_id],
            [function ($query) use ($request) {
                if (($term = $request->term)) {
                    $query->orWhere('name', 'LIKE', '%' . $term . '%')->get();
                }
            }]
        ])->orderBy("id", "desc")->paginate(10);

        return view('index', compact('file_uploaded'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function edit($id)
    {
        $user_id = Auth::user()->id;
        $file_uploaded = FileUploaded::where('id', $id)->where('user_id',$user_id)->first();
        return view('edit',compact('file_uploaded'));
    }


    public function index()
    {
        $user_id = Auth::user()->id;
        $file_uploaded = FileUploaded::where('user_id', $user_id)->latest()->get();

        return view('index', compact('file_uploaded'));
    }

    public function update(Request $request, $id)
    {
        //dd($request);
        $request->validate([
            'name' => 'required'
        ]);

        $user_id = Auth::user()->id;
        FileUploaded::where('id', $id)->where('user_id',$user_id)->update(['name' => $request->name]);

        return redirect()->route('index')
                        ->with('success','Product updated successfully');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $files = new FileUploaded($request->all());
        if ($request->file('file')) {

            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $size = $file->getSize();
            $request->file('file')->storeAs('file_uploaded', $filename, 'local');
            //insert into db
            $files->user_id = Auth::user()->id;
            $files->name = $filename;
            $files->size = $this->humanFileSize($size);
            $files->save();
        } else {
            return response()->json(['fail' => "Not a file."]);
        }

        //return response()->json(['success' => "File uploaded successfully."]);
        return redirect()->route('index');
    }

    function humanFileSize($size, $unit = "")
    {
        if ((!$unit && $size >= 1 << 30) || $unit == "GB")
            return number_format($size / (1 << 30), 2) . "GB";
        if ((!$unit && $size >= 1 << 20) || $unit == "MB")
            return number_format($size / (1 << 20), 2) . "MB";
        if ((!$unit && $size >= 1 << 10) || $unit == "KB")
            return number_format($size / (1 << 10), 2) . "KB";
        return number_format($size) . " bytes";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function download($id)
    {
        if (Storage::disk('local')->exists("file_uploaded/$id")) {
            $path = Storage::disk('local')->path("file_uploaded/$id");
            $content = file_get_contents($path);
            return response($content)->withHeaders(['Content-Type' => mime_content_type($path)]);
        }
        return redirect('/404');
    }

    //@DeleteMapping("/files/delete")
    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        DB::table("file_uploaded")->whereIn('id', explode(",", $ids))->delete();
        return response()->json(['success' => "Files deleted successfully"]);
    }
}
