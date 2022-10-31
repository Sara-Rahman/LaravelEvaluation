<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;

class SubCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $category=Category::all();
        $subcategories=Subcategory::all();
        return view('layouts.pages.subcategories',compact('category','subcategories'));
        
    }
   
    public function store(Request $request){
        
        $validator=Validator::make($request->all(),[
        'title'=>'required',
        'description'=>'required',
        'category_id'=>'required',
        ]);
        if($validator->fails()){
            return response()->json([
                'status'=>400,
                'errors'=>$validator->message(),
    
            ]);
        }
        else{
            $subcategory=new Subcategory;
            $subcategory->title=$request->input('title');
            $subcategory->description=$request->input('description');
            $subcategory->category_id=$request->input('category_id');
            $subcategory->save();
            return response()->json([
                'status'=>200,
                'message'=>"Subcategory Created Successfully",
    
            ]);
        }
            
        }
        public function destroy($id){
            $category=Subcategory::find($id);
            $category->delete();
            return response()->json([
                'status'=>200,
                'message'=>"SubCategory Deleted Successfully",
    
            ]);
        }
}
