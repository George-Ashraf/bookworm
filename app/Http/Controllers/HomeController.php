<?php

namespace App\Http\Controllers;

use App\Models\book;
use App\Models\opinion;
use App\Models\quotes;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  
    public function index()
    {
        $product= book::take(6)->get();
        $opinion=opinion::all();
        $quotes= quotes::all();
        return view('home',compact('quotes','opinion','product'));
    }
    public function selection()
    {
        return view('auth.selection');
    }

    public function profile(){
        return view('profile');
    }
}
