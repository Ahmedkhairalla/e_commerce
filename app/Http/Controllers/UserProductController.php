<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\User;
use Illuminate\Http\Request;

class UserProductController extends Controller
{
    public function index()
    {
        $products=product::all();
        return view('user.products.index',compact('products'));
    }
    public function show($id){
        $product=product::findOrFail($id);
        return view('user.products.Show',compact('product'));
    }
}
