<?php
require_once '../model/Empleado.php';
require_once '../model/Cliente.php';
require_once '../controler/clienteController.php';
require_once '../controler/cocheController.php';
require_once '../controler/tareaController.php';
require_once '../controler/empleadoController.php';
$errores = [];

session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST["cerrar"])) {
    session_unset();
    session_destroy();
    setcookie(session_name(), "", time() - 3600, "/");
    header("Location: login.php");
}

echo '<p style="color: green; font-size: 26px">Hola ' . $_SESSION['user']->nombrecompleto . " " . $_SESSION['user']->rol . "</p><br>";

if (isset($_POST['registrar'])) {
    if (!preg_match('/[0-9]{4}[A-Z]{3}$/', $_POST['matricula']))
        $errores['matricula'] = 'Formato 1234AAA';
    if (!preg_match('/\d{8}[A-Z]{1}/', $_POST['dni']))
        $errores['dni'] = '8 dígitos con 1 letra mayúscula';
    if (!preg_match('/\d{9}/', $_POST['telf']))
        $errores['telf'] = '9 dígitos';
    var_dump($_POST['mantenimiento']);
    if (is_uploaded_file($_FILES['foto']['tmp_name']) && $_FILES['foto']['type'] == "image/jpeg") {
        $fich = time() . "-" . $_FILES['foto']['name'];
        move_uploaded_file("../coches/" . $_FILES['foto']['tmp_name'], $fich);
        $coche = new Coche($_POST['matricula'], $_POST['marca'], $_POST['modelo'], $_POST['km'], $fich, $_POST['dni']);
        $cliente = new Cliente($_POST['dni'], $_POST['nombrecompleto'], $_POST['direccion'], $_POST['telf']);
        $tareas = [];
        foreach ($_POST['reparacion'] as $value) {
            echo $value;
        }
        foreach ($_POST['mantenimiento'] as $value) {
            $tareas[] = $value;
        }
        foreach ($_POST['electronica'] as $value) {
            $tareas[] = $value;
        }
        if (empty($tareas))
            $errores['multiple'] = "Hay que seleccionar al menos 1";
        if (empty($errores)) {
            if ($_SESSION['nuevo'] == true) {
                trabajoController::registrarInsertar($coche, $cliente, $tareas, $_POST['mecanico']);
            } else {
                trabajoController::registrarUpdate($coche, $cliente, $tareas, $_POST['mecanico']);
            }
        }
    } else {
        $errores['fichero'] = "El fichero ha de estar en formato .jpg";
    }
}

if (isset($_POST['buscar'])) {
    $cli = clienteController::buscar($_POST['dni']);
    if ($cli != false) {
        $_SESSION['cliente'] = $cli;
    } else {
        $errores['cliente'] = "No se encuentra al cliente en la BBDD";
        $_SESSION['cliente'] = null;
    }
}

if (isset($_POST["seleccionar"])) {
    $_SESSION['nuevo'] = null;
    $_SESSION['coche'] = cocheController::buscar($_POST['seleccionar']);
}

if (isset($_POST['nuevo'])) {
    $_SESSION['coche'] = true;
    $_SESSION['nuevo'] = true;
}
?>
<form action="" method="POST">
    <input type="submit" name="cerrar" value="Cerrar Sesion">
</form><br>

<form action="" method="POST">
    DNI Cliente: <input type="text" name="dni" value="<?php if (isset($_SESSION['cliente'])) echo $_SESSION['cliente']->dni; ?>">
    <input type="submit" name="buscar" value="Buscar">
</form>
<?php
if (!empty($errores['cliente'])) {
    echo "<span style=color:red>" . $errores['cliente'] . "</span><br>";
}

