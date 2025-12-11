<?php
require_once '../model/Juego.php';
require_once '../model/Cliente.php';
require_once '../controler/juegosController.php';
require_once '../controler/alquilerController.php';

session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']->tipo != "admin") {
    header("Location: index.php");
    exit;
}

$juego = juegosController::buscar($_COOKIE['juego']);

if (isset($_POST["borrar"])) {
    if (juegosController::borrar($juego->codigo)) {
        setcookie("juego", "", time() - 3600);
        unlink($juego->imagen);
        header("Location: index.php");
    } else {
        echo "No se ha podido borrar el juego<br>";
    }
}
?>

<img src="<?php echo $juego->imagen; ?>" height=200><br><br>
Nombre: <?php echo $juego->nombre_juego ?><br>
Consola: <?php echo $juego->nombre_consola ?><br>
Año: <?php echo $juego->anno ?><br>
Precio: <?php echo $juego->precio ?><br>
Descripción: <?php echo $juego->descripcion ?><br>
<form action="" method="POST">
    <button type="submit" name="borrar" value="borrar">Borrar</button>
</form>

<a href="index.php">Inicio</a>