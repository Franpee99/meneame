<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoticiaRequest;
use App\Http\Requests\UpdateNoticiaRequest;
use App\Models\Categoria;
use App\Models\Noticia;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class NoticiaController extends Controller implements HasMiddleware
{

    public static function middleware() // Para implementar que debe estar logeado
    {
        return [
            new Middleware('auth', only: ['create', 'store']), // Para que te rediriga a iniciar sesion
        ];
    }

    public function index(){
        return redirect()->route('home');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('noticias.create', [
        'categorias' => Categoria::orderBy('nombre')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNoticiaRequest $request)
    {
        //En vez de poner aqui la validacion, se pone en el StoreNoticiaRequest

        $noticia = new Noticia($request->input());
        $noticia->user_id = Auth::id();
        $noticia->save();
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     */
    public function show(Noticia $noticia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Noticia $noticia)
    {
        Gate::authorize('update', $noticia); //En el NoticiaPolicy ponemos quien quien puede editarlo (autorizacion)

        return view('noticias.edit', [
            'noticia' => $noticia,
            'categorias' => Categoria::orderBy('nombre')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNoticiaRequest $request, Noticia $noticia)
    {
        //En vez de poner aqui la validacion, se pone en el UpdateNoticiaRequest

        Gate::authorize('update', $noticia); //Lo ponemos otra vez por seguridad

        $noticia->fill($request->input());
        $noticia->save();
        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Noticia $noticia)
    {
        //
    }
}
