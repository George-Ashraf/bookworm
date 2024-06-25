<?php

namespace App\Http\Controllers;

use App\Models\author;
use App\Models\book;
use App\Models\booksharing_one;
use App\Models\booksharingsection;
use App\Models\bookstore;
use App\Models\delivery_man;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $data['user'] = db::table('users')->where('premium','none')->count();
        $data['premium'] = db::table('users')->where('premium','done')->count();
        $data['author'] = db::table('author')->count();
        $data['bookstore'] =db::table('book_store')->count();

        $data['users'] = db::table('users')->where('premium','none')->get();
        $data['preusers'] = db::table('users')->where('premium','done')->get();
        $data['authors'] = author::all();
        $data['bookstores'] = bookstore::all();

        $data['all_book']=DB::table('book')->count();
        $data['shared_book1']=DB::table('book_sharing_one')->count();
        $data['shared_book2']=DB::table('book_sharing_two')->count();



        return view('dashboard.dashboard',$data);
    }
}
