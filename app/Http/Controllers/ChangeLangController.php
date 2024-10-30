<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChangeLangController extends Controller
{
    public function index($lang){
        if($lang=='ar'){
            session()->put('lang','ar');
        }else{
            session()->put('lang','en');
        }
return redirect()->back();
    }
}
