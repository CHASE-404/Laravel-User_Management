<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', [UserController::class, 'index']);
Route::get('/addUser', function () {return view('addUser');})->name('addUser');
Route::get('/deleteUser', [UserController::class, 'showDeleteUser'])->name('deleteUser');
Route::get('/updateUser', [UserController::class, 'showUpdateUser'])->name('users.update');

// Route for form submission
Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
// Route for handling user deletion
Route::post('/users/delete', [UserController::class, 'delete'])->name('users.delete');
// Route for form submission to update user
Route::post('/updateUser', [UserController::class, 'update'])->name('users.update');





