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

$proxy_url    = getenv('PROXY_URL');
$proxy_schema = getenv('PROXY_SCHEMA');

if (!empty($proxy_url)) {
   URL::forceRootUrl($proxy_url);
}

if (!empty($proxy_schema)) {
   URL::forceScheme($proxy_schema);
}

Auth::routes(['verify' => true]);

Route::get('/', function () {
    return view('landing');
});

Route::get('user/{id}', 'UserController@show');

Route::get('api', 'ApiController');
Route::get('api/getUsers', 'ApiController@getUsers');
// Untuk Oauth
Route::get('auth/{provider}','Auth\LoginController@redirectToProvider');
Route::get('auth/{provider}/callback','Auth\LoginController@handleProviderCallback');

// Untuk api register
Route::post('api/register', 'API\UserController@register');


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
    Route::get('/keanggotaan/{a}', 'DashboardController@keanggotaan');
    Route::post('/keanggotaan/{a}', 'DashboardController@keanggotaan');
    Route::get('/generate_nomor_anggota', 'DashboardController@generate_nomor_anggota');
    Route::get('/generate_nomor_anggota/{a}', 'DashboardController@generate_nomor_anggota');

    Route::get('/rayon', 'DashboardController@rayon')->name('rayon');
    Route::get('/rayon/{a}', 'DashboardController@rayon');
    Route::post('/rayon/{a}', 'DashboardController@rayon');

    Route::get('/data_rayon', 'DashboardController@data_rayon')->name('data_rayon');
    Route::get('/data_rayon/{a}', 'DashboardController@data_rayon');
    Route::post('/data_rayon/{a}', 'DashboardController@data_rayon');

#    Route::get('/lokasi', 'DashboardController@lokasi')->name('lokasi');
#    Route::get('/lokasi/{a}', 'DashboardController@lokasi');
#    Route::post('/lokasi/{a}', 'DashboardController@lokasi');

    Route::get('/lettercode', 'DashboardController@lokasi')->name('lettercode');
    Route::get('/lettercode/{a}', 'DashboardController@lokasi');
    Route::post('/lettercode/{a}', 'DashboardController@lokasi');

    Route::get('/kode_pos', 'DashboardController@kode_pos')->name('kode_pos');
    Route::get('/kode_pos/{a}', 'DashboardController@kode_pos');
    Route::post('/kode_pos/{a}', 'DashboardController@kode_pos');

    Route::get('/bandara', 'DashboardController@bandara')->name('bandara');
    Route::get('/bandara/{a}', 'DashboardController@bandara');
    Route::post('/bandara/{a}', 'DashboardController@bandara');

    Route::get('/pelabuhan', 'DashboardController@pelabuhan')->name('pelabuhan');
    Route::get('/pelabuhan/{a}', 'DashboardController@pelabuhan');
    Route::post('/pelabuhan/{a}', 'DashboardController@pelabuhan');

    Route::get('/stasiun', 'DashboardController@stasiun')->name('stasiun');
    Route::get('/stasiun/{a}', 'DashboardController@stasiun');
    Route::post('/stasiun/{a}', 'DashboardController@stasiun');

    Route::get('/terminal', 'DashboardController@terminal')->name('terminal');
    Route::get('/terminal/{a}', 'DashboardController@terminal');
    Route::post('/terminal/{a}', 'DashboardController@terminal');


    Route::get('/mode_transportasi', 'DashboardController@mode_transportasi')->name('mode_transportasi');
    Route::get('/mode_transportasi/{a}', 'DashboardController@mode_transportasi');
    Route::post('/mode_transportasi/{a}', 'DashboardController@mode_transportasi');

    Route::get('/jenis_kendaraan', 'DashboardController@jenis_kendaraan')->name('jenis_kendaraan');
    Route::get('/jenis_kendaraan/{a}', 'DashboardController@jenis_kendaraan');
    Route::post('/jenis_kendaraan/{a}', 'DashboardController@jenis_kendaraan');

    Route::get('/kendaraan', 'DashboardController@kendaraan')->name('kendaraan');
    Route::get('/kendaraan/{a}', 'DashboardController@kendaraan');
    Route::post('/kendaraan/{a}', 'DashboardController@kendaraan');

    Route::get('/edit/asosiasi', 'EditController@edit_asosiasi');
    Route::post('/edit/asosiasi', 'EditController@submit_asosiasi');
    Route::get('/edit/perusahaan', 'EditController@edit_perusahaan');
    Route::post('/edit/perusahaan', 'EditController@submit_perusahaan');
    Route::get('/edit/professional', 'EditController@edit_professional');
    Route::post('/edit/professional', 'EditController@submit_professional');
    Route::get('/edit/kendaraan', 'EditController@edit_kendaraan');
    Route::post('/edit/kendaraan', 'EditController@submit_kendaraan');

    Route::get('/iuran', 'IuranController');
    Route::get('/iuran/hapus', 'IuranController@hapus');
    Route::get('/iuran/konfirmasi', 'IuranController@konfirmasi');
    Route::get('/iuran/unkonfirmasi', 'IuranController@unkonfirmasi');
    Route::post('/iuran', 'IuranController');
    Route::post('/iuran/input', 'IuranController@input');
    Route::get('/agenda', 'AgendaController@agenda');
    Route::post('/agenda/{a}', 'AgendaController@agenda');
    Route::get('/agenda/{a}', 'AgendaController@agenda');
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

