<?php 
    require 'includes/funciones.php';
    incluirTemplate('header');
?>
    <main class="contenedor seccion">
        <h2 class="fw300 seccion">Casas y Depas en Venta</h2>
        <?php 
            $limite = 9;
            include 'includes/templates/anuncios.php';  
        ?>
    </main>

    <?php    
    incluirTemplate('footer');
?>