<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TblUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return redirect()->route('register.index');
});
Route::post('upload', [CustomerController::class, 'upload'])->name('upload');
Route::get('show', [CustomerController::class, 'show'])->name('show');
Route::get('updatePage/{id}', [CustomerController::class, 'updatePage'])->name('updatePage');
Route::post('update/{id}', [CustomerController::class, 'update'])->name('update');
Route::get('delete/{id}', [CustomerController::class, 'delete'])->name('delete');

Route::resource('student', StudentController::class);

Route::resource('user', TblUserController::class);

Route::resource('register', RegisterController::class);
