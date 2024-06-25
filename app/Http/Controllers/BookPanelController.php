<?php

namespace App\Http\Controllers;

use App\Http\Traits\attachfiletrait;
use App\Models\book;
use App\Models\category;
use App\Models\review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookPanelController extends Controller
{
    use attachfiletrait;

    public function __construct()
    {
        $this->middleware('auth:author,admin,bookstore');
    }
    public function index()
    {
        if (auth('author')->check()) {
            $product = DB::table('book')->where('author_id', Auth()->user()->id)->get();
            $revenue = DB::table('revenue')->where('author_id', Auth()->user()->id)->get();
            $countrevenue = DB::table('revenue')->where('author_id', Auth()->user()->id)->sum('author_revenue');
            $pri_product=null;


        }
         elseif (auth('admin')->check()) {
            $pri_product = db::table('book')->where('status','private')->get();
            $product = db::table('book')->where('status','public')->get();

            $revenue=null;
            $countrevenue=null;
        }
        elseif (auth('bookstore')->check()) {
            $product = DB::table('book')->where('bookstore_id', Auth()->user()->id)->get();
            $revenue = DB::table('revenue')->where('bookstore_id', Auth()->user()->id)->get();
            $countrevenue = DB::table('revenue')->where('bookstore_id', Auth()->user()->id)->sum('bookstore_revenue');
            $pri_product=null;


        }
        return view('bookpanel.bookpanel', compact('product','revenue','countrevenue','pri_product'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = category::all();
        return view('bookpanel.createbook', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $all_book = new book();

        $request->validate([
            'book_file' => 'file|max:4096|mimes:pdf|nullable',
            'book_cover' => 'required|file|max:1024|mimes:,jpg,jpeg,webp,gif,svg',
            'book_name' => 'required|string|max:20',
            'language' => 'required|string|max:20',
            'format' => 'required',
            'description' => 'required|string',
            'author' => 'required|string',
            'price_soft' => 'nullable|numeric',
            'price_hard' => 'nullable|numeric',
            'category' => 'required|string',


        ]);



        $all_book->format = $request->format;
        $all_book->pricehard = $request->price_hard;
        $all_book->pricesoft = $request->price_soft;

        $all_book->book_cover =  $request->file('book_cover')->getClientOriginalName();
        if ($all_book->format == 'soft copy') {
            $request->validate([
                'book_file' => 'file|max:4096|mimes:pdf|required',
                'price_soft' => 'required|numeric',

            ]);

            $all_book->book_file =    $request->file('book_file')->getClientOriginalName();
            $all_book->choose = 'soft';
        } elseif ($all_book->format == 'hard copy & soft copy') {
            $request->validate([
                'book_file' => 'file|max:4096|mimes:pdf|required',
                'price_soft' => 'required|numeric',
                'price_hard' => 'required|numeric',


            ]);
            $all_book->book_file =   $request->file('book_file')->getClientOriginalName();
        } else {
            $request->validate([

                'price_hard' => 'required|numeric',


            ]);
        }
        $all_book->book_name = $request->book_name;
        $all_book->language = $request->language;
        $all_book->description = $request->description;
        $all_book->author = $request->author;


        $all_book->category_id = $request->category;
        if (auth('admin')->check()) {
            $all_book->admin_id = Auth()->user()->id;
        } else if (auth('author')->check()) {
            $all_book->author_id = Auth()->user()->id;
        } else if (auth('bookstore')->check()) {
            $all_book->bookstore_id = Auth()->user()->id;
        }
        $all_book->save();



        $this->uploadFile($request, 'book_cover','book_panel'. $all_book->id);
        if ($all_book->format == 'soft copy') {

            $this->uploadFile($request, 'book_file', 'book_panel'. $all_book->id);
        } elseif ($all_book->format == 'hard copy & soft copy') {
            $this->uploadFile($request, 'book_file', 'book_panel'. $all_book->id);
        }
        return redirect()->route('bookpanel.all');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\book  $book
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $all_book = book::findOrFail($id);
        $reviews=db::table('reviews')->where('book_id',$all_book->id)->get();
        $countreviews=db::table('reviews')->where('book_id',$all_book->id)->count();
        $sumreviews=db::table('reviews')->where('book_id',$all_book->id)->sum('rate');

        if ($reviews->isNotEmpty()) {
            $ave=$sumreviews/$countreviews;
        } else {
            $ave = null; // No reviews, set averageRating to null or 0
        }
        if($all_book->rate=='done'){
            return view('bookpanel.show', compact('all_book','reviews','ave'));

        }
        else{
            return view('bookpanel.show', compact('all_book','reviews'));

        }

    }
    public function status($id)
    {


        $book = book::findOrFail($id);
        if ($book->status == 'private') {

            $book->status = 'public';
            $book->save();
            return redirect()->route('bookpanel.all');
        } else if ($book->status == 'public') {
            $book->status = 'private';
            $book->save();


            return redirect()->route('bookpanel.all');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category=category::all();
        $book=book::findOrFail($id);
        return view('bookpanel.edit',compact('book','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $all_book =  book::findOrFail($id);

        $request->validate([
            'book_file' => 'file|max:4096|mimes:pdf|nullable',
            'book_cover' => 'file|max:1024|mimes:,jpg,jpeg,webp,gif,svg',
            'book_name' => 'required|string|max:20',
            'language' => 'required|string|max:20',
            'format' => 'required',
            'description' => 'required|string',
            'author' => 'required|string',
            'price_soft' => 'nullable|numeric',
            'price_hard' => 'nullable|numeric',
            'category' => 'required|string',


        ]);



        $all_book->format = $request->format;
        $all_book->pricehard = $request->price_hard;
        $all_book->pricesoft = $request->price_soft;

        if ($request->hasfile('book_cover')) {

            $this->deleteFile($all_book->book_cover, 'book_panel'. $all_book->id);

            $this->uploadFile($request, 'book_cover', 'book_panel'. $all_book->id);

            $book_cover_new =  $request->file('book_cover')->getClientOriginalName();

            $all_book->book_cover = $all_book->book_cover !== $book_cover_new ? $book_cover_new : $all_book->book_cover;
        }
        if ($all_book->format == 'soft copy') {
            $request->validate([
                'book_file' => 'file|max:4096|mimes:pdf',
                'price_soft' => 'required|numeric',

            ]);

            if ($request->hasfile('book_file')) {

                $this->deleteFile($all_book->book_file, 'book_panel'. $all_book->id);

                $this->uploadFile($request, 'book_file', 'book_panel'. $all_book->id);

                $book_file_new =  $request->file('book_file')->getClientOriginalName();

                $all_book->book_file = $all_book->book_file !== $book_file_new ? $book_file_new : $all_book->book_file;
            }
            $all_book->choose = 'soft';
        }
         elseif ($all_book->format == 'hard copy & soft copy') {
            $request->validate([
                'book_file' => 'file|max:4096|mimes:pdf',
                'price_soft' => 'required|numeric',
                'price_hard' => 'required|numeric',


            ]);
            if ($request->hasfile('book_file')) {

                $this->deleteFile($all_book->book_file, 'book_panel'. $all_book->id);

                $this->uploadFile($request, 'book_file', 'book_panel'. $all_book->id);

                $book_file_new =  $request->file('book_file')->getClientOriginalName();

                $all_book->book_file = $all_book->book_file !== $book_file_new ? $book_file_new : $all_book->book_file;
            }
        }
        else
        {
            $request->validate([

                'price_hard' => 'required|numeric',


            ]);
        }
        $all_book->book_name = $request->book_name;
        $all_book->language = $request->language;
        $all_book->description = $request->description;
        $all_book->author = $request->author;


        $all_book->category_id = $request->category;
        // if (auth('admin')->check()) {
        //     $all_book->admin_id = Auth()->user()->id;
        // } else if (auth('author')->check()) {
        //     $all_book->author_id = Auth()->user()->id;
        // } else if (auth('bookstore')->check()) {
        //     $all_book->bookstore_id = Auth()->user()->id;
        // }
        $all_book->save();




        return redirect()->route('all_book.show',$all_book->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
