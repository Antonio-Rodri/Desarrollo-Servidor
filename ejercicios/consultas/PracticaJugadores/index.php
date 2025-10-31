<head>
    <title>TODO supply a title</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h1>Menú de jugadores</h1>
    1.-<a href="introducir.php">Introducir jugador</a><br><br>
    2.-<a href="mostrar.php">Mostar jugador</a><br><br>
    3.-<a href="buscar.php">Buscar jugador</a><br><br>
    4.-<a href="modificar.php">Modificar jugador</a><br><br>
    5.-<a href="borrar.php">Borrar jugador</a><br><br>
</body>

<?php
if (isset($_GET['n'])) {
    if ($_GET['n'] == 1)
        echo "<p style='color:green;'>El jugador se ha insertado correctamente.</p>";
    if ($_GET['n'] == 2)
        echo "<p style='color:green;'>El jugador se ha modificado correctamente.</p>";
    if ($_GET['n'] == 3)
        echo "<p style='color:green;'>El jugador se ha borrado correctamente.</p>";
}
