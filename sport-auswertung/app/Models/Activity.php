<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Eine Einheit (Training oder Spiel).
 * Das Model ist die PHP-Klasse zur Tabelle "activities".
 * Mit ihr liest und schreibst du Zeilen, ohne SQL zu tippen.
 */

class Activity extends Model
{
    // Spalten, die per create() befüllt werden dürfen (Schutz vor Mass Assignment).
    protected $fillable = ['type', 'started_at', 'distance_m'];
}
