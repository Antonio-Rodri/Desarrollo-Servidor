<x-layouts::app :title="__('Crear estudiante')">

    <form method="POST" action="{{ route('estudiante.store') }}" class="flex flex-col gap-6">
        @csrf

        <!-- DNI -->
        <flux:input name="dni" :label="__('DNI')" :value="old('dni')" type="text" required autofocus
            autocomplete="dni" :placeholder="__('DNI')" />

        <!-- Name -->
        <flux:input name="name" :label="__('Name')" :value="old('name')" type="text" required autofocus
            autocomplete="name" :placeholder="__('Full name')" />

        <!-- Apellidos -->
        <flux:input name="apellidos" :label="__('Apellidos')" :value="old('apellidos')" type="text" required autofocus
            autocomplete="apellidos" :placeholder="__('Apellidos')" />

        <!-- Email Address -->
        <flux:input name="email" :label="__('Email address')" :value="old('email')" type="email" required
            autocomplete="email" placeholder="email@example.com" />

        <flux:input name="curso" :label="__('Curso')" :value="old('curso')" type="text" required autofocus
            autocomplete="curso" :placeholder="__('Curso')" />

        <flux:input name="asignatura" :label="__('Asignatura')" :value="old('asignatura')" type="text" required
            autofocus autocomplete="asignatura" :placeholder="__('Asignatura')" />

        <flux:input name="nota" :label="__('Nota')" :value="old('nota')" type="number" required autofocus
            autocomplete="nota" :placeholder="__('Nota')" step="0.01" min="0" max="10" />

        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full" data-test="register-user-button">
                {{ __('Crear estudiante') }}
            </flux:button>
        </div>
    </form>

</x-layouts::app>
