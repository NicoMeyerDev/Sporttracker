<?php

namespace App\Console\Commands;

use App\Models\Activity;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('import:tcx {datei} {sport} {type}')]
#[Description('Liest eine Garmin-TCX-Datei ein und speichert die Einheit')]
class ImportTcx extends Command
{
    public function handle()
    {
        // Datei einlesen (Pfad relativ zum Projektordner, z. B. daten/datei.tcx)
        $xml = simplexml_load_file(base_path($this->argument('datei')));

        if ($xml === false) {
            $this->error('Datei konnte nicht gelesen werden.');
            return self::FAILURE;
        }

        // Garmin-Namensraum registrieren, sonst findet xpath nichts
        $xml->registerXPathNamespace('t', 'http://www.garmin.com/xmlschemas/TrainingCenterDatabase/v2');

        // Werte aus der Zusammenfassung (Lap) der Einheit lesen
        $beginn   = \Carbon\Carbon::parse((string) $xml->xpath('//t:Lap')[0]['StartTime'])->format('Y-m-d H:i:s');
        $distanz  = (int) round((float) $xml->xpath('//t:Lap/t:DistanceMeters')[0]);
        $dauer    = (int) round((float) $xml->xpath('//t:Lap/t:TotalTimeSeconds')[0]);
        $maxSpeed = (float) $xml->xpath('//t:Lap/t:MaximumSpeed')[0];
        $kalorien = (int) $xml->xpath('//t:Lap/t:Calories')[0];
        $avgHr    = (int) $xml->xpath('//t:Lap/t:AverageHeartRateBpm/t:Value')[0];
        $maxHr    = (int) $xml->xpath('//t:Lap/t:MaximumHeartRateBpm/t:Value')[0];

        // Einheit in der Datenbank speichern
        Activity::updateOrCreate(
        ['started_at' => $beginn, 'sport' => $this->argument('sport')],
        [
            'sport'        => $this->argument('sport'),
            'type'         => $this->argument('type'),
            'started_at'   => $beginn,
            'distance_m'   => $distanz,
            'duration_s'   => $dauer,
            'max_speed_ms' => $maxSpeed,
            'calories'     => $kalorien,
            'avg_hr'       => $avgHr,
            'max_hr'       => $maxHr,
        ]);

        $this->info('Einheit gespeichert.');
    }
}