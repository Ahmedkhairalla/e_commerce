<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use League\CommonMark\Extension\CommonMark\Node\Inline\Strong;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products=Product::all();
        return view('admin.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'name'=>'required|string|max:255',
            'description'=>'required|string',
            'price'=>'required|integer|min:0',
            'quantity'=>'required|integer|min:1',
            'image'=>'nullable|image|mimes:jpeg,jpg,png|max:4000'
        ]);
            if($request->hasFile('image')){
       $data['image']= Storage::putFile('products',$request->image);  }
       product::create($data);
       session()->flash('success','product is added');
       return redirect('product');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product=product::find($id);
        return view('admin.product.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product=product::findOrFail($id);
        return view('admin.product.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
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
        session()->flash('success','product is updated');
        return redirect('products');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product=product::findOrFail($id);
        if($product->image){
            Storage::delete($product->image);

        }
        $product->delete();
        session()->flash('success','product is deleted');
return redirect('products');
    }
}
