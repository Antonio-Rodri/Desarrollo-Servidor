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
        echo "Suma con for: ";
        $sumafor = 1;
        for ($index = 2; $index < 101; $index++) {
            $sumafor += $index;
        }
        echo "$sumafor<br>Suma con while: ";
      
        $sumawhile = 1;
        $indexw = 2;
        while ($indexw < 101) {
            $sumawhile += $indexw;
            $indexw++;
        }
        echo "$sumawhile<br>Suma con do-while: ";
        
        $sumadowhile = 1;
        $indexd = 2;
        do {
            $sumadowhile += $indexd;
            $indexd++;
        } while ($indexd < 101);
        echo $sumadowhile;
        ?>
    </body>
</html>
