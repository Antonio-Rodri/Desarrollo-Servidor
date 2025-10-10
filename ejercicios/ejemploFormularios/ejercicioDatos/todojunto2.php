<?php
if (isset($_POST['enviar'])) {
    echo "Datos recibidos<br>";
    echo "Nombre: " . $_POST['nombre'] . "<br>";
    echo "Apellidos: " . $_POST['apellidos'] . "<br>";
    echo "Número de matrícula: " . $_POST['dir'] . "<br>";
    echo "Curso: " . $_POST['tarj'] . "<br>";
    ?>
    <form action="" method="post">
        <input type="hidden" name="nombre" value="<?php echo $_POST['nombre']; ?>">
        <input type="hidden" name="apellidos" value="<?php echo $_POST['apellidos']; ?>">
        <input type="hidden" name="dir" value="<?php echo $_POST['dir']; ?>">
        <input type="hidden" name="tarj" value="<?php echo $_POST['tarj']; ?>">
        <button type="submit" name="atras">Cancelar</button><br>
        <button type="submit" name="vacio">Confirmar</button><br>
    </form>
    <?php
} elseif (isset($_POST['siguiente'])) {
    ?>
    <form action="" method="post">
        Direccion: <input type="text" name="dir" value="<?php if (isset($_POST['dir'])) echo $_POST['dir'] ?>"/><br>
        Número de tarjeta: <input type="number" name="tarj" value="<?php if (isset($_POST['tarj'])) echo $_POST['tarj'] ?>"/><br>
        <input type="hidden" name="nombre" value="<?php echo $_POST['nombre']; ?>">
        <input type="hidden" name="apellidos" value="<?php echo $_POST['apellidos']; ?>">
        <button type="submit" name="atras">Atrás</button><br>
        <button type="submit" name="enviar">Enviar</button><br>
    </form>
    <?php
} else {
    ?>
    <form action="" method="post">
        Nombre: <input type="text" name="nombre" value="<?php if (isset($_POST['nombre']) && isset($_POST['atras'])) echo $_POST['nombre']; ?>"/><br>
        Apellidos: <input type="text" name="apellidos" value="<?php if (isset($_POST['apellidos']) && isset($_POST['atras'])) echo $_POST['apellidos']; ?>"/><br>
        <input type="hidden" name="dir" value="<?php if (isset($_POST['dir']) && isset($_POST['atras'])) echo $_POST['dir']; ?>">
        <input type="hidden" name="tarj" value="<?php if (isset($_POST['tarj']) && isset($_POST['atras'])) echo $_POST['tarj']; ?>">
        <button type="submit" name="siguiente">Siguiente</button><br>
    </form>
    <?php
}
?>
