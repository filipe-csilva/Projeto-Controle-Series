<?php

namespace App\Providers;

use App\Repositories\EloquentSeriesRepository;
use App\Repositories\Interfaces\ISeriesRepository;
use Illuminate\Support\ServiceProvider;

class SeriesRepositoryProvider extends ServiceProvider
{
    public array $bindings = [
        ISeriesRepository::class => EloquentSeriesRepository::class
    ];
}
