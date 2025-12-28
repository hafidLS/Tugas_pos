<?php
use App\Http\Controllers\Utama;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});
