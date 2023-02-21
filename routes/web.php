<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
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

Route::controller(ShopController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index')->middleware(['auth']);
        Route::get('/reselogin', 'reselogin');
        Route::post('/reselogin', 'reselogin');
        Route::get('/reseregistration', 'reseregistration')->name('reseregistration');
        Route::get('/done', 'done');
        Route::get('/thanks', 'thanks');
        Route::get('/menu1', 'menu1')->name('menu1')->middleware(['auth']);
        Route::get('/menu2', 'menu2')->name('menu2');
        Route::get('/reserve/{id}', 'reserve');
        Route::post('/reserve/{id}', 'reserve');
        Route::post('/reserveadd', 'reserveadd');
        Route::get('/mypage', 'mypage')->middleware(['auth']);
        Route::get('/logout', 'getLogout')->name('logout');
        Route::post('/reservedel/{id}', 'reservedel');
        Route::post('/favoriteadd/{id}', 'favoriteadd')->middleware(['auth']);
        Route::post('/favoritedel/{id}', 'favoritedel')->middleware(['auth']);
    });



Route::get('/aaa', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


require __DIR__ . '/auth.php';
