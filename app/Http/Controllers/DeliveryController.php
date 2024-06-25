<?php

namespace App\Http\Controllers;

use App\Models\book_delivery;
use Illuminate\Support\Facades\DB;

use App\Models\booksharing_one;
use App\Models\booksharing_two;
use App\Models\booksharingsection;
use App\Models\delivery;
use App\Models\delivery_man;
use App\Models\purchased_book;
use App\Models\user_payment_book;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $booksharing_one = DB::table('book_sharing_one')->where('format', 'hard copy')->get();
        $booksharing_two = DB::table('book_sharing_two')->where('format', 'hard copy')->get();
        $delivery = delivery::all();
        $purchased =  db::table('purchased_book')->where('format', 'hard')->get();
        $book_delivery = book_delivery::all();
        $mans = delivery_man::all();
        $data['countman']=db::table('delivery_man')->count();
        $data['countdelivery']=db::table('delivery')->count();
        $data['countddeliverypurchased']=db::table('book_delivery')->count();


        return view('delivery.index',$data,compact('mans', 'booksharing_one', 'booksharing_two', 'delivery', 'purchased','book_delivery'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id, $BS_id)
    {

        $mans = delivery_man::all();
        $booksharing_one = booksharing_one::find($id);
        $booksharing_two = DB::table('book_sharing_two')->where('BS_section_id', $booksharing_one->BS_section_id)->get();
        $booksharingsection = booksharingsection::find($BS_id);



        return view('delivery.create', compact('booksharing_one', 'mans', 'booksharing_two', 'booksharingsection'));
    }
    public function create2($id, $BS_id)
    {

        $mans = delivery_man::all();
        $booksharing_two = booksharing_two::find($id);

        $booksharing_one = DB::table('book_sharing_one')->where('BS_section_id', $booksharing_two->BS_section_id)->get();
        $booksharingsection = booksharingsection::find($BS_id);


        return view('delivery.create2', compact('booksharing_one', 'mans', 'booksharing_two', 'booksharingsection'));
    }
    public function create3($id)
    {

        $mans = delivery_man::all();
        $purchasedbook = user_payment_book::findOrFail($id);
        return view('delivery.create3', compact('purchasedbook', 'mans'));
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
            'street' => 'required|max:150',
            'city' => 'required|max:150',
            'phone' => 'required',
            'street2' => 'required|max:150',
            'city2' => 'required|max:150',
            'phone2' => 'required',
            'booksharing_section_id' => 'required',
            'from_booksharing_one' => 'nullable',
            'to_booksharing_two' => 'nullable',
            'from_booksharing_two' => 'nullable',
            'to_booksharing_one' => 'nullable',
            'delivery_man_id' => 'required|string',

        ]);




        db::beginTransaction();
        $delivery = new delivery();
        $delivery->street = $request->street;
        $delivery->city = $request->city;
        $delivery->phone = $request->phone;
        $delivery->street2 = $request->street2;
        $delivery->city2 = $request->city2;
        $delivery->phone2 = $request->phone2;
        $delivery->booksharing_section_id = $request->booksharing_section_id;
        $delivery->from_booksharing_one = $request->from_booksharing_one;
        $delivery->to_booksharing_two = $request->to_booksharing_two;
        $delivery->from_booksharing_two = $request->from_booksharing_two;
        $delivery->to_booksharing_one = $request->to_booksharing_one;
        $delivery->delivery_man_id = $request->delivery_man_id;
        $delivery->admin_id = auth()->user()->id;
        $delivery->save();
        $booksharing_one = booksharing_one::find($request->booksharing_one_id);
        $booksharing_one->delivery = 'done';
        $booksharing_one->save();
        DB::commit();



        $booksharing_two = booksharing_two::find($request->booksharing_two_id);
        if ($booksharing_two->format == 'hard copy') {
            $booksharing_two->delivery = 'done';
        }
        $booksharing_two->save();
        DB::commit();





        return redirect()->route('delivery.index');
    }
    public function store2(Request $request)
    {

        $request->validate([
            'street' => 'required|max:150',
            'city' => 'required|max:150',
            'phone' => 'required',
            'street1' => 'required|max:150',
            'city1' => 'required|max:150',
            'phone1' => 'required',
            'booksharing_section_id' => 'required',
            'from_booksharing_one' => 'nullable',
            'to_booksharing_two' => 'nullable',
            'from_booksharing_two' => 'nullable',
            'to_booksharing_one' => 'nullable',
            'delivery_man_id' => 'required|string',

        ]);




        db::beginTransaction();
        $delivery = new delivery();
        $delivery->street = $request->street;
        $delivery->city = $request->city;
        $delivery->phone = $request->phone;
        $delivery->street2 = $request->street1;
        $delivery->city2 = $request->city1;
        $delivery->phone2 = $request->phone1;
        $delivery->booksharing_section_id = $request->booksharing_section_id;
        $delivery->from_booksharing_one = $request->from_booksharing_one;
        $delivery->to_booksharing_two = $request->to_booksharing_two;
        $delivery->from_booksharing_two = $request->from_booksharing_two;
        $delivery->to_booksharing_one = $request->to_booksharing_one;
        $delivery->delivery_man_id = $request->delivery_man_id;
        $delivery->admin_id = auth()->user()->id;

        $delivery->save();
        $booksharing_two = booksharing_two::find($request->booksharing_two_id);
        $booksharing_two->delivery = 'done';
        $booksharing_two->save();
        DB::commit();
        return redirect()->route('delivery.index');
    }
    public function store3(Request $request)
    {

        $request->validate([
            'street' => 'required|max:150',
            'city' => 'required|max:150',
            'phone' => 'required',
            'delivery_man_id' => 'required|string',

        ]);



        db::beginTransaction();
        $delivery = new book_delivery();
        $delivery->street = $request->street;
        $delivery->city = $request->city;
        $delivery->phone = $request->phone;
        $delivery->book_id = $request->book_id;
        $delivery->delivery_man_id = $request->delivery_man_id;
        $delivery->admin_id = auth()->user()->id;
        $delivery->save();
        $purchased = user_payment_book::find($request->bookpayment_id);
        $purchased->delivery = 'done';
        $purchased->save();
        db::commit();
        return redirect()->route('delivery.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function show(delivery $delivery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function edit(delivery $delivery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, delivery $delivery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function destroy(delivery $delivery)
    {
        //
    }
}
