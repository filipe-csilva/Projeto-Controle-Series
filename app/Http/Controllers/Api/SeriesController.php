<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class SeriesController extends Controller
{
    public function __construct(private SerieRepository $serieRepository) {
        
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
    
    public function index()
    {
        return Series::all();        
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

    public function show(Series $series)
    {
        return response()->json($series);
    }

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

    public function store(SeriesFormRequest $request){
        return response()->json(Series::create($request->all()), 201);
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
                ),
                new OA\Property(
                    property: 'seasonsQty',
                    type: 'integer',
                    example: 0
                )
            ]
        )
    )]

    #[OA\Response(
        response: 200,
        description: 'Séries atualizada com sucesso'
    )]

    public function update(Series $series, SeriesFormRequest $request){
        //$series->nome = $request->nome;
        $series->fill($request->all());
        $series->save();

        return to_route('series.index')->with('mensagem.sucesso', "Série '{$series->name}' atualizada com sucesso!");
    }
}
