<?php

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

new class extends Component {
    use WithPagination;
    use WithoutUrlPagination;
    public $nombre;
    public $buscador;
    public $campoOrden = 'id';
    public $direccionOrden = 'asc';
    public function mount($nombre)
    {
        $this->nombre = $nombre;
    }

    #[On('insertCar')]
    public function render()
    {
        $user = Auth::user();
        $mycars = $user
            ->cars()
            ->where('marca', 'like', '%' . $this->buscador . '%')
            ->orWhere('modelo', 'like', '%' . $this->buscador . '%')
            ->orderBy($this->campoOrden, $this->direccionOrden)
            ->paginate(2);
        return $this->view(['mycars' => $mycars]);
    }

    public function ordenar($campo)
    {
        if ($this->campoOrden == $campo) {
            $this->direccionOrden = $this->direccionOrden == 'asc' ? 'desc' : 'asc';
        } else {
            $this->campoOrden = $campo;
            $this->direccionOrden = 'asc';
        }
    }

    public function updatingBuscador()
    {
        $this->resetPage();
    }
};
?>

<div>
    <h1 class="text-2xl font-bold"> Los coches de {{ $nombre }}</h1>

    <div class="px-6 py-3 flex justify-end">
        Buscador: <input class="text-gray-800" type="text" name="buscador" id="buscador" placeholder="Buscar coche"
            wire:model.live="buscador">
        <br>
        {{ $buscador }}
    </div>
    <div class="flex">
        <livewire:car.carcreate></livewire:car.carcreate>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('id')">
                        @if ($campoOrden == 'id')
                            {{ $direccionOrden == 'asc' ? '▲' : '▼' }}
                        @endif
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('matricula')">
                        @if ($campoOrden == 'matricula')
                            {{ $direccionOrden == 'asc' ? '▲' : '▼' }}
                        @endif
                        Matricula
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('marca')">
                        @if ($campoOrden == 'marca')
                            {{ $direccionOrden == 'asc' ? '▲' : '▼' }}
                        @endif
                        Marca
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('modelo')">
                        @if ($campoOrden == 'modelo')
                            {{ $direccionOrden == 'asc' ? '▲' : '▼' }}
                        @endif
                        Modelo
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('year')">
                        @if ($campoOrden == 'year')
                            {{ $direccionOrden == 'asc' ? '▲' : '▼' }}
                        @endif
                        Año
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('fecha_ultima_revision')">
                        @if ($campoOrden == 'fecha_ultima_revision')
                            {{ $direccionOrden == 'asc' ? '▲' : '▼' }}
                        @endif
                        Fecha ultima revision
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('precio')">
                        Precio
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Foto
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mycars as $car)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $car->id }}
                        </th>
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
                            {{ $car->year }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $car->fecha_ultima_revision }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $car->precio }}
                        </td>
                        <td class="px-6 py-4">
                            <img class="w-60 h-50" src="{{ asset('storage/imgcars/' . $car->foto) }}" alt="">
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="#"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $mycars->links() }}
</div>
