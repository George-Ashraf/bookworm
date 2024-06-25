<?php

namespace App\Http\Controllers;

use App\Http\Traits\attachfiletrait;
use App\Models\author;
use App\Models\book;
use App\Models\opinion;
use App\Models\quotes;
use App\Rules\UniqueAcrossTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AuthorController extends Controller
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
        return view('author.create');
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
            'email' => 'required|email|unique:users,email|unique:author,email|unique:admins,email|unique:book_store,email',
            'name' => 'required|max:15|unique:users,name|unique:author,name|unique:admins,name|unique:book_store,name',
            'type_of_write' => 'required',
            'experience' => 'required',
            'card_number' => 'required|regex:/^\d{4}-\d{4}-\d{4}-\d{4}$/|min:19',
            'cvv' => 'required|numeric|min:3',
            'exp_date' => 'required|date',
            'password' => 'required|min:8',
            'confirm_password' => 'required|required_with:password|same:password|min:8'
        ]);
        $author = new author();
        $author->email = $request->email;
        $author->password = hash::make($request->password);
        $author->confirm_password = hash::make($request->confirm_password);
        $author->name = $request->name;
        $author->experience = $request->experience;
        $author->type_of_write = $request->type_of_write;
        $author->card_number = $request->card_number;
        $author->cvv = $request->cvv;
        $author->exp_date = $request->exp_date;
        $author->save();
        return redirect()->route('selection');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\author  $author
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $author= author::findOrFail($id);
        return view('author.show',compact('author'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(author $author)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $ignoreTable = 'author';
        $ignoreId = $id;

        $request->validate([
            'email' => [
                'required',
                'email',
                new UniqueAcrossTables(['admins','author','users','book_store'],'email',$ignoreTable,$ignoreId),
                Rule::unique('author')->ignore($id),


            ],

            'name' => [
                'required',
                new UniqueAcrossTables(['admins','author','users','book_store'],'name',$ignoreTable,$ignoreId),
                Rule::unique('author')->ignore($id),


            ],

            'type_of_write' => 'required',
            'experience' => 'required',
            'card_number' => 'required|regex:/^\d{4}-\d{4}-\d{4}-\d{4}$/|min:19',
            'cvv' => 'required|numeric|min:3',
            'exp_date' => 'required',
            'img' => 'file|max:1024|mimes:jpg,jpeg,webp,gif,svg',

        ]);
        $author = author::findOrFail($id);
        $author->email = $request->email;
        $author->name = $request->name;
        $author->experience = $request->experience;
        $author->type_of_write = $request->type_of_write;
        $author->card_number = $request->card_number;
        $author->cvv = $request->cvv;
        $author->exp_date = $request->exp_date;
        if ($request->hasfile('img')) {

            $this->deleteFile($author->img, 'author' . $author->id);

            $this->uploadFile($request, 'img', 'author' . $author->id);

            $img_new =  $request->file('img')->getClientOriginalName();

            $author->img = $author->img !== $img_new ? $img_new : $author->img;
        }
        $author->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(author $author)
    {
        //
    }
}
