<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class UserProductController extends Controller
{
    public function index()
    {
        $products=product::all();
        return view('user.products.index',compact('products'));
    }
}
