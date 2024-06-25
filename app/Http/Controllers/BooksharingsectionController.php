<?php

namespace App\Http\Controllers;

use App\Models\booksharing_one;
use App\Models\booksharing_two;
use App\Models\booksharingsection;
use Illuminate\Http\Request;

class BooksharingsectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:web,admin');
    }
    // // public function index()
    // {
    //     $booksharingsection= booksharingsection::all();
    //     return view('booksharing.index',compact('booksharingsection'));
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'section_name' => 'required|string|max:15',
        ]);
        $booksharingsection = new booksharingsection();

        $booksharingsection->section_name = $request->section_name;
        $booksharingsection->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\booksharingsection  $booksharingsection
     * @return \Illuminate\Http\Response
     */
    public function show(booksharingsection $booksharingsection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\booksharingsection  $booksharingsection
     * @return \Illuminate\Http\Response
     */
    public function edit(booksharingsection $booksharingsection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\booksharingsection  $booksharingsection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, booksharingsection $booksharingsection)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\booksharingsection  $booksharingsection
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $booksharingsection = booksharingsection::findOrFail($id);

        try {


            $booksharingsection->delete();

            return redirect()->back();
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function search(Request $request)
    {

        

        $name = $request->search;
        $se_booksharingsection = booksharingsection::where(function ($query) use ($name) {
            $query->where('section_name', 'like', '%' . $name . '%');
        })
        ->orWhereHas('booksharingone',function ($query) use ($name){
            $query->where('book_name','like','%'.$name.'%');
        })
        ->orWhereHas('booksharingtwo',function ($query) use ($name){
            $query->where('book_name','like','%'.$name.'%');
        })
        ->orWhereHas('user1',function ($query) use ($name){
            $query->where('name','like','%'.$name.'%');
        })
        ->orWhereHas('user2',function ($query) use ($name){
            $query->where('name','like','%'.$name.'%');
        })->get();
        return view('booksharing.search', compact('se_booksharingsection', 'name'));
    }
}
