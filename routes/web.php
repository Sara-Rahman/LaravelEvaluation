<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;

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

Auth::routes();
// Root URL
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// For Product
Route::get('/product',[ProductController::class,'index'])->name('product.index');
Route::post('/store/product',[ProductController::class,'store'])->name('product.store');
Route::delete('/delete/product/{id}', [ProductController::class,'destroy']);


Route::post('/store/product',[ProductController::class,'store'])->name('product.store');
// For Category
Route::get('/category',[CategoryController::class,'index'])->name('category.index');
Route::get('/fetch/category',[CategoryController::class,'fetchCategory'])->name('category.fetch');
Route::post('/store/category',[CategoryController::class,'store'])->name('category.store');
Route::delete('/delete/category/{id}', [CategoryController::class,'destroy']);
    


// For Subcategory
Route::get('/subcategory',[SubCategoryController::class,'index'])->name('subcategory.index');
Route::post('/store/subcategory',[SubCategoryController::class,'store'])->name('subcategory.store');
Route::delete('/delete/subcategory/{id}', [SubCategoryController::class,'destroy']);

