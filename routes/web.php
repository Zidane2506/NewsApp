<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', [\App\Http\Controllers\frontEndController::class, 'index'] );
Route::get('/detail/news/{slug}', [\App\Http\Controllers\frontEndController::class, 'detailNews'])->name('detailNews');
Route::get('/detail/category/{slug}', [\App\Http\Controllers\frontEndController::class, 'detailCategory'])->name('detailCategory');

Auth::routes();

//handle redirect register to login
// Route::match(['GET','POST'], '/register', function(){
//     return redirect('/login');
// });

Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/profile', [App\Http\Controllers\profileController::class, 'index'])->name('profile.index');
    Route::get('/changePassword', [App\Http\Controllers\profileController::class, 'changePassword'])->name('profile.changePassword');
    Route::put('/updatePassword', [App\Http\Controllers\profileController::class, 'updatePassword'])->name('profile.updatePassword');
    Route::get('/createProfile', [App\Http\Controllers\profileController::class, 'createProfile'])->name('createProfile');
    Route::post('/storeProfile', [App\Http\Controllers\profileController::class, 'storeProfile'])->name('storeProfile');
    Route::get('/editProfile', [App\Http\Controllers\profileController::class, 'editProfile'])->name('editProfile');
    Route::put('/updateProfile', [App\Http\Controllers\profileController::class, 'updateProfile'])->name('updateProfile');

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::resource('news', NewsController::class);
        Route::resource('profile', profileController::class);
        Route::resource('category', CategoryController::class)->middleware('auth');
        Route::get('/allUser', [App\Http\Controllers\profileController::class, 'allUser'])->name('allUser');
        Route::put('/resetPassword/{id}', [App\Http\Controllers\profileController::class, 'resetPassword'])->name('resetPassword');
    });
});
