<?php

namespace App\Http\Controllers;

use App\Http\Traits\attachfiletrait;
use App\Models\book;
use App\Models\category;
use App\Models\summary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    use attachfiletrait;
    public function __construct()
    {
        $this->middleware('auth:author,admin,bookstore,web');
    }


    public function index()
    {
        $category = category::all();
        $product = DB::table('book')->where('status', 'public')->get();
        return view('books.index', compact('product', 'category'));
    }
    public function show($id)
    {
        $product = book::findOrFail($id);
        $summary = db::table('summary')->where('book_id', $product->id)->first();
        $reviews = db::table('reviews')->where('book_id', $product->id)->get();
        $countreviews = db::table('reviews')->where('book_id', $product->id)->count();
        $sumreviews = db::table('reviews')->where('book_id', $product->id)->sum('rate');
        if ($reviews->isNotEmpty()) {
            $ave=$sumreviews/$countreviews;
        } else {
            $ave = null; // No reviews, set averageRating to null or 0
        }
        if ($product->rate == 'done') {
            return view('books.show', compact('product', 'summary', 'reviews', 'ave'));
        } else {
            return view('books.show', compact('product', 'summary', 'reviews'));
        }
    }
    public function choose($id)
    {
        $format = book::findOrFail($id);
        if ($format->choose == 'hard') {

            $format->choose = 'soft';
            $format->save();
            return redirect()->back();
        } else if ($format->choose == 'soft') {

            $format->choose = 'hard';
            $format->save();

            return redirect()->back();
        }
    }

    public function purchased()
    {
        $purchased =  db::table('purchased_book')->where('user_id', auth()->user()->id)->get();
        return view('books.purchasedbook', compact('purchased'));
    }
    public function downloadpurchased($filename, $id)
    {
        $book = book::findOrFail($id);
        return response()->download(public_path('attachments/' . 'book_panel' . $book->id . '/' . $filename));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(book $book)
    {
        //
    }



    public function search(Request $request)
    {
        $category = category::all();

        $name = $request->search;
        $se_book = book::where('book_name', 'like', '%' . $name . '%')->orwhere('pricehard', 'like', '%' . $name . '%')->orwhere('pricesoft', 'like', '%' . $name . '%')->orwhere('author', 'like', '%' . $name . '%')->get();

        return view('books.search', compact('se_book', 'name', 'category'));
    }
}
