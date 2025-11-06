<?php
$msg = "";

try {
    $bd = 'mysql:host=localhost; dbname=autobuses;charset=utf8mb4';
    $opciones = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_CASE => PDO::CASE_LOWER);
    $conex = new PDO($bd, 'dwes', 'abc123.', $opciones);
    $matricula = $conex->query("SELECT matricula FROM autos");
} catch (PDOException $exc) {
    echo $exc->getTraceAsString();
    echo $exc->getMessage();
}

if (isset($_POST['enviar'])) {
    try {
        $bd = 'mysql:host=localhost; dbname=autobuses;charset=utf8mb4';
        $opciones = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_CASE => PDO::CASE_LOWER);
        $conex = new PDO($bd, 'dwes', 'abc123.', $opciones);
        $plazas = $conex->query("SELECT num_plazas FROM autos WHERE matricula = '$_POST[matricula]'")->fetch();
        $result = $conex->prepare("INSERT INTO viajes VALUES (:fecha, :matricula, :origen, :destino, :plaza)");
        $result->execute(array("fecha" => $_POST['fecha'], "matricula" => $_POST['matricula'], "origen" => $_POST['origen'], "destino" => $_POST['destino'], "plaza" => $plazas['num_plazas']));
        $msg = "Viaje insertado correctamente";
    } catch (PDOException $exc) {
        echo $exc->getTraceAsString();
        echo $exc->getMessage();
    }
}
?>

<h1>Nuevo viaje</h1>
<form action="" method="post">
    Fecha: <input type="date" name="fecha"><br><br>
    Matricula: <select name="matricula">
        <?php
        while ($row = $matricula->fetchObject()) {
            if (isset($_POST['matricula']) && $row->matricula == $_POST['matricula']) {
                echo "<option value='" . $row->matricula . "' selected>" . $row->matricula . "</option>";
            } else {
                echo "<option value='" . $row->matricula . "'>" . $row->matricula . "</option>";
            }
        }
        ?>
    </select><br><br>
    Origen: <input type="text" name="origen"><br><br>
    Destino: <input type="text" name="destino"><br><br>
    <button><a href="index.php">Menú</a></button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" name="enviar">Añadir</button>
</form>
<?php
if (!empty($msg))
    echo $msg;
?>