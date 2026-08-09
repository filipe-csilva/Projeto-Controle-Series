<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeriesFormRequest;
use App\Http\Requests\UpdateSeriesFormRequest;
use App\Repositories\SeriesRepository;
use App\Models\Series;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class SeriesController extends Controller
{
    public function __construct(private SeriesRepository $serieRepository) {
        
    }

    #[OA\Get(
        path: '/api/v1/series',
        operationId: 'listSeries',
        summary: 'List Series',
        tags: ['Series']
    )]

    #[OA\Response(
        response: 200,
        description: 'Lista de séries retornada com sucesso'
    )]

    #[OA\Response(
        response: 404,
        description: 'Falha na solicitação'
    )]
    
    public function index(Request $request)
    {
        // if(!$request->has('name')){
        //     $listSeries = Series::all();
        //     if($listSeries === null){return response()->json(['message' => 'Series not found'], 404);}
        //     return $listSeries;
        // }
        
        // return Series::whereName($request->name)->get();

        $query = Series::query();
        if($request->has('name')){
            $query->where('name', $request->name);
        }
        return $query->paginate();
    }

    #[OA\Parameter(
        name: 'id',
        in: 'path',
        required: true,
        description: 'ID da série',
        schema: new OA\Schema(type: 'integer')
    )]

    #[OA\Response(
        response: 200,
        description: 'Série encontrada'
    )]

    #[OA\Response(
        response: 404,
        description: 'Série não encontrada'
    )]

    public function show(int $series)
    {
        $seriesModel = Series::with('seasons.episodes')->find($series);
        if($seriesModel === null){return response()->json(['message' => 'Series not found'], 404);}
        return $seriesModel;
    }
    // public function show(int $series)
    // {
    //     $response = Series::whereId($series)->with('seasons.episodes')->first();
    //     return $response;
    // }

    #[OA\Post(
        path: '/api/v1/series',
        operationId: 'CreateSerie',
        summary: 'Create serie',
        tags: ['Series']
    )]

    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            required: ['name'],
            properties: [
                new OA\Property(
                    property: 'name',
                    type: 'string',
                    example: 'Serie Name'
                ),
                new OA\Property(
                    property: 'seasonsQty',
                    type: 'int',
                    example: 1
                ),
                new OA\Property(
                    property: 'episodesPerSeason',
                    type: 'int',
                    example: 1
                )
            ]
        )
    )]

    #[OA\Response(
        response: 201,
        description: 'Série criada'
    )]

    // Antes da criação do repository
    // public function store(SeriesFormRequest $request){
    //     return response()->json(Series::create($request->all()), 201);
    // }

    public function store(SeriesFormRequest $request){
        return response()->json($this->serieRepository->add($request), 201);
    }

    #[OA\Put(
        path: '/api/v1/series',
        operationId: 'UpdateSerie',
        summary: 'Update série',
        tags: ['Series']
    )]

    #[OA\Parameter(
        name: 'id',
        in: 'path',
        required: true,
        description: 'ID da série'
    )]

    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            required: ['name'],
            properties: [
                new OA\Property(
                    property: 'name',
                    type: 'string',
                    example: 'Serie Name'
                )
            ]
        )
    )]

    #[OA\Response(
        response: 200,
        description: 'Séries atualizada com sucesso'
    )]

    public function update(Series $series, UpdateSeriesFormRequest $request){
        //$series->nome = $request->nome;
        $series->fill($request->all());
        $series->save();

        return $series;
    }

    #[OA\Parameter(
        name: 'id',
        in: 'path',
        required: true,
        description: 'ID da série',
        schema: new OA\Schema(type: 'integer')
    )]

    #[OA\Response(
        response: 200,
        description: 'Série Deletada'
    )]

    #[OA\Response(
        response: 404,
        description: 'Série não encontrada'
    )]


    public function destroy(int $series)
    {
        Series::destroy($series);
        return response()->noContent();
    }
}
