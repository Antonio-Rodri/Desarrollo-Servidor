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
        <table border='1'>
        <?php
        $num = 1;
        $index = 0;
        while ($index < 5) {
            echo "<tr>";
            $index1 = 0;
            while ($index1 < 7) {
                echo "<td>$num";
                $num++;
                $index1++;
            }
            $index++;
        }
        echo "</table><br><table border='1'>";
        $num1 = 1;
        $index2 = 0;
        do {
            echo "<tr>";
            $index3 = 0;
            do {
                echo "<td>$num1";
                $num1++;
                $index3++;
            } while ($index3 < 7);
            $index2++;
        } while ($index2 < 5);
        ?>
        </table>
    </body>
</html>
