<?php

namespace App\Http\Controllers;

use App\Http\Traits\attachfiletrait;
use App\Models\book;
use App\Models\opinion;
use App\Models\quotes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Rules\UniqueAcrossTables;
use Illuminate\Validation\Rule;
class UserController extends Controller
{
    use attachfiletrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        return view('user.create');
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
            'street'=>'required|max:150',
            'city'=>'required|max:50',
            'phone'=>'required|max:15|unique:users,phone',
            'password' => 'required|min:8',
            'confirm_password' => 'required|required_with:password|same:password|min:8'
        ]);
        $user = new User();
        $user->email = $request->email;
        $user->street=$request->street;
        $user->city=$request->city;
        $user->phone=$request->phone;
        $user->password = hash::make($request->password);
        $user->confirm_password = hash::make($request->confirm_password);
        $user->name = $request->name;
        $user->save();
        return redirect()->route('selection');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $ignoreTable = 'users';
        $ignoreId = $id;

        $request->validate([
            'email' => [
                'required',
                'email',
                new UniqueAcrossTables(['admins','author','users','book_store'],'email',$ignoreTable,$ignoreId),
                Rule::unique('users')->ignore($id),


            ],
            'name' => [
                'required',
                new UniqueAcrossTables(['author','users','admins','book_store'],'name', $ignoreTable,$ignoreId),
                Rule::unique('users')->ignore($id),


            ],
            'street'=>'required|max:150',
            'img'=>'file|max:1024|mimes:jpg,jpeg,webp,gif,svg',
            'city'=>'required|max:90',
            'phone'=>'required|max:15',
            'phone' => [
                'required',
                'max:15',
                Rule::unique('users')->ignore($id),
            ],
            // other validation rules

        ]);
        $user = User::findOrFail($id);
        $user->email = $request->email;
        $user->street=$request->street;
        $user->city=$request->city;
        $user->phone=$request->phone;
        $user->name = $request->name;
        if ($request->hasfile('img')) {

            $this->deleteFile($user->img, 'user'.$user->id);

            $this->uploadFile($request, 'img', 'user'.$user->id);

            $img_new =  $request->file('img')->getClientOriginalName();

            $user->img = $user->img !== $img_new ? $img_new : $user->img;
        }
        $user->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
