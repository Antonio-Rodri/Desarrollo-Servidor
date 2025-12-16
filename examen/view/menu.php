<?php
require_once '../model/Empleado.php';

session_start();

if (!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}

if (isset($_POST["cerrar"])) {
    session_unset();
    session_destroy();
    setcookie(session_name(), "", time() - 3600, "/");
    header("Location: login.php");
}

echo '<p style="color: green; font-size: 26px">Hola ' . $_SESSION['user']->nombrecompleto . " " . $_SESSION['user']->rol . "</p><br>";
?>
<form action="" method="POST">
    <input type="submit" name="cerrar" value="Cerrar Sesion">
</form><br>

<?php
if($_SESSION['user']->rol == "admin"){
    echo "<a href='registrar.php'>Registrar trabajo</a><br><br>";
}
echo "<a href='trabajos.php'>Ver trabajo</a>";
