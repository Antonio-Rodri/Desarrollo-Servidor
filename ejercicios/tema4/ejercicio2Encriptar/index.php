<?php
if (!isset($_COOKIE['registro']) || $_COOKIE['registro'] != "true") {
    header("Location: login.php");
    exit;
}

if (isset($_POST['salir'])) {
    setcookie("nombre", "");
    setcookie("apellidos", "");
    setcookie("registro", "");
    header("Location: login.php");
    exit;
}
setcookie($_COOKIE['dni'], time(), time() + 34560000);
if (isset($_COOKIE[$_COOKIE['dni']])) {
    echo "Bienvenido $_COOKIE[nombre] $_COOKIE[apellidos], su ultimo inicio de sesión fue el: " . date("d m Y H:i:s", $_COOKIE[$_COOKIE['dni']]);
} else {
    echo "Es la primera vez que entras, Bienvenido $_COOKIE[nombre] $_COOKIE[apellidos]";
}
?>

<form action="" method="post">
    <input type="submit" name="salir" value="Salir"><br>
</form>