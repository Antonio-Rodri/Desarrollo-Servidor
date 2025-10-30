<form action="" method="post">
    DNI: <input type="text" name="DNI"/><br>
    Nombre: <input type="text" name="nombre"/><br>
    Apellido: <input type="text" name="apellido"/><br>
    Salario: <input type="number" name="salario"/><br>
    Idiomas:<br>
    <input type="checkbox" name="idiomas[]" value="ingles"/>Inglés<br>
    <input type="checkbox" name="idiomas[]" value="frances"/>Francés<br>
    <input type="checkbox" name="idiomas[]" value="aleman"/>Aleman<br>
    <input type="checkbox" name="idiomas[]" value="chino"/>Chino<br>
    <input type="checkbox" name="idiomas[]" value="portugues"/>Portugués<br>
    <button type="submit" name="add">Añadir</button>
    <button type="submit" name="buscar">Buscar</button>
</form>

<?php
$msg = "";

if (isset($_POST['add'])) {
    try {
        try {
            $conex = new mysqli("localhost", "dwes", "abc123.", "empleados");
            $conex->set_charset("utf8mb4");
        } catch (mysqli_sql_exception $exc) {
            $msg = "Fallo en la conexión" . $exc->getMessage();
        }
        $conex->autocommit(false);
        $stmt = $conex->prepare("INSERT INTO datos (DNI,Nombre,Apellidos,Salario) VALUES (?,?,?,?)");
        $stmt->bind_param("sssi", $_POST['DNI'], $_POST['nombre'], $_POST['apellido'], $_POST['salario']);
        $stmt->execute();
        $stmt = $conex->prepare("INSERT INTO idiomas (DNI,idioma) VALUES (?,?)");
        $stmt->bind_param("ss", $_POST['DNI'], $idioma);
        foreach ($_POST['idiomas'] as $idioma)
            $stmt->execute();
        $conex->commit();
        $conex->autocommit(true);
        $msg = "Inserción realizada satisfactoriamente";
        $stmt->close();
        $conex->close();
    } catch (mysqli_sql_exception $exc) {
        $msg = "Fallo en la inserción" . $exc->getMessage();
        $conex->rollback();
        $conex->autocommit(true);
        $stmt->close();
        $conex->close();
    }
}

if (isset($_POST['buscar'])) {
    try {
        try {
            $conex = new mysqli("localhost", "dwes", "abc123.", "empleados");
            $conex->set_charset("utf8mb4");
        } catch (mysqli_sql_exception $exc) {
            $msg = "Fallo en la conexión" . $exc->getMessage();
        }
        $stmt = $conex->prepare("SELECT Nombre,Apellidos FROM idiomas join datos using(DNI) where idioma = ?");
        $stmt->bind_param("s", $idioma);
        foreach ($_POST['idiomas'] as $idioma) {
            $stmt->execute();
            $result = $stmt->get_result();
            echo "<h1>" . $idioma . "</h1>";
            while ($row = $result->fetch_object()) {
                echo "Nombre: " . $row->Nombre . " Apellido: " . $row->Apellidos . "<br>";
            }
        }
        $stmt->close();
        $conex->close();
    } catch (mysqli_sql_exception $exc) {
        $msg = "Fallo en la muestra de los idiomas" . $exc->getMessage();
        $stmt->close();
        $conex->close();
    }
}
echo $msg;
?>