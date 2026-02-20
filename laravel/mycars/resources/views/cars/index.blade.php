<x-layouts::app :title="__('Todos los coches')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        @if (session('msg'))
            <div class="alert alert-success">
                {{ session('msg') }}
            </div>
        @endif
        <div class="flex flex-col gap-4">


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
                            <th scope="col" class="px-6 py-3">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cars as $car)
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
                                    <img src="{{ asset('storage/imgcars/' . $car->foto) }}" alt="">
                                </td>
                                <td class="px-6 py-4">
                                    <flux:button variant="primary" color="blue"
                                        href="{{ route('cars.show', ['car' => $car->id]) }}">Detalles</flux:button>
                                    <flux:button variant="primary" color="green"
                                        href="{{ route('cars.edit', ['car' => $car->id]) }}">Editar</flux:button>
                                    <form action="{{ route('cars.destroy', ['car' => $car->id]) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <flux:button variant="primary" color="red" type="submit" class="cursor-pointer">Eliminar
                                        </flux:button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        {{ $cars->links() }}

        <livewire:car.carlist :nombre="Auth::user()->name"/>
    </div>
</x-layouts::app>
