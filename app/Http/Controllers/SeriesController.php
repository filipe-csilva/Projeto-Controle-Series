<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Serie;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        //$series = DB::select('SELECT nome FROM series;');
        $series = Serie::query()->orderBy('nome')->get();

        //$mensagemSucesso = $request->session()->get('mensagem.sucesso');
        $mensagemSucesso = session('mensagem.sucesso');
        //$request->session()->get('mensagem.sucesso');

        //return view('listar-series', ['series' => $series]);
        //return view('listar-series')->with('series', $series)->with('mensagemSucesso', $mensagemSucesso);
        return view('series.index', compact('series', 'mensagemSucesso'));
    }

    public function create(){
        return view('series.create');
    }

    public function store(SeriesFormRequest $request){

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
        $serie = Serie::create($request->all());

        //Traz todas as informações excerto o token
        //Serie::create($request->except(['_token']));

        //Traz determinadas informações
        //Serie::create($request->only(['nome']));

        //$request->session()->flash('mensagem.sucesso', "Série '{$serie->nome}' adicionada com sucesso!");
        
        return to_route('series.index')->with('mensagem.sucesso', "Série '{$serie->nome}' adicionada com sucesso!");
    }

    public function destroy(Serie $series){
        //dd($request->id);
        //dd($request->route())

        //$serie = Serie::find($request->serie);


        //Serie::destroy($request->series);
        $series->delete();
        //$request->session()->put('mensagem.sucesso', 'Série removida com sucesso!');
        //$request->session()->flash('mensagem.sucesso', "Série '{$series->nome}' removida com sucesso!");

        return to_route('series.index')->with('mensagem.sucesso', "Série '{$series->nome}' removida com sucesso!");
    }

    public function edit(Serie $series){
        return view('series.edit')->with('serie', $series);
    }

    public function update(Serie $series, SeriesFormRequest $request){
        //$series->nome = $request->nome;
        $series->fill($request->all());
        $series->save();

        return to_route('series.index')->with('mensagem.sucesso', "Série '{$series->nome}' atualizada com sucesso!");
    }
}
