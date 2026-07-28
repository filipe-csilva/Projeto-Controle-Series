<?php

namespace App\Listeners;

use App\Events\SerieCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogSeriesCreated implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SerieCreated $event): void
    {
        Log::info("Série {$event->seriesName} criada com sucesso!");
    }
}
