<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::get('/', [HomeController::class, 'homeIndex']);
Route::get('/adminpanel', [AdminController::class, 'adminPanel']);
// Route::get('/admin', [AdminController::class, 'admin']);
Route::get('/viewCategory', [AdminController::class, 'viewCategory']);
Route::post('/addCategory', [AdminController::class, 'addCategory']);
Route::get('/viewProduct', [AdminController::class, 'viewProduct']);
Route::post('/addProduct', [AdminController::class, 'addProduct']);
Route::get('/listCategories', [AdminController::class, 'listCategories']);
Route::get('/deleteCategory/{id}', [AdminController::class, 'deleteCategory']);
Route::post('/updateCategory/{id}', [AdminController::class, 'updateCategory']);
Route::get('/listProducts', [AdminController::class, 'listProducts']);
Route::get('/deleteProduct/{id}', [AdminController::class, 'deleteProduct']);
Route::get('/shoppingCart/{id}', [HomeController::class, 'shoppingCart']);
Route::get('/viewCart', [HomeController::class, 'viewCart']);



Route::post('/editProduct', [AdminController::class, 'editProduct']);