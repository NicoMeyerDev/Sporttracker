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


    /**
 * Fasst alle Einheiten pro Sportart zusammen.
 * groupBy('sport') bildet Gruppen, COUNT, SUM und AVG rechnen pro Gruppe.
 * Leere Werte (null) ignoriert AVG automatisch, z. B. fehlende Pulswerte beim Schwimmen.
 */
    
     public function summary()
    {
        return Activity::select('sport')
            ->selectRaw('COUNT(*) as anzahl')
            ->selectRaw('SUM(distance_m) as gesamt_distanz_m')
            ->selectRaw('ROUND(AVG(avg_hr)) as durchschnitt_puls')
            ->groupBy('sport')
            ->get();
    }
}