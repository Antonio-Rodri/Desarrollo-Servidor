<?php
session_start();

if (!isset($_COOKIE['PHPSESSID'])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST['salir'])) {
    session_destroy();
    setcookie('PHPSESSID', $_COOKIE['PHPSESSID'], time() + 3600, '/');
    header("Location: index.php");
    exit;
}
if (isset($_COOKIE['intentos'])) {
    setcookie('PHPSESSID', $_COOKIE['PHPSESSID'], time() + 3600, '/');
    setcookie("intentos", $_COOKIE['intentos'], time() - 3600, "/");
}
?>
<body style="background: <?php echo "$_SESSION[colorfondo]"; ?>; color: <?php echo "$_SESSION[colorletra]"; ?>; font-size: <?php echo "$_SESSION[tamanoletra]"; ?>; font-family: <?php echo "$_SESSION[tipoletra]"; ?>;">
    <form action="" method="post">
        <input type="submit" name="salir" value="Salir"><br><br><br><br>
    </form>

    <p>Hola <?php echo "$_SESSION[nombre] $_SESSION[apellidos]"; ?></p><br><br><br><br>

    <a href="datos.php">Ver mis datos</a><br><br>
    <a href="modificar.php">Modificar mis datos</a><br><br>
</body>