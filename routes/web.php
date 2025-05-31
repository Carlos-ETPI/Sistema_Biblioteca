<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/prueba', function () {
    return view('prueba');
});
Route::get('/login', function () {
    return view('login');
});
Route::get('/crud', function () {
    return view('crud');
});