<h1>Borrar Jugador</h1>
<form action="" method="post">
    Buscar jugador(DNI): <input type="text" name="dni"><br><br>
    <button><a href="index.php">Menú</a></button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" name="buscar">Buscar</button>
</form>
<?php
if (isset($_POST['buscar'])) {
    try {
        $conex = new mysqli("localhost", "dwes", "abc123.", "jugadores");
        $conex->set_charset("utf8mb4");
        $stmt = $conex->prepare("SELECT * FROM jugador WHERE dni = ?");
        $stmt->bind_param("s", $_POST['dni']);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            echo '<h1>Datos del jugador</h1>';
            while ($row = $result->fetch_assoc()) {
                foreach ($row as $key => $value)
                    echo $key . ' : ' . $value . '<br>';
            }
            ?>
            <br><form action="" method="post">
                <input type="hidden" name="dni" value="<?php echo $_POST['dni']; ?>">
                <button type="submit" name="borrar">Borrar</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" name="cancelar">Cancelar</button>
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

if (isset($_POST['borrar'])) {
    try {
        $conex = new mysqli("localhost", "dwes", "abc123.", "jugadores");
        $conex->set_charset("utf8mb4");
        $stmt = $conex->prepare("DELETE FROM jugador WHERE dni = ?");
        $stmt->bind_param("s", $_POST['dni']);
        $stmt->execute();
        $stmt->close();
        $conex->close();
        header("Location: index.php?n=3");
    } catch (mysqli_sql_exception $exc) {
        echo $exc->getTraceAsString();
        echo $exc->getMessage();
    }
}