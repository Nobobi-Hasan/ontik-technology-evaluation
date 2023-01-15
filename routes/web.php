<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::group(['middleware'=>['PreventBackHistory']], function(){
Route::middleware('PreventBackHistory')->group(function () {
    Route::get('/home', [App\Http\Controllers\ProductController::class, 'index'])->name('home');

    Route::get('/product/create', [App\Http\Controllers\ProductController::class, 'create'])->name('create');
    Route::post('/product/create', [App\Http\Controllers\ProductController::class, 'store'])->name('store');
    
    Route::post('/home/{id}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('destroy');
    
});



