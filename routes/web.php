<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\NewsController;
use App\Models\News;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

//handle redirect register to login
// Route::match(['GET','POST'], '/register', function(){
//     return redirect('/login');
// });

Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::resource('news', NewsController::class);

        Route::resource('category', CategoryController::class)->middleware('auth');
    });
});
