<?php

namespace App\Http\Controllers;

use App\Models\quotes;
use Illuminate\Http\Request;

class QuotesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:web,admin,author,bookstore');
    }

    public function index(){

    }
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
            'quotes' => 'required|string|max:250',
            'author' => 'required|string|max:50',
            'reference' => 'string|max:15|nullable',

        ]);
        $quotes= new quotes();
        $quotes->name=Auth()->user()->name;
        $quotes->quotes=$request->quotes;
        $quotes->author=$request->author;
        $quotes->reference=$request->reference;

        if(auth('admin')->check())
        {
            $quotes->admin_id=Auth()->user()->id;

        }
        elseif(auth('bookstore')->check())
        {

            $quotes->bookstore_id=Auth()->user()->id;
     


        }
        elseif(auth('author')->check())
        {
            $quotes->author_id=Auth()->user()->id;

        }
        elseif(auth('web')->check())
        {
            $quotes->reader_id=Auth()->user()->id;

        }
        $quotes->save();
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\quotes  $quotes
     * @return \Illuminate\Http\Response
     */
    public function show(quotes $quotes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\quotes  $quotes
     * @return \Illuminate\Http\Response
     */
    public function edit(quotes $quotes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\quotes  $quotes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, quotes $quotes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\quotes  $quotes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quote= quotes::findOrFail($id);
        $quote->delete();
        return redirect()->back();
    }
}
