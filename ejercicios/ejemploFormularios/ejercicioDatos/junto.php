<?php
if (isset($_POST['enviar'])) {
    echo "Datos recibidos<br>";
    echo "Nombre: " . $_POST['nombre'] . "<br>";
    echo "Apellidos: " . $_POST['apellidos'] . "<br>";
    echo "Número de matrícula: " . $_POST['numMat'] . "<br>";
    echo "Curso: " . $_POST['curso'] . "<br>";
    echo "Precio: " . $_POST['precio'] . "<br>";
    /*
     * $_POST['idiomas'] = json_decode($_POST['idiomas']);
     */
    $_POST['idiomas'] = explode(";", $_POST['idiomas']);
    foreach ($_POST['idiomas'] as $value) {
        echo $value . '<br>';
    }
    echo '<a href=""><button>Ir al formulario</button></a>';
} elseif (isset($_POST['siguiente'])) {
    ?>
    <form action="" method="post">
        Nº Matrícula: <input type="number" name="numMat"/><br>
        Curso: <input type="text" name="curso"/><br>
        Precio: <input type="number" name="precio"/><br>
        <input type="hidden" name="nombre" value="<?php echo $_POST['nombre']; ?>">
        <input type="hidden" name="apellidos" value="<?php echo $_POST['apellidos']; ?>">
        <input type="hidden" name="idiomas" value="<?php echo implode(";", $_POST['idiomas']); ?>">
        <!<!-- Ahora con json sería tal que: 
        <input type="hidden" name="idiomas" value='<?php // echo json_encode($_POST['idiomas']); ?>'>
        El value debe de estar entre comillas simples para que no se lie
        -->
        <button type="submit" name="enviar">Enviar</button><br>
    </form>
    <?php
} else {
    ?>
    <form action="" method="post">
        Nombre: <input type="text" name="nombre"/><br>
        Apellidos: <input type="text" name="apellidos"/><br>
        Idiomas:<br>
        <input type="checkbox" name="idiomas[]" value="Ingles"/>Inglés
        <input type="checkbox" name="idiomas[]" value="Frances"/>Francés
        <input type="checkbox" name="idiomas[]" value="Aleman"/>Alemán
        <input type="checkbox" name="idiomas[]" value="Ruso"/>Ruso
        <button type="submit" name="siguiente">Siguiente</button><br>
    </form>
    <?php
}
?>
