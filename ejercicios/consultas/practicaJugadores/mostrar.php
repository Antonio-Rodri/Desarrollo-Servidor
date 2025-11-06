<h1>Lista de Jugadores</h1>
<?php
try {
    $conex = new mysqli("localhost", "dwes", "abc123.", "jugadores");
    $conex->set_charset("utf8mb4");
    $stmt = $conex->prepare("SELECT * FROM jugador");
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            foreach ($row as $key => $value)
                echo $key . ' : ' . $value . '<br>';
            echo'---------------------------<br>';
        }
    } else {
        echo 'No hay jugadores en la BBDD<br><br>';
    }
    $stmt->close();
    $conex->close();
    echo '<button><a href="index.php">Menú</a></button>';
} catch (mysqli_sql_exception $exc) {
    echo $exc->getTraceAsString();
    echo $exc->getMessage();
}

