<?php
$errores = [];
if(isset($_POST['registrar'])){
    header("Location: registro.php");
    exit;
}

if (isset($_POST['acceder'])) {
    try {
        $conex = new mysqli("localhost", "dwes", "abc123.", "encriptar");
        $conex->set_charset("utf8mb4");
        $stmt = $conex->prepare("SELECT * FROM usuario WHERE email = ?");
        $stmt->bind_param("s", $_POST['email']);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            $errores['login'] = "Usuario o contraseña no encontrado";
        } else {
            $row = $result->fetch_assoc();
            if (password_verify($_POST['pass'], $row['password'])) {
                setcookie("dni", $row['DNI']);
                setcookie("nombre", $row['nombre']);
                setcookie("apellidos", $row['apellidos']);
                setcookie("email", $row['email']);
                setcookie("pass", $_POST['pass']);
                setcookie("recordar", $_POST['check'], time() + 34560000);
                setcookie("registro", "true");
                header("Location: index.php");
            } else {
                $errores['login'] = "Usuario o contraseña no encontrado";
            }
        }
    } catch (mysqli_sql_exception $exc) {
        echo $exc->getMessage();
        echo $exc->getTraceAsString();
    }
}
if(isset($_GET['n']))
    if($_GET['n'] == 1)
        echo "<span style=color:green>Usuario insertado correctamente</span>";
?>

<form action="" method="post">
    Email: <input type="text" name="email" value="<?php if (isset($_COOKIE['email']) && isset($_COOKIE['recordar'])) echo "$_COOKIE[email]"; ?>"><br><br>
    Contraseña: <input type="text" name="pass" value="<?php if (isset($_COOKIE['pass']) && isset($_COOKIE['recordar'])) echo "$_COOKIE[pass]"; ?>"><br><br>
    Recordarme: <input type="checkbox" name="check" <?php echo (isset($_COOKIE['recordar'])) ? 'checked' : ''; ?>><br><br>
    <input type="submit" name="acceder" value="Acceder"><br>
    <input type="submit" name="registrar" value="Registrar"><br>
</form>

<?php
if (!empty($errores['login']))
    echo "<span style=color:red>" . $errores['login'] . "</span>";
?>
