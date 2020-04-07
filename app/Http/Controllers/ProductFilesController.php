<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Category;
use App\Subcategory;
use App\Product;
use App\ProductFile;

class ProductFilesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($productID)
    {
        if(auth()->user()->isAdmin())
            return view('pages.product_files.create')->with('productID', $productID);
        else abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(auth()->user()->isAdmin()){
            
            $this->validate($request,[
                'prodfile_file'=>'required'
            ]);
            
            // Handle file
            if($request->hasFile('prodfile_file')){

                // Get file name
                $fileNameFull = $request->file('prodfile_file')->getClientOriginalName();
                $fileName = pathinfo($fileNameFull, PATHINFO_FILENAME);
                $fileExt = pathinfo($fileNameFull, PATHINFO_EXTENSION);
                $fileNameToStore = $fileName.'_'.time().'.'.$fileExt;

                // Upload
                $file = $request->file('prodfile_file');
                $file->storeAs('productfiles/', $fileNameToStore, 'public_uploads');
                
                $product_file = new ProductFile;
                
                if($request->input('prodfile_name') != '')
                    $product_file->name = $request->input('prodfile_name');
                else $product_file->name = $fileName;

                $product_file->file_name = $fileNameToStore;
                $product_file->product_id = $request->input('prodfile_productID');

                if(strtolower($fileExt) == 'jpg' || strtolower($fileExt) == 'jpeg' || strtolower($fileExt) == 'png')
                    $product_file->type = 'image';
                else if(strtolower($fileExt) == 'pdf' || strtolower($fileExt) == 'docx' || strtolower($fileExt) == 'doc' || strtolower($fileExt) == 'pptx' || strtolower($fileExt) == 'xlsx')
                    $product_file->type = 'document';
                else return "Not supported file type. Supported types: PDF, DOCX, DOC, PPTX, XLSX.";

                $product_file->save();
                return redirect('products/'.$product_file->product_id);
            }
            else return "No file";
        }
        else abort(404);
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
        if(auth()->user()->isAdmin()){
            $product_file = ProductFile::find($id);
            if($product_file == null) abort(404);
            return view('pages.product_files.edit') -> with('product_file', $product_file);
        }
        else abort(404);
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
        if(auth()->user()->isAdmin()){
            
            $this->validate($request,[
                'prodfile_name'=>'required'
            ]);
            
            $product_file = ProductFile::find($id);
            if($product_file == null) abort(404);
            $product_file->name = $request->input('prodfile_name');
            $product_file->save();
            return redirect('products/'.$product_file->product_id);
        }
        else abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(auth()->user()->isAdmin()){
            $product_file = ProductFile::find($id);
            if($product_file == null) abort(404);
            Storage::disk('public_uploads')->delete('productfiles/'.$product_file->file_name);
            $productID = $product_file->product_id;
            $product_file->delete();
            return redirect('products/'.$productID);
        }
        else abort(404);
    }
}