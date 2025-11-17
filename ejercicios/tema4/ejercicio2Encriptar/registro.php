<?php
$errores = [];
if (isset($_POST['login'])){
    header("Location: login.php");
    exit;
}

if (isset($_POST['registrar'])) {
    if (empty($_POST['nombre']) || !preg_match('/[a-z]{1,30}/i', $_POST['nombre']))
        $errores['nombre'] = 'Solo texto, máximo 30';
    if (empty($_POST['apellidos']) || !preg_match('/[a-z]{1,30}/i', $_POST['apellidos']))
        $errores['apellidos'] = 'Solo texto, máximo 30';
    if (empty($_POST['dni']) || !preg_match('/\d{8}[A-Z]{1}/', $_POST['dni'])) {
        $errores['dni'] = '8 dígitos con 1 letra mayúscula';
    } else {
        try {
            $conex = new mysqli("localhost", "dwes", "abc123.", "encriptar");
            $conex->set_charset("utf8mb4");
            $stmt = $conex->prepare("SELECT dni FROM usuario WHERE dni = '$_POST[dni]'");
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0)
                $errores['dni'] = "DNI no válido, ya exista en la Base de Datos";
            $stmt->close();
            $conex->close();
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
            echo $exc->getMessage();
        }
    }
    if (empty($_POST['email']) || !preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $_POST['email'])) {
        $errores['email'] = 'El correo ha de tener un formato aa1Aa@aaAAa.aa';
    } else {
        try {
            $conex = new mysqli("localhost", "dwes", "abc123.", "encriptar");
            $conex->set_charset("utf8mb4");
            $stmt = $conex->prepare("SELECT email FROM usuario WHERE email = '$_POST[email]'");
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0)
                $errores['email'] = "Email no válido, ya exista en la Base de Datos";
            $stmt->close();
            $conex->close();
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
            echo $exc->getMessage();
        }
    }

    if (empty($_POST['pass']) || !preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/', $_POST['pass']))
        $errores['pass'] = 'La contraseña ha de tener al menos una letra, un número y ser de mínimo 6 caracteres';

    if (empty($errores)) {
        try {
            $conex = new mysqli("localhost", "dwes", "abc123.", "encriptar");
            $conex->set_charset("utf8mb4");
            $stmt = $conex->prepare("INSERT INTO usuario VALUES (?,?,?,?,?)");
            $stmt->bind_param("sssss", $_POST['dni'], $_POST['nombre'], $_POST['apellidos'], $_POST['email'], password_hash($_POST['pass'], PASSWORD_DEFAULT));
            $stmt->execute();
            $stmt->close();
            $conex->close();
            header("Location: login.php?n=1");
            exit;
        } catch (mysqli_sql_exception $exc) {
            echo $exc->getMessage();
            echo $exc->getTraceAsString();
        }
    }
}
?>

<form action="" method="post">
    DNI: <input type="text" name="dni"><?php if (!empty($errores['dni'])) echo "<span style=color:red>" . $errores['dni'] . "</span>"; ?><br><br>
    Nombre: <input type="text" name="nombre"><?php if (!empty($errores['nombre'])) echo "<span style=color:red>" . $errores['nombre'] . "</span>"; ?><br><br>
    Apellidos: <input type="text" name="apellidos"><?php if (!empty($errores['apellidos'])) echo "<span style=color:red>" . $errores['apellidos'] . "</span>"; ?><br><br>
    Email: <input type="text" name="email"><?php if (!empty($errores['email'])) echo "<span style=color:red>" . $errores['email'] . "</span>"; ?><br><br>
    Contraseña: <input type="text" name="pass"><?php if (!empty($errores['pass'])) echo "<span style=color:red>" . $errores['pass'] . "</span>"; ?><br><br>

    <input type="submit" name="login" value="Login"><br>
    <input type="submit" name="registrar" value="Registrar"><br>
</form>