if (!isset($_POST['cliente'])) {
    ?>
    <table border="1px solid black">
        <tr>
            <th>Matrícula</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Operaciones</th>
        </tr>
        <?php
        $coch = cocheController::buscarCoches($_SESSION['cliente']->dni);
        foreach ($coch as $value) {
            ?>
            <tr>
                <td><?= $value->matricula ?></td>
                <td><?= $value->marca ?></td>
                <td><?= $value->modelo ?></td>
                <td><form action="" method="POST"><button type="submit" name="seleccionar" value="<?= $value->matricula ?>">Seleccionar</button></form></td>
            </tr>
            <?php
        }
        echo "<td></td><td></td><td></td><td><form action='' method='POST'><button type='submit' name='nuevo' value=''>Nuevo</button></form></td>";
        ?>
    </table>
    <?php
}

if (isset($_SESSION['coche'])) {
    ?>
    <h1>Datos</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        Matricula: <input type="text" name="matricula" value="<?= (is_null($_SESSION['nuevo'])) ? $_SESSION['coche']->matricula : "" ?>" required><?php
        if (!empty($errores['matricula'])) {
            echo "<span style=color:red>" . $errores['matricula'] . "</span><br>";
        }
        ?>
        Marca: <input type="text" name="marca" value="<?= (is_null($_SESSION['nuevo'])) ? $_SESSION['coche']->marca : "" ?>" required>
        Modelo: <input type="text" name="modelo" value="<?= (is_null($_SESSION['nuevo'])) ? $_SESSION['coche']->modelo : "" ?>" required>
        KM: <input type="text" name="km" value="<?= (is_null($_SESSION['nuevo'])) ? $_SESSION['coche']->km : "" ?>" required>
        <img src="../coches/<?= (is_null($_SESSION['nuevo'])) ? $_SESSION['coche']->foto : "" ?>" height="200">
        <input type="file" name="foto"><br>
        <?php
        if (!empty($errores['fichero'])) {
            echo "<span style=color:red>" . $errores['fichero'] . "</span><br>";
        }
        ?>
        DNI: <input type="text" name="dni" value="<?= $_SESSION['cliente']->dni ?>" required>
        <?php
        if (!empty($errores['dni'])) {
            echo "<span style=color:red>" . $errores['dni'] . "</span><br>";
        }
        ?>
        Nombre y Apellidos: <input type="text" name="nombrecompleto" value="<?= $_SESSION['cliente']->nombrecompleto ?>" required>
        Direccion: <input type="text" name="direccion" value="<?= $_SESSION['cliente']->direccion ?>" required>
        Telefono: <input type="text" name="telf" value="<?= $_SESSION['cliente']->telf ?>" required><br><?php
        if (!empty($errores['telf'])) {
            echo "<span style=color:red>" . $errores['telf'] . "</span><br>";
        }
        ?>


        <h1>Tareas</h1>
        <h2>Mantenimiento</h2>
        <select name="mantenimiento" multiple>
            <?php
            foreach (tareaController::buscarTarea("Mantenimiento") as $value) {
                echo "<option value='$value->id'>$value->descripcion</option>";
            }
            ?>
        </select><br>
        <h2>Reparación</h2>
        <select name="reparacion" multiple>
            <?php
            foreach (tareaController::buscarTarea("Reparacion") as $value) {
                echo "<option value='$value->id'>$value->descripcion</option>";
            }
            ?>
        </select><br>
        <h2>Electronica</h2>
        <select name="electronica" multiple>
            <?php
            foreach (tareaController::buscarTarea("Electronica") as $value) {
                echo "<option value='$value->id'>$value->descripcion</option>";
            }
            ?>
        </select><br>
        <?php
        if (!empty($errores['multiple'])) {
            echo "<span style=color:red>" . $errores['multiple'] . "</span><br>";
        }
        ?>
        Mecanico: <select name="mecanico">
            <?php
            foreach (empleadoController::buscarMecanicos() as $value) {
                echo "<option value='$value'>$value->nombrecompleto</option>";
            }
            ?>
        </select><br>
        <input type="submit" name="registrar" value="Registrar">
    </form>
    <?php
}
?>