<form action="" method="post">
    DNI: <input type="text" name="dni"><br><br>
    Nombre: <input type="text" name="nombre"><br><br>
    Apellidos: <input type="text" name="apellidos"><br><br>
    Salario: <input type="text" name="salario"><br><br>
    Usuario: <input type="text" name="usuario"><br><br>
    Password: <input type="text" name="password"><br><br>
    Idiomas:<br>
    <input type="checkbox" name="idiomas[]" value="1">Español<br>
    <input type="checkbox" name="idiomas[]" value="2">Inglés<br>
    <input type="checkbox" name="idiomas[]" value="4">Aleman<br>
    <input type="checkbox" name="idiomas[]" value="8">Chino<br><br>
    Estudios:<br>
    <select multiple="" name="estudios[]">
        <option value="ESO">ESO</option>
        <option value="Bachillerato">Bachillerato</option>
        <option value="CFGM">CFGM</option>
        <option value="CFGS">CFGS</option>
    </select><br>
    <input type="submit" name="insertar" value="Insertar">
    <input type="submit" name="recuperar" value="Recuperar"><br>
</form>


<?php
if (isset($_POST['insertar'])) {
    try {
        $conex = new mysqli("localhost", "dwes", "abc123.", "empleados");
        $conex->set_charset("utf8mb4");
        $idio = 0;
        foreach ($_POST['idiomas'] as $value) {
            $idio += $value;
        }
        $estu = implode(",", $_POST['estudios']);
        $conex->query("INSERT INTO datos VALUES('$_POST[dni]', '$_POST[nombre]', '$_POST[apellidos]', $_POST[salario], '$_POST[usuario]', '$_POST[password]', $idio, '$estu')");
    } catch (mysqli_sql_exception $exc) {
        echo $exc->getTraceAsString();
        echo $exc->getMessage();
    }
}

if(isset($_POST['recuperar'])){
    try {
        $conex = new mysqli("localhost", "dwes", "abc123.", "empleados");
        $conex->set_charset("utf8mb4");
        $result = $conex->query("SELECT * FROM datos");
        if($result->num_rows){
            while($fila = $result->fetch_object()){
                echo "DNI: " . $fila->DNI . "<br>";
                echo "Nombre: " . $fila->Nombre . "<br>";
                echo "Apellidos: " . $fila->Apellidos . "<br>";
                echo "Salario: " . $fila->Salario . "<br>";
                echo "Idiomas: " . $fila->idiomas . "<br>";
                echo "Estudios: " . $fila->estudios . "<br>";
                echo '==============================<br><br>';
            }
        } else {
            echo 'NO hay registros';
        }
    } catch (mysqli_sql_exception $exc) {
        echo $exc->getTraceAsString();
        echo $exc->getMessage();
    }
}