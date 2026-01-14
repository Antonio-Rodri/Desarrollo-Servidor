<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <title>Document</title>
</head>

<body>
    <x-alert colortext="blue" colorbg="red">
        CUIDADO CON EL PERRO
        <x-slot name="cont">
            Contacte a su perrera más cercana.
        </x-slot>
    </x-alert>
    <br>
    <x-alert colortext="red" colorbg="yellow">CUIDADO2 CON EL PERRO
        <x-slot name="cont">
            Contacte a su perrera más cercana.
        </x-slot>
    </x-alert>
    <br>
    <x-alert colortext="green" colorbg="blue">CUIDADO3 CON EL PERRO
        <x-slot name="cont">
            Contacte a su perrera más cercana.
        </x-slot>
    </x-alert>
    <br>
    <x-alert colortext="yellow" colorbg="green">CUIDADO4 CON EL PERRO
        <x-slot name="cont">
            Contacte a su perrera más cercana.
        </x-slot>
    </x-alert>
    <br>
    <x-alert>Cuidado con el gato
        <x-slot name="cont">
            Contacte a su gatera más cercana.
        </x-slot>
    </x-alert>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>
