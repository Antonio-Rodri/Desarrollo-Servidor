<?php
$error = false;
$msg = "";
try {
    $bd = 'mysql:host=localhost; dbname=dwes;charset=utf8mb4';
    $opciones = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,PDO::ATTR_CASE => PDO::CASE_LOWER);
    $conex = new PDO($bd, 'dwes', 'abc123.', $opciones);
} catch (PDOException $exc) {
    $msg = "Fallo en la conexión";
    $error = true;
}

if (!$error) {
    try {
        $familias = $conex->query("SELECT cod,nombre FROM familia");
    } catch (PDOException $exc) {
        $msg = "Fallo al cargar productos";
        $error = true;
    }

    if (isset($_POST['enviar'])) {
        try {
            $productos = $conex->query("SELECT cod,nombre_corto,pvp FROM producto WHERE familia ='$_POST[fam]'");
        } catch (PDOException $exc) {
            $msg = "Fallo al cargar el stock";
            $error = true;
        }
    }
}
?>

<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Selector Productos</title>
        <link rel="stylesheet" href="estilos.css" />
    </head>
    <body>
        <div id="encabezado">
            <h1>Tarea: Listado de productos de una familia</h1>
            <form action="" method="post">
                Familia:
                <select name="fam">
                    <?php
                    if (!$error)
                        while ($familia = $familias->fetch())
                            if (isset($_POST['enviar']) && $_POST['fam'] === $familia['cod'] || !isset($_POST['enviar']) && isset($_GET['n']) && $_GET['n'] === $familia['cod'])
                                echo "<option value='" . $familia['cod'] . "' selected>" . $familia['nombre'] . "</option>";
                            else
                                echo "<option value='" . $familia['cod'] . "'>" . $familia['nombre'] . "</option>";
                    ?>
                </select>
                <button type="submit" name="enviar">Mostrar familia</button>
        </div>
        <div id="contenido">
            <h1>Producto de la familia</h1>
            <?php
            if (isset($_POST['enviar']) && !$error)
                while ($producto = $productos->fetch())
                    echo "<b>Producto $producto[cod]:</b> $producto[nombre_corto] $producto[pvp] <button><a href='editar.php?n=$producto[cod]'>Editar</a></button><br><br>";
            ?>
        </form>
    </div><br>
    <div id="pie">
        <?php
        echo $msg;
        if(isset($_GET['o']))
            echo "Actualizado correctamente";
        ?>
    </div>
</body>
</html>

