<x-app-layout>
    <div>
        {{$videojuego->titulo}}
        {{$videojuego->desarrolladora->nombre}}
        {{$videojuego->desarrolladora->distribuidora->nombre}}
    </div>
</x-app-layout>
