<?php
if (isset($_POST['enviar'])) {
    if (empty($_POST['filas']) || !is_numeric($_POST['filas']) || $_POST['filas'] < 1)
        $errores['filas'] = "Debe de haber un número superior a 1";
    if (empty($_POST['columnas']) || !is_numeric($_POST['columnas']) || $_POST['columnas'] < 1)
        $errores['columnas'] = "Debe de haber un número superior a 1";
    if ($_GET['opcion'] === 'cuatro' && $_POST['filas'] != $_POST['columnas'])
        $errores['cuad'] = "La matriz ha de ser cuadrada";
}
if (isset($_POST['enviar']) && empty($errores)) {
    echo "Datos recibidos<br>";
    echo "Nombre: " . $_POST['nombre'] . "<br>";
    echo "Apellidos: " . $_POST['apellidos'] . "<br>";
    echo "Modulos: <br>";
    foreach ($_POST['modulos'] as $value) {
        echo $value . '<br>';
    }
    echo '<br><a href="">Volver al formulario</a>';
} else {
    ?>
    <form action="" method="post">
        Nombre: <input type="text" name="nombre" value="<?php if (empty($errores['nombre']) && isset($_POST['nombre'])) echo $_POST['nombre'] ?>"/> <?php if (!empty($errores['nombre'])) echo "<span style=color:red>".$errores['nombre']."</span>"; ?><br>
        Apellidos: <input type="text" name="apellidos" value="<?php if (empty($errores['apellidos']) && isset($_POST['apellidos'])) echo $_POST['apellidos'] ?>"/><?php if (!empty($errores['apellidos'])) echo "<span style=color:red>".$errores['apellidos']."</span>"; ?><br>
        Modulos:<?php if (!empty($errores['modulos'])) echo "<span style=color:red>".$errores['modulos']."</span>"; ?><br>
        <input type="checkbox" name="modulos[]" value="DWES" <?php if (isset($_POST['modulos']) && in_array("DWES", $_POST['modulos'])) echo 'checked'; ?>/>Desarrollo web de entorno servidor<br>
        <input type="checkbox" name="modulos[]" value="DWEC" <?php if (isset($_POST['modulos']) && in_array("DWEC", $_POST['modulos'])) echo 'checked'; ?>/>Desarrollo web de entorno cliente<br>
        <input type="checkbox" name="modulos[]" value="DIW" <?php if (isset($_POST['modulos']) && in_array("DIW", $_POST['modulos'])) echo 'checked'; ?>/>Diseño de interfaces web<br>
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

