<?php

if (isset($_POST['enviar'])) {
            echo "Datos recibidos<br>";
            echo "Nombre: " . $_POST['nombre'] . "<br>";
            echo "Apellidos: " . $_POST['apellidos'] . "<br>";
            echo "Número de matrícula: " . $_POST['numMat'] . "<br>";
            echo "Curso: " . $_POST['curso'] . "<br>";
            echo "Precio: " . $_POST['precio'] . "<br>";
            echo '<a href="datos1.php"><button>Ir al formulario</button></a>';
        } else {
            echo 'No se han enviado datos';
            echo '<a href="datos1.php"><button>Ir al formulario</button></a>';
}
