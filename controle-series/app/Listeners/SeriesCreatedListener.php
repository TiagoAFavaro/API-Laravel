<?php

namespace App\Listeners;

use App\Events\SeriesCreated;
use App\Models\Season;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SeriesCreatedListener
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\SeriesCreated  $event
     * @return void
     */
    public function handle(SeriesCreated $event)
    {
        $series = $event->seriesId;

        // Lógica para criar as temporadas e episódios associados à série
        for ($i = 1; $i <= $event->seriesSeasonsQty; $i++) {
            $season = Season::create([
                'number' => $i,
                'series_id' => $series,
            ]);

            // Lógica para criar os episódios para cada temporada
            for ($j = 1; $j <= $event->seriesEpisodesPerSeason; $j++) {
                $season->episodes()->create([
                    'number' => $j,
                    // Se houver outros campos necessários para os episódios, você pode passá-los aqui
                ]);
            }
        }
    }
}
