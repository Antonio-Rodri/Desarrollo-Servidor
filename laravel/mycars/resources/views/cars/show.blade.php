<x-layouts::app :title="__('Detalles del coche')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        {{-- <div class="flex flex-col gap-4">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Matricula
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Marca
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Modelo
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Precio
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Fecha ultima revision
                            </th>
                            <th scope="col" class="px-6 py-3 w-80">
                                Foto
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                            <td class="px-6 py-4">
                                {{ $car->matricula }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $car->marca }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $car->modelo }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $car->precio }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $car->fecha_ultima_revision }}
                            </td>
                            <td class="px-6 py-4">
                                <img src="{{ asset($url . $car->foto) }}" alt="">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div> --}}



        <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <a href="#">
                <img class="rounded-t-lg" src="{{ asset($url . $car->foto) }}" alt="" />
            </a>
            <div class="p-5">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $car->modelo }}</h5>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $car->marca }}</p>
                <p>Precio: {{ $car->precio }}</p>
                <p>Fecha ultima revision: {{ $car->fecha_ultima_revision }}</p>
                <p>Color: {{ $car->color }}</p>
                <p>Año: {{ $car->year }}</p>
                <p>Matricula: {{ $car->matricula }}</p>
            </div>
        </div>

    </div>
    </div>
</x-layouts::app>
