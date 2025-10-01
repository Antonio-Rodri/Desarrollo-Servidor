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
        $nombres = array(0 => "Ana", 1 => "Luis", 2 => "Carlos", 3 => "María");
        $nombresDelReves = array_reverse($nombres);
        foreach ($nombresDelReves as $key => $value) {
            echo $value . " ";
        }
        echo "<br>";
        echo in_array("Carlos", $nombres);
        echo "<br>";
        array_push($nombres, "Juan");
        foreach ($nombres as $key => $value) {
            echo $value . " ";
        }
        ?>
    </body>
</html>
