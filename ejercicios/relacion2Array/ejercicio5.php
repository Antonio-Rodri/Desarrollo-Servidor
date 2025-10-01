<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <table border="1">
        <?php
        $productos = array(
            "Prod1" => array("Nombre" => "Jamón", "Precio" => 199.95, "Cantidad" => 35),
            "Prod2" => array("Nombre" => "Coca-cola", "Precio" => 1.35, "Cantidad" => 28),
            "Prod3" => array("Nombre" => "Pan", "Precio" => 0.99, "Cantidad" => 53));

        echo $productos["Prod2"]["Nombre"]." ".$productos["Prod2"]["Precio"];
        
        echo "<br><tr><th></th>";
        foreach ($productos["Prod1"] as $key => $value) {
            echo "<th>".$key."</th>";
        }
        echo "</tr>";
        foreach ($productos as $key => $value) {
            echo "<tr>";
            echo "<th>".$key."</th>";
            foreach ($value as $key2 => $value2) {
                echo "<td>".$value2."</td>";
            }
            echo "</tr>";
        } 
        ?>
        </table>
    </body>
</html>
