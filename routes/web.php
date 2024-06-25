<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookPanelController;
use App\Http\Controllers\BooksharingController;
use App\Http\Controllers\BooksharingOneController;
use App\Http\Controllers\BooksharingsectionController;
use App\Http\Controllers\BooksharingTwoController;
use App\Http\Controllers\BookstoreController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DaysController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\DeliveryManController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OpinionController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PeriodController;
use App\Http\Controllers\QuotesController;
use App\Http\Controllers\RevenueContoller;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SeminarController;
use App\Http\Controllers\SpeakerController;
use App\Http\Controllers\SummaryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



// Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('guest');

Route::get('/home', [HomeController::class, 'index'])->name('homee');
Route::get('/selection', [HomeController::class, 'selection'])->name('selection')->middleware('guest');
Route::get('/profile', [HomeController::class, 'profile'])->name('profile')->middleware('auth:web,bookstore,admin,author');

Route::group(['namespace' => 'Auth'], function () {
    Route::get('/login/{type}', [LoginController::class, 'loginform'])->middleware('guest')->name('login.show');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
    Route::get('/logout/{type}', [LoginController::class, 'logout'])->name('logout');

});
// about
Route::get('about', [AboutController::class, 'index'])->name('about.index');
Route::get('message', [AboutController::class, 'index2'])->name('about.index2');
Route::post('storeabout', [AboutController::class, 'store'])->name('about.store');
Route::get('destroyabout/{id}', [AboutController::class, 'destroy'])->name('about.destroy');

// author
Route::get('/author/home', [AuthorController::class, 'index'])->middleware('auth:author')->name('author.home');
Route::get('/createauthor', [AuthorController::class, 'create'])->middleware('guest')->name('author.create');
Route::post('/storeauthor', [AuthorController::class, 'store'])->middleware('guest')->name('author.store');
Route::post('/updateauthor/{id}', [AuthorController::class, 'update'])->name('author.update');
Route::get('/showauthor/{id}', [AuthorController::class, 'show'])->name('author.show')->middleware('auth:web,bookstore,admin,author');

// user
Route::get('/user/home', [UserController::class, 'index'])->middleware('auth:web')->name('user.home');
Route::get('/createuser', [userController::class, 'create'])->middleware('guest')->name('user.create');
Route::post('/storeuser', [userController::class, 'store'])->middleware('guest')->name('user.store');
Route::post('/updateuser/{id}', [userController::class, 'update'])->name('user.update');

// admin
Route::get('/admin/home', [AdminController::class, 'index'])->middleware('auth:admin')->name('admin.home');
Route::get('/createadmin', [AdminController::class, 'create'])->middleware('auth:admin')->name('admin.create');
Route::post('/storeadmin', [AdminController::class, 'store'])->middleware('auth:admin')->name('admin.store');
Route::post('/updateadmin/{id}', [adminController::class, 'update'])->name('admin.update');

// bookstore
Route::get('/bookstore/home', [BookstoreController::class, 'index'])->middleware('auth:bookstore')->name('bookstore.home');
Route::get('/createbookstore', [BookstoreController::class, 'create'])->middleware('guest')->name('bookstore.create');
Route::post('/storebookstore', [BookstoreController::class, 'store'])->middleware('guest')->name('bookstore.store');
Route::post('/updatebookstore/{id}', [bookstoreController::class, 'update'])->name('bookstore.update');

// booksharingone
Route::get('booksharingsection', [BooksharingOneController::class, 'index'])->name('booksharingsection.index');
Route::get('createbook/{id}', [BooksharingOneController::class, 'create'])->name('book.create')->middleware('auth:web');
Route::post('sharebook', [BooksharingOneController::class, 'store'])->name('book.store');
Route::get('showbook/{id}/{BSid}', [BooksharingOneController::class, 'show'])->name('book.show');

Route::get('status/{id}', [BooksharingOneController::class, 'status'])->name('change.status');
Route::get('editbook/{id}/{BSid}', [BooksharingOneController::class, 'edit'])->name('book.edit');
Route::post('updatebook/{id}/{BSid}', [BooksharingOneController::class, 'update'])->name('book.update');
Route::get('destroybook/{id}/{BSid}', [BooksharingOneController::class, 'destroy'])->name('book.destroy');
Route::get('downloadshare/{file_name}/{id}', [BooksharingOneController::class, 'downloadshare'])->name('downloadshare.download');

