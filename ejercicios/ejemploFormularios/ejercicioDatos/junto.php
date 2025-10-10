<?php
if (isset($_POST['enviar'])) {
    echo "Datos recibidos<br>";
    echo "Nombre: " . $_POST['nombre'] . "<br>";
    echo "Apellidos: " . $_POST['apellidos'] . "<br>";
    echo "Número de matrícula: " . $_POST['numMat'] . "<br>";
    echo "Curso: " . $_POST['curso'] . "<br>";
    echo "Precio: " . $_POST['precio'] . "<br>";
    echo '<a href="datos1.php"><button>Ir al formulario</button></a>';
} elseif (isset($_POST['siguiente'])) {
    ?>
    <form action="" method="post">
        Nº Matrícula: <input type="number" name="numMat"/><br>
        Curso: <input type="text" name="curso"/><br>
        Precio: <input type="float" name="precio"/><br>
        <input type="hidden" name="nombre" value="<?php echo $_POST['nombre']; ?>">
        <input type="hidden" name="apellidos" value="<?php echo $_POST['apellidos']; ?>">
        <button type="submit" name="enviar">Enviar</button><br>
    </form>
    <?php
} else {
    ?>
    <form action="" method="post">
        Nombre: <input type="text" name="nombre"/><br>
        Apellidos: <input type="text" name="apellidos"/><br>
        <button type="submit" name="siguiente">Siguiente</button><br>
    </form>
    <?php
}
?>
