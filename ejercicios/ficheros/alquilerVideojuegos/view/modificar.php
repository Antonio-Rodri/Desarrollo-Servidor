<?php
require_once '../model/Cliente.php';
require_once '../model/Juego.php';
require_once '../controler/juegosController.php';

session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']->tipo != "admin") {
    header("Location: index.php");
    exit;
}

$juego = juegosController::buscar($_COOKIE['juego']);

if (isset($_POST['enviar'])) {
    if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
        $fich = time() . "-" . $_FILES['foto']['name'];
        $ruta = "../imagenes/" . $fich;
        move_uploaded_file($_FILES['foto']['tmp_name'], $ruta);
        $j = new Juego($juego->codigo, $juego->nombre_juego, $juego->nombre_consola, $_POST['anio'], $_POST['precio'], "NO", $ruta, $_POST['descripcion']);
        $j->generarCodigoCorto();
        if (juegosController::modificar($j)) {
            unlink($juego->imagen);
            $juego = juegosController::buscar($_COOKIE['juego']);
            echo '<p style="color: green; font-size: 26px">Juego modificado correctamente</p><br>';
        } else {
            unlink($ruta);
            echo '<p style="color: red; font-size: 26px">Fallo al modificar el juego</p><br>';
        }
    } else {
        echo '<p style="color: red; font-size: 26px">Necesita subir una carátula</p><br>';
    }
}

if (isset($_COOKIE['PHPSESSID'])) {
    echo '<p style="color: green; font-size: 26px">Hola ' . $_SESSION['user']->nombre . "</p><br>";
}
?>

<form action="" method="POST" enctype="multipart/form-data">
    Nombre: <input type="text" name="nombre" value="<?php echo $juego->nombre_juego ?>" disabled><br>
    Consola: <input type="text" name="consola" value="<?php echo $juego->nombre_consola ?>" disabled><br>
    Año: <input type="text" name="anio" value="<?php echo $juego->anno ?>"><br>
    Precio: <input type="text" name="precio" value="<?php echo $juego->precio ?>"><br>
    Imagen: <input type="file" name="foto"><br>
    <img src="<?= $juego->imagen ?>" height="200"><br>
    Descripcion: <textarea name="descripcion"><?php echo $juego->descripcion ?></textarea><br>
    <a href="index.php">Volver</a>
    <input type="submit" name="enviar" value="Añadir"><br>
</form>