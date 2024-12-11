<?php

namespace App\Http\Controllers;

use App\Models\Desarrolladora;
use App\Models\Videojuego;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideojuegoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuario = Auth::user();  // Obtener el usuario autenticado
        $videojuegos_en_posesion = $usuario->videojuegos;
        $videojuegos = Videojuego::with('desarrolladora')->get();

        return view('videojuegos.index', ['videojuegos' => $videojuegos, 'videojuegos_en_posesion' => $videojuegos_en_posesion]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $desarrolladoras = Desarrolladora::with('distribuidora')->get();
        return view('videojuegos.create', [ 'desarrolladoras' => $desarrolladoras ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'desarrolladora_id' => 'required|integer|exists:desarrolladoras,id',
            'titulo' => 'required|string|max:255',
        ], [
            'desarrolladora_id' => 'El usuario no existe',
            'titulo.required' => 'El titulo es obligatorio.',
            'titulo.max' => 'El titulo no puede tener más de 255 caracteres.',
        ]);

        $videojuego = New Videojuego();
        $videojuego->desarrolladora_id = $validated['desarrolladora_id'];
        $videojuego->titulo = $validated['titulo'];

        $videojuego->save();

        return redirect()->route('videojuegos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Videojuego $videojuego)
    {
        return view('videojuegos.show', ['videojuego' => $videojuego]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Videojuego $videojuego)
    {
        $desarrolladoras = Desarrolladora::with('distribuidora')->get();
        return view('videojuegos.edit', ['videojuego' => $videojuego, 'desarrolladoras' => $desarrolladoras]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Videojuego $videojuego)
    {
        $validated = $request->validate([
            'desarrolladora_id' => 'required|integer|exists:desarrolladoras,id',
            'titulo' => 'required|string|max:255',
        ], [
            'desarrolladora_id' => 'El usuario no existe',
            'titulo.required' => 'El titulo es obligatorio.',
            'titulo.max' => 'El titulo no puede tener más de 255 caracteres.',
        ]);

        $videojuego->desarrolladora_id = $validated['desarrolladora_id'];
        $videojuego->titulo = $validated['titulo'];

        $videojuego->save();

        return redirect()->route('videojuegos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Videojuego $videojuego)
    {
        $usuario = Auth::user();
        $usuario->videojuegos()->detach($videojuego);
        $videojuego->delete();
        return redirect()->route('videojuegos.index');
    }
}
