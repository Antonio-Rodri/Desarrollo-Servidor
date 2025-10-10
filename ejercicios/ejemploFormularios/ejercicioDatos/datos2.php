<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        if (isset($_POST['enviar'])) {
            ?>
            <form action="confirma.php" method="post">
                Nº Matrícula: <input type="number" name="numMat"/><br>
                Curso: <input type="text" name="curso"/><br>
                Precio: <input type="float" name="precio"/><br>
                <input type="hidden" name="nombre" value="<?php echo $_POST['nombre']; ?>">
                <input type="hidden" name="apellidos" value="<?php echo $_POST['apellidos']; ?>">
                <button type="submit" name="enviar">Enviar</button><br>
            </form>
            <?php
        } else {
            echo "No ha enviado nada<br>";
            echo '<a href="datos1.php"><button>Ir al formulario</button></a>';
        }
        ?>
    </body>
</html>
