<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\date;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Storage;

class DownloadFileController extends Controller
{
    public function download(Product $product)
    {
        //$destinationPath='filename/';
        //$headers=['Content-Type: '];
        //$fileName=time();
        //return response()->download($fileName,$destinationPath,$headers);
        return storage::download();
        
    }
}
