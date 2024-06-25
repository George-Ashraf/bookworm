<?php

namespace App\Http\Controllers;

use App\Models\delivery_man;
use Illuminate\Http\Request;

class DeliveryManController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:15',
            'age' => 'required|numeric',
            'phone' => 'required',

        ]);
        $man = new delivery_man();
        $man->name = $request->name;
        $man->age = $request->age;
        $man->phone = $request->phone;
        $man->admin_id = Auth()->user()->id;
        $man->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\delivery_man  $delivery_man
     * @return \Illuminate\Http\Response
     */
    public function show(delivery_man $delivery_man)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\delivery_man  $delivery_man
     * @return \Illuminate\Http\Response
     */
    public function edit(delivery_man $delivery_man)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\delivery_man  $delivery_man
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:15',
            'age' => 'required|numeric',
            'phone' => 'required',

        ]);
        $man =  delivery_man::findOrFail($id);
        $man->name = $request->name;
        $man->age = $request->age;
        $man->phone = $request->phone;
        $man->admin_id = Auth()->user()->id;
        $man->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\delivery_man  $delivery_man
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $man = delivery_man::findOrFail($id);


        try {


            $man->delete();


            return redirect()->back();
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }

        return redirect()->back();
    }
}
