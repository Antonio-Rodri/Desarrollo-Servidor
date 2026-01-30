<ul>
    @foreach ($frutas as $fruta)
        <li>{{ $fruta->nombre }}</li>
        {{ $fruta->color }}<br>
        {{ $fruta->precio }}<br>
        {{ $fruta->pais_origen }}<br><br>
    @endforeach
</ul>
