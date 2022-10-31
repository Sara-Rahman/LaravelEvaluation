<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        
        $key=null;
        if(request()->search){
            $key=request()->search;
            $category=Category::all();  
            $subcategory=Subcategory::all();
            $products = Product::where('title','LIKE','%'.$key.'%')
                ->orWhere('price','LIKE','%'.$key.'%')
                ->get();    
            return view('layouts.pages.product',compact('category','subcategory','products','key')); 
        }
        $category=Category::all();
        $subcategory=Subcategory::all();
        $products=Product::all();
        return view('layouts.pages.product',compact('category','subcategory','products','key'));
    }
   
   
        
    
    public function store(Request $request){
    
    $validator=Validator::make($request->all(),[
    'title'=>'required',
    'description'=>'required',
    'price'=>'required',
    ]);
    if($validator->fails()){
        return response()->json([
            'status'=>400,
            'errors'=>$validator->message(),

        ]);
    }
    else{
        $product=new Product;
        $product->title=$request->input('title');
        $product->description=$request->input('description');
        $product->category_id=$request->input('category_id');
        $product->subcategory_id=$request->input('subcategory_id');
        $product->price=$request->input('price');
        $product->save();
        return response()->json([
            'status'=>200,
            'message'=>"Product Created Successfully",

        ]);
    }
        
    }
    public function destroy($id){
        $product=Product::find($id);
        $product->delete();
        return response()->json([
            'status'=>200,
            'message'=>"Product Deleted Successfully",

        ]);
    }
    
}
