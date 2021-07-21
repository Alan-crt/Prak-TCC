<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileUploadController extends Controller
{
   public function FileUpload()
    {
        return view('file-upload');
    }
 
    public function store(Request $request)
    {
         
        $validatedData = $request->validate([
         'file' => 'required|csv,txt,xlx,xls,pdf|max:2048',
 
        ]);
                //nama file
        $name = $request->file('file')->getClientOriginalName();
                //tempat dimana file disimpan storage-public-files
        $path = $request->file('file')->store('public/files');
 
 
        $save = new File;
 
        $save->name = $name;
        $save->path = $path;
 
        return redirect('file-upload')->with('status', 'File Has been uploaded successfully in laravel 8');
 
    }
}
