<?php
require_once "../Controler/alquilerController.php";
require_once "../Controler/juegosController.php";
require_once '../model/Cliente.php';
require_once '../model/Juego.php';
require_once '../model/Alquiler.php';

session_start();

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST["salir"])) {
    session_unset();
    session_destroy();
    setcookie(session_name(), "", time() - 3600, "/");
    header("Location: login.php");
}

echo '<p style="color: green; font-size: 26px">Hola ' . $_SESSION['user']->nombre . "</p><br>";

if (isset($_POST['devolver'])) {
    alquilerController::devolver($_POST['id'], $_POST['cod']);
    $alq = new DateTime($_POST['fecha']);
    $dev = new DateTime();
    $diff = $alq->diff($dev);
    $req = (($diff->days > 7) ? ($diff->days - 7) : 0);
    echo "Juego devuelto correctamente<br>Coste alquiler:<br>Precio(1 semana): $_POST[precio]€<br>Recargo ($req dias): $req €<br>Total: " . $_POST['precio'] + $req . "€";
}

$alquileres = alquilerController::buscarAlquilados($_SESSION['user']->dni);

if ($alquileres == null) {
    echo 'No tiene juegos alquilados';
}
?>
<table border="1px solid black">
    <tr>
        <th>Carátula</th>
        <th>Nombre</th>
        <th>Consola</th>
        <th>Año</th>
        <th>Fecha alquiler</th>
        <th>Fecha prevista devolución</th>
        <th>Fecha devolución</th>
        <th>Precio</th>
        <th>Abonado</th>
    </tr>
    <?php
    foreach ($alquileres as $value) {
        $j = $value['juego'];
        $a = $value['alquiler'];
        ?>
        <tr>
            <td><img src="<?= $j->imagen; ?>" height="200"></td>
            <td><?= $j->nombre_juego; ?></td>
            <td><?= $j->nombre_consola; ?></td>
            <td><?= $j->anno; ?></td>
            <td><?= $a->Fecha_alquiler; ?></td>
            <td>
                <?php
                $pendiente = is_null($a->Fecha_devol);
                if ($pendiente) {
                    $prevista = new DateTime($a->Fecha_alquiler);
                    $prevista->modify("+7 days");
                    echo $prevista->format("d-m-Y");
                } else {
                    echo '-';
                }
                ?>
            </td>
            <td>
                <?php
                if ($pendiente) {
                    ?>
                    <form action="" method="POST">
                        <input type="hidden" name="id" value="<?php echo $a->id; ?>">
                        <input type="hidden" name="cod" value="<?php echo $j->codigo; ?>">
                        <input type="hidden" name="fecha" value="<?php echo $a->Fecha_alquiler; ?>">
                        <input type="hidden" name="precio" value="<?php echo $j->precio; ?>">
                        <input type="submit" name="devolver" value="Devolver">
                    </form>
                    <?php
                } else {
                    echo $a->Fecha_devol;
                }
                ?>
            </td>
            <td><?= $j->precio; ?></td>
            <td>
                <?php
                if ($pendiente) {
                    echo "-";
                } else {
                    $alq = new DateTime($a->Fecha_alquiler);
                    $dev = new DateTime($a->Fecha_devol);
                    $diff = $alq->diff($dev);
                    echo $j->precio + (($diff->days > 7) ? ($diff->days - 7) : 0);
                }
                ?>
            </td>
        </tr>
        <?php
    }
    ?>
</table>

<form action="" method="POST">
    <input type="submit" name="salir" value="Salir">
</form>