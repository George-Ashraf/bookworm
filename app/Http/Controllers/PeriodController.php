<?php

namespace App\Http\Controllers;

use App\Models\period;
use Illuminate\Http\Request;

class PeriodController extends Controller
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

        $request->validate([
            'periods_list.*.period1'=>'required',
            'periods_list.*.period2'=>'required',
            'periods_list.*.period_topic'=>'required',
            'periods_list.*.period_des'=>'required',
            'periods_list.*.speaker_id'=>'required'


        ]);
        $periods_list = $request->periods_list;

        foreach ($periods_list as $periods) {
            $period= new period();
            $period->period1 = $periods['period1'];
            $period->period2 = $periods['period2'];
            $period->period_topic = $periods['period_topic'];
            $period->period_des = $periods['period_des'];
            $period->speaker_id = $periods['speaker_id'];
            $period->day_id = $request->day_id;
            $period->admin_id = auth()->user()->id;
            $period->save();
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\period  $period
     * @return \Illuminate\Http\Response
     */
    public function show(period $period)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\period  $period
     * @return \Illuminate\Http\Response
     */
    public function edit(period $period)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\period  $period
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'period1'=>'required',
            'period2'=>'required',
            'period_topic'=>'required',
            'period_des'=>'required',
            'speaker_id'=>'required'


        ]);

            $period= period::findOrFail($id);
            $period->period1 = $request->period1;
            $period->period2 = $request->period2;
            $period->period_topic = $request->period_topic;
            $period->period_des = $request->period_des;
            $period->speaker_id = $request->speaker_id;
            $period->admin_id = auth()->user()->id;
            $period->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\period  $period
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $period= period::findOrFail($id);
        $period->delete();
        return redirect()->back();
    }
}
