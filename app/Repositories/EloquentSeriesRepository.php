<?php

namespace App\Repositories;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Series;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EloquentSeriesRepository implements SeriesRepository
{
    public function Add(SeriesFormRequest $request):Series
    {
        //DB::beginTransaction();
        return DB::transaction(function() use ($request){

        
            //Criado uma request
            // $request->validate([
            //     'nome' => ['required', 'min:3']
            //     ]);

            //$nomeSerie = $request->input('nome');
            //$nomeSerie = $request->nome;

            //DB::insert('INSERT INTO series (nome) VALUES (?);', [$nomeSerie]);

            // $serie = new Serie();
            // $serie->nome = $nomeSerie;
            // $serie->save();

            //mass assignment
            //Traz todas as informações da request e insere no banco
            //$serie = Series::create($request->all());
            // $serie = Series::create([
            //     'name' => $request->name,
            //     'cover' => $request->coverPath
            // ]);

            $data = [
                'name' => $request->name,
            ];

             // Só adiciona o cover se ele existir
            if (isset($request->coverPath) && $request->coverPath) {
                $data['cover'] = $request->coverPath;
            } else {
                // Se não tiver imagem, define um valor padrão ou null
                $data['cover'] = 'series_cover/default.jpg'; // ou 'default.png'
            }

            $serie = Series::create($data);


            //Traz todas as informações excerto o token
            //Serie::create($request->except(['_token']));

            //Traz determinadas informações
            //Serie::create($request->only(['nome']));

            //$request->session()->flash('mensagem.sucesso', "Série '{$serie->nome}' adicionada com sucesso!");

            // for($i = 1; $i <= $request->seasonsQty; $i++){
            //     $season = $serie->seasons()->create([
            //         'number' => $i,
            //     ]);
            //     for($j = 1; $i <= $request->episodesPerSeason; $i++){
            //         $season->episodes()->create([
            //             'number' => $j
            //         ]);
            //     }
            // }

            $seasons = [];

            for($i = 1; $i <= $request->seasonsQty; $i++){
                $seasons[] = [
                    'series_id' => $serie->id,
                    'number' => $i,
                ];
                
                Season::insert($seasons);

                $episodes = [];
                foreach($serie->seasons as $season){
                    for($j = 1; $i <= $request->episodesPerSeason; $i++){
                        $episodes[] = [
                            'season_id' => $season->id,
                            'number' => $j
                        ];
                    }
                }
                Episode::insert($episodes);
            }
            
            return $serie;

        });
    }
}
