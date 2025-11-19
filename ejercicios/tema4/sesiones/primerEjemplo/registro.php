<?php
$errores = [];
if (isset($_POST['cancelar'])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST['registrar'])) {
    if (empty($_POST['nombre']))
        $errores['nombre'] = 'El nombre no puede estar vacío';
    if (empty($_POST['apellidos']))
        $errores['apellidos'] = 'El apellido no puede estar vacío';
    if (empty($_POST['direccion']))
        $errores['direccion'] = 'La direcció no puede estar vacía';
    if (empty($_POST['localidad']))
        $errores['localidad'] = 'La localidad no puede estar vacía';
    if (empty($_POST['pass'])) {
        $errores['pass'] = 'La contraseña no puede estar vacía';
    } elseif (empty($_POST['repPass'])) {
        $errores['repPass'] = 'Repite la contraseña';
    } elseif ($_POST['pass'] != $_POST['repPass']) {
        $errores['repPass'] = 'Las contraseñas han de coincidir';
    }
    if (empty($_POST['username'])) {
        $errores['username'] = 'Introduzca un nombre de usuario';
    } else {
        try {
            $conex = new mysqli("localhost", "dwes", "abc123.", "morilenses");
            $conex->set_charset("utf8mb4");
            $stmt = $conex->prepare("SELECT username FROM usuario WHERE username = '$_POST[username]'");
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0)
                $errores['username'] = "Nombre de usuario no válido, ya exista en la Base de Datos";
            $stmt->close();
            $conex->close();
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
            echo $exc->getMessage();
        }
    }

    if (empty($errores)) {
        try {
            $conex = new mysqli("localhost", "dwes", "abc123.", "morilenses");
            $conex->set_charset("utf8mb4");
            $stmt = $conex->prepare("INSERT INTO usuario (nombre, apellidos, direccion, localidad, username, password, colorletra, colorfondo, tipoletra, tamanoletra) VALUES (?,?,?,?,?,?,?,?,?,?)");
            $stmt->bind_param("sssssssssi", $_POST['nombre'], $_POST['apellidos'], $_POST['direccion'], $_POST['localidad'], $_POST['username'], password_hash($_POST['pass'], PASSWORD_DEFAULT), $_POST['colLetra'], $_POST['colFondo'], $_POST['tipoLetra'], $_POST['tamLetra']);
            $stmt->execute();
            $stmt->close();
            $conex->close();
            header("Location: index.php");
            exit;
        } catch (mysqli_sql_exception $exc) {
            echo $exc->getMessage();
            echo $exc->getTraceAsString();
        }
    }
}
?>

<form action="" method="post">
    Nombre: <input type="text" name="nombre"><?php if (!empty($errores['nombre'])) echo "<span style=color:red>" . $errores['nombre'] . "</span>"; ?><br><br>
    Apellidos: <input type="text" name="apellidos"><?php if (!empty($errores['apellidos'])) echo "<span style=color:red>" . $errores['apellidos'] . "</span>"; ?><br><br>
    Dirección: <input type="text" name="direccion"><?php if (!empty($errores['direccion'])) echo "<span style=color:red>" . $errores['direccion'] . "</span>"; ?><br><br>
    Localidad: <input type="text" name="localidad"><?php if (!empty($errores['localidad'])) echo "<span style=color:red>" . $errores['localidad'] . "</span>"; ?><br><br>
    Username: <input type="text" name="username"><?php if (!empty($errores['username'])) echo "<span style=color:red>" . $errores['username'] . "</span>"; ?><br><br>
    Contraseña: <input type="text" name="pass"><?php if (!empty($errores['pass'])) echo "<span style=color:red>" . $errores['pass'] . "</span>"; ?><br><br>
    Repetir Contraseña: <input type="text" name="repPass"><?php if (!empty($errores['repPass'])) echo "<span style=color:red>" . $errores['repPass'] . "</span>"; ?><br><br>
    Color de letra:<select name="colLetra">
        <option value="#FF0000">Rojo</option>
        <option value="#0000FF">azul</option>
        <option value="#00FF00">Verde</option>
        <option value="#FFC0CB">Rosa</option>
    </select><br><br>
    Color de fondo:<select name="colFondo">
        <option value="#FF0000">Rojo</option>
        <option value="#0000FF">azul</option>
        <option value="#00FF00">Verde</option>
        <option value="#FFC0CB">Rosa</option>
    </select><br><br>
    Tipo de letra:<select name="tipoLetra">
        <option value="Comic Sans">Comic Sans</option>
        <option value="Times New Roman">Times New Roman</option>
        <option value="Arial">Arial</option>
        <option value="Helvetica">Helvetica</option>
    </select><br><br>
    Tamaño de letra<select name="tamLetra">
        <option value="14">14</option>
        <option value="16">16</option>
        <option value="20">20</option>
        <option value="24">24</option>
    </select><br><br>

    <input type="submit" name="cancelar" value="Cancelar"><br>
    <input type="submit" name="registrar" value="Registrar"><br>
</form>