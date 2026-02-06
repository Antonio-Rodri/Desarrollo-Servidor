<x-layouts::app :title="__('Dashboard')">

    <h1>Profesor</h1>
    <p>Nombre: {{ $user->name }}</p>
    <p>Email: {{ $user->email }}</p>
    <p>Alumnos:</p>
    <ul>
        @foreach ($estudiantes as $estudiante)
            <li>{{ $estudiante->name }}</li>
            <li>{{ $estudiante->apellidos }}</li>
            <li>{{ $estudiante->email }}</li>
            <li>{{ $estudiante->pivot->nota }}</li>
            <li>{{ $estudiante->pivot->asignatura }}</li>
            <hr>
        @endforeach
    </ul>
    {{ $estudiantes->links() }}

</x-layouts::app>
