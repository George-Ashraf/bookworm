<?php

namespace App\Http\Controllers;

use App\Http\Traits\attachfiletrait;
use Illuminate\Support\Facades\DB;
use App\Models\admin;
use App\Models\book;
use App\Models\opinion;
use App\Models\quotes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Rules\UniqueAcrossTables;
use Illuminate\Validation\Rule;
class AdminController extends Controller
{
use attachfiletrait;

    public function index()
    {
        $product= book::take(6)->get();
        $opinion=opinion::all();
        $quotes= quotes::all();
        return view('home',compact('quotes','opinion','product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
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
            'password' => 'required|min:8',
            'confirm_password' => 'required|required_with:password|same:password|min:8'
        ]);
        $admin = new admin();
        $admin->email = $request->email;
        $admin->password = hash::make($request->password);
        $admin->confirm_password = hash::make($request->confirm_password);
        $admin->name = $request->name;
        $admin->save();
        return redirect()->route('selection');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ignoreTable = 'admins';
        $ignoreId = $id;
        $request->validate([
            'email' => [
                'required',
                'email',
                new UniqueAcrossTables(['admins','author','users','book_store'],'email',$ignoreTable,$ignoreId),
                Rule::unique('admins')->ignore($id),


            ],
            'name' => [
                'required',
                new UniqueAcrossTables(['admins','author','users','book_store'],'name',$ignoreTable,$ignoreId),
                Rule::unique('admins')->ignore($id),


            ],
            'img'=>'file|max:1024|mimes:jpg,jpeg,webp,gif,svg',

        ]);
        $admin = admin::findOrFail($id);
        $admin->email = $request->email;
        $admin->name = $request->name;
        if ($request->hasfile('img')) {

            $this->deleteFile($admin->img, 'admin'.$admin->id);

            $this->uploadFile($request, 'img', 'admin'.$admin->id);

            $img_new =  $request->file('img')->getClientOriginalName();

            $admin->img = $admin->img !== $img_new ? $img_new : $admin->img;
        }
        $admin->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(admin $admin)
    {
        //
    }
}
