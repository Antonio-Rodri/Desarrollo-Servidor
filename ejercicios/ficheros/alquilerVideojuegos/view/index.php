<?php
require_once '../model/Cliente.php';
require_once '../model/Juego.php';
require_once '../controler/juegosController.php';
require_once '../controler/alquilerController.php';
?>
<a href="login.php">Login</a>
<a href="registro.php">Registro</a><br>
<?php
if (isset($_COOKIE['PHPSESSID'])) {
    session_start();
    echo '<p style="color: green; font-size: 26px">Hola ' . $_SESSION['user']->nombre . "</p><br>";
}
?>
<form action="" method="POST">
    <input type="submit" name="filtro" value="Todos">
    <input type="submit" name="filtro" value="Alquilados">
    <input type="submit" name="filtro" value="NoAlquilados">
</form>
<?php
$juegos = juegosController::mostrar((isset($_POST['filtro'])) ? $_POST['filtro'] : "");

foreach ($juegos as $juego) {
    echo "<p style='color: red; font-size: 26px'>$juego->nombre_juego</p><br>";
    echo "<a href='detalle.php?n=$juego->codigo'><img src='../$juego->imagen' alt='$juego->nombre_juego' height=200></a>";
    if($_SESSION['user']->tipo == "admin"){
        if($juego->alquilado == "SI")
            echo "<br><p style='color: blue; font-size: 18px'>" . alquilerController::buscar($juego->codigo) . "</p>";
        echo "<br><input type='submit' name='modificar' value='$juego->codigo'>";
        echo "<input type='submit' name='borrar' value='$juego->codigo'>";
    }
}
?>