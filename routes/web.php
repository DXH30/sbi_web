<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes(['verify' => true]);

Route::get('/', function () {
    return view('landing');
});

Route::get('user/{id}', 'UserController@show');

Route::get('api', 'ApiController');
Route::get('api/getUsers', 'ApiController@getUsers');

// RegisterController
// Route::get('/register', 'RegistrationController@create');
// Route::post('/register', 'RegistrationController@store');

// SesssionsController
// Route::get('/login', 'LoginController')->name('login');
// Route::post('/login', 'LoginController@authenticate');
// Route::get('/logout', 'LoginController@logout');

// DashboardController
Route::get('/dashboard', 'DashboardController')->name('dashboard');
Route::get('/profile', 'DashboardController@profile')->name('profile')->middleware('verified');
Route::post('/profile/{a}', 'DashboardController@profile');

Route::get('/vtoken', 'TokenController@verify');
Route::post('/vtoken/{a}', 'TokenController@verify');

Route::middleware(['check_profile', 'token_verified'])->group(function () {
    Route::get('/kategori', 'DashboardController@kategori')->name('kategori');
    Route::get('/kategori/{a}', 'DashboardController@kategori');
    Route::post('/kategori/{a}', 'DashboardController@kategori');

    Route::get('/keanggotaan', 'DashboardController@keanggotaan')->name('keanggotaan');
    Route::post('/keanggotaan/{a}', 'DashboardController@keanggotaan');

    Route::get('/rayon', 'DashboardController@rayon')->name('rayon');
    Route::get('/rayon/{a}', 'DashboardController@rayon');
    Route::post('/rayon/{a}', 'DashboardController@rayon');

    Route::get('/data_rayon', 'DashboardController@data_rayon')->name('data_rayon');
    Route::get('/data_rayon/{a}', 'DashboardController@data_rayon');
    Route::post('/data_rayon/{a}', 'DashboardController@data_rayon');

    Route::get('/lokasi', 'DashboardController@lokasi')->name('lokasi');
    Route::get('/lokasi/{a}', 'DashboardController@lokasi');
    Route::post('/lokasi/{a}', 'DashboardController@lokasi');

    Route::get('/mode_transportasi', 'DashboardController@mode_transportasi')->name('mode_transportasi');
    Route::get('/mode_transportasi/{a}', 'DashboardController@mode_transportasi');
    Route::post('/mode_transportasi/{a}', 'DashboardController@mode_transportasi');

    Route::get('/jenis_kendaraan', 'DashboardController@jenis_kendaraan')->name('jenis_kendaraan');
    Route::get('/jenis_kendaraan/{a}', 'DashboardController@jenis_kendaraan');
    Route::post('/jenis_kendaraan/{a}', 'DashboardController@jenis_kendaraan');

    Route::get('/kendaraan', 'DashboardController@kendaraan')->name('kendaraan');
    Route::get('/kendaraan/{a}', 'DashboardController@kendaraan');
    Route::post('/kendaraan/{a}', 'DashboardController@kendaraan');
});

// Provinsi, Kecamatan, Kabupaten
Route::get('/getProvinsi', 'ApiController@getProvinsi');
Route::get('/getProvinsi/{id_prov}', 'ApiController@getProvinsi');

Route::get('/getKabupaten', 'ApiController@getKabupaten');
Route::get('/getKabupaten/{id_prov}', 'ApiController@getKabupaten');
Route::get('/getKabupaten/{id_prov}/{id_kab}', 'ApiController@getKabupaten');

Route::get('/getKecamatan', 'ApiController@getKecamatan');
Route::get('/getKecamatan/{id_prov}', 'ApiController@getKecamatan');
Route::get('/getKecamatan/{id_prov}/{id_kec}', 'ApiController@getKecamatan');

Route::get('/getKelurahan', 'ApiController@getKelurahan');
Route::get('/getKelurahan/{id_kec}', 'ApiController@getKelurahan');
Route::get('/getKelurahan/{id_kec}/{id_kel}', 'ApiController@getKelurahan');

Route::get('/sendMail', 'MailController@sendMail');
Route::post('/sendMail', 'MailController@sendMail');

Auth::routes();

Route::get('/home', 'DashboardController')->name('home');
