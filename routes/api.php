<?php

use App\Http\Controllers\GuestController;
use Illuminate\Support\Facades\Route;



Route::controller(GuestController::class)->group(function (){
    Route::post('/login','login')->name('login');
    Route::post('/register','register')->name('register');
});


