<?php

$errores = [];

if (isset($_POST['enviar'])) {
    $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
    try {
        $conex = new mysqli("localhost", "dwes", "abc123.", "encriptar");
        $conex->set_charset("utf8mb4");
        $result = $conex->query("SELECT * FROM usuario WHERE email = '$_POST[email]'");
        
        if ($result->num_rows == 0) {
            $errores['email'] = "Su email no se encuentra en la BBDD";
        } else {
            $row = $result->fetch_assoc();
            if(password_verify($_POST['pass'], password_hash($row['password'], PASSWORD_DEFAULT))){
                setcookie("dni", $row['DNI']);
                setcookie("nombre", $row['nombre']);
                setcookie("apellidos", $row['apellidos']);
                header("Location: index.php"); 
            } else {
                $errores['pass'] = "Contraseña incorrecta";
            }
        }
    } catch (mysqli_sql_exception $exc) {
        echo $exc->getMessage();
        echo $exc->getTraceAsString();
    }
}

?>

<form action="" method="post">
    Email: <input type="text" name="email" value="<?php if(isset($_POST['enviar']) && empty($errores['email'])) echo "$_POST[email]"; ?>"> <?php if(!empty($errores['email'])) echo "<span style=color:red>" . $errores['email'] . "</span>"; ?><br><br>
    Contraseña: <input type="text" name="pass" value="<?php if(isset($_POST['enviar']) && empty($errores['pass'])) echo "$_POST[pass]"; ?>"> <?php if(!empty($errores['pass'])) echo "<span style=color:red>" . $errores['pass'] . "</span>"; ?><br><br>
    <input type="submit" name="enviar" value="Entrar"><br>
</form>
