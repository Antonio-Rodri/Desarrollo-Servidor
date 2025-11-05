<?php

try {
    $bd = 'mysql:host=localhost; dbname=dwes;charset=utf8mb4';
    $opciones = array(/* PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, */PDO::ATTR_CASE => PDO::CASE_LOWER);
    $conex = new PDO($bd, 'dwes', 'abc123.', $opciones);
    /* $conex->beginTransaction();
      $reg1 = $conex->exec("UPDATE stock SET unidades = 200 WHERE producto = '3DSNG'");
      $reg2 = $conex->exec("UPDATE stock SET unidades = 200 WHERE producto = 'ARCLPMP32GBN'");
      if ($reg1 === 0)
      echo 'No se ha actualizado el producto 1';
      if ($reg2 === 0)
      echo 'No se ha actualizado el producto 2';
      $conex->commit(); */
} catch (PDOException $ex) {
    $conex->rollBack();
    echo $ex->getMessage() . "<br>";
    print_r($ex->errorInfo);
}

/*
  try {
  $result = $conex->query("SELECT * FROM producto");
  echo "Numero de registros devueltos: " . $result->rowCount() . "<br>";
  while ($fila = $result->fetchObject()) {
  var_dump($fila);
  echo '<br>================================<br>';
  }
  } catch (PDOException $exc) {
  echo $exc->getTraceAsString();
  }
 */

/*
try {
    $menor = 100;
    $mayor = 200;
    $result = $conex->prepare("SELECT * FROM producto WHERE PVP > ? AND PVP < ?");
    $result->bindParam(1, $menor);
    $result->bindParam(2, $mayor);
    for ($index = 0; $index < 1000; $index += 100) {
        $result->execute();
        $menor += $index;
        $mayor += $index;
        while ($fila = $result->fetchObject()) {
            echo $fila->nombre_corto;
            echo '<br>================================<br>';
        }
    }
} catch (PDOException $exc) {
    echo $exc->getMessage();
    echo $exc->getTraceAsString();
}
*/

try {
    $menor = 100;
    $mayor = 200;
    $result = $conex->prepare("SELECT * FROM producto WHERE PVP > :pvp1 AND PVP < :pvp2");
    // $result->bindParam(":pvp1", $menor);
    // $result->bindParam(":pvp2", $mayor);
    for ($index = 0; $index < 1000; $index += 100) {
        // $result->execute();
        $result->execute(array(":pvp1"=>$menor, ":pvp2"=>$mayor));
        $menor += $index;
        $mayor += $index;
        while ($fila = $result->fetchObject()) {
            echo $fila->nombre_corto;
            echo '<br>================================<br>';
        }
    }
} catch (PDOException $exc) {
    echo $exc->getMessage();
    echo $exc->getTraceAsString();
}