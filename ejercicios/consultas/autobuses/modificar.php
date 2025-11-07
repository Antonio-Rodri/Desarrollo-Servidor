<?php
$msg = "";
$error = "";

if (isset($_POST['modificarBien'])) {
    try {
        $bd = 'mysql:host=localhost; dbname=autobuses;charset=utf8mb4';
        $opciones = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_CASE => PDO::CASE_LOWER);
        $conex = new PDO($bd, 'dwes', 'abc123.', $opciones);
        $conex->beginTransaction();
        $autos = $conex->prepare("UPDATE autos SET num_plazas = :plazas WHERE matricula = :matricula");
        $autos->execute(array("plazas" => $_POST['num_plazas'], "matricula" => $_POST['matricula']));
        $viajes = $conex->prepare("
            UPDATE viajes 
            SET plazas_libres = :plazas, 
                fecha = :fecha, 
                origen = :origen, 
                destino = :destino, 
                matricula = :matricula
            WHERE fecha = :oldfecha 
              AND origen = :oldorigen 
              AND destino = :olddestino 
              AND matricula = :oldmatricula
");

        $viajes->execute([
            "plazas" => $_POST['plazas_libres'],
            "fecha" => $_POST['fecha'],
            "origen" => $_POST['origen'],
            "destino" => $_POST['destino'],
            "matricula" => $_POST['matricula'],
            // Valores antiguos
            "oldfecha" => $_POST['oldfecha'],
            "oldorigen" => $_POST['oldorigen'],
            "olddestino" => $_POST['olddestino'],
            "oldmatricula" => $_POST['oldmatricula']
        ]);
        $conex->commit();
        $msg = "Registro modificado satisfactoriamente";
    } catch (PDOException $exc) {
        echo $exc->getTraceAsString();
        echo $exc->getMessage();
    }
}

try {
    $bd = 'mysql:host=localhost; dbname=autobuses;charset=utf8mb4';
    $opciones = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_CASE => PDO::CASE_LOWER);
    $conex = new PDO($bd, 'dwes', 'abc123.', $opciones);
    $tabla = $conex->query("SELECT viajes.*,autos.Num_plazas FROM `viajes` JOIN autos ON viajes.Matricula = autos.Matricula");
} catch (PDOException $exc) {
    echo $exc->getTraceAsString();
    echo $exc->getMessage();
}
?>
<h1>Modificar/Borrar viaje</h1>
<table border="1">
    <tr>
        <?php
        $row = $tabla->fetch();
        foreach ($row as $key => $value) {
            echo '<th>' . $key . '</th>';
        }
        ?>
        <th>Operaciones</th>
    </tr>
    <?php
    do {
        echo '<form action="" method="post"><tr>';
        foreach ($row as $key => $value) {
            echo '<td>' . $value . '</td>';
            echo '<input type="hidden" name="' . $key . '" value="' . $value . '">';
        }
        echo '<td><button type="submit" name="modificar">Modificar</button><button type="submit" name="borrar">Borrar</button></td>';
        echo '</tr></form>';
    } while ($row = $tabla->fetch());
    ?>
</table><br>
<button><a href="index.php">Menú</a></button>
<?php
if (isset($_POST['modificar'])) {
    try {
        $matriculas = $conex->query("Select matricula from autos");
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
        echo $exc->getMessage();
    }
    ?>
    <h2>Menu Modificar</h2>
    <form action="" method="post">
        <?php
        foreach ($_POST as $key => $value) {
            if ($key != "modificar") {
                if ($key === "matricula") {
                    echo "$key: <select name='$key'>";
                    while ($matricula = $matriculas->fetch()) {
                        if ($matricula[$key] === $value) {
                            echo "$key: <option value='$matricula[$key]' selected>$matricula[$key]</option>";
                        } else {
                            echo "$key: <option value='$matricula[$key]'>$matricula[$key]</option>";
                        }
                    }
                    echo '</select><br>';
                } elseif ($key === "fecha") {
                    echo "$key: <input type='date' name='$key' value='$value'><br>";
                } else {
                    echo "$key: <input type='text' name='$key' value='$value'><br>";
                }
                echo "<input type='hidden' name='old$key' value='$value'>";
            }
        }
        ?>
        <button type="submit" name="modificarBien">Modificar</button>
    </form>
    <?php
}
echo $msg;
?>