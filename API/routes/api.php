<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Utama;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [Utama::class, 'login']);


Route::middleware('api_token')->group(function () {

    Route::get('/profile', function (Request $request) {
        return response()->json([
            'id_pengguna' => $request->auth_pengguna->id_pengguna,
            'username'    => $request->auth_pengguna->username,
            'role'        => $request->auth_pengguna->role,
        ]);
    });

    Route::post('/logout', function (Request $request) {
        $request->auth_pengguna->api_token = null;
        $request->auth_pengguna->token_expired_at = null;
        $request->auth_pengguna->save();

        return response()->json([
            'message' => 'Logout berhasil'
        ]);
    });

});

