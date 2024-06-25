<?php

namespace App\Http\Controllers;

use App\Models\about;
use Illuminate\Http\Request;

class AboutController extends Controller
{



    public function __construct()
    {
        $this->middleware('auth:web,author,bookstore,admin');
    }
    public function index()
    {
        return view('about');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index2()
    {
        $contact_us= about::all();
        return view('dashboard.message',compact('contact_us'));
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
            'email' => 'required|email',
            'name' => 'required|max:15',
            'message' => 'required|max:150',

        ]);
        $contact= new about();
        $contact->name=$request->name;
        $contact->email=$request->email;
        $contact->message=$request->message;
        if(auth('bookstore')->check())
        {

             $contact->bookstore_id=Auth()->user()->id;



        }
        elseif(auth('author')->check())
        {
             $contact->author_id=Auth()->user()->id;

        }
        elseif(auth('web')->check())
        {
             $contact->reader_id=Auth()->user()->id;

        }
      
        $contact->save();
        return redirect()->back()->with('done','send done');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\about  $about
     * @return \Illuminate\Http\Response
     */
    public function show(about $about)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\about  $about
     * @return \Illuminate\Http\Response
     */
    public function edit(about $about)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\about  $about
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, about $about)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\about  $about
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
$message= about::findOrFail($id);
$message->delete();
return redirect()->back();
    }
}
