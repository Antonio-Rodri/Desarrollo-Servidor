<html>
    <head>
        <title>title</title>
    </head>
    <body>
        <?php
        if (isset($_POST['enviar'])) {
            echo "Datos recibidos<br>";
            echo "Nombre: " . $_POST['nombre'] . "<br>";
            echo "Apellidos: " . $_POST['apellidos'] . "<br>";
            $nom = $_POST['nombre'];
            $apell = $_POST['apellidos'];
            echo "Modulos: <br>";
            foreach ($_POST['modulos'] as $value) {
                echo $value.'<br>';
            }
        } else {
            echo "No has enviado nada al servidor. Envíalos";
        }
        
        ?>
        <a href="miPrimerFormulario.php?n=<?= $nom ?>&a=<?= $apell ?>">Ir a datos</a>
    </body>
</html>




