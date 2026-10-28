<?php

use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Welcome')->name('home');

#Beispiel Route:

#Route::METHODE('PFAD', function () {
#    return ANTWORT;
#});


Route::get('/ping', function () {
    return ['status' => 'ok'];
});
