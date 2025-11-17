<?php
session_name('admin');
session_start();
echo $_SESSION['nombre'];
$_SESSION['nombre'] = "Antonio";
session_unset();
session_destroy();
setcookie('admin', $_COOKIE['admin'], time() - 1, '/');

?>

<br><a href="index.php">Ir a index</a>