<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <title>Document</title>
</head>

@php
    $colortext = 'blue';
    $colorbg = 'red';
    $tipocomponente = 'alert';
@endphp

<body>
    <x-alertAnonimo colortext="blue" :colorbg="$colorbg">Título de la Alerta
        <x-slot name="li1">
            Entrada 1.
        </x-slot>
        <x-slot name="li2">
            Entrada 2.
        </x-slot>
        <x-slot name="li3">
            Entrada 3.
        </x-slot>
    </x-alertAnonimo>
    <x-alert :colortext="$colortext" :colorbg="$colorbg" class="text-green-500">
        CUIDADO CON EL PERRO
        {{-- <x-slot name="cont">
            Contacte a su perrera más cercana.
        </x-slot> --}}
    </x-alert>
    <br>
    <x-alert colortext="red" colorbg="yellow">CUIDADO2 CON EL PERRO
        {{-- <x-slot name="cont">
            Contacte a su perrera más cercana.
        </x-slot> --}}
    </x-alert>
    <br>
    <x-alert colortext="green" colorbg="blue">CUIDADO3 CON EL PERRO
        {{-- <x-slot name="cont">
            Contacte a su perrera más cercana.
        </x-slot> --}}
    </x-alert>
    <br>
    <x-alert colortext="yellow" colorbg="green">CUIDADO4 CON EL PERRO
        {{-- <x-slot name="cont">
            Contacte a su perrera más cercana.
        </x-slot> --}}
    </x-alert>
    <br>
    <x-alert>Cuidado con el gato
        {{-- <x-slot name="cont">
            Contacte a su gatera más cercana.
        </x-slot> --}}
    </x-alert>
    <x-alertAnonimo>Hola, soy Homero chino, soy homero pero... Homero chino
        <x-slot name="li1">
            Cuanto valen los helaos de sien?.
        </x-slot>
        <x-slot name="li2">
            Los helaos de sien valen sien.
        </x-slot>
        <x-slot name="li3">
            Celveza.
        </x-slot>
    </x-alertAnonimo>
    <x-dynamic-component :component="$tipocomponente">
        Este es el componente dinámico
    </x-dynamic-component>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>
