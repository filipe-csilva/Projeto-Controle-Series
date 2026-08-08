<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes\Get;
use OpenApi\Attributes\Response;
use OpenApi\Attributes as OA;

class SwaggerTestController extends Controller
{
    #[OA\Get(
        path: '/api/',
        operationId: 'testApi',
        summary: 'Endpoint de teste',
        tags: ['Teste']
    )]
    #[OA\Response(
        response: 200,
        description: 'Sucesso'
    )]
    
    public function index(): JsonResponse
    {
        return response()->json([
            'message' => 'Swagger funcionando!'
        ]);
    }
}