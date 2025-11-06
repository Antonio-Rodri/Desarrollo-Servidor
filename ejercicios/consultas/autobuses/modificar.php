<?php
$msg = "";
$error = "";

try {
    $bd = 'mysql:host=localhost; dbname=autobuses;charset=utf8mb4';
    $opciones = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_CASE => PDO::CASE_LOWER);
    $conex = new PDO($bd, 'dwes', 'abc123.', $opciones);
    $origen = $conex->query("SELECT DISTINCT origen FROM viajes");
    $destino = $conex->query("SELECT DISTINCT destino FROM viajes");
} catch (PDOException $exc) {
    echo $exc->getTraceAsString();
    echo $exc->getMessage();
}

if (isset($_POST['reservar'])) {
    if ($_POST['plazas'] - $_POST['misplazas'] < 0) {
        $error = "No se pueden reservar más plazas de las que hay disponibles";
    } else {
        try {
            $bd = 'mysql:host=localhost; dbname=autobuses;charset=utf8mb4';
            $opciones = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_CASE => PDO::CASE_LOWER);
            $conex = new PDO($bd, 'dwes', 'abc123.', $opciones);
            $viajes = $conex->prepare("UPDATE viajes SET plazas_libres = :plazas WHERE fecha = :fecha AND origen = :origen AND destino = :destino AND matricula = :matricula");
            $viajes->execute(array("plazas" => ($_POST['plazas'] - $_POST['misplazas']), "fecha" => $_POST['fecha'], "origen" => $_POST['origen'], "destino" => $_POST['destino'], "matricula" => $_POST['matricula']));
            $msg = "Ha reservado " . $_POST['misplazas'] . " plazas para el viaje de " . $_POST['origen'] . " a " . $_POST['destino'] . " el día " . $_POST['fecha'];
            if ($viajes->rowCount() == 0) {
                $error = "No hay viaje desde $_POST[origen] hasta $_POST[destino] el $_POST[fecha]";
            } else {
                $viajes = $viajes->fetch();
            }
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
            echo $exc->getMessage();
        }
    }
}

if (isset($_POST['consultar'])) {
    if ($_POST['origen'] === $_POST['destino']) {
        $error = "El origen y el destino han de ser diferentes";
    } else {
        try {
            $bd = 'mysql:host=localhost; dbname=autobuses;charset=utf8mb4';
            $opciones = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_CASE => PDO::CASE_LOWER);
            $conex = new PDO($bd, 'dwes', 'abc123.', $opciones);
            $viajes = $conex->prepare("SELECT * FROM viajes WHERE fecha = :fecha AND origen = :origen AND destino = :destino");
            $viajes->execute(array("fecha" => $_POST['fecha'], "origen" => $_POST['origen'], "destino" => $_POST['destino']));
            if ($viajes->rowCount() == 0)
                $error = "No hay viaje desde $_POST[origen] hasta $_POST[destino] el $_POST[fecha]";
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
            echo $exc->getMessage();
        }
    }
}
?>

<h1>Reserva</h1>
<form action="" method="post">
    Fecha: <input type="date" name="fecha"><br><br>
    Origen: <select name="origen">
        <?php
        while ($row = $origen->fetchObject()) {
            if (isset($_POST['origen']) && $row->origen == $_POST['origen']) {
                echo "<option value='" . $row->origen . "' selected>" . $row->origen . "</option>";
            } else {
                echo "<option value='" . $row->origen . "'>" . $row->origen . "</option>";
            }
        }
        ?>
    </select><br><br>
    Destino: <select name="destino">
        <?php
        while ($row = $destino->fetchObject()) {
            if (isset($_POST['destino']) && $row->destino == $_POST['destino']) {
                echo "<option value='" . $row->destino . "' selected>" . $row->destino . "</option>";
            } else {
                echo "<option value='" . $row->destino . "'>" . $row->destino . "</option>";
            }
        }
        ?>
    </select><br><br>
    <button><a href="index.php">Menú</a></button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" name="consultar">Consultar</button>
</form>

<?php
if (isset($_POST['consultar']) && empty($error)) {
    while ($row = $viajes->fetch()) {
        foreach ($row as $key => $value) {
            echo $key . " : " . $value . "<br>";
        }
        ?>
        <form action="" method="post">
            <input type="hidden" name="fecha" value="<?php echo $row['fecha'] ?>">
            <input type="hidden" name="origen" value="<?php echo $row['origen'] ?>">
            <input type="hidden" name="destino" value="<?php echo $row['destino'] ?>">
            <input type="hidden" name="matricula" value="<?php echo $row['matricula'] ?>">
            <input type="hidden" name="plazas" value="<?php echo $row['plazas_libres'] ?>"><br>
            Numero de plazas a reservar: <input type="text" name="misplazas"><br>
            <button type="submit" name="reservar">Reservar</button>
        </form>
        <?php
    }
} else {
    echo $error;
}
echo $msg;
?>
