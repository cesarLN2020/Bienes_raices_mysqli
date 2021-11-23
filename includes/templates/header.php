<?php

// si la session existe
if (!isset($_SESSION)) {
    // iniciamos la sesion para acceder a la session
    session_start();
}
// si esta autenticado manda true si no false
$auth = $_SESSION['login'] ?? false;
// se puede usar false o null es igual

// var_dump($auth); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="/build/css/app.css">
</head>

<body>

    <!-- cabecera -->
    <!--si la variable de inicio es (?)true imprimir inicio si no(:) poner cadena vacia
    isset para ver si la variabel esta definida si no no se muestra nada
-->
    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">

                <a href="/">
                    <img src="/build/img/logo.svg" alt="Logotipo bienes raices">
                </a>

                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="icono menu">
                </div>

                <div class="derecha">
                    <img src="/build/img/dark-mode.svg" alt="" class="dark-mode-boton">
                    <nav id="navegacion" class="navegacion">
                        <a class="a_select" href="nosotros.php">Nosotros</a>
                        <a class="a_select" href="anuncios.php">Anuncios</a>
                        <a class="a_select" href="blog.php">Blog</a>
                        <a class="a_select" href="contacto.php">Contacto</a>
                        <!-- si auth esta como true entonces -->
                        <?php if($auth) : ?>
                            <a href="cerrar-sesion.php">Cerrar Sesión</a>
                        <?php endif; ?>
                    </nav>
                </div>
            </div>
            <?php
            // if($inicio){
            //     echo "<h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>";
            // }
            ?>
            <!-- hacer lo de arriba pero con un ternareo ?=verdaderro :=negativo -->
            <?php echo $inicio ? "<h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>" : ''; ?>
        </div>
    </header>