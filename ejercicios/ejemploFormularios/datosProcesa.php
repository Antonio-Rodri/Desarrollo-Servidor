<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        if (!isset($_POST['enviar'])) {
            ?>
            <form action="" method="post">
                Nombre: <input type="text" name="nombre"/><br>
                Apellidos: <input type="text" name="apellidos"/><br>
                Modulos:<br>
                <input type="checkbox" name="modulos[]" value="DWES"/>Desarrollo web de entorno servidor
                <input type="checkbox" name="modulos[]" value="DWEC"/>Desarrollo web de entorno cliente
                <input type="checkbox" name="modulos[]" value="DIW"/>Diseño de interfaces web
                <button type="submit" name="enviar">Enviar</button><br>
                <a href="opciones.php?n=1">Opcion 1</a><br>
                <a href="opciones.php?n=2">Opcion 2</a><br>
                <a href="opciones.php?n=3">Opcion 3</a><br>
                <br>
            </form>
            <?php
        }
        if (isset($_POST['enviar'])) {
            echo "Datos recibidos<br>";
            echo "Nombre: " . $_POST['nombre'] . "<br>";
            echo "Apellidos: " . $_POST['apellidos'] . "<br>";
            $nom = $_POST['nombre'];
            $apell = $_POST['apellidos'];
            foreach ($_POST['modulos'] as $value) {
                echo $value . '<br>';
            }
            echo '<a href="datosProcesa.php">Ir al formulario</a>';
        }
        ?>
    </body>
</html>
