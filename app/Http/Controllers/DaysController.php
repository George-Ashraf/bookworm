<?php

namespace App\Http\Controllers;

use App\Models\days;
use Illuminate\Http\Request;

class DaysController extends Controller
{
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


        $days_list = $request->days_list;
        $request->validate([

            'days_list.*.day' => 'required',
        ]);
        foreach ($days_list as $days) {
            $day = new days();
            $day->day = $days['day'];
            $day->seminar_id = $request->seminar_id;
            $day->admin_id = auth()->user()->id;
            $day->save();
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\days  $days
     * @return \Illuminate\Http\Response
     */
    public function show(days $days)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\days  $days
     * @return \Illuminate\Http\Response
     */
    public function edit(days $days)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\days  $days
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([

            'day' => 'required',
        ]);
            $day = days::findOrFail($id);
            $day->day = $request->day;
            $day->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\days  $days
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $day=days::findOrFail($id);
        $day->delete();
        return redirect()->back();
    }
}
