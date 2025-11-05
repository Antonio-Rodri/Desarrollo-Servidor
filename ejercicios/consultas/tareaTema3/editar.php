<?php
$error = false;
$msg = "";
try {
    $bd = 'mysql:host=localhost; dbname=dwes;charset=utf8mb4';
    $opciones = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_CASE => PDO::CASE_LOWER);
    $conex = new PDO($bd, 'dwes', 'abc123.', $opciones);
} catch (PDOException $exc) {
    $msg = "Fallo en la conexión";
    $error = true;
}

if (!$error) {
    if (isset($_POST['cancelar']))
        header("Location: listado.php?n=$_POST[family]");

    if (isset($_POST['actualizar'])) {
        try {
            $result = $conex->prepare("UPDATE producto SET nombre = :nom, nombre_corto = :nomcorto, descripcion = :desc, pvp = :pvp WHERE cod = :cod");
            $result->execute(array("nom" => $_POST['nombre'], "nomcorto" => $_POST['nombreC'], "desc" => $_POST['desc'], "pvp" => $_POST['pvp'], "cod" => $_GET['n']));
            header("Location: listado.php?o=true&n=$_POST[family]");
        } catch (PDOException $exc) {
            $msg = "Fallo al actualizar";
            $error = true;
        }
    }

    if (isset($_GET['n'])) {
        try {
            $producto = $conex->query("SELECT * FROM producto WHERE cod ='$_GET[n]'")->fetch();
        } catch (PDOException $exc) {
            $msg = "Fallo al cargar el producto";
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
            <h1>Edición de un producto</h1>
        </div>
        <div id="contenido">
            <h1>Producto:</h1>
            <form action="" method="post">
                Nombre corto: <input type="text" name="nombreC" class="bloque" value="<?php echo $producto['nombre_corto'] ?>"><br>
                Nombre: <textarea name="nombre" class="bloque" rows="2"><?php echo $producto['nombre'] ?></textarea><br>
                Descripción: <textarea name="desc" class="bloque" rows="5"><?php echo $producto['descripcion'] ?></textarea><br>
                PVP: <input type="number" name="pvp" class="bloque" value="<?php echo $producto['pvp'] ?>"><br>
                <input type="hidden" name="family" value="<?php echo $producto['familia'] ?>">
                <button type="submit" name="actualizar">Actualizar</button>
                <button type="submit" name="cancelar">Cancelar</button>
            </form>
        </div><br>
        <div id="pie">
            <?php
            echo $msg;
            ?>
        </div>
    </body>
</html>

