<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\SeriesRepository;
use App\Models\Series;
use OpenApi\Attributes as OA;

class SeasonsController extends Controller
{
    public function __construct(private SeriesRepository $serieRepository) {
        
    }
    public function show(int $series)
    {
        $seriesModel = Series::with('seasons')->find($series);
        if($seriesModel === null){return response()->json(['message' => 'Series not found'], 404);}
        return $seriesModel->seasons;
    }
}
