<?php 

    // importar BD
    require 'includes/config/database.php';
    $db = conectarDB();

    // Consultar a la Base
    $query = "SELECT * FROM propiedades LIMIT ${limite}";

    // obtener resultados
    $resultado = mysqli_query($db, $query);

?>

<div class="contenedor-anuncios">
    <?php while($propiedad = mysqli_fetch_assoc($resultado)): ?>
    <div class="anuncio">

        <!-- <picture>
            <source srcset="build/img/anuncio1.jpg" type="image/webp">
            <source srcset="build/img/anuncio1.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/anuncio1.jpg" alt="anuncio">
        </picture> -->

        <img class="anuncio-img" loading="lazy" src="../admin/imagenes/<?php echo $propiedad['imagen']; ?>" alt="anuncio">

        <div class="contenido-anuncio">
            <h3><?php echo $propiedad['titulo']; ?></h3>            
            <p class="test"><?php echo $propiedad['descripcion']; ?></p>
            <p class="precio"><?php echo $propiedad['precio']; ?></p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                    <p><?php echo $propiedad['wc']; ?></p>
                </li>
                <li>
                    <img loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p><?php echo $propiedad['estacionamiento']; ?></p>
                </li>
                <li>
                    <img loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono dormitorio">
                    <p><?php echo $propiedad['habitaciones']; ?></p>
                </li>
            </ul>
            <a href="anuncio.php?id=<?php echo $propiedad['id']; ?>" class="boton-naranja-block">Ver Propiedad</a>
        </div>

    </div>
    <?php endwhile; ?>
</div>

<?php 
mysqli_close($db);
?>