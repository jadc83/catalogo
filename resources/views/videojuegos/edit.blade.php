<x-app-layout>
    <div class="flex justify-center items-start mt-16">
        <form action="{{ route('videojuegos.update', $videojuego) }}" method="POST" class="bg-gray-100 p-8 rounded-lg shadow-lg w-1/3">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <x-input-label for="titulo">Título</x-input-label>
                <x-text-input name="titulo" id="titulo" value="{{ old('titulo', $videojuego->titulo) }}" class="w-full" />
            </div>

            <div class="mb-4">
                <x-input-label for="desarrolladora_id">Desarrolladora</x-input-label>
                <select name="desarrolladora_id" id="desarrolladora_id" class="w-full p-2 rounded-md border">
                    @foreach ($desarrolladoras as $desarrolladora)
                        <option value="{{ $desarrolladora->id }}"
                            {{ old('desarrolladora_id', $videojuego->desarrolladora_id) == $desarrolladora->id ? 'selected' : '' }}>
                            {{ $desarrolladora->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mt-4 text-center justify-center ">
                <x-primary-button>Actualizar videojuego</x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
