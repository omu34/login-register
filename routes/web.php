<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\Calculator\CalculatorController;

use App\Http\Middleware\CheckRole;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::middleware(['auth:sanctum',config('jetstream.auth_session'),
//     'verified',])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });





// Route::middleware([
//     CheckRole::class, // Add your custom middleware here
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::controller(LoginRegisterController::class)->group(function() {
//         Route::get('/register', 'register')->name('register');
//         Route::post('/store', 'store')->name('store');
//         Route::get('/login', 'login')->name('login');
//         Route::post('/authenticate', 'authenticate')->name('authenticate');
//         Route::get('/dashboard', 'dashboard')->name('dashboard');
//         Route::post('/logout', 'logout')->name('logout');
//     });
//     // Your routes that require authentication
// });




Route::get('/', function () {
    return view('welcome');
});

Route::controller(LoginRegisterController::class)->group(function () {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/logout', 'logout')->name('logout');
});

Route::controller(CalculatorController::class)->group(function () {
    Route::get('/asset-finance-calculator', 'CalculatorController@showCalculator');
    Route::post('/asset-finance-calculator', 'CalculatorController@calculate');
});
