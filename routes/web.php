<?php

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

Auth::routes();

Route::get('/', [App\Http\Controllers\Advert\AdvertController::class, 'index'])->name('main');

Route::resource('user', App\Http\Controllers\User\UserController::class)->names('user');

Route::resource('advert', App\Http\Controllers\Advert\AdvertController::class)->names('advert');

Route::get('/user/{id}/review', [App\Http\Controllers\User\UserReviewController::class, 'getAllReviews'])->name('review.all');

Route::get('/advert/all/{id}', [App\Http\Controllers\Advert\AdvertController::class, 'all'])->name('advert.all');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/advert/close/{id}', [App\Http\Controllers\Advert\AdvertController::class, 'close'])->name('advert.close');

    Route::post('/review/store/{to}/{from}', [App\Http\Controllers\User\UserReviewController::class, 'store'])->name('review.store');
});

Route::get('/password/reset', function () {
    return redirect()->route('main');
});

Route::get('/home', function () {
    return redirect()->route('main');
});

