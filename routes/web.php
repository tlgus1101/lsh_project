<?php

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


Route::get('/', 'IndexController@index')->middleware('https');
Route::post('/userinfosave', 'IndexController@userinfosave')->middleware('https');

// 일반 로그인
Route::get('/login', 'Auth\LoginController@loginForm')->middleware('https')->name('login');
Route::post('/login', 'Auth\LoginController@login');

// 소셜 로그인
Route::get('/{provider}/login', 'Auth\SocialiteController@redirectToProvider')->middleware('https');
Route::get('/{provider}/callback', 'Auth\SocialiteController@handleProviderCallback')->middleware('https');

// 회원가입
Route::get('/register', function () {
    return view('auth.register');
});

// 비밀번호 찾기
Route::prefix('verify')->group(function () {
    Route::get('/', 'Auth\VerifyController@index')->middleware('https');
    Route::post('/send', 'Auth\VerifyController@send')->middleware('https');
});
//비밀번호 변경
Route::prefix('/reset')->group(function () {
  Route::get('/', 'Auth\ReSetPasswordController@index')->middleware('https');
  Route::post('/update', 'Auth\ReSetPasswordController@update')->middleware('https');
});

// 로그아웃
Route::get('/logout', 'Auth\LoginController@logout')->middleware('https');

//객실 리스트
Route::prefix('goods')->group(function () {
    Route::get('/', 'Product\GoodsController@index')->middleware('https');
});

//객실 리스트
Route::prefix('community')->group(function () {
    Route::post('/', 'Product\CommunityController@index')->middleware('https');
    Route::post('/wish', 'Product\CommunityController@wish')->middleware('https');
});

//예약하기
Route::prefix('reserve')->middleware('auth', 'https')->group(function () {
    Route::get('/', 'Product\ReserveController@index');
    Route::POST('/show', 'Product\ReserveController@show');
    Route::POST('/save', 'Product\ReserveController@store');
    Route::POST('/contact/check', 'Product\ReserveController@contactcheck');
    Route::POST('/contact/send', 'Product\ReserveController@contactsend');
});

//나의 예약 내역
Route::prefix('reservation')->middleware('auth', 'https')->group(function () {
  Route::get('/', 'My\ReservationController@index');
  Route::POST('/show', 'My\ReservationController@show');
  Route::get('/cancle', 'My\ReservationController@cancle');
  Route::POST('/cancle', 'My\ReservationController@store');
});

//나의 정보
Route::prefix('information')->middleware('auth', 'https')->group(function () {
    Route::get('/', 'My\InformationController@index');
    Route::POST('/show', 'My\InformationController@show');
    Route::POST('/update', 'My\InformationController@update');
    Route::POST('/delete', 'My\InformationController@delete');
    Route::POST('/contact/check', 'My\InformationController@contactcheck');
    Route::POST('/contact/send', 'My\InformationController@contactsend');
});
//예약 확인
Route::prefix('confirm')->middleware('auth', 'https')->group(function () {
    Route::get('/', 'Product\ReserveConfirmController@index');
});

//1:1 문의
Route::prefix('/question')->middleware('auth', 'https')->group(function () {
    Route::get('/', 'My\QuestionController@index');
    Route::POST('/save', 'My\QuestionController@store');
});

Route::prefix('wishlist')->middleware('https')->group(function () {
  Route::get('/', 'My\WishController@index');
  Route::post('/info', 'My\WishController@info');
});

Route::prefix('detail')->middleware('https')->group(function () {
    Route::get('/', 'Product\DetailController@index');
    Route::post('/info', 'Product\DetailController@info');
});

Route::post('/store', 'User\UserController@store');

Route::get('/search', 'IndexController@search');

Route::get('/agreement', function () {
    return view('service.agreement');
});
Route::get('/privacy', function () {
    return view('service.privacy');
});
Route::get('/shell', 'Shell\ShellController@index')->middleware('https');



