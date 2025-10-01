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
        <form action="ejercicio10.php" method="post">
            <label for="texto">Introduzca un texto:</label>
            <input type="text" id="texto" name="texto"><br><br>

            <input type="submit" value="Enviar">
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $array = str_split(strtolower($_POST["texto"]));
            foreach ($array as $value) {
                echo $value."<br>";
            }
            $count = 0;
            foreach ($array as $value) {
                if ($value === "a" || $value === "e" || $value === "i" || $value === "o" || $value === "u") {
                    $count++;
                }
            }
            echo "La cadena tiene: ".$count." vocales";
        }
        ?>
    </body>
</html>
