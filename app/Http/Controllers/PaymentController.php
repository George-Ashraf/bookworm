<?php

namespace App\Http\Controllers;

use App\Models\book;
use App\Models\booksharing_one;
use App\Models\booksharing_two;
use App\Models\booksharingsection;
use App\Models\payment;
use App\Models\revenue;
use App\Models\seminar;
use App\Models\User;
use App\Models\user_payment_book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web,admin');
    }
    public function index()
    {
        //
    }
    public function createpaymentshare_one($id)
    {
        $booksharing_one = booksharing_one::findOrFail($id);
        return view('booksharing.createpayment', compact('booksharing_one'));
    }

    public function sharepaymentone(Request $request)
    {
        $request->validate([
            'card_holder_name' => 'required|string',
            'card_number' => 'required|regex:/^\d{4}-\d{4}-\d{4}-\d{4}$/|min:19',
            'cvv' => 'required|numeric|min:3',
            'exp_date' => 'required|date|after:today',

        ]);
        DB::beginTransaction();
        $payment = new payment();
        $payment->card_holder_name = $request->card_holder_name;
        $payment->card_number = $request->card_number;
        $payment->cvv = $request->cvv;
        $payment->exp_date = $request->exp_date;

        $payment->price = '100';
        $payment->type = 'booksharing_one_payment';
        $payment->reader_id = Auth()->user()->id;
        $payment->booksharing_one = $request->booksharing_one_id;
        $payment->save();
        $booksharingsection = booksharingsection::findOrFail($request->BS_section_id);
        $booksharingsection->payment_one = "done";
        $booksharingsection->save();
        DB::commit();
        $booksharing_one = db::table('book_sharing_one')->where('BS_section_id', $booksharingsection->id)->first();

        return redirect()->route('book.show', [$booksharing_one->id, $booksharingsection->id]);
    }
    public function sharepaymentonecash(Request $request)
    {

        DB::beginTransaction();
        $payment = new payment();
        $payment->price = '100';
        $payment->type = 'booksharing_one_payment';
        $payment->reader_id = Auth()->user()->id;
        $payment->booksharing_one = $request->booksharing_one_id;
        $payment->save();
        $booksharingsection = booksharingsection::findOrFail($request->BS_section_id);
        $booksharingsection->payment_one = "done";
        $booksharingsection->save();
        DB::commit();
        $booksharing_one = db::table('book_sharing_one')->where('BS_section_id', $booksharingsection->id)->first();

        return redirect()->route('book.show', [$booksharing_one->id, $booksharingsection->id]);
    }
    public function createpaymentshare_two($id)
    {
        $booksharing_two = booksharing_two::findOrFail($id);
        return view('booksharing.createpayment2', compact('booksharing_two'));
    }

    public function sharepaymenttwo(Request $request)
    {

        $request->validate([
            'card_holder_name' => 'required|string',
            'card_number' => 'required|regex:/^\d{4}-\d{4}-\d{4}-\d{4}$/|min:19',
            'cvv' => 'required|numeric|min:3',
          'exp_date' => 'required|date|after:today',

        ]);
        DB::beginTransaction();
        $payment = new payment();
        $payment->card_holder_name = $request->card_holder_name;
        $payment->card_number = $request->card_number;
        $payment->cvv = $request->cvv;
        $payment->exp_date = $request->exp_date;

        $payment->price = '100';

        $payment->type = 'booksharing_two_payment';
        $payment->booksharing_two = $request->booksharing_two_id;

        $payment->reader_id = Auth()->user()->id;
        $payment->save();

        $booksharingsection = booksharingsection::findOrFail($request->BS_section_id);
        $booksharingsection->payment_two = "done";
        $booksharingsection->save();
        DB::commit();
        $booksharing_two = db::table('book_sharing_two')->where('BS_section_id', $booksharingsection->id)->first();

        return redirect()->route('book.show2', [$booksharing_two->id, $booksharingsection->id]);
    }


  public function  sharepaymenttwocash(Request $request){

    DB::beginTransaction();
    $payment = new payment();
    $payment->price = '100';
    $payment->type = 'booksharing_two_payment';
    $payment->booksharing_two = $request->booksharing_two_id;

    $payment->reader_id = Auth()->user()->id;
    $payment->save();

    $booksharingsection = booksharingsection::findOrFail($request->BS_section_id);
    $booksharingsection->payment_two = "done";
    $booksharingsection->save();
    DB::commit();
    $booksharing_two = db::table('book_sharing_two')->where('BS_section_id', $booksharingsection->id)->first();

    return redirect()->route('book.show2', [$booksharing_two->id, $booksharingsection->id]);
  }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createpaymentbook($id)
    {
        $bookinfo = book::findOrFail($id);
        return view('books.createpayment', compact('bookinfo'));
    }
    public function storepaymentbook(Request $request)
    {
        $request->validate([
            'card_holder_name' => 'required|string',
            'card_number' => 'required|regex:/^\d{4}-\d{4}-\d{4}-\d{4}$/|min:19',
            'cvv' => 'required|numeric|min:3',
           'exp_date' => 'required|date|after:today',

        ]);
        db::beginTransaction();
        // insert in payment table
        $product = book::find($request->book_id);
        $payment = new payment();
        $payment->card_holder_name = $request->card_holder_name;
        $payment->card_number = $request->card_number;
        $payment->cvv = $request->cvv;
        $payment->exp_date = $request->exp_date;
        $payment->type = 'book_payment';
        $payment->book = $request->book_id;
        $payment->reader_id = Auth()->user()->id;
        if ($product->choose == 'hard') {
            $payment->price = $request->pricehard;
        } elseif ($product->choose == 'soft') {
            $payment->price = $request->pricesoft;
        }
        $payment->save();
        // insert in user payment book table
        $user_payment_book = new user_payment_book();
        $user_payment_book->user_id = auth()->user()->id;
        $user_payment_book->book_payment_id = $payment->id;
        $user_payment_book->book_id = $product->id;
        if ($product->choose == 'hard') {
            $user_payment_book->format = 'hard';
        } elseif ($product->choose == 'soft') {
            $user_payment_book->format = 'soft';
        }
        $user_payment_book->save();
        //  insert in revenue table
        $revenue = new revenue();
        if ($product->author_id) {
            if ($product->choose == 'hard') {
                $revenue->admin_revenue = $product->pricehard * 0.1;
                $revenue->author_revenue = $product->pricehard - ($product->pricehard * 0.1);
            } elseif ($product->choose == 'soft') {
                $revenue->admin_revenue = $product->pricesoft * 0.1;
                $revenue->author_revenue = $product->pricesoft - ($product->pricesoft * 0.1);
            }
            $revenue->author_id = $product->author_id;
            $revenue->admin_id = $product->admin_id;
            $revenue->book_id = $product->id;
            $revenue->book_name = $product->book_name;
        } elseif ($product->bookstore_id) {
            if ($product->choose == 'hard') {
                $revenue->admin_revenue = $product->pricehard * 0.1;
                $revenue->bookstore_revenue = $product->pricehard - ($product->pricehard * 0.1);
            } elseif ($product->choose == 'soft') {
                $revenue->admin_revenue = $product->pricesoft * 0.1;
                $revenue->bookstore_revenue = $product->pricesoft - ($product->pricesoft * 0.1);
            }
            $revenue->bookstore_id = $product->bookstore_id;
            $revenue->admin_id = $product->admin_id;
            $revenue->book_id = $product->id;
            $revenue->book_name = $product->book_name;
        } elseif ($product->admin_id) {
            if ($product->choose == 'hard') {
                $revenue->admin_revenue = $product->pricehard;
            } elseif ($product->choose == 'soft') {
                $revenue->admin_revenue = $product->pricesoft;
            }
            $revenue->admin_id = $product->admin_id;
            $revenue->book_id = $product->id;
            $revenue->book_name = $product->book_name;
        }
        $revenue->save();
        db::commit();
        if ($product->choose == 'hard') {
            return redirect()->route('product.show', $request->book_id)->with('done', 'payment done ,you will receive book in 24 hours');
        } elseif ($product->choose == 'soft') {
            return redirect()->route('product.show', $request->book_id)->with('done', 'payment done , go to purchased book section to download');
        }
    }
    public function paycashbook(Request $request)
    {

        db::beginTransaction();
        // insert in payment table
        $product = book::find($request->book_id);
        $payment = new payment();

        $payment->type = 'book_payment_cash';
        $payment->book = $request->book_id;
        $payment->reader_id = Auth()->user()->id;
        if ($product->choose == 'hard') {
            $payment->price = $request->pricehard;
        }
        $payment->save();
        // insert in user payment book table
        $user_payment_book = new user_payment_book();
        $user_payment_book->user_id = auth()->user()->id;
        $user_payment_book->book_payment_id = $payment->id;
        $user_payment_book->book_id = $product->id;
        if ($product->choose == 'hard') {
            $user_payment_book->format = 'hard';
        }
        $user_payment_book->save();
        //  insert in revenue table
        $revenue = new revenue();
        if ($product->author_id) {
            if ($product->choose == 'hard') {
                $revenue->admin_revenue = $product->pricehard * 0.1;
                $revenue->author_revenue = $product->pricehard - ($product->pricehard * 0.1);
            }
            $revenue->author_id = $product->author_id;
            $revenue->admin_id = $product->admin_id;
            $revenue->book_id = $product->id;
            $revenue->book_name = $product->book_name;
        } elseif ($product->bookstore_id) {
            if ($product->choose == 'hard') {
                $revenue->admin_revenue = $product->pricehard * 0.1;
                $revenue->bookstore_revenue = $product->pricehard - ($product->pricehard * 0.1);
            }
            $revenue->bookstore_id = $product->bookstore_id;
            $revenue->admin_id = $product->admin_id;
            $revenue->book_id = $product->id;
            $revenue->book_name = $product->book_name;
        } elseif ($product->admin_id) {
            if ($product->choose == 'hard') {
                $revenue->admin_revenue = $product->pricehard;
            }
            $revenue->admin_id = $product->admin_id;
            $revenue->book_id = $product->id;
            $revenue->book_name = $product->book_name;
        }
        $revenue->save();
        db::commit();
        if ($product->choose == 'hard') {
            return redirect()->route('product.show', $request->book_id)->with('done', 'payment done ,you will receive book in 24 hours');
        }
    }
    public function createpremium()
    {
        return view('premium.createpayment');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function storepremium(Request $request)
    {
        $request->validate([
            'card_holder_name' => 'required|string',
            'card_number' => 'required|regex:/^\d{4}-\d{4}-\d{4}-\d{4}$/|min:19',
            'cvv' => 'required|numeric|min:3',
           'exp_date' => 'required|date|after:today',

        ]);
        $payment = new payment();
        $payment->card_holder_name = $request->card_holder_name;
        $payment->card_number = $request->card_number;
        $payment->cvv = $request->cvv;
        $payment->exp_date = $request->exp_date;
        $payment->price = '50';
        $payment->type = 'premium';
        $payment->reader_id = Auth()->user()->id;
        $payment->save();

        $user = User::findOrFail(auth()->user()->id);
        $user->premium = 'done';
        $user->save();
        return redirect()->route('user.home');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function createpaymentseminar($id)
    {
        $seminar=seminar::findOrFail($id);
        return view('seminar.createpayment',compact('seminar'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function storepaymentseminar(Request $request)
    {
        $request->validate([
            'card_holder_name' => 'required|string',
            'card_number' => 'required|regex:/^\d{4}-\d{4}-\d{4}-\d{4}$/|min:19',
            'cvv' => 'required|numeric|min:3',
         'exp_date' => 'required|date|after:today',

        ]);
        $payment = new payment();
        $payment->card_holder_name = $request->card_holder_name;
        $payment->card_number = $request->card_number;
        $payment->cvv = $request->cvv;
        $payment->exp_date = $request->exp_date;
        $payment->price = '100';
        $payment->type = 'offline_seminar';
        $payment->seminer =$request->seminar_id ;
        $payment->reader_id = Auth()->user()->id;
        $payment->save();


        return redirect()->route('seminar.show',$request->seminar_id)->with('done','payment done');
    }
    public function  storepaymentseminarcash(Request $request)
    {

        $payment = new payment();
        $payment->price = '100';
        $payment->type = 'offline_seminar';
        $payment->seminer =$request->seminar_id ;
        $payment->reader_id = Auth()->user()->id;
        $payment->save();


        return redirect()->route('seminar.show',$request->seminar_id)->with('done','payment done');
    }

}
