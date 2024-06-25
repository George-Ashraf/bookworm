<?php

namespace App\Http\Controllers;

use App\Http\Traits\attachfiletrait;
use App\Models\booksharing_one;
use App\Models\booksharingsection;
use App\Models\payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BooksharingOneController extends Controller
{
    use attachfiletrait;


    public function __construct()
    {
        $this->middleware('auth:web,admin');
    }

    public function index()
    {
        $booksharingsection = booksharingsection::orderBy('id', 'desc')->with(['booksharingone', 'booksharingtwo'])->get();
        $section_list = booksharingsection::all();
        return view('booksharing.index', compact('booksharingsection', 'section_list'));
    }

    public function create($id)
    {
        $booksharingsection = booksharingsection::findOrFail($id);
        return view('booksharing.create', compact('booksharingsection'));
    }


    public function store(Request $request)
    {
        DB::beginTransaction();
        $booksharing_one = new booksharing_one();

        $request->validate([
            'name' => 'required|string',
            'image' => 'required|file|max:1024|mimes:jpg,jpeg,webp,gif,svg',
            'book_file' => 'file|max:4096|mimes:pdf|nullable',
            'book_cover' => 'required|file|max:1024|mimes:,jpg,jpeg,webp,gif,svg',
            'book_name' => 'required|string|max:20',
            'language' => 'required|string|max:20',
            'format' => 'required',
            'type_of_book' => 'required|string',
            'description' => 'required|string',
            'author' => 'required|string',
            'used_around' => 'required',
            'book_you_want_description' => 'required|string'
        ]);


        $booksharing_one->name = $request->name;
        $booksharing_one->format = $request->format;
        $booksharing_one->book_cover = $request->file('book_cover')->getClientOriginalName();

        $booksharing_one->image = $request->file('image')->getClientOriginalName();

        if ($booksharing_one->format == 'soft copy') {
            $request->validate([

                'book_file' => 'required|file|max:4096|mimes:pdf',

            ]);
            $booksharing_one->book_file = $request->file('book_file')->getClientOriginalName();
        }
        $booksharing_one->book_name = $request->book_name;
        $booksharing_one->language = $request->language;
        $booksharing_one->type_of_book = $request->type_of_book;
        $booksharing_one->description = $request->description;
        $booksharing_one->author = $request->author;
        $booksharing_one->used_around = $request->used_around;
        $booksharing_one->book_you_want_description = $request->book_you_want_description;
        $booksharing_one->reader_id = Auth()->user()->id;
        $booksharing_one->BS_section_id = $request->BS_section_id;
        $booksharing_one->save();


        $booksharingsection =  booksharingsection::findOrFail($request->BS_section_id);
        $booksharingsection->section_name = $request->section_name;
        $booksharingsection->booksharing_one_upload = "submit";
        $booksharingsection->format_one = $booksharing_one->format;
        $booksharingsection->share_one = Auth()->user()->id;

        $booksharingsection->save();
        Db::commit();
        $this->uploadFile($request, 'book_cover', 'booksharing_one' . $booksharing_one->id);
        $this->uploadFile($request, 'image', 'booksharing_one' . $booksharing_one->id);
        if ($booksharing_one->format == 'soft copy') {

            $this->uploadFile($request, 'book_file', 'booksharing_one' . $booksharing_one->id);
        }

        return redirect()->route('booksharingsection.index')->with('done', 'shared done! wait another user to upload book');
    }



    public function status($id)
    {


        $booksharing_section = booksharingsection::findOrFail($id);
        if ($booksharing_section->status_one == 'reject') {

            $booksharing_section->status_one = 'accept';
            $booksharing_section->save();
            return redirect()->back();
        } else {


            return redirect()->back();
        }
    }


    public function show($id, $BSid)
    {
        $booksharing_one = booksharing_one::findOrFail($id);
        $booksharingsection = booksharingsection::findOrFail($BSid);
        $booksharing_two = db::table('book_sharing_two')->where('BS_section_id', $booksharing_one->BS_section_id)->first();
        return view('booksharing.show', compact('booksharing_one', 'booksharingsection', 'booksharing_two'));
    }


    public function edit($id, $BSid)
    {
        $booksharing_one = booksharing_one::findOrFail($id);
        $booksharingsection = booksharingsection::findOrFail($BSid);

        return view('booksharing.edit', compact('booksharing_one', 'booksharingsection'));
    }


    public function update(Request $request, $id, $BSid)
    {
        $request->validate([
            'name' => 'required|string',
            'image' => 'file|max:1024|mimes:jpg,jpeg,webp,gif,svg',
            'book_file' => 'file|max:4096|mimes:pdf',
            'book_cover' => 'file|max:1024|mimes:,jpg,jpeg,webp,gif,svg',
            'book_name' => 'required|string|max:20',
            'language' => 'required|string|max:20',
            'format' => 'required',
            'type_of_book' => 'required|string',
            'description' => 'required|string',
            'author' => 'required|string',
            'used_around' => 'required',
            'book_you_want_description' => 'required|string'
        ]);
        db::beginTransaction();
        $booksharing_one =  booksharing_one::findOrfail($id);

        $booksharingsection = booksharingsection::findOrFail($BSid);

        $booksharing_one->name = $request->name;

        if ($request->hasfile('image')) {

            $this->deleteFile($booksharing_one->image, 'booksharing_one' . $booksharing_one->id);

            $this->uploadFile($request, 'image', 'booksharing_one' . $booksharing_one->id);

            $image_new =  $request->file('image')->getClientOriginalName();

            $booksharing_one->image = $booksharing_one->image !== $image_new ? $image_new : $booksharing_one->image;
        }
        if ($request->hasfile('book_file')) {

            $this->deleteFile($booksharing_one->book_file, 'booksharing_one' . $booksharing_one->id);

            $this->uploadFile($request, 'book_file', 'booksharing_one' . $booksharing_one->id);

            $book_file_new =  $request->file('book_file')->getClientOriginalName();

            $booksharing_one->book_file = $booksharing_one->book_file !== $book_file_new ? $book_file_new : $booksharing_one->book_file;
        }
        if ($request->hasfile('book_cover')) {

            $this->deleteFile($booksharing_one->book_cover, 'booksharing_one' . $booksharing_one->id);

            $this->uploadFile($request, 'book_cover', 'booksharing_one' . $booksharing_one->id);

            $book_cover_new =  $request->file('book_cover')->getClientOriginalName();

            $booksharing_one->book_cover = $booksharing_one->book_cover !== $book_cover_new ? $book_cover_new : $booksharing_one->book_cover;
        }
        $booksharing_one->book_name = $request->book_name;
        $booksharing_one->language = $request->language;
        $booksharing_one->format = $request->format;
        $booksharing_one->type_of_book = $request->type_of_book;
        $booksharing_one->description = $request->description;
        $booksharing_one->author = $request->author;
        $booksharing_one->used_around = $request->used_around;
        $booksharing_one->book_you_want_description = $request->book_you_want_description;
        // $booksharing_one->reader_id = Auth()->user()->id;
        $booksharing_one->BS_section_id = $booksharingsection->id;
        $booksharing_one->save();
        $booksharingsection->format_one = $booksharing_one->format;
        $booksharingsection->save();
        db::commit();
        return redirect()->route('booksharingsection.index');
    }

    public function destroy($id, $BSid)
    {
        try {
            Db::beginTransaction();

            $booksharingsection = booksharingsection::findOrFail($BSid);
            $booksharingsection->booksharing_one_upload = 'none';
            $booksharingsection->status_one = 'reject';
            $booksharingsection->share_one = null;
            $booksharingsection->payment_one = 'none';

            $booksharingsection->save();
            $booksharing_one = booksharing_one::findOrFail($id);
            $this->deleteFile($booksharing_one->book_cover, 'booksharing_one' . $booksharing_one->id);
            $this->deleteFile($booksharing_one->book_file, 'booksharing_one' . $booksharing_one->id);
            $this->deleteFile($booksharing_one->image, 'booksharing_one' . $booksharing_one->id);
            $booksharing_one->delete();
            Db::commit();
            return redirect()->route('booksharingsection.index');
        } catch (\Throwable $th) {
            db::rollBack();

            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function downloadshare($filename, $id)
    {
        $booksharing_one = booksharing_one::findOrFail($id);
        return response()->download(public_path('attachments/' . 'booksharing_one' . $booksharing_one->id . '/' . $filename));
    }



}
