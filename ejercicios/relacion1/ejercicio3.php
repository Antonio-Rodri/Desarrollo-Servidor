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
        $n1 = 4;
        $n2 = 10;
        $n3 = 5;
        
        if($n1 > $n2)
            $max = $n1;
        else
            $max = $n2;
        
        if($n3 > $max)
            $max = $n3;
        
        echo "El número más grande es $max";
        ?>
    </body>
</html>
