<?php
require_once '../controler/clienteController.php';
$errores = [];
if (isset($_POST['inicio'])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST['registrar'])) {
    if (empty($_POST['nombre']))
        $errores['nombre'] = 'El nombre no puede estar vacío';
    if (empty($_POST['apellidos']))
        $errores['apellidos'] = 'El apellido no puede estar vacío';
    if (empty($_POST['direccion']))
        $errores['direccion'] = 'La direcció no puede estar vacía';
    if (empty($_POST['localidad']))
        $errores['localidad'] = 'La localidad no puede estar vacía';
    if (empty($_POST['pass']))
        $errores['pass'] = 'La contraseña no puede estar vacía';
    if (empty($_POST['dni']) || !preg_match('/^[0-9]{8}[A-Z]$/', $_POST['dni'])) {
        $errores['dni'] = 'Introduzca un dni valido';
    } elseif (clienteController::dniRepetido($_POST['dni']))
        $errores['username'] = "DNI no válido, ya exista en la Base de Datos";

    if (empty($errores)) {
        $cli = new Cliente($_POST['dni'], $_POST['nombre'], $_POST['apellidos'], $_POST['direccion'], $_POST['localidad'], $_POST['pass'], "cliente");
        clienteController::insertar($cli);
        header("Location: index.php");
    }
}
?>

<form action="" method="post">
    Nombre: <input type="text" name="nombre"><?php if (!empty($errores['nombre'])) echo "<span style=color:red>" . $errores['nombre'] . "</span>"; ?><br><br>
    Apellidos: <input type="text" name="apellidos"><?php if (!empty($errores['apellidos'])) echo "<span style=color:red>" . $errores['apellidos'] . "</span>"; ?><br><br>
    Dirección: <input type="text" name="direccion"><?php if (!empty($errores['direccion'])) echo "<span style=color:red>" . $errores['direccion'] . "</span>"; ?><br><br>
    Localidad: <input type="text" name="localidad"><?php if (!empty($errores['localidad'])) echo "<span style=color:red>" . $errores['localidad'] . "</span>"; ?><br><br>
    DNI: <input type="text" name="dni"><?php if (!empty($errores['dni'])) echo "<span style=color:red>" . $errores['dni'] . "</span>"; ?><br><br>
    Contraseña: <input type="text" name="pass"><?php if (!empty($errores['pass'])) echo "<span style=color:red>" . $errores['pass'] . "</span>"; ?><br><br>

    <input type="submit" name="inicio" value="Inicio"><br>
    <input type="submit" name="registrar" value="Registrar"><br>
</form>