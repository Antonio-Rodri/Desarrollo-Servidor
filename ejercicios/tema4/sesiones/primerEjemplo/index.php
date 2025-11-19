<?php
$errores = [];
if (isset($_COOKIE['PHPSESSID'])) {
    header("Location: inicio.php");
    exit;
}

if (isset($_POST['registrar'])) {
    header("Location: registro.php");
    exit;
}

if (!isset($_COOKIE['intentos'])) {
    setcookie("intentos", 2, 0, "/");
    $intentos = 3;
} else
    $intentos = $_COOKIE['intentos'];


if (isset($_POST['acceder'])) {
    try {
        $conex = new mysqli("localhost", "dwes", "abc123.", "morilenses");
        $conex->set_charset("utf8mb4");
        $stmt = $conex->prepare("SELECT * FROM usuario WHERE username = ?");
        $stmt->bind_param("s", $_POST['user']);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            $errores['login'] = "Usuario o contraseña no encontrado";
            setcookie("intentos", $intentos - 1, 0, "/");
        } else {
            $row = $result->fetch_assoc();
            if (password_verify($_POST['pass'], $row['password'])) {
                session_start();
                $_SESSION["id"] = $row['id'];
                $_SESSION["nombre"] = $row['nombre'];
                $_SESSION["apellidos"] = $row['apellidos'];
                $_SESSION["direccion"] = $row['direccion'];
                $_SESSION["localidad"] = $row['localidad'];
                $_SESSION["username"] = $row['username'];
                $_SESSION["password"] = $row['password'];
                $_SESSION["colorletra"] = $row['colorletra'];
                $_SESSION["colorfondo"] = $row['colorfondo'];
                $_SESSION["tipoletra"] = $row['tipoletra'];
                $_SESSION["tamanoletra"] = $row['tamanoletra'];
                header("Location: inicio.php");
                exit;
            } else {
                $errores['login'] = "Usuario o contraseña no encontrado";
                setcookie("intentos", $intentos - 1, 0, "/");
            }
        }
    } catch (mysqli_sql_exception $exc) {
        echo $exc->getMessage();
        echo $exc->getTraceAsString();
    }
}

if ($intentos <= 0) {
    header("Location: intentos.php");
    exit;
}

echo "Te quedan $intentos intentos";
?>

<form action="" method="post">
    Usuario: <input type="text" name="user"><br><br>
    Contraseña: <input type="text" name="pass"><br><br>
    <input type="submit" name="acceder" value="Acceder"><br>
    <input type="submit" name="registrar" value="Registrar"><br>
</form>

<?php
if (!empty($errores['login']))
    echo "<span style=color:red>" . $errores['login'] . "</span>";
?>
