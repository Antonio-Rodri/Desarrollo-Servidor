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
        $ano = 2028;
        $entre4 = ($ano % 4 == 0) ? true : false;
        $entre100 = ($ano % 100 == 0) ? true : false;
        $entre400 = ($ano % 400 == 0) ? true : false;

        if ($entre4 && !$entre100 || $entre4 && $entre100 && $entre400)
            echo "El año " . $ano . " es bisiesto";
        else
            echo "El año " . $ano . " NO es bisiesto";
        ?>
    </body>
</html>
