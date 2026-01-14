@include('cabecera')
    <p>Hola soy {{ $nom }} y tengo {{ $ed }} años</p>
    @if ($ed >= 18)
        <p>Es mayor de edad</p>
    @else
        <p>Es menor de edad</p>
    @endif

    @foreach ($frutas as $fruta) {{-- comentarios --}}
        {{ $fruta }}<br>
    @endforeach