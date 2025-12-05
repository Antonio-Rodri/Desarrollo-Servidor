<?php
require_once '../model/Cliente.php';
require_once '../model/Juego.php';
require_once '../controler/juegosController.php';
require_once '../controler/alquilerController.php';
if (isset($_COOKIE['PHPSESSID'])) {
    session_start();
}

if (isset($_POST['modificar'])) {
    setcookie('juego', $_POST['modificar']);
    header("Location: modificar.php");
    exit;
}

if (isset($_POST['borrar'])) {
    setcookie('juego', $_POST['borrar']);
    header("Location: borrar.php");
    exit;
}
?>
<a href="login.php">Login</a>
<a href="registro.php">Registro</a><br>
<?php
if (isset($_COOKIE['PHPSESSID'])) {
    echo '<p style="color: green; font-size: 26px">Hola ' . $_SESSION['user']->nombre . "</p><br>";
}
?>
<form action="" method="POST">
    <input type="submit" name="filtro" value="Todos">
    <input type="submit" name="filtro" value="Alquilados">
    <input type="submit" name="filtro" value="NoAlquilados">
    <?php
    if (isset($_SESSION['user'])) {
        echo "<a href='misjuegos.php'>Mis juegos</a>";
        if ($_SESSION['user']->tipo == "admin")
            echo "<a href='nuevo.php'>Nuevo juego</a>";
    }
    ?>
</form>
<?php
$juegos = juegosController::mostrar((isset($_POST['filtro'])) ? $_POST['filtro'] : "");

foreach ($juegos as $juego) {
    echo "<p style='color: red; font-size: 26px'>$juego->nombre_juego</p><br>";
    echo "<a href='detalle.php?n=$juego->codigo'><img src='../$juego->imagen' alt='$juego->nombre_juego' height=200></a>";
    if (isset($_SESSION['user']) && $_SESSION['user']->tipo == "admin") {
        if ($juego->alquilado == "SI")
            echo "<br><p style='color: blue; font-size: 18px'>" . alquilerController::buscar($juego->codigo) . "</p>";
        echo "<br><button type='submit' name='modificar' value='$juego->codigo'>Modificar</button>";
        echo "<button type='submit' name='borrar' value='$juego->codigo'>Borrar</button>";
    }
}
?>