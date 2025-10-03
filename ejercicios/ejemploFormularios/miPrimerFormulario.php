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
        <form action="procesa.php" method="post">
            Nombre: <input type="text" name="nombre"/><br>
            Apellidos: <input type="text" name="apellidos"/><br>
            Modulos:<br>
            <input type="checkbox" name="modulos[]" value="DWES"/>Desarrollo web de entorno servidor
            <input type="checkbox" name="modulos[]" value="DWEC"/>Desarrollo web de entorno cliente
            <input type="checkbox" name="modulos[]" value="DIW"/>Diseño de interfaces web
            <button type="submit" name="enviar">Enviar</button><br>
            <a href="opciones.php?n=1">Opcion 1</a><br>
            <a href="opciones.php?n=2">Opcion 2</a><br>
            <a href="opciones.php?n=3">Opcion 3</a><br>
            <br>
            <?php
            var_dump($_GET);
            ?>
        </form>
    </body>
</html>
