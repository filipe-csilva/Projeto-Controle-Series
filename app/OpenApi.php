<?php

namespace App;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: '1.0.0',
    title: 'Sistema de Séries API',
    description: 'Documentação da API'
)]

// #[OA\Server(
//     url: 'http://localhost:8080',
//     description: 'Servidor Local'
// )]

#[OA\Tag(
    name: 'Teste',
    description: 'Endpoints de teste'
)]

#[OA\Tag(
    name: 'Series',
    description: 'Series Endpoints'
)]

class OpenApi
{
}