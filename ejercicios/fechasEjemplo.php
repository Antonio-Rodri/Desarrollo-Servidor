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
        $d1 = 25;
        $m1 = 8;
        $y1 = 2028;
        $fecha = mktime(0,0,0,$m1,$d1,$y1);
        echo date("N, d m Y",$fecha);
        echo "<br>";
        $dia = date("N",$fecha);
        $dia_mes = date("d",$fecha);
        $mes = date("m",$fecha);
        $ano = date("Y",$fecha);
        
        switch ($dia) {
            case 1:
                $d = "Lunes, ";
                break;
            case 2:
                $d = "Martes, ";
                break;
            case 3:
                $d = "Miercoles, ";
                break;
            case 4:
                $d = "Jueves, ";
                break;
            case 5:
                $d = "Viernes, ";
                break;
            case 6:
                $d = "Sabado, ";
                break;
            case 7:
                $d = "Domingo, ";
                break;
            default:
                break;
        }
        
        switch ($mes) {
            case 1:
                $m = "enero de ";
                break;
            case 2:
                $m = "febrero de ";
                break;
            case 3:
                $m = "marzo de ";
                break;
            case 4:
                $m = "abril de ";
                break;
            case 5:
                $m = "mayo de ";
                break;
            case 6:
                $m = "junio de ";
                break;
            case 7:
                $m = "julio de ";
                break;
            case 8:
                $m = "agosto de ";
                break;
            case 9:
                $m = "septiembre de ";
                break;
            case 10:
                $m = "octubre de ";
                break;
            case 11:
                $m = "noviembre de ";
                break;
            case 12:
                $m = "diciembre de ";
                break;
            default:
                break;
        }
        
        echo $d.$dia_mes." de ".$m.$ano;
        ?>
    </body>
</html>
