<?php
if (isset($_POST['enviar'])) {
    if (!empty($_POST['nombre']) && !empty($_POST['apellidos']) && !empty($_POST['modulos'])) {
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
            Nombre: <input type="text" name="nombre" value="<?php if (!empty($_POST['nombre'])) echo $_POST['nombre'] ?>"/> <?php if (empty($_POST['nombre'])) echo "<span style=color:red> El nombre no puede estar vacio</span>"; ?><br>
            Apellidos: <input type="text" name="apellidos" value="<?php if (!empty($_POST['apellidos'])) echo $_POST['apellidos'] ?>"/><?php if (empty($_POST['apellidos'])) echo "<span style=color:red> El apellido no puede estar vacio</span>"; ?><br>
            Modulos:<?php if (empty($_POST['modulos'])) echo "<span style=color:red> Seleccione al menos 1 módulo</span>"; ?><br>
            <input type="checkbox" name="modulos[]" value="DWES"/>Desarrollo web de entorno servidor<br>
            <input type="checkbox" name="modulos[]" value="DWEC"/>Desarrollo web de entorno cliente<br>
            <input type="checkbox" name="modulos[]" value="DIW"/>Diseño de interfaces web<br>
            <button type="submit" name="enviar">Enviar</button><br>
            <a href="opciones.php?n=1">Opcion 1</a><br>
            <a href="opciones.php?n=2">Opcion 2</a><br>
            <a href="opciones.php?n=3">Opcion 3</a><br>
            <br>
        </form>
        <?php
    }
} else {
    ?>

    <form action="" method="post">
        Nombre: <input type="text" name="nombre"/><br>
        Apellidos: <input type="text" name="apellidos"/><br>
        Modulos:<br>
        <input type="checkbox" name="modulos[]" value="DWES"/>Desarrollo web de entorno servidor<br>
        <input type="checkbox" name="modulos[]" value="DWEC"/>Desarrollo web de entorno cliente<br>
        <input type="checkbox" name="modulos[]" value="DIW"/>Diseño de interfaces web<br>
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
