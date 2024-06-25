<?php

namespace App\Http\Controllers;

use App\Http\Traits\attachfiletrait;
use App\Models\book;
use App\Models\bookstore;
use App\Models\opinion;
use App\Models\quotes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Rules\UniqueAcrossTables;
use Illuminate\Validation\Rule;

class BookstoreController extends Controller
{
    use attachfiletrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = book::take(6)->get();
        $opinion = opinion::all();
        $quotes = quotes::all();
        return view('home', compact('quotes', 'opinion', 'product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bookstore.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|required|max:15|unique:users,email|unique:author,email|unique:admins,email|unique:book_store,email',
            'book_store_name' => 'required|max:15|unique:users,name|unique:author,name|unique:admins,name|unique:book_store,name',
            'phone' => 'required|max:15|unique:book_store,phone',
            'address' => 'required|max:30',
            'owner' => 'required|max:15',
            'card_number' => 'required|regex:/^\d{4}-\d{4}-\d{4}-\d{4}$/|min:19',
            'cvv' => 'required|numeric|min:3',
            'exp_date' => 'required|date',
            'password' => 'required|min:8',
            'confirm_password' => 'required|required_with:password|same:password|min:8'
        ]);
        $bookstore = new bookstore();
        $bookstore->email = $request->email;
        $bookstore->password = hash::make($request->password);
        $bookstore->confirm_password = hash::make($request->confirm_password);
        $bookstore->bookstore_name = $request->book_store_name;
        $bookstore->phone = $request->phone;
        $bookstore->address = $request->address;
        $bookstore->card_number = $request->card_number;
        $bookstore->cvv = $request->cvv;
        $bookstore->exp_date = $request->exp_date;
        $bookstore->name = $request->owner;

        $bookstore->save();
        return redirect()->route('selection');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\bookstore  $bookstore
     * @return \Illuminate\Http\Response
     */
    public function show(bookstore $bookstore)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\bookstore  $bookstore
     * @return \Illuminate\Http\Response
     */
    public function edit(bookstore $bookstore)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\bookstore  $bookstore
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $ignoreTable = 'book_store';
        $ignoreId = $id;

        $request->validate([
            'email' => [
                'required',
                'email',
                new UniqueAcrossTables(['admins', 'author', 'users', 'book_store'], 'email', $ignoreTable, $ignoreId),
                Rule::unique('book_store')->ignore($id),


            ],
            'bookstore_name' => 'required',
            'phone' => [
                'required',
                'max:15',
                Rule::unique('book_store')->ignore($id),
            ],
            'address' => 'required|max:150',
            'name' => [
                'required',
                new UniqueAcrossTables(['admins', 'author', 'users', 'book_store'], 'name', $ignoreTable, $ignoreId),
                Rule::unique('book_store')->ignore($id),


            ],
            'card_number' => 'required|regex:/^\d{4}-\d{4}-\d{4}-\d{4}$/|min:19',
            'cvv' => 'required|numeric|min:3',
            'img' => 'file|max:1024|mimes:jpg,jpeg,webp,gif,svg',
            'exp_date' => 'required',

        ]);
        $bookstore = bookstore::findOrFail($id);
        $bookstore->email = $request->email;
        $bookstore->bookstore_name = $request->bookstore_name;
        $bookstore->phone = $request->phone;
        $bookstore->address = $request->address;
        $bookstore->card_number = $request->card_number;
        $bookstore->cvv = $request->cvv;
        $bookstore->exp_date = $request->exp_date;
        $bookstore->name = $request->name;
        if ($request->hasfile('img')) {

            $this->deleteFile($bookstore->img, 'bookstore' . $bookstore->id);

            $this->uploadFile($request, 'img', 'bookstore' . $bookstore->id);

            $img_new =  $request->file('img')->getClientOriginalName();

            $bookstore->img = $bookstore->img !== $img_new ? $img_new : $bookstore->img;
        }
        $bookstore->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\bookstore  $bookstore
     * @return \Illuminate\Http\Response
     */
    public function destroy(bookstore $bookstore)
    {
        //
    }
}
