<x-layouts::app :title="__('Edit')">
    <x-layouts::auth>
        <div class="flex flex-col gap-6">
            <form method="POST" action="{{ route('edit', ['id' => $Pelicula->id]) }}" class="flex flex-col gap-6">
                @csrf
                @method('PUT')
                <flux:input name="titulo" :label="__('Título')" :value="old('titulo', $Pelicula->title)" type="text"
                    required autofocus autocomplete="titulo" :placeholder="__('Título de la película')" />

                <flux:input name="anio" :label="__('Año')" :value="old('year', $Pelicula->year)" type="text"
                    required autocomplete="anio" placeholder="Año de estreno" />

                <flux:input name="director" :label="__('Director')" :value="old('director', $Pelicula->director)"
                    type="text" required autocomplete="director" :placeholder="__('Director')" />

                <flux:input name="poster" :label="__('Poster')" :value="old('poster', $Pelicula->poster)"
                    type="text" required autocomplete="poster" :placeholder="__('Poster de la película')" />

                <flux:textarea name="synopsis" :label="__('Resumen')" required autocomplete="synopsis"
                    :placeholder="__('Sinopsis de la película')">
                    {{ old('synopsis', $Pelicula->synopsis) }}
                </flux:textarea>

                <div class="flex items-center justify-end">
                    <flux:button type="submit" variant="primary" class="w-full">
                        {{ __('Modificar película') }}
                    </flux:button>
                </div>
            </form>
        </div>
    </x-layouts::auth>
</x-layouts::app>
