<h1>Buscar Jugador</h1>
<form action="" method="post">
    Buscar por:&nbsp;&nbsp;&nbsp;&nbsp;<select name="filtro">
        <option value="equipo">Equipo</option>
        <option value="posicion">Posición</option>
        <option value="dni">DNI</option>
    </select><br><br>
    Valor a buscar:&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="valor"><br><br>
    <button><a href="index.php">Menú</a></button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" name="buscar">Buscar</button>
</form>
<?php
if (isset($_POST['buscar'])) {
    try {
        $conex = new mysqli("localhost", "dwes", "abc123.", "jugadores");
        $conex->set_charset("utf8mb4");
        if ($_POST['filtro'] === 'posicion') {
            $sql = "SELECT * FROM jugador WHERE FIND_IN_SET(?, $_POST[filtro])";
        } else {
            $sql = "SELECT * FROM jugador WHERE $_POST[filtro] = ?";
        }
        $stmt = $conex->prepare($sql);
        $stmt->bind_param("s", $_POST['valor']);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            echo '<h1>Listado de jugador/es</h1>';
            while ($row = $result->fetch_assoc()) {
                foreach ($row as $key => $value)
                    echo $key . ' : ' . $value . '<br>';
                echo'---------------------------<br>';
            }
        } else {
            echo "No se ha encontrado ningún jugador con $_POST[filtro] $_POST[valor]";
        }
        $stmt->close();
        $conex->close();
    } catch (mysqli_sql_exception $exc) {
        echo $exc->getTraceAsString();
        echo $exc->getMessage();
    }
}