// API Data Rayon
Route::get('/getDataRayon', 'ApiController@getDataRayon');
Route::get('/getDataRayon/{id_asos}', 'ApiController@getDataRayon');

// API Consul Barang
Route::get('/getConsulBarang', 'ApiController@getConsulBarang');
Route::get('/getConsulBarang/{id_user}', 'ApiController@getConsulBarang');

// API Port Handling
Route::get('/getPortHandling', 'ApiController@getPortHandling');
Route::get('/getPortHandling/{id_user}', 'ApiController@getPortHandling');

// API Konsolidator
Route::get('/getKonsolidator', 'ApiController@getKonsolidator');
Route::get('/getKonsolidator/{id_user}', 'ApiController@getKonsolidator');

// API Regulated Agent
Route::get('/getRegulatedAgent', 'ApiController@getRegulatedAgent');
Route::get('/getRegulatedAgent/{id_user}', 'ApiController@getRegulatedAgent');

// API Airport Warehouse
Route::get('/getAirportWarehouse', 'ApiController@getAirportWarehouse');
Route::get('/getAirportWarehouse/{id_user}', 'ApiController@getAirportWarehouse');

// API Packing
Route::get('/getPacking', 'ApiController@getPacking');
Route::get('/getPacking/{id_user}', 'ApiController@getPacking');

// API Agent Cargo
Route::get('/getAgentCargo', 'ApiController@getAgentCargo');
Route::get('/getAgentCargo/{id_user}', 'ApiController@getAgentCargo');

// API Port To Port
Route::get('/getPortToPort', 'ApiController@getPortToPort');
Route::get('/getPortToPort/{id_user}', 'ApiController@getPortToPort');

// API Door To Door
Route::get('/getDoorToDoor', 'ApiController@getDoorToDoor');
Route::get('/getDoorToDoor/{id_user}', 'ApiController@getDoorToDoor');

// API Gudang
Route::get('/getGudang', 'ApiController@getGudang');
Route::get('/getGudang/{id_user}', 'ApiController@getGudang');

// API Truck Services
Route::get('/getOrderTruckServices', 'ApiController@getOrderTruckServices');
Route::get('/getOrderTruckServices/{id_user}', 'ApiController@getOrderTruckServices');

Auth::routes();

Route::get('/home', 'DashboardController')->name('home');

Auth::routes();

#Route::get('/home', 'HomeController@index')->name('home');

Route::get('consul_barang', 'DashboardController@consul_barang');
Route::post('consul_barang/{a}', 'DashboardController@consul_barang');
Route::get('port_handling', 'DashboardController@port_handling');
Route::post('port_handling/{a}', 'DashboardController@port_handling');
Route::get('konsolidator', 'DashboardController@konsolidator');
Route::post('konsolidator/{a}', 'DashboardController@konsolidator');
Route::get('regulated_agent', 'DashboardController@regulated_agent');
Route::post('regulated_agent/{a}', 'DashboardController@regulated_agent');
Route::get('airport_warehouse', 'DashboardController@airport_warehouse');
Route::post('airport_warehouse/{a}', 'DashboardController@airport_warehouse');
Route::get('packing', 'DashboardController@packing');
Route::post('packing/{a}', 'DashboardController@packing');
Route::get('agent_cargo', 'DashboardController@agent_cargo');
Route::post('agent_cargo/{a}', 'DashboardController@agent_cargo');
Route::get('port_to_port', 'DashboardController@port_to_port');
Route::post('port_to_port/{a}', 'DashboardController@port_to_port');
Route::get('door_to_door', 'DashboardController@door_to_door');
Route::post('door_to_door/{a}', 'DashboardController@door_to_door');
Route::get('order_truck_services', 'DashboardController@order_truck_services');
Route::post('order_truck_services/{a}', 'DashboardController@order_truck_services');
Route::get('gudang', 'DashboardController@gudang');
Route::post('gudang/{a}', 'DashboardController@gudang');

Route::get('kendaraan_darat', 'DashboardController@kendaraan_darat');
Route::get('kendaraan_udara', 'DashboardController@kendaraan_udara');

Route::get('/daftar_asosiasi', 'DashboardController@daftar_asosiasi')->name('daftar_asosiasi');
Route::get('/daftar_asosiasi/{a}', 'DashboardController@daftar_asosiasi');
Route::post('/daftar_asosiasi/{a}', 'DashboardController@daftar_asosiasi');

