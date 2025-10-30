<?php
$errores = [];
if (isset($_POST['aceptar'])) {
    if (empty($_POST['nombre']) || !preg_match('/[a-z]{1,30}/i', $_POST['nombre']))
        $errores['nombre'] = 'Solo texto, máximo 30';
    if (empty($_POST['DNI']) || !preg_match('/\d{8}[A-Z]{1}/', $_POST['DNI']))
        $errores['DNI'] = '8 dígitos con 1 letra mayúscula';
    if (empty($_POST['nac']) || !preg_match('/^\d{2}[-\/]\d{2}[-\/]\d{4}$/', $_POST['nac'])) {
        $errores['nac'] = 'Formato de fecha inválido (dd-mm-yyyy)';
    } else {
        $fecha = str_replace('/', '-', $_POST['nac']);
        list($day, $month, $year) = explode('-', $fecha);
        if (!checkdate($month, $day, $year)) {
            $errores['nac'] = 'La fecha no es válida';
        }
    }
    if (empty($_POST['email']) || !preg_match('/^[A-Za-z0-9._]+(@)[A-Za-z0-9]+(\.)(com|es|org)$/', $_POST['email']))
        $errores['email'] = 'El correo ha de ser (texto numero . _)@(texto numero).(com|es|org)';
    if (empty($_POST['edad']) || !preg_match('/\d+/', $_POST['edad']) || $_POST['edad'] < 18)
        $errores['edad'] = 'La edad han de ser sólo números y mayor de 18 años';
}
?>

<form action="" method="post">
    Nombre:<input type="text" name="nombre" value="<?php if (empty($errores['nombre']) && isset($_POST['nombre'])) echo $_POST['nombre'] ?>"> <?php if (!empty($errores['nombre'])) echo "<span style=color:red>" . $errores['nombre'] . "</span>"; ?><br><br>
    DNI:<input type="text" name="DNI" value="<?php if (empty($errores['DNI']) && isset($_POST['DNI'])) echo $_POST['DNI'] ?>"> <?php if (!empty($errores['DNI'])) echo "<span style=color:red>" . $errores['DNI'] . "</span>"; ?><br><br>
    Fecha Nacimiento:<input type="text" name="nac" value="<?php if (empty($errores['nac']) && isset($_POST['nac'])) echo $_POST['nac'] ?>"> <?php if (!empty($errores['nac'])) echo "<span style=color:red>" . $errores['nac'] . "</span>"; ?><br><br>
    Email:<input type="text" name="email" value="<?php if (empty($errores['email']) && isset($_POST['email'])) echo $_POST['email'] ?>"> <?php if (!empty($errores['email'])) echo "<span style=color:red>" . $errores['email'] . "</span>"; ?><br><br>
    Edad:<input type="text" name="edad" value="<?php if (empty($errores['edad']) && isset($_POST['edad'])) echo $_POST['edad'] ?>"> <?php if (!empty($errores['edad'])) echo "<span style=color:red>" . $errores['edad'] . "</span>"; ?><br><br>
    <button type="submit" name="aceptar">Aceptar</button>
</form>

