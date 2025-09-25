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
        for ($index = 0; $index < 5; $index++) {
            echo "<tr>";
            for ($index1 = 0; $index1 < 7; $index1++) {
                echo "<td>$num";
                $num++;
            }
        }
        ?>
        </table>  
    </body>
</html>
