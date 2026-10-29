<?php

//import(s)
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PingController; 
use App\Http\Controllers\ActivityController;

Route::inertia('/', 'Welcome')->name('home');

// Beispiel Route:

// Route::METHODE('PFAD', function () {
//     return ANTWORT;
// });

// Bessere Route mit verbindung zum Controller
// Route::get('/ping', [KLASSE::class, 'METHODE']);

// Health-Check: Liefert {"status":"ok"}, um zu prüfen, ob die API läuft.
Route::get('/ping', [PingController::class, 'index']);

// Liste aller gespeicherten Einheiten (Training/Spiel) als JSON.
// Ablauf: Browser -> Route -> ActivityController::index -> Model -> Datenbank
Route::get('/activities', [ActivityController::class, 'index']);
