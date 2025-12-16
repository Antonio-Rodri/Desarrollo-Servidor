<?php
require_once '../controler/empleadoController.php';
$errores = [];

if (isset($_POST['entrar'])) {
    try {
        $user = empleadoController::verificar($_POST["codigo"], $_POST['clave']);
        if ($user) {
            session_start();
            $_SESSION["user"] = $user;
            header("Location: menu.php");
            exit;
        } else {
            $errores['login'] = "Usuario o contraseña incorrecta";
        }
    } catch (mysqli_sql_exception $exc) {
        echo $exc->getMessage();
        echo $exc->getTraceAsString();
    }
}
?>

<form action="" method="post">
    Codigo: <input type="text" name="codigo"><br><br>
    Clave: <input type="text" name="clave"><br><br>
    <input type="submit" name="entrar" value="Entrar"><br>
</form>

<?php
if (!empty($errores['login']))
    echo "<span style=color:red>" . $errores['login'] . "</span>";
?>
