<?php
session_start();

if (!isset($_COOKIE['PHPSESSID'])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST['modificar'])) {
    try {
        $conex = new mysqli("localhost", "dwes", "abc123.", "morilenses");
        $conex->set_charset("utf8mb4");
        $stmt = $conex->prepare("UPDATE usuario SET nombre = ?, apellidos = ?, direccion = ?, localidad = ?, username = ?, password = ?, colorletra = ?, colorfondo = ?, tipoletra = ?, tamanoletra = ? WHERE id = ?");
        $stmt->bind_param("sssssssssii", $_POST['nombre'], $_POST['apellidos'], $_POST['direccion'], $_POST['localidad'], $_POST['username'], password_hash($_POST['password'], PASSWORD_DEFAULT), $_POST['colorletra'], $_POST['colorfondo'], $_POST['tipoLetra'], $_POST['tamanoletra'], $_SESSION['id']);
        $stmt->execute();
        $stmt = $conex->prepare("SELECT * FROM usuario WHERE id = ?");
        $stmt->bind_param("s", $_SESSION['id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
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
        $stmt->close();
        $conex->close();
        header("Location: inicio.php");
        exit;
    } catch (mysqli_sql_exception $exc) {
        echo $exc->getMessage();
        echo $exc->getTraceAsString();
    }
}
?>
<body style="background: <?php echo "$_SESSION[colorfondo]"; ?>; color: <?php echo "$_SESSION[colorletra]"; ?>; font-size: <?php echo "$_SESSION[tamanoletra]"; ?>; font-family: <?php echo "$_SESSION[tipoletra]"; ?>;">

    <h1>Tus datos</h1>
    <form action="" method="post">
        <?php
        foreach ($_SESSION as $key => $value) {
            if ($key == "colorletra") {
                ?>
                <br>Color de letra: <select name="colorletra">;
                    <option value="#FF0000" <?php if ($value == "#FF0000") echo 'selected'; ?>>Rojo</option>
                    <option value="#0000FF" <?php if ($value == "#0000FF") echo 'selected'; ?>>azul</option>
                    <option value="#00FF00" <?php if ($value == "#00FF00") echo 'selected'; ?>>Verde</option>
                    <option value="#FFC0CB" <?php if ($value == "#FFC0CB") echo 'selected'; ?>>Rosa</option>
                </select><br>
                <?php
            } elseif ($key == "colorfondo") {
                ?>
                <br>Color de letra: <select name="colorfondo">;
                    <option value="#FF0000" <?php if ($value == "#FF0000") echo 'selected'; ?>>Rojo</option>
                    <option value="#0000FF" <?php if ($value == "#0000FF") echo 'selected'; ?>>azul</option>
                    <option value="#00FF00" <?php if ($value == "#00FF00") echo 'selected'; ?>>Verde</option>
                    <option value="#FFC0CB" <?php if ($value == "#FFC0CB") echo 'selected'; ?>>Rosa</option>
                </select><br>
                <?php
            } elseif ($key == "tipoletra") {
                ?>
                <br>Tipo de letra: <select name="tipoLetra">
                    <option value="Comic Sans" <?php if ($value == "Comic Sans") echo 'selected'; ?>>Comic Sans</option>
                    <option value="Times New Roman" <?php if ($value == "Times New Roman") echo 'selected'; ?>>Times New Roman</option>
                    <option value="Arial" <?php if ($value == "Arial") echo 'selected'; ?>>Arial</option>
                    <option value="Helvetica" <?php if ($value == "Helvetica") echo 'selected'; ?>>Helvetica</option>
                </select><br>
                <?php
            } elseif ($key == "tamanoletra") {
                ?>
                <br>Tamaño de letra: <select name="tamanoletra">
                    <option value="14" <?php if ($value == "14") echo 'selected'; ?>>14</option>
                    <option value="16" <?php if ($value == "16") echo 'selected'; ?>>16</option>
                    <option value="20" <?php if ($value == "20") echo 'selected'; ?>>20</option>
                    <option value="24" <?php if ($value == "24") echo 'selected'; ?>>24</option>
                </select><br>
                <?php
            } elseif ($key == "password") {
                echo "$key: <input type='text' name=$key><br>";
            } elseif ($key == "id") {
                echo "";
            } else {
                echo "$key: <input type='text' name=$key value=$value><br>";
            }
        }
        ?>
        <a href="inicio.php">Volver</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" name="modificar">Modificar</button>
    </form>
</body>
