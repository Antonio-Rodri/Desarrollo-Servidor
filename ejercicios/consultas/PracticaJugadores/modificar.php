<h1>Modificar Jugador</h1>
<form action="" method="post">
    Buscar jugador(DNI): <input type="text" name="dni"><br><br>
    <button><a href="index.php">Menú</a></button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" name="buscar">Buscar</button>
</form>
<?php
$posiciones = ['portero', 'defensa', 'centrocampista', 'delantero'];
if (isset($_POST['buscar'])) {
    try {
        $conex = new mysqli("localhost", "dwes", "abc123.", "jugadores");
        $conex->set_charset("utf8mb4");
        $stmt = $conex->prepare("SELECT * FROM jugador WHERE dni = ?");
        $stmt->bind_param("s", $_POST['dni']);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            ?>
            <h1>Datos del jugador</h1>
            <form action="" method="post">
                <?php
                while ($row = $result->fetch_assoc()) {
                    foreach ($row as $key => $value) {
                        if ($key == "dorsal") {
                            echo $key . ':<br><select name="dorsal">';
                            for ($index = 1; $index < 12; $index++) {
                                if ($index == $value) {
                                    echo "<option value='" . $index . "' selected>" . $index . "</option>";
                                } else {
                                    echo "<option value='" . $index . "'>" . $index . "</option>";
                                }
                            }
                            echo '</select><br>';
                        } elseif ($key == "posicion") {
                            echo $key . ':<br><select multiple="" name="posicion[]">';
                            foreach ($posiciones as $value2) {
                                if (in_array($value2, explode(",", $value))) {
                                    echo "<option value='" . $value2 . "' selected>" . $value2 . "</option>";
                                } else {
                                    echo "<option value='" . $value2 . "'>" . $value2 . "</option>";
                                }
                            }
                            echo '</select><br>';
                        } else {
                            echo "$key: <input type='text' name=$key value=$value><br>";
                        }
                    }
                }
                ?>
                <button type="submit" name="modificar">Modificar</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" name="cancelar">Cancelar</button>
            </form>
            <?php
        } else {
            echo "No se ha encontrado ningún jugador con DNI $_POST[dni]";
        }
        $stmt->close();
        $conex->close();
    } catch (mysqli_sql_exception $exc) {
        echo $exc->getTraceAsString();
        echo $exc->getMessage();
    }
}

if (isset($_POST['modificar'])) {
    try {
        $conex = new mysqli("localhost", "dwes", "abc123.", "jugadores");
        $conex->set_charset("utf8mb4");
        $stmt = $conex->prepare("UPDATE jugador SET nombre = ?, dorsal = ?, posicion = ?, equipo = ?, goles = ? WHERE dni = ?");
        $stmt->bind_param("sissis", $_POST['nombre'], $_POST['dorsal'], implode(",", $_POST['posicion']), $_POST['equipo'], $_POST['goles'], $_POST['dni']);
        $stmt->execute();
        $stmt->close();
        $conex->close();
        header("Location: index.php?n=2");
    } catch (mysqli_sql_exception $exc) {
        echo $exc->getTraceAsString();
        echo $exc->getMessage();
    }
}