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
        $modulos["DAW"]["DWES"] = "Desarrollo de aplicaciones web en entorno servidor";
        $modulos["DAW"]["DWEC"] = "Desarrollo de aplicaciones web en entorno cliente";
        $modulos["DAW"]["DIW"] = "Diseño de interfaces web";
        $modulos["DAW"]["OPT"] = "Módulo optativo";
        $modulos["DAM"]["DI"] = "Diseño de interfaces";
        $modulos["DAM"]["ANDROID"] = "Desarrollo de aplicaciones Android";
        $modulos["DAM"]["WINDOWS"] = "Desarrollo de aplicaciones Android";
        $modulos["DAM"]["OPT"] = "Módulo optativo";

        // También se puede definir de la siguiente forma

        $moodulos = array("DAW" => array("DWES" => "Desarrollo...", "DWEC" => "Desarrollo...", "DIW" => "Desarrollo...", "OPT" => "Optativa..."),
            "DAM" => array("DI" => "Desarrollo...", "ANDROID" => "Desarrollo...", "WINDOWS" => "Desarrollo...", "OPT" => "Optativa..."));
        ?>
    </body>
</html>
