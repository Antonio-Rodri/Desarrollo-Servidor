<x-layouts::app :title="__('Index')">
    <div class="grid grid-cols-4">
        @foreach ($arrayPeliculas as $key => $pelicula)
            <a href="{{ route('show', ['id' => $key]) }}">
                <img src="{{ $pelicula['poster'] }}" style="height:200px">
                <p class="text-blue-600">{{ $pelicula['title'] }}</p>
            </a>
        @endforeach
    </div>
</x-layouts::app>
