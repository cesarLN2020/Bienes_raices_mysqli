<?php 

    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header('Location: /');
    }
    // var_dump($id);
    // importar BD
    require 'includes/config/database.php';
    $db = conectarDB();

    // Consultar a la Base
    $query = "SELECT * FROM propiedades WHERE id=${id}";
    // obtener resultados
    $resultado = mysqli_query($db, $query);

    // num rows aparece en 1 cuando existe el resultado y 0 si no existe
    // echo "<pre>";
    //     var_dump($resultado->num_rows);
    // echo "</pre>";

    if(!$resultado->num_rows){ 
        header('Location: /');
    }


    $propiedad = mysqli_fetch_assoc($resultado);

    require 'includes/funciones.php';
    incluirTemplate('header');
?>
    <main class="contenedor seccion contenido-centrado">
        <h1><?php echo $propiedad['titulo']; ?></h1>

       <img loading="lazy" src="../admin/imagenes/<?php echo $propiedad['imagen']; ?>" alt="imagen de la propiedad">

        <div class="resumen-propiedad">
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

            <p><?php echo $propiedad['descripcion']; ?></p>
            <!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus cumque doloremque, excepturi quod illum voluptatum amet nihil perspiciatis fugit? Illo vero molestias a est, cumque debitis reiciendis cupiditate ab quod maxime excepturi saepe explicabo quasi, praesentium, similique repellat dignissimos fugiat neque natus delectus qui rem minus. Ducimus, velit quis blanditiis eaque odio voluptatum rem explicabo accusamus unde reprehenderit nemo deserunt consequuntur impedit dolor eos ut architecto ex vitae vel. Nihil quaerat id distinctio saepe magni? Nesciunt molestiae quam ullam veniam laborum doloribus dolor corrupti eaque, repellendus ratione tempora enim distinctio reprehenderit sequi velit porro harum debitis nulla aperiam deleniti impedit!</p> -->
        </div>

    </main>

<?php 
mysqli_close($db);
include 'includes/templates/footer.php' ?>