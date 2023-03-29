<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserlistController;
use App\Http\Controllers\ManagementController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ChargeController;

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
        Route::get('/', 'index')->name('index');
        Route::get('/reselogin', 'reselogin');
        Route::post('/reselogin', 'reselogin');
        Route::get('/reseregistration', 'reseregistration')->name('reseregistration');

        Route::get('/done', 'done');
        Route::get('/thanks', 'thanks');
        Route::get('/menu1', 'menu1')->name('menu1')->middleware(['verified']);
        Route::get('/menu2', 'menu2')->name('menu2');
        Route::get('/reserve/{id}', 'reserve');
        Route::post('/reserve/{id}', 'reserve');
        Route::post('/reserveadd', 'reserveadd');
        Route::get('/mypage', 'mypage')->name('mypage')->middleware(['verified']);
        Route::get('/logout', 'getLogout')->name('logout');
        Route::post('/reservedel/{id}', 'reservedel');
        Route::post('/favoriteadd/{id}', 'favoriteadd')->middleware(['verified']);
        Route::post('/favoritedel/{id}', 'favoritedel')->middleware(['verified']);
        Route::post('/reservationchange/{id}', 'reservationchange')->middleware(['verified']);
        Route::get('/reservationchange/{id}', 'reservationchange')->middleware(['verified']);
        Route::post('/reserveedit/{id}', 'reserveedit')->middleware(['verified']);
        Route::post('/review/{id}', 'review')->middleware(['verified']);
        Route::post('/reviewadd', 'reviewadd')->middleware(['verified']);
        Route::post('/reservehidden/{id}', 'reservehidden')->middleware(['verified']);
    });

// 管理者用
Route::controller(UserlistController::class)
    ->middleware(['verified', 'can:admin'])->group(
        function () {
            // 権限付与
            Route::get('/userlist', 'userlist');
            Route::post('/userlist', 'userlist');
            Route::post('/authorityadd/{id}', 'authorityadd');
            Route::post('/authoritydel/{id}', 'authoritydel');
        }
    );

// 店舗責任者用
Route::controller(ManagementController::class)
    ->middleware(['verified', 'can:manager'])->group(
        function () {
            // 店舗管理
            Route::get('/shopmanagement', 'shopmanagement');
            Route::post('/shopmanagement', 'shopmanagement');
            Route::post('/shopedit/{id}', 'shopedit');
            Route::post('/shopeditsave', 'shopeditsave');
            Route::get('/shopadd', 'shopadd');
            Route::post('/shopaddsave', 'shopaddsave');
            Route::post('/shopdel/{id}', 'shopdel');

            // 予約管理
            Route::get('/reservelist', 'reservelist');
            Route::post('/reservelist', 'reservelist');
            Route::post('/reservelistedit/{id}', 'reservelistedit');
            Route::post('/reservelistdel/{id}', 'reservelistdel');


            // メール送信
            Route::post('/mailmessage/{id}', 'mailmessage');
            Route::post('/mailsend', 'mailsend');
        }
    );

Route::controller(ChargeController::class)
    ->group(
        function () {
            Route::post('/charge', 'charge');
        }
    );

require __DIR__ . '/auth.php';
