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
        $tabla = array(
            "Marketing" => array("Nombre" => "Pepe", "Apellidos" => "López", "Salario" => "1500", "Edad" => "35"),
            "Contabilidad" => array("Nombre" => "Juan", "Apellidos" => "Sánchez", "Salario" => "1750", "Edad" => "28"),
            "Ventas" => array("Nombre" => "Maria", "Apellidos" => "Carpio", "Salario" => "1675", "Edad" => "33"),
            "Informatica" => array("Nombre" => "Pedro", "Apellidos" => "Luna", "Salario" => "2100", "Edad" => "48"),
            "Direccion" => array("Nombre" => "Rosa", "Apellidos" => "Catalá", "Salario" => "5100", "Edad" => "53"));

        echo "<tr><th></th>";
        foreach ($tabla["Ventas"] as $key => $value) {
            echo "<th>".$key."</th>";
        }
        echo "</tr>";
        foreach ($tabla as $key => $value) {
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
