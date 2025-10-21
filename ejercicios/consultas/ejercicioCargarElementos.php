<?php
$error = false;
$msg = "";
try {
    $conex = new mysqli("localhost", "dwes", "abc123.", "dwes");
    $conex->set_charset("utf8mb4");
} catch (mysqli_sql_exception $exc) {
    $msg = "Fallo en la conexión";
    $error = true;
}

if (!$error) {
    try {
        $productos = $conex->query("SELECT cod,nombre_corto FROM producto")->fetch_all(MYSQLI_ASSOC);
    } catch (mysqli_sql_exception $exc) {
        $msg = "Fallo al cargar productos";
        $error = true;
    }

    if (isset($_POST['enviar'])) {
        try {
            $stock = $conex->query("SELECT stock.unidades, tienda.nombre FROM stock JOIN tienda ON stock.tienda = tienda.cod WHERE stock.producto ='" . $_POST['prod'] . "'")->fetch_all(MYSQLI_ASSOC);
        } catch (mysqli_sql_exception $exc) {
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
        <h1>Ejercicio: Conjunto de resultados en MySQLi</h1>
        <form action="" method="post">
            Producto:<br>
            <select name="prod">
                <?php
                if (!$error) {
                    foreach ($productos as $producto) {
                        if (isset($_POST['enviar']) && $_POST['prod'] === $producto['cod'])
                            echo "<option value='" . $producto['cod'] . "' selected>" . $producto['nombre_corto'] . "</option>";
                        else
                            echo "<option value='" . $producto['cod'] . "'>" . $producto['nombre_corto'] . "</option>";
                    }
                }
                ?>
            </select>
            <button type="submit" name="enviar">Mostrar producto</button><br><br>
            <h1>Stock del producto en las tiendas</h1>
            <?php
            if (isset($_POST['enviar']) && !$error)
                foreach ($stock as $tienda)
                    echo 'Tienda: ' . $tienda['nombre'] . " :" . $tienda['unidades'] . " unidades<br>";
            ?>
        </form>
            <?php
            echo $msg;
            ?>
    </body>
</html>

