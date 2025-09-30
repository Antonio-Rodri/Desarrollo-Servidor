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
        <?php
        $persona = array("nombre" => "Juan", "edad" => 25, "ciudad" => "Madrid");
        echo $persona["nombre"].$persona["ciudad"];
        $persona["profesion"] = "Ingeniero";
        foreach ($persona as $key => $value) {
            echo $key." ".$value." ";
        }
        ?>
    </body>
</html>
