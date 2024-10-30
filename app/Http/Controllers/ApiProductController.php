<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ApiProductController extends Controller
{
    public function index()
    {
        $products=product::all();
        $respnose=ProductResource::collection($products);
        return $respnose;
    }
    public function show($id){
        $product=product::find($id);
        if($product){
             return  new ProductResource($product);
        }
        return response()->json([
            'stutas'=>'success',
            'msg'=>'not find data '
        ],404);
    }
    public function store(Request $request)
    {
       $validate= Validator::make($request->all(),[
            'name'=>'required|string|max:255',
            'description'=>'nullable|string|max:255',
            'price'=>'required|integer|min:0',
            'quantity'=>'required|integer|min:1',
            'image'=>'nullable|image|mimes:jpeg,jpg,png|max:2048'
        ]);
    if($validate->fails()){
        return response()->json([
            'error'=>$validate->errors()
        ],300);
    }
    $image=Storage::putFile('products',$request->image);
    product::create([
        'name'=>$request->name,
        'description'=>$request->description,
        'price'=>$request->price,
        'quantity'=>$request->quantity,
        'image'=>$image,
    ]);
    return response()->json([
        'succrss'=>'product is added'
    ],200);
    }
    public function update(Request $request,$id)
    {
       $validate= Validator::make($request->all(),[
            'name'=>'required|string|max:255',
            'description'=>'nullable|string|max:255',
            'price'=>'required|integer|min:0',
            'quantity'=>'required|integer|min:1',
            'image'=>'nullable|image|mimes:jpeg,jpg,png|max:2048'
        ]);
    $product=product::find($id);
            $image=$product->image;
            if($request->hasFile('image')){
                Storage::delete($product->image);
                $image= Storage::putFile('products',$request->image);  }



    $product->update([
        'name'=>$request->name,
        'description'=>$request->description,
        'price'=>$request->price,
        'quantity'=>$request->quantity,
        'image'=>$image,
    ]);
    return response()->json([
        'succrss'=>'product is updated'
    ],200);
    }
        public function delete($id){
            $product=product::find($id);
            if($product->image){
                Storage::delete($product->image);}
            $product->delete();
            return response()->json([
            'succrss'=>'product is deleted'
        ],200);

        }


}
