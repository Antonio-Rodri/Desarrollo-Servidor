<?php
$errores = [];
$msg = "";
if (isset($_POST['enviar'])) {
    if(empty($_POST['marca']))
        $errores['marca'] = "Introduzca una marca";
    if(empty($_POST['plaza']))
        $errores['plaza'] = "El autobús debe de tener plazas";
    if (empty($_POST['matricula']) || !preg_match('/\d{3}[A-Z]{3}/', $_POST['matricula'])) {
        $errores['matricula'] = 'La matricula consta de 3 números con 3 letras mayúsculas';
    } else {
        try {
            $bd = 'mysql:host=localhost; dbname=autobuses;charset=utf8mb4';
            $opciones = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_CASE => PDO::CASE_LOWER);
            $conex = new PDO($bd, 'dwes', 'abc123.', $opciones);
            $result = $conex->query("SELECT matricula FROM autos");
            if ($result->rowCount() > 0) {
                while ($row = $result->fetchObject()) {
                    if ($row->matricula == $_POST['matricula']) {
                        $errores['matricula'] = "La matrícula ya existe";
                        break;
                    }
                }
            }
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
            echo $exc->getMessage();
        }
    }

    if (empty($errores['matricula'])) {
        try {
            $bd = 'mysql:host=localhost; dbname=autobuses;charset=utf8mb4';
            $opciones = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_CASE => PDO::CASE_LOWER);
            $conex = new PDO($bd, 'dwes', 'abc123.', $opciones);
            $result = $conex->prepare("INSERT INTO autos VALUES (:matricula, :marca, :plaza)");
            $result->execute(array("matricula" => $_POST['matricula'], "marca" => $_POST['marca'], "plaza" => $_POST['plaza']));
            $msg = "Autobús insertado correctamente";
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
            echo $exc->getMessage();
        }
    }
}
?>
<h1>Nuevo autobús</h1>
<form action="" method="post">
    Matrícula: <input type="text" name="matricula" value="<?php if (empty($msg) && isset($_POST['matricula'])) echo $_POST['matricula'] ?>"><?php if (!empty($errores['matricula'])) echo "<span style=color:red>" . $errores['matricula'] . "</span>"; ?><br><br>
    Marca: <input type="text" name="marca" value="<?php if (isset($_POST['marca'])) echo $_POST['marca'] ?>"><?php if (!empty($errores['marca'])) echo "<span style=color:red>" . $errores['marca'] . "</span>"; ?><br><br>
    Nº de plazas: <input type="number" name="plaza" value="<?php if (isset($_POST['plaza'])) echo $_POST['plaza'] ?>"><?php if (!empty($errores['plaza'])) echo "<span style=color:red>" . $errores['plaza'] . "</span>"; ?><br><br>
    <button><a href="index.php">Menú</a></button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" name="enviar">Añadir</button>
</form>
<?php
if (!empty($msg))
    echo $msg;
?>