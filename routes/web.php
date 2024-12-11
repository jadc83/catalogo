<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VideojuegoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('videojuegos', VideojuegoController::class);
});

Route::post('lotengo/{id}', function ($id) {

    $consulta = DB::table('usuario_videojuego')
        ->select('user_id', 'videojuego_id')
        ->where('user_id', Auth::id())
        ->where('videojuego_id', $id)
        ->get();

    if ($consulta->isEmpty()) {
        DB::table('usuario_videojuego')->insert([
            'user_id' => Auth::id(),
            'videojuego_id' => $id,
        ]);

        session()->flash('exito', 'Videojuego añadido correctamente');
    } else {
        session()->flash('error', 'Ya posees una copia del título');
    }
    return redirect()->route('videojuegos.index');
})->name('lotengo');

Route::post('nolotengo/{id}', function ($id) {

    $usuario = Auth::user();
    $usuario->videojuegos()->detach($id);
    session()->flash('exito', 'Videojuego borrado correctamente');
    return redirect()->route('videojuegos.index');
})->name('nolotengo');

require __DIR__.'/auth.php';
