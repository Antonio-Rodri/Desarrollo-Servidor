<?php
if (isset($_POST['enviar'])) {
    if (empty($_POST['nombre']))
        $errores['nombre'] = "El nombre es obligatorio";
    if (empty($_POST['apellidos']))
        $errores['apellidos'] = "El apellido es obligatorio";
    if (empty($_POST['sexo']))
        $errores['sexo'] = "Marque 1";
    if (empty($_POST['estado']))
        $errores['estado'] = "Marque 1";
    if (empty($_POST['aficiones']))
        $errores['aficiones'] = "Seleccione al menos 1 afición";
    if (empty($_POST['estudios']))
        $errores['estudios'] = "Seleccione al menos 1 estudio";
    if (empty($_POST['provincia']) || $_POST['provincia'] === "No")
        $errores['provincia'] = "Seleccione una provincia";
    if (empty($_POST['edad']) || $_POST['edad'] < 18)
        $errores['edad'] = "Introduzca su edad(mayor de 18 años)";
}
if (isset($_POST['enviar']) && empty($errores)) {
    echo "Datos recibidos<br>";
    echo "Nombre: " . $_POST['nombre'] . "<br>";
    echo "Apellidos: " . $_POST['apellidos'] . "<br>";
    echo "Sexo: " . $_POST['sexo'] . "<br>";
    echo "Estado civil: " . $_POST['estado'] . "<br>";
    echo "Aficiones: ";
    foreach ($_POST['aficiones'] as $value)
        echo $value . ' ';
    echo "<br>Estudios: ";
    foreach ($_POST['estudios'] as $value)
        echo $value . ' ';
    echo "<br>Provincia: " . $_POST['provincia'] . "<br>";
    echo "Edad: " . $_POST['edad'] . "<br>";
    echo '<br><a href="">Volver al formulario</a>';
} else {
    ?>
    <form action="" method="post">
        Nombre: <input type="text" name="nombre" value="<?php if (empty($errores['nombre']) && isset($_POST['nombre'])) echo $_POST['nombre'] ?>"/> <?php if (!empty($errores['nombre'])) echo "<span style=color:red>" . $errores['nombre'] . "</span>"; ?><br>
        Apellidos: <input type="text" name="apellidos" value="<?php if (empty($errores['apellidos']) && isset($_POST['apellidos'])) echo $_POST['apellidos'] ?>"/><?php if (!empty($errores['apellidos'])) echo "<span style=color:red>" . $errores['apellidos'] . "</span>"; ?><br>
        Sexo:<?php if (!empty($errores['sexo'])) echo "<span style=color:red>" . $errores['sexo'] . "</span>"; ?>
        <input type="radio" name="sexo" value="Hombre" <?php if (isset($_POST['sexo']) && $_POST['sexo'] === "Hombre") echo 'checked'; ?>/>Hombre
        <input type="radio" name="sexo" value="Mujer" <?php if (isset($_POST['sexo']) && $_POST['sexo'] === "Mujer") echo 'checked'; ?>/>Mujer<br>
        Estado Civil:<?php if (!empty($errores['estado'])) echo "<span style=color:red>" . $errores['estado'] . "</span>"; ?>
        <input type="radio" name="estado" value="Soltero" <?php if (isset($_POST['estado']) && $_POST['estado'] === "Soltero") echo 'checked'; ?>/>Soltero
        <input type="radio" name="estado" value="Casado" <?php if (isset($_POST['estado']) && $_POST['estado'] === "Casado") echo 'checked'; ?>/>Casado
        <input type="radio" name="estado" value="Otro" <?php if (isset($_POST['estado']) && $_POST['estado'] === "Otro") echo 'checked'; ?>/>Otro<br>
        Aficiones:<?php if (!empty($errores['aficiones'])) echo "<span style=color:red>" . $errores['aficiones'] . "</span>"; ?><br>
        <input type="checkbox" name="aficiones[]" value="Cine" <?php if (isset($_POST['aficiones']) && in_array("Cine", $_POST['aficiones'])) echo 'checked'; ?>/>Cine
        <input type="checkbox" name="aficiones[]" value="Lectura" <?php if (isset($_POST['aficiones']) && in_array("Lectura", $_POST['aficiones'])) echo 'checked'; ?>/>Lectura
        <input type="checkbox" name="aficiones[]" value="TV" <?php if (isset($_POST['aficiones']) && in_array("TV", $_POST['aficiones'])) echo 'checked'; ?>/>TV<br>
        <input type="checkbox" name="aficiones[]" value="Deporte" <?php if (isset($_POST['aficiones']) && in_array("Deporte", $_POST['aficiones'])) echo 'checked'; ?>/>Deporte
        <input type="checkbox" name="aficiones[]" value="Musica" <?php if (isset($_POST['aficiones']) && in_array("Musica", $_POST['aficiones'])) echo 'checked'; ?>/>Música<br>
        Estudios:<?php if (!empty($errores['estudios'])) echo "<span style=color:red>" . $errores['estudios'] . "</span>"; ?><br>
        <select name="estudios[]" multiple size="5">
            <option value="ESO" <?php if (isset($_POST['estudios']) && in_array("ESO", $_POST['estudios'])) echo 'selected'; ?>>ESO</option>
            <option value="Bachillerato" <?php if (isset($_POST['estudios']) && in_array("Bachillerato", $_POST['estudios'])) echo 'selected'; ?>>Bachillerato</option>
            <option value="CFGM" <?php if (isset($_POST['estudios']) && in_array("CFGM", $_POST['estudios'])) echo 'selected'; ?>>CFGM</option>
            <option value="CFGS" <?php if (isset($_POST['estudios']) && in_array("CFGS", $_POST['estudios'])) echo 'selected'; ?>>CFGS</option>
            <option value="Universidad" <?php if (isset($_POST['estudios']) && in_array("Universidad", $_POST['estudios'])) echo 'selected'; ?>>Universidad</option>
        </select><br>
        Provincia:<?php if (!empty($errores['provincia'])) echo "<span style=color:red>" . $errores['provincia'] . "</span>"; ?><br>
        <select name="provincia">
            <option value="No">Seleccione una provincia</option>
            <option value="Cordoba" <?php if (isset($_POST['provincia']) && $_POST['provincia'] === "Cordoba") echo 'selected'; ?>>Cordoba</option>
            <option value="Sevilla" <?php if (isset($_POST['provincia']) && $_POST['provincia'] === "Sevilla") echo 'selected'; ?>>Sevilla</option>
            <option value="Malaga" <?php if (isset($_POST['provincia']) && $_POST['provincia'] === "Malaga") echo 'selected'; ?>>Malaga</option>
            <option value="Jaen" <?php if (isset($_POST['provincia']) && $_POST['provincia'] === "Jaen") echo 'selected'; ?>>Jaen</option>
            <option value="Granada" <?php if (isset($_POST['provincia']) && $_POST['provincia'] === "Granada") echo 'selected'; ?>>Granada</option>
            <option value="Almeria" <?php if (isset($_POST['provincia']) && $_POST['provincia'] === "Almeria") echo 'selected'; ?>>Malaga</option>
            <option value="Cadiz" <?php if (isset($_POST['provincia']) && $_POST['provincia'] === "Cadiz") echo 'selected'; ?>>Jaen</option>
            <option value="Huelva" <?php if (isset($_POST['provincia']) && $_POST['provincia'] === "Huelva") echo 'selected'; ?>>Granada</option>
        </select><br>
        Edad: <input type="number" name="edad" value="<?php if (empty($errores['edad']) && isset($_POST['edad'])) echo $_POST['edad'] ?>"/> <?php if (!empty($errores['edad'])) echo "<span style=color:red>" . $errores['edad'] . "</span>"; ?><br>
        <button type="submit" name="enviar">Enviar</button><br>
        <br>
    </form>
    <?php
}
?>
</body>
</html>

