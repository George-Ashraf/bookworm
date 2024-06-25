<?php

namespace App\Http\Controllers;

use App\Models\opinion;
use Illuminate\Http\Request;

class OpinionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web,admin,author,bookstore');
    }
    public function index()
    {
        //
    }

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
            'opinion' => 'required|string|max:250',
            'job' => 'required|string|max:70',
        ]);
        $opinion= new opinion();
        $opinion->name=Auth()->user()->name;
        $opinion->job=$request->job;
        $opinion->opinion=$request->opinion;
        if(auth('admin')->check())
        {
            $opinion->admin_id=Auth()->user()->id;

        }
        elseif(auth('bookstore')->check())
        {
            $opinion->bookstore_id=Auth()->user()->id;

        }
        elseif(auth('author')->check())
        {
            $opinion->author_id=Auth()->user()->id;

        }
        elseif(auth('web')->check())
        {
            $opinion->reader_id=Auth()->user()->id;

        }
        $opinion->save();
        return redirect()->back();


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\opinion  $opinion
     * @return \Illuminate\Http\Response
     */
    public function show(opinion $opinion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\opinion  $opinion
     * @return \Illuminate\Http\Response
     */
    public function edit(opinion $opinion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\opinion  $opinion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, opinion $opinion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\opinion  $opinion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quote= opinion::findOrFail($id);
        $quote->delete();
        return redirect()->back();
    }
}
