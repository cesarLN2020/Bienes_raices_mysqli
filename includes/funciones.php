<?php

require "app.php";

function incluirTemplate(string $nombre, bool  $inicio = false ){
    //echo TEMPLATES_URL . "/${nombre}.php";
    include TEMPLATES_URL . "/${nombre}.php";

}

function estaAutenticado() : bool{
    session_start();
     // echo "<pre>";
    // var_dump($_SESSION);
    // echo "</pre>";
    // del login biene definido true si la sesion esta activa
    $auth = $_SESSION['login'];
    if($auth){
        return true;
    }
    return false;
    // el segundo return se entiende como si fuera un else
    // y siguiendo las mejores practicas si returno algo el segundo ya no retorna

}

?>