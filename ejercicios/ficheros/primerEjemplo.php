<?php
if(isset($_POST['enviar'])){
    var_dump($_FILES['foto']);
    sleep(30);
    echo "<br>Nombre original:" . $_FILES['foto']['name'] . "<br>";
    echo "<br>Nombre temporal:" . $_FILES['foto']['tmp_name'] . "<br>";
    echo "<br>Tamaño:" . $_FILES['foto']['size'] . "<br>";
    echo "<br>Tipo:" . $_FILES['foto']['type'] . "<br>";
    echo "<br>Error:" . $_FILES['foto']['error'] . "<br>";
    
    if(is_uploaded_file($_FILES['foto']['tmp_name'])){
        echo 'hola';
    } else {
        echo "<br><b>Error:</b>" . $_FILES['imagen']['error'];
        if($_FILES['foto']['error'] == 1){
            echo "<br>El fichero supera el máximo de 40MB permitidos";
        }
    }
    
}

?>

<form action="" method="POST" enctype="multipart/form-data">
    Nombre: <input type="text" name="nombre"><br>
    Imagen: <input type="file" name="foto"><br>
    <input type="submit" name="enviar" value="Enviar"><br>
    <input type="submit" name="mostrar" value="Mostrar"><br>
</form>

