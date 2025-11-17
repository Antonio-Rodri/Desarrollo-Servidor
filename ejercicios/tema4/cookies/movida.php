<?php

setcookie("nombre", "pillao", -1);
echo "$_COOKIE[nombre] Si te fijas, aquí se muestra el valor 'Antonio' que es el"
        . " anterior pero al revisar el valor en el F12 aparece 'pillao' eso es "
        . "debido a que siempre la cookie se crea y modifica en el servidor pero"
        . " se almacena en el cliente y se envia mediante cabeceras; por lo tanto"
        . " si modificas la cookie en el cliente al intentar mostrarla en el "
        . "mismo momento no se va a mostrar el cambio, pues aún no ha llegado "
        . "al servidor";
