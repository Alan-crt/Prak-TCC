<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GovernmentController extends Controller
{
    public function indexGovern(){
        return view ('government.govern');
    }
}
