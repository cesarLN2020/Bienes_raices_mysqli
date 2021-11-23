<?php 
session_start();
var_dump($_SESSION);

// se puede eliminar la sesion de varias maneras como:
// session_decode();
// session_destroy();
// o poner el arreglo a vacio que estabamos usando
$_SESSION = [];
header('Location: /');
?>