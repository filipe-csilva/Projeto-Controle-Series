<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Series;
use App\Repositories\EloquentSeriesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

//use Illuminate\Support\Facades\DB;

class SeriesController extends Controller
{
    public function __construct(private EloquentSeriesRepository $repository)
    {
        
    }

    public function index(Request $request)
    {
        //$series = DB::select('SELECT nome FROM series;');
        //$series = Serie::query()->orderBy('nome')->get();
        $series = Series::all();
        //$series = Series::with(['season'])->get();

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

    //forma de receber repository, Laravel Identifica o repository
    // public function store(SeriesFormRequest $request, SeriesRepository $repository){

    //     $serie = $repository->add($request);

    //     return to_route('series.index')->with('mensagem.sucesso', "Série '{$serie->name}' adicionada com sucesso!");

    // }
    
    public function store(SeriesFormRequest $request){

        $serie = $this->repository->add($request);

        return to_route('series.index')->with('mensagem.sucesso', "Série '{$serie->name}' adicionada com sucesso!");

    }

    public function destroy(Series $series){
        //dd($request->id);
        //dd($request->route())

        //$serie = Serie::find($request->serie);


        //Serie::destroy($request->series);
        $series->delete();
        //$request->session()->put('mensagem.sucesso', 'Série removida com sucesso!');
        //$request->session()->flash('mensagem.sucesso', "Série '{$series->nome}' removida com sucesso!");

        return to_route('series.index')->with('mensagem.sucesso', "Série '{$series->name}' removida com sucesso!");
    }

    public function edit(Series $series){
        return view('series.edit')->with('serie', $series);
    }

    public function update(Series $series, SeriesFormRequest $request){
        //$series->nome = $request->nome;
        $series->fill($request->all());
        $series->save();

        return to_route('series.index')->with('mensagem.sucesso', "Série '{$series->name}' atualizada com sucesso!");
    }
}
