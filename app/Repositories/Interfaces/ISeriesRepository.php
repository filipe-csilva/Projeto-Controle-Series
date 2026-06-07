<?php

namespace App\Repositories\Interfaces;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;

interface ISeriesRepository
{
    public function add(SeriesFormRequest $request): Series;
}
