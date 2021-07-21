<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\date;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(5);
        return view('products.index', compact('products'))
            ->with('i', (request()->input('page',1)-1)*5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'filename' => 'required|mimes:jpeg,png,jpg,gif,svg,doc,docx,pdf,xlx,xlsx,csv,txt|max:10048',
        ]);
  
        $input = $request->all();
  
        if ($filename = $request->file('filename')) {
            $destinationPath = 'filename';
            //$profilefilename = date('YmdHis') . "." . $filename->getClientOriginalExtension();
            $profilefilename = date('YmdHis').".".$filename->getClientOriginalExtension();
            $filename->move($destinationPath, $profilefilename);
            $input['filename'] = "$profilefilename";
        }
    
        Product::create($input);
     
        return redirect()->route('products.index')
                        ->with('success','Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required'
        ]);
  
        $input = $request->all();
  
        if ($filename = $request->file('filename')) {
            $destinationPath = 'filename/';
            $profilefilename = $filename->getClientOriginalName();
            $filename->move($destinationPath, $profilefilename);
            $input['filename'] = "$profilefilename";
        }else{
            unset($input['filename']);
        }
          
        $product->update($input);
    
        return redirect()->route('products.index')
                        ->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')
            ->with('success','Product deleted successfully!');
    }
    /**
     * Download the specified resource from storage.
     * 
     */
    public function download(Request $request, $id)
    {
        $pathToFile = resource_path('filename/'.$id);
        //$name= $profilefilename->getClientOriginalName($id);
        //$headers = ['Content-Type' => 'application/octet'];
        return response()->download($pathToFile);
        //return storage::download($filePath, $profilefilename, $headers);

    }
}
