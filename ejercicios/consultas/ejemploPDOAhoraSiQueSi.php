<?php

try {
    $bd = 'mysql:host=localhost; dbname=dwes;charset=utf8mb4';
    $opciones = array(/* PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, */PDO::ATTR_CASE => PDO::CASE_LOWER);
    $conex = new PDO($bd, 'dwes', 'abc123.', $opciones);
    $conex->beginTransaction();
    $reg1 = $conex->exec("UPDATE stock SET unidades = 200 WHERE producto = '3DSNG'");
    $reg2 = $conex->exec("UPDATE stock SET unidades = 200 WHERE producto = 'ARCLPMP32GBN'");
    if ($reg1 === 0)
        echo 'No se ha actualizado el producto 1';
    if ($reg2 === 0)
        echo 'No se ha actualizado el producto 2';
    $conex->commit();
} catch (PDOException $ex) {
    $conex->rollBack();
    echo $ex->getMessage() . "<br>";
    print_r($ex->errorInfo);
}

try {
    $reult = $conex->query("SELECT * FROM producto");
    echo "Numero de registros devueltos: " . $result->rowCount() . "<br>";
    while ($result->fetchObject()) {
        
    }
} catch (PDOException $exc) {
    echo $exc->getTraceAsString();
}
