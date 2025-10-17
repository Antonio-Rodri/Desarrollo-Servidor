<?php

function generarMatrizAleatoria(int $filas, int $columnas): array {
    $matriz = [];
    for ($i = 0; $i < $filas; $i++) {
        for ($j = 0; $j < $columnas; $j++) {
            $matriz[$i][$j] = rand(0, 10);
        }
    }
    return $matriz;
}

function sumaFilas(array $matriz): array {
    $sumaFilas = [];
    foreach ($matriz as $i => $fila) {
        $sumaFilas[$i] = array_sum($fila);
    }
    return $sumaFilas;
}

function sumaColumnas(array $matriz): array {
    $sumaColumnas = [];
    foreach ($matriz as $fila) {
        foreach ($fila as $columna => $valor) {
            if (!isset($sumaColumnas[$columna])) {
                $sumaColumnas[$columna] = 0;
            }
            $sumaColumnas[$columna] += $valor;
        }
    }
    return $sumaColumnas;
}

function sumaFilasYColumnas(array $matriz): array {
    return [
        'filas' => sumaFilas($matriz),
        'columnas' => sumaColumnas($matriz)
    ];
}

function sumaDiagonalPrincipal(array $matriz): int {
    $suma = 0;
    $n = count($matriz);
    for ($i = 0; $i < $n; $i++) {
        if (isset($matriz[$i][$i])) {
            $suma += $matriz[$i][$i];
        }
    }
    return $suma;
}

function matrizTraspuesta(array $matriz): array {
    $traspuesta = [];
    foreach ($matriz as $i => $fila) {
        foreach ($fila as $j => $valor) {
            $traspuesta[$j][$i] = $valor;
        }
    }
    return $traspuesta;
}

function mostrarMatriz(array $matriz): void {
    echo "<table border='1'>";
    foreach ($matriz as $fila) {
        echo "<tr>";
        foreach ($fila as $valor) {
            echo "<td>$valor</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}

?>