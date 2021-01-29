<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;

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

// Route::get('/', function () {
//     return view('index');
// });

use App\Http\Controllers\donationsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CookiesController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminRestaurantController;
use App\Http\Controllers\AdminDonationController;
use App\Http\Controllers\AdminPuasaController;
use App\Http\Controllers\RmadminController;
use App\Http\Controllers\RmadminMenuController;
use App\Http\Controllers\RmadminProfileController;
use App\Http\Controllers\RmadminRegistController;
use App\Http\Controllers\LoginController;

// Route::get('/', [Menu::class, 'index']);
// Route::get('/add', [Menu::class, 'create']);
// Route::post('/', [Menu::class, 'store']);
// Route::get('/{package}', [Menu::class, 'show']);
// Route::delete('/{package}', [Menu::class, 'destroy']);

Route::resource('/', donationsController::class );
Route::resource('/login', LoginController::class);
Route::resource('/cart', CartController::class);
Route::resource('/transaction', TransactionController::class);
Route::resource('/admin/restaurant', AdminRestaurantController::class);
Route::resource('/admin/donation', AdminDonationController::class);
Route::resource('/admin/puasa', AdminPuasaController::class);
Route::resource('/admin', AdminController::class);
Route::resource('/rmadmin/menu', RmadminMenuController::class);
Route::resource('/rmadmin/profile', RmadminProfileController::class);
Route::resource('/rmadmin/regist', RmadminRegistController::class);
Route::resource('/rmadmin', RmadminController::class);
Route::get('/admin/verifikasi/{id}', [AdminController::class, 'verifikasi']);
Route::get('/admin/unverifikasi/{id}', [AdminController::class, 'unverifikasi']);
Route::get('/admin/puasa/activate/{id}', [AdminPuasaController::class, 'activate']);
Route::get('/admin/puasa/deactivate/{id}', [AdminPuasaController::class, 'deactivate']);
Route::post('/rmadmin/profile/change_password/{id}', [RmadminProfileController::class, 'change_password']);
Route::get('/transaction/cancel/{id}', [TransactionController::class, 'cancel']);
Route::get('/logout', [LoginController::class, 'logout']);
Route::get('/admin/donation/verifikasi/{id}', [AdminDonationController::class, 'verifikasi']);
Route::get('/admin/donation/tolak/{id}', [AdminDonationController::class, 'tolak']);


// Route::post('/transaction/done', [TransactionController::class, 'done']);

use App\Models\Donation;
use App\Models\Restaurant;
use App\Models\Menu;
use App\Models\User;

Route::get('/tambah_donasi', function(){
    $donasi = Donation::create([
        'restaurant_id' => 1,
        'menu_id' => 1,
        'target' => 50,
        'dibayar' => 5,
        'dalam_proses' => 1
    ]);

    return $donasi;
});

Route::get('/tambah_rm', function(){
    $restaurant = Restaurant::create([
        'nama_resto' => 'RM Warmindo Mantap',
        'alamat' => 'Sleman'
    ]);

    return $restaurant;
});

Route::get('/tambah_menu', function(){
    $menu = Menu::create([
        'nama_menu' => 'Ayam Penyet',
        'harga' => 5000
    ]);

    return $menu;
});

Route::get('/tambah', function(){
    $restaurant = Restaurant::create([
        'nama_resto' => 'RM Mekar Mulya',
        'alamat' => 'Pogung'
    ]);

    $menu = Menu::create([
        'nama_menu' => 'Ayam Bakar',
        'harga' => 20000
    ]);

    $donasi = Donation::create([
        'restaurant_id' => 2,
        'menu_id' => 2,
        'target' => 20,
        'dibayar' => 1,
        'dalam_proses' => 1
    ]);

    return 'Success';
});



Route::get('/tampil_donasi', function(){
    $donations = new Donation();
    return $donations->allDonation();
});

Route::get('/set/{id}', [CookiesController::class, 'set']);
Route::get('/get', [CookiesController::class, 'get']);
Route::get('/delete', [CookiesController::class, 'delete']);

Route::get('/buatuser', function(){
    $user = User::create([
        'username' => 'admin',
        'password' => Hash::make('admin'),
        'role' => 1
    ]);

    return 'Success';
});

Route::get('/buatuser2', function(){
    $user = User::create([
        'username' => 'adminrm',
        'password' => Hash::make('adminrm'),
        'role' => 0
    ]);

    return 'Success';
});