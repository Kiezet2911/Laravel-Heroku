<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Acc;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\AdminController;
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

Route::get('/', [WebController::class, 'index'])->name('home');

Route::get('/link', function () {
    return view('link');
});


Route::post('signin', [Acc::class, 'login'])->name('login');
Route::view('signin', 'signin');
Route::get('/signin', function () {

    if (session()->has('UserLogin')) {
        if (isset($data['id'])) {
            return view('home');
        } else return view('signin');
    } else {
        return view('signin');
    }
});

Route::get('/logout', function () {
    if (session()->has('UserLogin') || session()->has('idbookforcart')) {
        session()->remove('UserLogin');
        session()->remove("idbookforcart");
    }
    return  redirect('');
});

Route::post('signup', [Acc::class, 'signup'])->name('signup');
Route::view('signup', 'signup');



Route::get('/profile', function () {
    if (session()->has('UserLogin')) {
        $urlcart = strstr($_SERVER["HTTP_REFERER"], "cart") ? strstr($_SERVER["HTTP_REFERER"], "cart") : null;
        if (isset(session()->get('UserLogin')['id'])) {
            $id = session()->get('UserLogin')['id'];
            $data = Http::get('https://bookingapiiiii.herokuapp.com/khachhangbyid/' . $id);
            session()->put('UserLogin', $data);
            return view('profile', compact('data', 'urlcart'));
        }
    }
});

Route::view('/products', 'products');
Route::get('/products', [WebController::class, 'product'])->name('product');

//Giỏ Hàng
Route::view('/cart', 'cart');
Route::get('/cart', [WebController::class, 'cart']);
Route::get('/CreateCart', [WebController::class, 'CreateCart']);
Route::get('plusCountItem', [WebController::class, 'plusCountItem']);
Route::get('minusCountItem', [WebController::class, 'minusCountItem']);

//Lịch sử Mua Hàng Của User
Route::get('history-pay', [WebController::class, 'HistoryPay']);
Route::get('CTBill/{idBill}/{date}/{money}/{TT}', [WebController::class, 'CTBill']);


//Thông Tin Chi Tiết Của Sách
Route::view('/details', 'details');
Route::get('/details', [WebController::class, 'details']);


//Admin's Route
Route::prefix('admin')->group(function () {
    Route::get('', [AdminController::class, 'AdminIndex']);

    Route::get('account-manager', [AdminController::class, 'AdminAccount']);
    Route::get('account-manager/{idBill}/{date}/{money}/{TT}', [AdminController::class, 'GetBill']);
    Route::get('bill-pay', [AdminController::class, 'AdminBill']);
    Route::get('change-bill-pay/{id}', [AdminController::class, 'ChangeStatusBill']);
    Route::get('storage-products', [AdminController::class, 'AdminStorage']);

    Route::get('setting', [AdminController::class, 'AdminSetting']);
    Route::post('setting', [AdminController::class, 'AdminSetting']);

    Route::get('add-newbook', [AdminController::class, 'AdminAddNewBook']);
});
