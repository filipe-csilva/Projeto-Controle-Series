<?php

namespace App\Http\Controllers;

use App\Events\SeriesCreated AS SeriesCreatedEvent;
use App\Http\Requests\SeriesFormRequest;
use App\Mail\SeriesCreated;
use App\Models\Series;
use App\Models\User;
use App\Repositories\Interfaces\ISeriesRepository;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

//use Illuminate\Support\Facades\DB;

class SeriesController extends Controller
{
    public function __construct(private ISeriesRepository $repository)
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
        if($request->hasFile('cover')){

            $file = $request->file('cover');

            // Validação customizada
            $validator = Validator::make(
                ['cover' => $file],
                ['cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048']
            );

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            // Salva a imagem
            $coverPath = $file->store('series_cover', 'public');
            // Ou $path = $file->storeAs('series', $file->getClientOriginalName());

            $request->coverPath = $coverPath;
        }

        $serie = $this->repository->add($request);

        $serie->seasonsQty = $request->seasonsQty;
        $serie->episodesPerSeason = $request->episodesPerSeason;

        $seriesCreatedEvent = new SeriesCreatedEvent(
            $serie->name,
            $serie->id,
            $serie->seasonsQty,
            $serie->episodesPerSeason,
        );
        //SeriesCreatedEvent::dispatch(); //gera o evento

        event($seriesCreatedEvent);

        // $userList = User::all(); 

        // //Envia para cada usuário da lista
        // foreach($userList as $index => $user){
        //     $email = new SeriesCreated(
        //         $serie->name,
        //         $serie->id,
        //         $request->seasonsQty,
        //         $request->episodesPerSeason,
        //     );
        //     $when = now()->addSeconds($index * 3);
        //     //$when->modify($index * 2 .' seconds');
        //     Mail::to($user)->queue($when, $email);
        // }

        //Envia para o usuário conectado
        // $email = new SeriesCreated(
        //     $serie->name,
        //     $serie->id,
        //     $request->seasonsQty,
        //     $request->episodesPerSeason,
        // );
        //Mail::to($request->user())->send($email);

        return to_route('series.index')->with('mensagem.sucesso', "Série '{$serie->name}' adicionada com sucesso!");

    }

    public function destroy(Series $series){
        //dd($request->id);
        //dd($request->route())

        //$serie = Serie::find($request->serie);

        if ($series->cover && Storage::disk('public')->exists($series->cover) && $series->cover != 'series_cover/default.jpg') {
            Storage::disk('public')->delete($series->cover);
        }

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
