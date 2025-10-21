<?php
if (isset($_POST['enviar'])) {

    if (!empty($_POST['to']) && !empty($_POST['td']) && !empty($_POST['codigo']) && !empty($_POST['unidades'])) {
        try {
            $conex = new mysqli("localhost", "dwes", "abc123.", "dwes");
            $conex->set_charset("utf8mb4");
            $stock = $conex->query("SELECT t1.unidades FROM producto p JOIN (SELECT * FROM stock s JOIN tienda t ON s.tienda=t.cod WHERE t.nombre='" . $_POST['to'] . "') t1 ON p.cod=t1.producto WHERE p.cod='" . $_POST['codigo'] . "'")->fetch_assoc()["unidades"] ?? 0;
            $stockDestino = $conex->query("SELECT t1.unidades FROM producto p JOIN (SELECT * FROM stock s JOIN tienda t ON s.tienda=t.cod WHERE t.nombre='" . $_POST['td'] . "') t1 ON p.cod=t1.producto WHERE p.cod='" . $_POST['codigo'] . "'")->fetch_assoc()["unidades"];
            $codigos = $conex->query("SELECT cod FROM producto")->fetch_all(MYSQLI_ASSOC);

            $codEncontrado = false;
            foreach ($codigos as $fila) {
                if ($_POST['codigo'] == $fila['cod']) {
                    $codEncontrado = true;
                    break;
                }
            }

            if ($_POST['to'] != $_POST['td'] && $codEncontrado && is_numeric($_POST['unidades']) && $_POST['unidades'] <= $stock && $stockDestino != null) {
                $conex->query("UPDATE stock s JOIN tienda t ON s.tienda=t.cod SET s.unidades = s.unidades - " . $_POST['unidades'] . " WHERE s.producto = '" . $_POST['codigo'] . "' AND t.nombre = '" . $_POST['to'] . "'");
                $conex->query("UPDATE stock s JOIN tienda t ON s.tienda=t.cod SET s.unidades = s.unidades + " . $_POST['unidades'] . " WHERE s.producto = '" . $_POST['codigo'] . "' AND t.nombre = '" . $_POST['td'] . "'");
                echo "<h3 style=color:green>El traspaso se ha realizado correctamente<h3>";
            } elseif ($_POST['to'] != $_POST['td'] && $codEncontrado && is_numeric($_POST['unidades']) && $_POST['unidades'] <= $stock && $stockDestino === null) {
                $conex->query("UPDATE stock s JOIN tienda t ON s.tienda=t.cod SET s.unidades = s.unidades - " . $_POST['unidades'] . " WHERE s.producto = '" . $_POST['codigo'] . "' AND t.nombre = '" . $_POST['to'] . "'");
                $conex->query("INSERT INTO stock (producto, tienda, unidades) VALUES ('" . $_POST['codigo'] . "', (SELECT cod FROM tienda WHERE nombre = '" . $_POST['td'] . "'), " . $_POST['unidades'] . ")");
                echo "<h3 style=color:green>El traspaso se ha realizado correctamente<h3>";
            } else {
                echo "<h3 style=color:red>NO SE HA PODIDO COMPLETAR EL TRASPASO<h3>";
            }
        } catch (mysqli_sql_exception $ex) {
            echo "<br>Código: " . $ex->getcode() . " Error: " . $ex->getMessage() . "<br>";
            die("ERROR EN LA CONEXIÓN");
        }
        $conex->close();
    }
}
?>
<html>
    <head>
        <title>Traspaso</title>
    </head>
    <body>
        <h1>Traspaso Stock</h1>
        <form action="" method="post">
            Tienda Origen:<br>
            <select name="to">
                <option>Seleccione una tienda de origen</option>
                <option value="CENTRAL"></option>
                <option value="SUCURSAL1"></option>
                <option value="SUCURSAL2"></option>
            </select><br><br>
            Tienda Destino:<br>
            <select name="td">
                <option>Seleccione una tienda de origen</option>
                <option value="CENTRAL">CENTRAL</option>
                <option value="SUCURSAL1">SUCURSAL1</option>
                <option value="SUCURSAL2">SUCURSAL2</option>
            </select><br><br>
            Codigo del producto: <input type="text" name="codigo"/><br><br>
            Unidades: <input type="number" name="unidades"/><br><br>
            <button type="submit" name="enviar">Enviar</button><br><br>
        </form>
    </body>
</html>

