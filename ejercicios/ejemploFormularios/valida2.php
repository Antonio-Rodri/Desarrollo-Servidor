<?php
$errores = [];
$datos = [];
if (isset($_POST['enviar'])) {
    if (empty($_POST['nombre']))
        $errores['nombre'] = "El nombre es obligatorio";
    else
        $datos['nombre'] = $_POST['nombre'];
    if (empty($_POST['apellidos']))
        $errores['apellidos'] = "El apellido es obligatorio";
    else
        $datos['apellidos'] = $_POST['apellidos'];
    if (empty($_POST['modulos']))
        $errores['modulos'] = "Seleccione al menos 1 módulo";
    else
        $datos['modulos'] = $_POST['modulos'];
}
if (isset($_POST['enviar']) && empty($errores)) {
    echo "Datos recibidos<br>";
    echo "Nombre: " . $_POST['nombre'] . "<br>";
    echo "Apellidos: " . $_POST['apellidos'] . "<br>";
    $nom = $_POST['nombre'];
    $apell = $_POST['apellidos'];
    echo "Modulos: <br>";
    foreach ($_POST['modulos'] as $value) {
        echo $value . '<br>';
    }
    echo '<br><a href="">Volver al formulario</a>';
} else {
    ?>
    <form action="" method="post">
        Nombre: <input type="text" name="nombre" value="<?php if (empty($errores['nombre']) && isset($datos['nombre'])) echo $datos['nombre'] ?>"/> <?php if (!empty($errores['nombre'])) echo "<span style=color:red>".$errores['nombre']."</span>"; ?><br>
        Apellidos: <input type="text" name="apellidos" value="<?php if (empty($errores['apellidos']) && isset($datos['apellidos'])) echo $datos['apellidos'] ?>"/><?php if (!empty($errores['apellidos'])) echo "<span style=color:red>".$errores['apellidos']."</span>"; ?><br>
        Modulos:<?php if (!empty($errores['modulos'])) echo "<span style=color:red>".$errores['modulos']."</span>"; ?><br>
        <input type="checkbox" name="modulos[]" value="DWES" <?php if (isset($datos['modulos']) && in_array("DWES", $datos['modulos'])) echo 'checked'; ?>/>Desarrollo web de entorno servidor<br>
        <input type="checkbox" name="modulos[]" value="DWEC" <?php if (isset($datos['modulos']) && in_array("DWEC", $datos['modulos'])) echo 'checked'; ?>/>Desarrollo web de entorno cliente<br>
        <input type="checkbox" name="modulos[]" value="DIW" <?php if (isset($datos['modulos']) && in_array("DIW", $datos['modulos'])) echo 'checked'; ?>/>Diseño de interfaces web<br>
        <button type="submit" name="enviar">Enviar</button><br>
        <a href="opciones.php?n=1">Opcion 1</a><br>
        <a href="opciones.php?n=2">Opcion 2</a><br>
        <a href="opciones.php?n=3">Opcion 3</a><br>
        <br>
    </form>
    <?php
}
?>
</body>
</html>

