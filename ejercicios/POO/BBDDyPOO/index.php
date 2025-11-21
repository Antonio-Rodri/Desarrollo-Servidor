<?php
require_once 'Conexion.php';
require_once 'Producto.php';

?>

<form action="" method="post">
    Codigo: <input type="text" name="cod"><br>
    Nombre: <input type="text" name="nom"><br>
    Precio: <input type="text" name="pre"><br>
    <input type="submit" name="insertar" value="Insertar">
    <input type="submit" name="buscar" value="Buscar">
    <input type="submit" name="mostrar" value="Mostrar">
</form>

<?php 

if(isset($_POST['insertar'])){
    $p = new Producto($_POST['cod'], $_POST['nom'], $_POST['pre']);
    if($p->insertar())
        echo "<br>EL usuario ha sido insertado correctamente<br>";
    else
        echo "<br>Fallo al insertar producto<br>";
}

if(isset($_POST['buscar'])){
    $p = Producto::buscar($_POST['cod']);
    if($p) echo $p;
    else echo "No se encuentra el producto seleccionado";
}

if(isset($_POST['mostrar'])){
    $productos = Producto::mostrar();
    foreach ($productos as $p) {
        echo "<br>Código: ".$p->codigo."<br>";
        echo "Nombre: ".$p->nombre."<br>";
        echo "Precio: ".$p->precio."<br>";
        echo "==========================";
    }
}





?>