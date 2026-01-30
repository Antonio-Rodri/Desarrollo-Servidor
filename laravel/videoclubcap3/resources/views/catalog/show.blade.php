<x-layouts::app :title="__('Show')">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 text-gray-900">
                    <div class="grid grid-cols-2">
                        <div>
                            <img src="{{ $arrayPeliculas[$id]->poster }}" style="height:200px">
                        </div>
                        <div>
                            <p>{{ $arrayPeliculas[$id]->title }}</p>
                            <p>{{ $arrayPeliculas[$id]->year }}</p>
                            <p>{{ $arrayPeliculas[$id]->director }}</p>
                            <p>{{ $arrayPeliculas[$id]->synopsis }}</p>
                            <br>
                            <div>
                                @if ($arrayPeliculas[$id]->rented)
                                    <p><span class="font-bold">Estado:</span>Película actualmente alquilada</p><br>
                                    <div class="flex justify-around">
                                        <a href="{{ route('catalog') }}"
                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Devolver
                                            película</a>
                                    @else
                                        <p><span class="font-bold">Estado:</span>Película disponible</p></br>
                                        <div class="flex justify-around">
                                            <a href="{{ route('catalog') }}"
                                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Alquilar
                                                película</a>
                                @endif
                                <a href="{{ route('edit', ['id' => $id]) }}"
                                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Editar
                                    película</a>

                                <a href="{{ route('catalog') }}"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Volver
                                    al catálogo</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-layouts::app>