// payment
Route::get('createpaymentshare_one/{id}', [PaymentController::class, 'createpaymentshare_one'])->name('createpaymentshare_one.create');
Route::post('sharepaymentone',[PaymentController::class,'sharepaymentone'])->name('sharepaymentone.store');
Route::post('sharepaymentonecash',[PaymentController::class,'sharepaymentonecash'])->name('sharepaymentonecash.store');

// booksharingtwo

Route::get('createbook2/{id}', [BooksharingTwoController::class, 'create'])->name('book.create2')->middleware('web');
Route::post('/sharebook2',[BooksharingTwoController::class,'store'])->name('book.store2')->middleware('web');
Route::get('showbook2/{id}/{BSid}', [BooksharingTwoController::class, 'show'])->name('book.show2');
Route::get('editbook2/{id}/{BSid}', [BooksharingTwoController::class, 'edit'])->name('book.edit2');
Route::post('updatebook2/{id}/{BSid}', [BooksharingTwoController::class, 'update'])->name('book.update2');
Route::get('destroybook2/{id}/{BSid}', [BooksharingTwoController::class, 'destroy'])->name('book.destroy2');
Route::get('downloadshare2/{file_name}/{id}', [BooksharingTwoController::class, 'downloadshare'])->name('downloadshare.download2');
Route::get('status2/{id}', [BooksharingTwoController::class, 'status'])->name('change.status2');
// payment
Route::get('createpaymentshare_two/{id}', [PaymentController::class, 'createpaymentshare_two'])->name('createpaymentshare_two.create');
Route::post('sharepaymenttwo',[PaymentController::class,'sharepaymenttwo'])->name('sharepaymenttwo.store');
Route::post('sharepaymenttwocash',[PaymentController::class,'sharepaymenttwocash'])->name('sharepaymenttwocash.store');


// payment book
Route::get('createpaymentbook/{id}',[PaymentController::class,'createpaymentbook'])->name('paymentbook.create');
Route::post('storepaymentbook',[PaymentController::class,'storepaymentbook'])->name('paymentbook.store');
Route::post('paycashbook',[PaymentController::class,'paycashbook'])->name('paycashbook.store');


// booksharing section
Route::post('storebooksharingsection', [BooksharingsectionController::class, 'store'])->name('booksharingsection.store');
Route::get('destorybooksharingsection/{id}', [BooksharingsectionController::class, 'destroy'])->name('booksharingsection.destroy')->middleware('auth:admin');
Route::get('/searchh', [BooksharingsectionController::class, 'search'])->name('booksharing.search');

// quotes
Route::post('storeopinion', [OpinionController::class, 'store'])->name('opinion.store');
Route::get('destroyopinion/{id}', [OpinionController::class, 'destroy'])->name('opinion.destroy');

// opinion
Route::post('storequotes', [QuotesController::class, 'store'])->name('quotes.store');
Route::get('destroyquote/{id}', [QuotesController::class, 'destroy'])->name('quote.destroy');

// delivery man
route::post('storeman',[DeliveryManController::class,'store'])->name('man.store');
route::post('updateman/{id}',[DeliveryManController::class,'update'])->name('man.update');
route::get('destroyman/{id}',[DeliveryManController::class,'destroy'])->name('man.destroy');
// delivery
route::get('delivery',[DeliveryController::class,'index'])->name('delivery.index');
route::get('createdelivery/{id}/{BS_id}',[DeliveryController::class,'create'])->name('delivery.create');
route::post('storedelivery',[DeliveryController::class,'store'])->name('delivery.store');
route::get('createdelivery2/{id}/{BS_id}',[DeliveryController::class,'create2'])->name('delivery.create2');
route::post('storedelivery2',[DeliveryController::class,'store2'])->name('delivery.store2');

route::get('createbookdelivery/{id}',[DeliveryController::class,'create3'])->name('delivery.create3');
route::post('storebookdelivery',[DeliveryController::class,'store3'])->name('delivery.store3');

