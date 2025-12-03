<?php
if(isset($_POST['enviar'])){
    var_dump($_FILES['foto']);
    echo "<br>Nombre original:" . $_FILES['foto']['name'] . "<br>";
    echo "<br>Nombre temporal:" . $_FILES['foto']['tmp_name'] . "<br>";
    echo "<br>Tamaño:" . $_FILES['foto']['size'] . "<br>";
    echo "<br>Tipo:" . $_FILES['foto']['type'] . "<br>";
    echo "<br>Error:" . $_FILES['foto']['error'] . "<br>";
    
    if(is_uploaded_file($_FILES['foto']['tmp_name'])){
        $fich = time()."-".$_FILES['foto']['name'];
        $ruta = "fotos/".$fich;
        move_uploaded_file($_FILES['foto']['tmp_name'], $ruta);
        try {
            $conex = new mysqli("localhost", "dwes", "abc123.", "ficheros");
            $conex->set_charset("utf8mb4");
            $conex->query("INSERT INTO foto (nombre, ruta) VALUES ('$_POST[nombre]', '$ruta')");
            $conex->close();
        } catch (mysqli_sql_exception $ex) {
            unlink($ruta);
            echo "<br>Código: " . $ex->getcode() . " Error: " . $ex->getMessage() . "<br>";
        }
    } else {
        echo "<br><b>Error:</b>" . $_FILES['imagen']['error'];
        if($_FILES['foto']['error'] == 1){
            echo "<br>El fichero supera el máximo de 40MB permitidos";
        }
    }
    
}

if(isset($_POST["mostrar"])){
    try {
            $conex = new mysqli("localhost", "dwes", "abc123.", "ficheros");
            $conex->set_charset("utf8mb4");
            $result = $conex->query("SELECT * FROM foto");
            if($result->num_rows){
                while ($row = $result->fetch_assoc()){
                    echo "Nombre: $row[nombre]<br>";
                    echo "<a href=$row[ruta] target=blank_><img src=$row[ruta] width=100 height=100></a><br>";
                    echo "=======================<br>";
                }
            }
        } catch (mysqli_sql_exception $ex) {
            echo "<br>Código: " . $ex->getcode() . " Error: " . $ex->getMessage() . "<br>";
        }
}

?>

<form action="" method="POST" enctype="multipart/form-data">
    Nombre: <input type="text" name="nombre"><br>
    Imagen: <input type="file" name="foto"><br>
    <input type="submit" name="enviar" value="Enviar"><br>
    <input type="submit" name="mostrar" value="Mostrar"><br>
</form>

