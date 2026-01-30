<x-layouts::app :title="__('Create')">
    <x-layouts::auth>
        <div class="flex flex-col gap-6">
            <form method="POST" action="{{ route('catalog') }}" class="flex flex-col gap-6">
                @csrf
                <flux:input name="titulo" :label="__('Título')" type="text" required autofocus autocomplete="titulo"
                    :placeholder="__('Título de la película')" />

                <flux:input name="anio" :label="__('Año')" type="text" required autocomplete="anio"
                    placeholder="Año de estreno" />

                <flux:input name="director" :label="__('Director')" type="text" required autocomplete="director"
                    :placeholder="__('Director')" />

                <flux:input name="poster" :label="__('Poster')" type="text" required autocomplete="poster"
                    :placeholder="__('Poster de la película')" />

                <flux:input name="synopsis" :label="__('Resumen')" type="textarea" required autocomplete="synopsis"
                    :placeholder="__('Sinopsis de la película')" />

                <div class="flex items-center justify-end">
                    <flux:button type="submit" variant="primary" class="w-full">
                        {{ __('Añadir película') }}
                    </flux:button>
                </div>
            </form>
        </div>
    </x-layouts::auth>
</x-layouts::app>
