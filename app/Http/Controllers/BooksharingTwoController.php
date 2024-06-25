<?php

namespace App\Http\Controllers;

use App\Http\Traits\attachfiletrait;
use App\Models\booksharing_one;
use App\Models\booksharing_two;
use App\Models\booksharingsection;
use App\Models\status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BooksharingTwoController extends Controller
{
    use attachfiletrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:web,admin');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

        $booksharingsection = booksharingsection::findOrFail($id);
        return view('booksharing.create2', compact('booksharingsection'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        $request->validate([
            'name' => 'required|string',
            'image' => 'required|file|max:1024|mimes:jpg,jpeg,webp,gif,svg',
            'book_file' => 'file|max:4096|mimes:pdf',
            'book_cover' => 'required|file|max:1024|mimes:,jpg,jpeg,webp,gif,svg',
            'book_name' => 'required|string|max:20',
            'language' => 'required|string|max:20',
            'format' => 'required',
            'type_of_book' => 'required|string',
            'description' => 'required|string',
            'author' => 'required|string',
            'used_around' => 'required',
        ]);

        $booksharing_two = new booksharing_two();
        $booksharing_two->name = $request->name;
        $booksharing_two->format = $request->format;
        $booksharing_two->book_cover =  $request->file('book_cover')->getClientOriginalName();
        $booksharing_two->image =  $request->file('image')->getClientOriginalName();
        if ($booksharing_two->format == 'soft copy') {
            $request->validate([

                'book_file' => 'required|file|max:4096|mimes:pdf',

            ]);
            $booksharing_two->book_file =  $request->file('book_file')->getClientOriginalName();
        }
        $booksharing_two->book_name = $request->book_name;
        $booksharing_two->language = $request->language;
        $booksharing_two->type_of_book = $request->type_of_book;
        $booksharing_two->description = $request->description;
        $booksharing_two->author = $request->author;
        $booksharing_two->used_around = $request->used_around;
        $booksharing_two->reader_id = Auth()->user()->id;
        $booksharing_two->BS_section_id = $request->BS_section_id;
        $booksharing_two->save();
        $this->uploadFile($request, 'book_cover', 'booksharing_two'.$booksharing_two->id);
        $this->uploadFile($request, 'image', 'booksharing_two'.$booksharing_two->id);

        if ($booksharing_two->format == 'soft copy') {

            $this->uploadFile($request, 'book_file', 'booksharing_two'.$booksharing_two->id);
        }

        $booksharingsection =  booksharingsection::findOrFail($request->BS_section_id);
        $booksharingsection->section_name = $request->section_name;
        $booksharingsection->booksharing_two_upload = "submit";
        $booksharingsection->format_two = $booksharing_two->format;

        $booksharingsection->share_two = Auth()->user()->id;

        $booksharingsection->save();
        Db::commit();
        return redirect()->route('booksharingsection.index')->with('done','shared done wait another user to accept your book');
    }


    public function status($id)
    {


        $booksharing_section = booksharingsection::findOrFail($id);
        if ($booksharing_section->status_two == 'reject') {
            $booksharing_section->status_two = 'accept';
            $booksharing_section->save();
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }
    public function show($id, $BSid)
    {

        $booksharing_two = booksharing_two::findOrFail($id);
        $booksharingsection = booksharingsection::findOrFail($BSid);
        $booksharing_one=db::table('book_sharing_one')->where('BS_section_id',$booksharing_two->BS_section_id)->first();

        return view('booksharing.show2', compact('booksharing_two', 'booksharingsection','booksharing_one'));
    }

    public function edit($id, $BSid)
    {
        $booksharing_two = booksharing_two::findOrFail($id);
        $booksharingsection = booksharingsection::findOrFail($BSid);

        return view('booksharing.edit2', compact('booksharing_two', 'booksharingsection'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\booksharing_one  $booksharing_one
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $BSid)
    {
        $request->validate([
            'name' => 'required|string',
            'image' => 'file|max:1024|mimes:jpg,jpeg,webp,gif,svg',
            'book_file' => 'file|max:4096|mimes:pdf',
            'book_cover' => 'file|max:1024|mimes:jpg,jpeg,webp,gif,svg',
            'book_name' => 'required|string|max:20',
            'language' => 'required|string|max:20',
            'format' => 'required',
            'type_of_book' => 'required|string',
            'description' => 'required|string',
            'author' => 'required|string',
            'used_around' => 'required',

        ]);
        db::beginTransaction();
        $booksharing_two =  booksharing_two::findOrFail($id);
        $booksharingsection = booksharingsection::findOrFail($BSid);
        $booksharing_two->name = $request->name;
        if ($request->hasfile('image')) {

            $this->deleteFile($booksharing_two->image, 'booksharing_two'.$booksharing_two->id);

            $this->uploadFile($request, 'image', 'booksharing_two'.$booksharing_two->id);

            $image_new = $request->file('image')->getClientOriginalName();

            $booksharing_two->image = $booksharing_two->image !== $image_new ? $image_new : $booksharing_two->image;
        }
        if ($request->hasfile('book_file')) {

            $this->deleteFile($booksharing_two->book_file, 'booksharing_two'.$booksharing_two->id);

            $this->uploadFile($request, 'book_file', 'booksharing_two'.$booksharing_two->id);

            $book_file_new =  $request->file('book_file')->getClientOriginalName();

            $booksharing_two->book_file = $booksharing_two->book_file !== $book_file_new ? $book_file_new : $booksharing_two->book_file;
        }
        if ($request->hasfile('book_cover')) {

            $this->deleteFile($booksharing_two->book_cover, 'booksharing_two'.$booksharing_two->id);

            $this->uploadFile($request, 'book_cover', 'booksharing_two'.$booksharing_two->id);

            $book_cover_new =  $request->file('book_cover')->getClientOriginalName();

            $booksharing_two->book_cover = $booksharing_two->book_cover !== $book_cover_new ? $book_cover_new : $booksharing_two->book_cover;
        }
        $booksharing_two->book_name = $request->book_name;
        $booksharing_two->language = $request->language;
        $booksharing_two->format = $request->format;
        $booksharing_two->type_of_book = $request->type_of_book;
        $booksharing_two->description = $request->description;
        $booksharing_two->author = $request->author;
        $booksharing_two->used_around = $request->used_around;
        // $booksharing_two->reader_id = Auth()->user()->id;
        $booksharing_two->BS_section_id = $booksharingsection->id;
        $booksharing_two->save();
        $booksharingsection->format_two = $booksharing_two->format;
        $booksharingsection->save();
        db::commit();
        return redirect()->route('booksharingsection.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\booksharing_two  $booksharing_two
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $BSid)
    {
        Db::beginTransaction();

        $booksharingsection = booksharingsection::findOrFail($BSid);
        $booksharingsection->booksharing_two_upload = 'none';
        $booksharingsection->status_two = 'reject';
        $booksharingsection->share_two = null;
        $booksharingsection->payment_two = 'none';


        $booksharingsection->save();
        $booksharing_two = booksharing_two::findOrFail($id);
        $this->deleteFile($booksharing_two->book_cover, 'booksharing_two'.$booksharing_two->id);
        $this->deleteFile($booksharing_two->book_file,'booksharing_two'.$booksharing_two->id);
        $this->deleteFile($booksharing_two->image, 'booksharing_two'.$booksharing_two->id);
        $booksharing_two->delete();
        Db::commit();
        return redirect()->route('booksharingsection.index');
    }
    public function downloadshare($filename,$id)
    {
        $booksharing_two=booksharing_two::findOrFail($id);
        return response()->download(public_path('attachments/'. 'booksharing_two'.$booksharing_two->id .'/' . $filename));
    }
}
