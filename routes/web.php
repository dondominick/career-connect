<?php

use Illuminate\Support\Facades\Route;


Route::view('/', 'pages.home');

Route::view('/index', 'pages.index')->name('index');
Route::view('/dashboard', 'pages.dahsboard')->name('dashboard');