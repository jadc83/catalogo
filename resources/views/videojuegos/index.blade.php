<x-app-layout>
    <div class="container mx-auto mt-6 text-center">
        <!-- Mensajes de éxito y error -->
        @if (session('exito'))
            <div class="alert alert-success text-white mb-4 bg-green-700 p-3 rounded-lg">
                {{ session('exito') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger text-white bg-red-700 mb-4 p-3 rounded-lg">
                {{ session('error') }}
            </div>
        @endif
    </div>

    <!-- Contenedor principal con separación entre columnas -->
    <div class="flex justify-between mx-8 mt-4 space-x-8">
        <div class="flex flex-col bg-gray-100 shadow-xl rounded-xl w-9/12 p-6">
            <h2 class="text-xl font-bold mb-4">Videojuegos en tu posesión</h2>
            @foreach ($videojuegos_en_posesion as $posesion)
                <div class="flex justify-between items-center p-4 border-b border-gray-300">
                    <div class="flex-grow">
                        <h3 class="font-semibold text-lg">{{ $posesion->titulo }}</h3>
                        <p class="text-sm">Desarrollado por: {{ $posesion->desarrolladora->nombre }}</p>
                        <p class="text-sm">Distribuido por: {{ $posesion->desarrolladora->distribuidora->nombre }}</p>
                    </div>
                    <div class="flex space-x-3">
                        <form action="{{ route('videojuegos.show', $posesion) }}" method="get">
                            <x-primary-button>Detalles</x-primary-button>
                        </form>
                        <form action="{{ route('videojuegos.edit', $posesion) }}" method="get">
                            <x-primary-button>Editar</x-primary-button>
                        </form>
                        <form action="{{ route('videojuegos.destroy', $posesion) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este videojuego?');">
                            @csrf
                            @method('DELETE')
                            <x-primary-button>Borrar</x-primary-button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
        <aside class="w-3/12 bg-gray-500 shadow-xl rounded-xl p-6">
            <h2 class="text-xl font-bold text-white mb-4">Videojuegos disponibles</h2>
            @foreach ($videojuegos as $videojuego)
                <div class="mb-6">
                    <h3 class="font-semibold text-white">{{ $videojuego->titulo }}</h3>
                    <div class="flex space-x-4 mt-2">
                        <form action="{{ route('lotengo', $videojuego) }}" method="post">
                            @csrf
                            <x-primary-button>Lo tengo</x-primary-button>
                        </form>
                        <form action="{{ route('nolotengo', $videojuego) }}" method="post">
                            @csrf
                            <x-primary-button>No lo tengo</x-primary-button>
                        </form>
                    </div>
                </div>
            @endforeach
            <div class="mt-6 text-center">
                <form action="{{ route('videojuegos.create') }}" method="get">
                    <x-primary-button>Nuevo videojuego</x-primary-button>
                </form>
            </div>
        </aside>
    </div>


</x-app-layout>
