<?php

#import(s)
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PingController; 

Route::inertia('/', 'Welcome')->name('home');

#Beispiel Route:

#Route::METHODE('PFAD', function () {
#    return ANTWORT;
#});

#Bessere Route mit verbindung zum Controller
#Route::get('/ping', [KLASSE::class, 'METHODE']);


Route::get('/ping', [PingController::class, 'index']);
