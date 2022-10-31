<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        return view('layouts.pages.categories');
        
    }
    public function fetchCategory(){
        $categories=Category::all();
        return response()->json([
            'categories'=>$categories,
        ]);
        
    }
   
    public function store(Request $request){
        
        $validator=Validator::make($request->all(),[
        'title'=>'required',
        'description'=>'required',
        
        ]);
        if($validator->fails()){
            return response()->json([
                'status'=>400,
                'errors'=>$validator->message(),
    
            ]);
        }
        else{
            $category=new Category;
            $category->title=$request->input('title');
            $category->description=$request->input('description');
            $category->save();
            return response()->json([
                'status'=>200,
                'message'=>"Category Created Successfully",
    
            ]);
        }
            
        }
        public function destroy($id){
            $category=Category::find($id);
            $category->delete();
            return response()->json([
                'status'=>200,
                'message'=>"Category Deleted Successfully",
    
            ]);
        }
}
