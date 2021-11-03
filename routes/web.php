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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', 'AuthManageController@viewLogin')->name('login');
Route::post('/verify_login', 'AuthManageController@verifyLogin');
Route::post('/first_account', 'UserManageController@firstAccount');

Route::group(['middleware' => ['auth', 'checkRole:admin,kasir']], function () {
    Route::get('/logout', 'AuthManageController@logoutProcess');
    Route::get('/dashboard', 'ViewManageController@viewDashboard');
    Route::post('/market/update', 'ViewManageController@updateMarket');
    // ------------------------- Fitur Cari -------------------------
    Route::get('/search/{word}', 'SearchManageController@searchPage');
    // ------------------------- Profil -------------------------
    Route::get('/profile', 'ProfileManageController@viewProfile');
    Route::post('/profile/update/data', 'ProfileManageController@changeData');
    Route::post(
        '/profile/update/password',
        'ProfileManageController@changePassword'
    );
    Route::post(
        '/profile/update/picture',
        'ProfileManageController@changePicture'
    );
    // ------------------------- Kelola Akun -------------------------
    // > Akun
    Route::get('/account', 'UserManageController@viewAccount');
    Route::get('/account/new', 'UserManageController@viewNewAccount');
    Route::post('/account/create', 'UserManageController@createAccount');
    Route::get('/account/edit/{id}', 'UserManageController@editAccount');
    Route::post('/account/update', 'UserManageController@updateAccount');
    Route::get('/account/delete/{id}', 'UserManageController@deleteAccount');
    Route::get('/account/filter/{id}', 'UserManageController@filterTable');

    // ------------------------- Kelola Barang -------------------------
    // > Barang
    Route::get('/product', 'ProductManageController@viewProduct');
    Route::get('/product/new', 'ProductManageController@viewNewProduct');
    Route::post('/product/create', 'ProductManageController@createProduct');
    Route::get('/product/edit/{id}', 'ProductManageController@editProduct');
    Route::post('/product/update', 'ProductManageController@updateProduct');
    Route::get('/product/delete/{id}', 'ProductManageController@deleteProduct');
});

// Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');