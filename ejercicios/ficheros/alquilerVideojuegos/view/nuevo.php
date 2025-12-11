<?php
require_once '../model/Cliente.php';
require_once '../model/Juego.php';
require_once '../controler/juegosController.php';

session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']->tipo != "admin") {
    header("Location: index.php");
    exit;
}

if (isset($_POST['enviar'])){
    if(is_uploaded_file($_FILES['foto']['tmp_name'])){
        $fich = time()."-".$_FILES['foto']['name'];
        $ruta = "../imagenes/".$fich;
        move_uploaded_file($_FILES['foto']['tmp_name'], $ruta);
        $juego = new Juego("-", $_POST['nombre'], $_POST['consola'], $_POST['anio'], $_POST['precio'], "NO", $ruta, $_POST['descripcion']);
        $juego->generarCodigoCorto();
        juegosController::insertar($juego);
        echo '<p style="color: green; font-size: 26px">Juego insertado correctamente</p><br>';
    } else {
        echo '<p style="color: red; font-size: 26px">Necesita subir una carátula</p><br>';
    }
    
}

if (isset($_COOKIE['PHPSESSID'])) {
    echo '<p style="color: green; font-size: 26px">Hola ' . $_SESSION['user']->nombre . "</p><br>";
}
?>

<form action="" method="POST" enctype="multipart/form-data">
    Nombre: <input type="text" name="nombre"><br>
    Consola: <input type="text" name="consola"><br>
    Año: <input type="text" name="anio"><br>
    Precio: <input type="text" name="precio"><br>
    Imagen: <input type="file" name="foto"><br>
    Descripcion: <textarea name="descripcion"></textarea><br>
    <a href="index.php">Volver</a>
    <input type="submit" name="enviar" value="Añadir"><br>
</form>