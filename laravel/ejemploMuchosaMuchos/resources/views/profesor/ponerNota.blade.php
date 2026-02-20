<x-layouts::app :title="__('Dashboard')">

    <form action="{{ route('user.putNota') }}" method="POST" class="flex flex-col gap-6">
        @csrf
        <flux:select name="estudiante_id" :label="__('Alumno')" placeholder="Elige alumno...">
            @foreach ($estudiantes as $estudiante)
                <flux:select.option value="{{ $estudiante->id }}">
                    {{ $estudiante->name . ' ' . $estudiante->apellidos }}</flux:select.option>
            @endforeach
        </flux:select>
        <flux:input name="asignatura" :label="__('Asignatura')" :value="old('asignatura')" type="text" required
            autofocus autocomplete="asignatura" :placeholder="__('Asignatura')" />

        <flux:input name="nota" :label="__('Nota')" :value="old('nota')" type="number" required autofocus
            autocomplete="nota" :placeholder="__('Nota')" step="0.01" min="0" max="10" />
        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full" data-test="register-user-button">
                {{ __('Enviar') }}
            </flux:button>
        </div>
    </form>

</x-layouts::app>
