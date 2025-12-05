<?php

require_once '../model/Juego.php';
require_once '../controler/juegosController.php';

if (isset($_COOKIE['PHPSESSID']) && isset($_SESSION['user']) && $_SESSION['user']->tipo == "admin") {
    session_start();
} else {
    header("Location: index.php");
    exit;
}


