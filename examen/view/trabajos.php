<?php
require_once '../model/Empleado.php';
require_once '../controler/trabajoController.php';
require_once '../controler/tareaController.php';

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
?>
<form action="" method="POST">
    <input type="submit" name="cerrar" value="Cerrar Sesion">
</form><br>

<?php
if ($_SESSION['user']->rol == "mecanico") {
    ?>
    <table border="1px solid black">
        <tr>
            <th>Matrícula</th>
            <th>Tarea</th>
            <th>Estado</th>
            <th>Horas</th>
            <th>Botón</th>
        </tr>
        <?php
        $trabajos = trabajoController::trabajoMecanico($_SESSION['user']->codigo);
        foreach ($trabajos as $value) {
            ?>
            <tr>
                <td><?= $value->matricula ?></td>
                <td><?php tareaController::buscar($value->id_tarea)->descripcion ?></td>
                <td>
                    <select name="estado">
                        <option value="Pendiente" <?php if ($value->estado == "Pendiente") echo 'selected' ?>>Pendiente</option>
                        <option value="En Proceso" <?php if ($value->estado == "En Proceso") echo 'selected' ?>>En Proceso</option>
                        <option value="Completada" <?php if ($value->estado == "Completada") echo 'selected' ?>>Completada</option>
                        <option value="Facturada" <?php if ($value->estado == "Facturada") echo 'selected' ?>>Facturada</option>
                    </select>
                </td>
                <td><?= $value->horas ?></td>
                <td><form action="" method="POST"><button type="submit" name="seleccionar" value="<?= $value->matricula ?>">Seleccionar</button></form></td>
            </tr>
            <?php
        }
        ?>
    </table>
    <?php
}