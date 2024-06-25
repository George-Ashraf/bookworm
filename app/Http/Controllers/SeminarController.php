<?php

namespace App\Http\Controllers;

use App\Http\Traits\meetingzoomtrait;
use App\Models\days;
use App\Models\seminar;
use App\Models\speaker;
use Illuminate\Http\Request;
use MacsiDigital\Zoom\Facades\Zoom;
use Illuminate\Support\Facades\DB;

class SeminarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use meetingzoomtrait;

    public function __construct()
    {
        $this->middleware('auth:web,admin');
    }
    public function index()
    {
        $speaker=speaker::all();
        $seminar = seminar::all();
        return view('seminar.index', compact('seminar','speaker'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('seminar.create');
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
            'type' => 'required',
            'seminar_name' => 'required',
            'seminar_des' => 'required',
            'address' => 'nullable',
            'topic' => 'required',
            'start_time' => 'required',
            'duration' => 'required|numeric',



        ]);
        $seminar = new seminar();
        $seminar->type = $request->type;
       if( $seminar->type=='online'){
        $meeting = $this->createmeeting($request);
        $seminar->integration = true;
        $seminar->seminar_name = $request->seminar_name;
        $seminar->seminar_des = $request->seminar_des;
        $seminar->admin_id = auth()->user()->id;
        $seminar->meeting_id = $meeting->id;
        $seminar->topic = $request->topic;
        $seminar->start_time = $request->start_time;
        $seminar->duration = $meeting->duration;
        $seminar->password = $meeting->password;
        $seminar->start_url = $meeting->start_url;
        $seminar->join_url = $meeting->join_url;
       }
       elseif($seminar->type=='offline'){
        $request->validate([

            'address' => 'required',

        ]);
        $seminar->seminar_name = $request->seminar_name;
        $seminar->seminar_des = $request->seminar_des;
        $seminar->address = $request->address;
        $seminar->start_time = $request->start_time;
        $seminar->duration = $request->duration;
        $seminar->topic = $request->topic;

        $seminar->admin_id = auth()->user()->id;
       }

        $seminar->save();
        return redirect()->route('seminar.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\seminar  $seminar
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $meet=seminar::findOrFail($id);
        $days=days::with('periods')->where('seminar_id',$meet->id)->get();
        $speaker=speaker::all();
        return view('seminar.show',compact('meet','days','speaker'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\seminar  $seminar
     * @return \Illuminate\Http\Response
     */
    public function edit(seminar $seminar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\seminar  $seminar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, seminar $seminar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\seminar  $seminar
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $meeting = Zoom::meeting()->find($id);
        $meeting->delete();
        seminar::where('meeting_id', $id)->delete();
        return redirect()->back();
    }
    public function destroyoff($id)
    {
        $seminar=seminar::findOrFail($id);
        $seminar->delete();
        return redirect()->back();
    }
}
