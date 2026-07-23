<?php

namespace App\Listeners;

use App\Mail\SeriesCreated;
use App\Models\User;
use App\Events\SeriesCreated AS SeriesCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class EmailUsersAbountSeriesCreated
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
    public function handle(SeriesCreatedEvent $event): void
    {
        $userList = User::all(); 

        //Envia para cada usuário da lista
        foreach($userList as $index => $user){
            $email = new SeriesCreated(
                $event->seriesName,
                $event->seriesId,
                $event->seriesSeasonsQty,
                $event->seriesEpisodesPerSeason,
            );
            $when = now()->addSeconds($index * 3);
            //$when->modify($index * 2 .' seconds');
            Mail::to($user)->queue($when, $email);
        }
    }
}
