<?php
require_once '../controler/clienteController.php';
$errores = [];

if (isset($_POST['inicio'])) {
    header("Location: index.php");
    exit;
}


if (isset($_POST['entrar'])) {
    try {
        $user = clienteController::verificar($_POST["dni"], $_POST['pass']);
        if ($user) {
            session_start();
            $_SESSION["user"] = $user;
            header("Location: index.php");
        } else {
            $errores['login'] = "Usuario o contraseña no encontrado";
        }
    } catch (mysqli_sql_exception $exc) {
        echo $exc->getMessage();
        echo $exc->getTraceAsString();
    }
}
?>

<form action="" method="post">
    Dni: <input type="text" name="dni"><br><br>
    Contraseña: <input type="text" name="pass"><br><br>
    <input type="submit" name="entrar" value="Entrar"><br>
    <input type="submit" name="inicio" value="Inicio"><br>
</form>

<?php
if (!empty($errores['login']))
    echo "<span style=color:red>" . $errores['login'] . "</span>";
?>
