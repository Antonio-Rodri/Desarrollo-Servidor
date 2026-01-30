<h1 class="text-2xl font-bold">Lista de frutas</h1>

<ul>
    @foreach ($frutas as $fruta)
        <li>{{ $fruta }}</li>
    @endforeach
</ul>
<br>
<br>

<a href="{{ route('frutas.naranjas') }}">Naranjas</a><br><br>
<a href="{{ route('frutas.peras') }}">Pera</a>


<form action="" method="POST">
    @csrf
    {{-- @put
    @delete --}}
    Nombre fruta: <input type="text" name="fruta" value="{{ old('fruta') }}"><br>
    Descripcion:<br>
    <textarea name="descripcion" cols="30" rows="10">{{ old('descripcion') }}</textarea><br>
    Pais: <input type="checkbox" name="pais" value="francia" {{ old('pais') == 'francia' ? 'checked' : '' }}>Francia
    <input type="checkbox" name="pais" value="España" {{ old('pais') == 'España' ? 'checked' : '' }}> España
    <input type="checkbox" name="pais" value="Alemania" {{ old('pais') == 'Alemania' ? 'checked' : '' }}>Alemania<br>
    <input type="submit" name="enciar" value="Enviar">
</form>
<br>
<br>

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif


@session('mensaje')
    <p>{{ session('mensaje') }}</p>
@endsession

{{-- @if (session('mensaje'))
    <p>{{ session('mensaje') }}</p>
@endif --}}
