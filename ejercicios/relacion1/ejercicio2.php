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
        echo "<table>";
        for ($index = 0; $index < 10; $index++) {
            echo "<tr>";
            for ($index1 = 0; $index1 < 10; $index1++) {
                echo "<td>";
                $proto = rand(1, 100);
                $random = ($proto % 2 === 0) ? $proto + 1 : $proto;
                echo "$random";
            }
        }
        ?>
    </body>
</html>
