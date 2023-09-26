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
        return redirect('/');
    })->name('dashboard');
});
Route::get('/', [HomeController::class, 'homeIndex']);
// Route::get('/admin', [AdminController::class, 'admin']);
// Route::middleware('admin')->group(function () {


// });
Route::get('/adminpanel', [AdminController::class, 'adminPanel'])->middleware('admin');
Route::get('/viewCategory', [AdminController::class, 'viewCategory'])->middleware('admin');
Route::post('/addCategory', [AdminController::class, 'addCategory'])->middleware('admin');
Route::get('/viewProduct', [AdminController::class, 'viewProduct'])->middleware('admin');
Route::post('/addProduct', [AdminController::class, 'addProduct'])->middleware('admin');
Route::get('/listCategories', [AdminController::class, 'listCategories'])->middleware('admin');
Route::get('/deleteCategory/{id}', [AdminController::class, 'deleteCategory'])->middleware('admin');
Route::post('/updateCategory/{id}', [AdminController::class, 'updateCategory'])->middleware('admin');
Route::get('/listProducts', [AdminController::class, 'listProducts'])->middleware('admin');
Route::get('/deleteProduct/{id}', [AdminController::class, 'deleteProduct'])->middleware('admin');
Route::post('/saveChanges', [AdminController::class, 'saveChanges'])->middleware('admin');
Route::post('/editProduct', [AdminController::class, 'editProduct'])->middleware('admin');
Route::get('/shoppingCart/{id}', [HomeController::class, 'shoppingCart']);
Route::get('/viewCart', [HomeController::class, 'viewCart']);
Route::post('/updateCart', [HomeController::class, 'updateCart']);
Route::get('/checkout', [HomeController::class, 'checkout']);
Route::get('/logout', [HomeController::class, 'logout']);