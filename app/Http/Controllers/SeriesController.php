<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB;

class SeriesController extends Controller
{
    public function index()
    {
        //$series = DB::select('SELECT nome FROM series;');
        $series = Serie::query()->orderBy('nome')->get();

        //return view('listar-series', ['series' => $series]);
        //return view('listar-series', -> with('series', $series));
        return view('series.index', compact('series'));
    }

    public function create(){
        return view('series.create');
    }

    public function store(Request $request){
        //$nomeSerie = $request->input('nome');
        //$nomeSerie = $request->nome;

        //DB::insert('INSERT INTO series (nome) VALUES (?);', [$nomeSerie]);

        // $serie = new Serie();
        // $serie->nome = $nomeSerie;
        // $serie->save();

        //mass assignment
        //Traz todas as informações da request e insere no banco
        Serie::create($request->all());

        //Traz todas as informações excerto o token
        //Serie::create($request->except(['_token']));

        //Traz determinadas informações
        //Serie::create($request->only(['nome']));
        
        return redirect('series.index');
    }
}
