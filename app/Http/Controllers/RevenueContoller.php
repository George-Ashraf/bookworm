<?php

namespace App\Http\Controllers;

use App\Models\payment;
use App\Models\revenue;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class RevenueContoller extends Controller
{
    public function index()
    {
        $data['revenue'] = db::table('revenue')->sum('admin_revenue');
        $data['countrevenue'] = db::table('revenue')->count();
        $data['booksharing_one'] = db::table('payment')->where('type', 'booksharing_one_payment')->sum('price');
        $data['booksharing_two'] = db::table('payment')->where('type', 'booksharing_two_payment')->sum('price');
        $data['countbooksharing_one'] = db::table('payment')->where('type', 'booksharing_one_payment')->count();
        $data['countbooksharing_two'] = db::table('payment')->where('type', 'booksharing_two_payment')->count();
        $data['premium'] = db::table('payment')->where('type', 'premium')->sum('price');
        $data['countpremium'] = db::table('payment')->where('type', 'premium')->count();
        $data['seminar'] = db::table('payment')->where('type', 'offline_seminar')->sum('price');
        $data['countseminar'] = db::table('payment')->where('type', 'offline_seminar')->count();
        $data['revenuee'] = revenue::all();
        $data['book_sharing_one_payment'] = db::table('book_sharing_one_payment')->get();
        $data['book_sharing_two_payment'] = db::table('book_sharing_two_payment')->get();



        return view('dashboard.revenue', $data);
    }
}
