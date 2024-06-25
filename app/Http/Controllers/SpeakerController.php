<?php

namespace App\Http\Controllers;

use App\Http\Traits\attachfiletrait;
use App\Models\speaker;
use Illuminate\Http\Request;

class SpeakerController extends Controller
{
    use attachfiletrait;
   public function __construct()
   {
$this->middleware('auth:admin');
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
            'name' => 'required|max:15',
            'about' => 'required',
            'phone'=>'required',
            'email'=>'required|email',
            'linked_in'=>'required',
            'img' => 'required|file|max:1024|mimes:png,jpg,jpeg,webp,gif,svg',

        ]);
        $speaker = new speaker();
        $speaker->name = $request->name;
        $speaker->about = $request->about;
        $speaker->phone = $request->phone;
        $speaker->email = $request->email;
        $speaker->img = $request->file('img')->getClientOriginalName();
        $speaker->linked_in = $request->linked_in;

        $speaker->admin_id =Auth()->user()->id;
        $speaker->save();
        $this->uploadFile($request,'img', 'speaker'.$speaker->id);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\speaker  $speaker
     * @return \Illuminate\Http\Response
     */
    public function show(speaker $speaker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\speaker  $speaker
     * @return \Illuminate\Http\Response
     */
    public function edit(speaker $speaker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\speaker  $speaker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\speaker  $speaker
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try {


            $speaker=speaker::findOrFail($id);
            $speaker->delete();

            return redirect()->back();
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }

        return redirect()->back();
    }
}
