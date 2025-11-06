<?php
$errores = [];
$posiciones = ['portero', 'defensa', 'centrocampista', 'delantero'];
if (isset($_POST['aceptar'])) {
    if (empty($_POST['nombre']) || !preg_match('/[a-z]{1,30}/i', $_POST['nombre']))
        $errores['nombre'] = 'Solo texto, máximo 30';
    if (empty($_POST['dni']) || !preg_match('/\d{8}[A-Z]{1}/', $_POST['dni'])) {
        $errores['dni'] = '8 dígitos con 1 letra mayúscula';
    } else {
        try {
            $conex = new mysqli("localhost", "dwes", "abc123.", "jugadores");
            $conex->set_charset("utf8mb4");
            $stmt = $conex->prepare("SELECT dni FROM jugador");
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_object()) {
                    if ($row->dni == $_POST['dni']) {
                        $errores['dni'] = "DNI no válido, ya exista en la Base de Datos";
                        break;
                    }
                }
            }
            $stmt->close();
            $conex->close();
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
            echo $exc->getMessage();
        }
    }
    if (empty($_POST['dorsal']))
        $errores['dorsal'] = 'No puede haber un jugador sin dorsal';
    if (empty($_POST['posicion']))
        $errores['posicion'] = 'No puede haber un jugador sin posicion';
    if (empty($_POST['equipo']) || !preg_match('/[a-z]{1,30}/i', $_POST['equipo']))
        $errores['equipo'] = 'Solo texto, máximo 30';
    if (empty($_POST['goles']) || !preg_match('/\d+/', $_POST['goles']))
        $errores['goles'] = 'Los goles han de ser sólo números';
    if (empty($errores)) {
        try {
            $conex = new mysqli("localhost", "dwes", "abc123.", "jugadores");
            $conex->set_charset("utf8mb4");
            $stmt = $conex->prepare("INSERT INTO jugador (dni,nombre,dorsal,posicion,equipo,goles) VALUES (?,?,?,?,?,?)");
            $stmt->bind_param("ssissi", $_POST['dni'], $_POST['nombre'], $_POST['dorsal'], implode(",", $_POST['posicion']), $_POST['equipo'], $_POST['goles']);
            $stmt->execute();
            $stmt->close();
            $conex->close();
            header("Location: index.php?n=1");
        } catch (mysqli_sql_exception $exc) {
            echo $exc->getTraceAsString();
            echo $exc->getMessage();
        }
    }
}
?>

<form action="" method="post">
    Nombre:<input type="text" name="nombre" value="<?php if (empty($errores['nombre']) && isset($_POST['nombre'])) echo $_POST['nombre'] ?>"> <?php if (!empty($errores['nombre'])) echo "<span style=color:red>" . $errores['nombre'] . "</span>"; ?><br><br>
    DNI:<input type="text" name="dni" value="<?php if (empty($errores['dni']) && isset($_POST['dni'])) echo $_POST['dni'] ?>"> <?php if (!empty($errores['dni'])) echo "<span style=color:red>" . $errores['dni'] . "</span>"; ?><br><br>
    Dorsal: <?php if (!empty($errores['dorsal'])) echo "<span style=color:red>" . $errores['dorsal'] . "</span>"; ?><br>
    <select name="dorsal">
        <option value=""></option>
        <?php
        for ($index = 1; $index < 12; $index++) {
            if (empty($errores['dorsal']) && isset($_POST['dorsal']) && $index == $_POST['dorsal']) {
                echo "<option value='" . $index . "' selected>" . $index . "</option>";
            } else {
                echo "<option value='" . $index . "'>" . $index . "</option>";
            }
        }
        ?>
    </select><br>
    Posicion: <?php if (!empty($errores['posicion'])) echo "<span style=color:red>" . $errores['posicion'] . "</span>"; ?><br>
    <select multiple="" name="posicion[]">
        <?php
        foreach ($posiciones as $value) {
            if (empty($errores['posicion']) && isset($_POST['posicion']) && in_array($value, $_POST['posicion'])) {
                echo "<option value='" . $value . "' selected>" . $value . "</option>";
            } else {
                echo "<option value='" . $value . "'>" . $value . "</option>";
            }
        }
        ?>
    </select><br>
    Equipo:<input type="text" name="equipo" value="<?php if (empty($errores['equipo']) && isset($_POST['equipo'])) echo $_POST['equipo'] ?>"> <?php if (!empty($errores['equipo'])) echo "<span style=color:red>" . $errores['equipo'] . "</span>"; ?><br><br>
    Goles:<input type="text" name="goles" value="<?php if (empty($errores['goles']) && isset($_POST['goles'])) echo $_POST['goles'] ?>"> <?php if (!empty($errores['goles'])) echo "<span style=color:red>" . $errores['goles'] . "</span>"; ?><br><br>
    <button><a href="index.php">Menú</a></button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" name="aceptar">Insertar</button>
</form>
