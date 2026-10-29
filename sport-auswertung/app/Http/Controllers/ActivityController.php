<?php

namespace App\Http\Controllers;

use App\Models\Activity;

/**
 * Nimmt Anfragen zu Einheiten entgegen und gibt Antworten zurück.
 * Der Controller enthält keine Datenbanklogik, die liegt im Model.
 */

class ActivityController extends Controller
{
    /**
     * Gibt alle Einheiten als JSON-Liste zurück.
     * Laravel wandelt die Ergebnisliste automatisch in JSON um.
     */
    public function index()
    {
        return Activity::all();
    }
}