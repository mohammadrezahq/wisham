<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\WishController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', [PageController::class, 'home'])->name('home');

// Wishes

Route::middleware('auth')->group(function ()
{
    Route::get('/wishes/{type}', [WishController::class, 'wishes'])
            ->name('wishes.index');

    Route::group([
        "controller" => WishController::class,
        'prefix' => 'wish',
        'as' => 'wish.',
    ], function ()
    {
        Route::get('/add/{type?}', 'create')->name('add');

        Route::post('/add', 'store')->name('store');

        Route::get('/edit/{wish}', 'edit')->name('edit');

        Route::put('/edit/{wish}', 'update')->name('update');

        Route::post('/complete/{wish}', 'complete')->name('complete');

        Route::delete('/delete/{wish}', 'destroy')->name('delete');
    });
});

require __DIR__.'/auth.php';
