<?php

$error = false;
$msg = "";
try {
    $conex = new mysqli("localhost", "dwes", "abc123.", "dwes");
    $conex->set_charset("utf8mb4");
    $stmt = $conex->prepare("INSERT INTO tienda (nombre,tlf) VALUES (?,?)");

    /*
      $tiendas = array('SUCURSAL4'=>'111111111','SUCURSAL5'=>'555555555','SUCURSAL6'=>'666666666');
      $nombre = "";
      $telf = "";
      $stmt->bind_param("ss",$nombre,$telf);
      foreach ($tiendas as $key => $value) {
      $nombre = $key;
      $telf = $value;
      $stmt->execute();
      echo $key." insertada<br>";
      }
     */
    
    $stmt->close();
    $stmt = $conex->prepare("SELECT * FROM tienda WHERE cod > ?");
    $cod = 3;
    $stmt->bind_param('i', $cod);
    $stmt->execute();
    
    //con bind_result
    echo '<br><h1>BIND_RESULT</h1><br>';
    $stmt->bind_result($codigo,$nombre,$telf);
    $stmt->store_result();
    if($stmt->num_rows())
        while($stmt->fetch()){
            echo 'Código: '.$codigo.'<br>';
            echo 'Nombre: '.$nombre.'<br>';
            echo 'Teléfono: '.$telf.'<br>';
        }
    
    //con get_result
    echo '<br><h1>GET_RESULT</h1><br>';
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc())
        foreach ($row as $key => $value) 
            echo $key.':'.$value.'<br>';
    
    
        
} catch (mysqli_sql_exception $exc) {
    $msg = "Fallo en la conexión";
    $error = true;
}