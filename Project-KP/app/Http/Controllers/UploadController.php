<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    
	public function upload(){
		return view('upload');
	}

	public function proses_upload(Request $request){
		$this->validate($request, [
			'file' => 'required',
			'keterangan' => 'required',
		]);

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
 
        return redirect('upload')->with('status', 'File Has been uploaded successfully!');
 
    }

	}
}
