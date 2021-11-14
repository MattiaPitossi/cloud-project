<?php

namespace App\Http\Controllers;

use App\Models\FileUploaded;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileUploadedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $file_uploaded = FileUploaded::where('user_id', $user_id)->latest()->get();

        return view('index', compact('file_uploaded'));
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

}
