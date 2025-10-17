<?php
require_once 'funciones.php';
if (!isset($_GET['opcion'])) {
    if (isset($_POST['enviar'])) {
        if (empty($_POST['filas']) || !is_numeric($_POST['filas']) || $_POST['filas'] < 1)
            $errores['filas'] = "Debe de haber un número superior a 1";
        if (empty($_POST['columnas']) || !is_numeric($_POST['columnas']) || $_POST['columnas'] < 1)
            $errores['columnas'] = "Debe de haber un número superior a 1";
        if ($_GET['opcion'] === 'cuatro' && $_POST['filas'] != $_POST['columnas'])
            $errores['cuad'] = "La matriz ha de ser cuadrada";
    }
    if (isset($_POST['enviar']) && empty($errores)) {
        $matrix = generarMatrizAleatoria($_POST['filas'], $_POST['columnas']);
        mostrarMatriz($matrix);
        switch ($_GET['opcion']) {
            case "uno":
                echo 'La suma de sus filas es: ' . implode(" ,", sumaFilas($matrix));
                break;
            case "dos":
                echo 'La suma de sus columnas es: ' . implode(" ,", sumaColumnas($matrix));
                break;
            case "tres":
                echo 'La suma de sus filas y columnas es: ';
                $fyc = sumaFilasYColumnas($matrix);
                echo implode(" ,", $fyc['filas']) . ' filas y ' . implode(" ,", $fyc['columnas']) . ' columnas';
                break;
            case "cuatro":
                echo 'La suma de sus diagonal principal es: ' . sumaDiagonalPrincipal($matrix);
                break;
            case "cinco":
                echo 'Su traspuesta es: <br>';
                mostrarMatriz(matrizTraspuesta($matrix));
                break;
            default:
                echo 'Ha habido un error';
                break;
        }
        echo '<br><a href="index.php">Volver</a>';
    } else {
        ?>
        <form action="" method="post">
            Filas: <input type="number" name="filas" value="<?php if (empty($errores['filas']) && isset($_POST['filas'])) echo $_POST['filas'] ?>"/> <?php if (!empty($errores['filas'])) echo "<span style=color:red>" . $errores['filas'] . "</span>"; ?><br>
            Columnas: <input type="number" name="columnas" value="<?php if (empty($errores['columnas']) && isset($_POST['columnas'])) echo $_POST['columnas'] ?>"/><?php if (!empty($errores['columnas'])) echo "<span style=color:red>" . $errores['columnas'] . "</span>"; ?><br>
            <?php if (isset($errores['cuad'])) echo "<span style=color:red>" . $errores['cuad'] . "</span>"; ?><br>
            <button type="submit" name="enviar">Enviar</button><br><br>
            <a href="index.php">Volver</a><br>
        </form>
        <?php
    }
} else
    header("Location: index.php");
?>
</body>
</html>