// books
route::get('book',[BookController::class,'index'])->name('product.index');
route::get('showproduct/{id}',[BookController::class,'show'])->name('product.show');
route::get('choose/{id}',[BookController::class,'choose'])->name('chosse.format');
route::get('purchasedbook',[BookController::class,'purchased'])->name('book.purchased');
route::get('downloadpurchasedbook/{filename}/{id}',[BookController::class,'downloadpurchased'])->name('download.purchased');
Route::get('/search', [BookController::class, 'search'])->name('books.search');
//book panel
route::get('all_bookpanel',[BookPanelController::class,'index'])->name('bookpanel.all');
route::get('create_all_book',[BookPanelController::class,'create'])->name('all_book.create');
route::post('store_all_book',[BookPanelController::class,'store'])->name('all_book.store');
route::get('edit_all_book/{id}',[BookPanelController::class,'edit'])->name('all_book.edit');
route::post('update_all_book/{id}',[BookPanelController::class,'update'])->name('all_book.update');
route::get('show_all_book/{id}',[BookPanelController::class,'show'])->name('all_book.show');
Route::get('allstatus/{id}', [BookPanelController::class, 'status'])->name('all.status');
// summary
route::get('createsummary/{id}',[SummaryController::class,'create'])->name('summary.create');
route::post('storesummary',[SummaryController::class,'store'])->name('summary.store');
route::get('download_audio/{filename}/{id}',[SummaryController::class,'download_audio'])->name('download.audio');
route::get('download_written/{filename}/{id}',[SummaryController::class,'download_written'])->name('download.written');
route::get('download_video/{filename}/{id}',[SummaryController::class,'download_video'])->name('download.video');
route::get('editsummary/{id}',[SummaryController::class,'edit'])->name('summary.edit');
route::post('updatesummary/{id}',[SummaryController::class,'update'])->name('summary.update');
route::get('destroysummary/{id}',[SummaryController::class,'destroy'])->name('summary.destroy');
//premium
route::get('createpremium',[PaymentController::class,'createpremium'])->name('premium.create');
route::post('storepremium',[PaymentController::class,'storepremium'])->name('premium.store');
// category
route::get('showcategory/{id}',[CategoryController::class,'show'])->name('category.show');
// review
route::post('storereview',[ReviewController::class,'store'])->name('review.store');
route::get('destroyreview/{id}',[ReviewController::class,'destroy'])->name('review.destroy');

//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::://

// seminar
route::get('seminar',[SeminarController::class,'index'])->name('seminar.index');
route::get('showseminar/{id}',[SeminarController::class,'show'])->name('seminar.show');
route::get('createseminar',[SeminarController::class,'create'])->name('seminar.create');
route::post('storeseminar',[SeminarController::class,'store'])->name('seminar.store');
route::get('destroyseminar/{id}',[SeminarController::class,'destroy'])->name('seminar.destroy');
route::get('destroyoffseminar/{id}',[SeminarController::class,'destroyoff'])->name('seminar.destroyoff');
route::get('createpaymentseminar/{id}',[PaymentController::class,'createpaymentseminar'])->name('seminar.createpayment');
route::post('storepaymentseminar',[PaymentController::class,'storepaymentseminar'])->name('seminar.storepayment');
route::post('storepaymentseminarcash',[PaymentController::class,'storepaymentseminarcash'])->name('seminar.storepaymentcash');

// day
route::post('storeday',[DaysController::class,'store'])->name('day.store');
route::post('updateday/{id}',[DaysController::class,'update'])->name('day.update');
route::get('detroyday/{id}',[DaysController::class,'destroy'])->name('day.destroy');
// period
route::post('storeperiod',[PeriodController::class,'store'])->name('period.store');
route::post('updateperiod/{id}',[PeriodController::class,'update'])->name('period.update');
route::get('destroyperiod/{id}',[PeriodController::class,'destroy'])->name('period.destroy');
//speaker
route::post('storespeaker',[SpeakerController::class,'store'])->name('speaker.store');
route::post('updatespeaker/{id}',[speakerController::class,'update'])->name('speaker.update');
route::get('destroyspeaker/{id}',[speakerController::class,'destroy'])->name('speaker.destroy');

//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::://
// dashboard
route::get('dashboard',[DashboardController::class,'index'])->name('dashboard.index');
route::get('revenue',[RevenueContoller::class,'index'])->name('revenue.index');

