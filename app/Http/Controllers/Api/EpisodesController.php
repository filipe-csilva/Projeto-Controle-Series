<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Episode;
use App\Repositories\SeriesRepository;
use App\Models\Series;
use OpenApi\Attributes as OA;
use Illuminate\Http\Request;

class EpisodesController extends Controller
{
    public function __construct(private SeriesRepository $serieRepository) {
        
    }
    public function show(int $series)
    {
        $seriesModel = Series::with('episodes')->find($series);
        if($seriesModel === null){return response()->json(['message' => 'Series not found'], 404);}
        return $seriesModel->episodes;
    }

    public function update(int $episode, Request $request)
    {
        $episodeModel = Episode::find($episode);
        if ($episodeModel === null) {return response()->json(['message' => 'Episódio não encontrado'], 404);}
        $episodeModel->watched = $request->boolean('watched');
        $episodeModel->save();
        return response()->json($episodeModel);
    }
}
