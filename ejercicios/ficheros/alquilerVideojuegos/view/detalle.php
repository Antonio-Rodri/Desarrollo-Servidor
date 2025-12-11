<?php
require_once '../model/Juego.php';
require_once '../model/Cliente.php';
require_once '../controler/juegosController.php';
require_once '../controler/alquilerController.php';

if (isset($_COOKIE['PHPSESSID'])) {
    session_start();
}

$juego = juegosController::buscar($_GET['n']);

if (isset($_POST["alquilar"])) {
    echo $juego->codigo . "<br>";
    if (alquilerController::alquilar($juego, $_SESSION['user'])) {
        $juego = juegosController::buscar($_GET['n']);
        echo "Juego alquilado con éxito<br>";
    } else {
        echo "No se ha podido alquilar el juego<br>";
    }
}
?>

<img src="<?php echo $juego->imagen; ?>" height=200><br><br>
Nombre: <?php echo $juego->nombre_juego ?><br>
Consola: <?php echo $juego->nombre_consola ?><br>
Año: <?php echo $juego->anno ?><br>
Precio: <?php echo $juego->precio ?><br>
Descripción: <?php echo $juego->descripcion ?><br>

<?php
if (isset($_COOKIE['PHPSESSID']) && isset($_SESSION['user'])) {
    if ($juego->alquilado == "SI") {
        $alq = alquilerController::buscarAlquilador($juego->codigo);
        echo "<br><p style='color: blue; font-size: 18px'>Juego alquilado por $alq[Nombre] $alq[Apellidos], fecha prevista de devolución: $alq[prevista] </p><br>";
    } else {
        echo "<br><p style='color: blue; font-size: 18px'>Disponible para alquilar</p>";
        ?>
        <form action="" method="POST">
            <button type="submit" name="alquilar" value="<?= $_GET['n'] ?>">Alquilar</button>
        </form>
        <?php
    }
}
?>
<a href="index.php">Inicio</a>