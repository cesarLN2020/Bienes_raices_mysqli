<?php

require '../../includes/funciones.php';

$auth = estaAutenticado();

// si no esta definida se redirecciona a otro lugar
if (!$auth) {
    header('Location: /');
}

// obtenemos el id, luego verificamos que sea tipo entero
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);
if (!$id) {
    header('Location: /admin');
}

// Base De Datos
require '../../includes/config/database.php';
$db = conectarDB();
// var_dump($db);
// echo "<pre>";
// var_dump($_SERVER);
// echo "</pre>";
// echo "<pre>";
// var_dump($_POST);
// echo "</pre>";
// Arreglo con mensajes de errores

// obtener los datos de la propiedad
$consulta = "SELECT * FROM propiedades WHERE id = ${id}";
$resultado = mysqli_query($db, $consulta);
$propiedad = mysqli_fetch_assoc($resultado);
// echo "<pre>"; var_dump($propiedad);echo "</pre>";

// consultar para obtener los vendedores
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);

$errores = [];

$titulo = $propiedad['titulo'];
$precio = $propiedad['precio'];
$descripcion = $propiedad['descripcion'];
$habitaciones = $propiedad['habitaciones'];
$wc = $propiedad['wc'];
$estacionamiento = $propiedad['estacionamiento'];
$vendedorId = $propiedad['vendedorId'];
// no se debe poner como tal la imagen ya que revela la ruta
// del servidor mejor poner la imagen que ya tiene
$imagenPropiedad = $propiedad['imagen'];
echo $imagenPropiedad;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "<pre>";
    // var_dump($_POST);
    // var_dump($_POST['titulo']);
    echo "</pre>";
    // exit;

    echo "<pre>";
    // var_dump($_FILES);
    echo "</pre>";

    // exit;

    // toma 2 parametros uno la base de datos y el otro la variable
    // esto nos lo podemos omitir con pdo o mysqli orientado a objetos 
    $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
    $precio = mysqli_real_escape_string($db, $_POST['precio']);
    $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
    $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
    $wc = mysqli_real_escape_string($db, $_POST['wc']);
    $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
    $vendedorId = mysqli_real_escape_string($db, $_POST['vendedorId']);
    $creado = date('Y/m/d');

    // asignar files hacia una variable
    $imagen = $_FILES['imagen'];

    //var_dump($imagen['name']);
    //exit;

    // validar campos vacios
    if (!$titulo) {
        $errores[] = "Debes a??adir un titulo";
    }
    if (!$precio) {
        $errores[] = "Debes a??adir un precio";
    }
    // strlen revisa cuantos caracteres trae
    if (strlen($descripcion) < 50) {
        $errores[] = "La descripcion debe tener al menos 50 caracteres";
    }
    if (!$habitaciones) {
        $errores[] = "Debes a??adir una habitacion";
    }
    if (!$wc) {
        $errores[] = "El numero de ba??os es obligatorio";
    }
    if (!$estacionamiento) {
        $errores[] = "El numero de estacionamientos es obligatorio";
    }
    if (!$vendedorId) {
        $errores[] = "Elige un vendedor";
    }

    // validar img por tama??o (1mb)
    $medida = 1000 * 1000;
    if ($imagen['size'] > $medida) {
        $errores[] = 'La imagen es muy grande';
    }

    // echo "<pre>";
    // var_dump($errores);
    // echo "</pre>";

    // el codigo se cancela y asi no sigue hacia la base de datos
    // exit;

    // revisar el arreglo de errores este vacio
    if (empty($errores)) {

        $ruta_imagen = "../imagenes/";

        // mkdir($ruta_imagen, 0777, true);

        // is_dir verifica si un directorio existe
        if (!is_dir($ruta_imagen)) {
            mkdir($ruta_imagen, 0777, true);
        }

        $nombreImagen = $imagenPropiedad;
        // echo "<pre>"; var_dump($propiedad);exit; "</pre>";
        if ($imagen['name']) {
            //eliminar la imagen previa
            // echo "si hay nueva img";
            // var_dump($nombreImagen);
            unlink($ruta_imagen . $propiedad['imagen']);
            /////// Generr un nombre unico
            $nombreImg = md5(uniqid(rand(), true)) . ".jpg";
            // var_dump($nombreImg);
            // toma la variable y el nombre, luego la ruta y luego el nombre para guardar
            // move_uploaded_file($imagen['tmp_name'], $ruta_imagen . "/archivo.jpg");
            move_uploaded_file($imagen['tmp_name'], $ruta_imagen . $nombreImg);
        } else {
            // echo "no hay nueva img";
            //mantiene el valor previo de la imagen 
            $nombreImagen = $propiedad['imagen'];
            // var_dump($nombreImagen);

// exit;
        }


        // exit;


        // INSERTAR EN LA BASE DE DATOS
        $query = "UPDATE propiedades SET titulo='${titulo}', precio='${precio}', imagen='${nombreImg}', descripcion='{$descripcion}', habitaciones={$habitaciones}, wc=${wc}, estacionamiento=${estacionamiento}, creado='${creado}', vendedorId=${vendedorId} WHERE id=${id}";

        // echo $query;
        // exit;

        $resultado = mysqli_query($db, $query);

        if ($resultado) {
            // echo "Insertado Correctamente";
            //redireccionar
            // header('Location: /admin?mensaje=Registrado Correctamente');
            header('Location: /admin?resultado=2');
        } else {
            echo "Error";
        }
    }
}

incluirTemplate('header');
?>
<main class="contenedor seccion">
    <h1>Titulo P??gina</h1>
    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Informaci??n Personal</legend>

            <label for="titulo">Titulo:</label>
            <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo; ?>">

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" value="<?php echo $precio; ?>">

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" name="imagen" accept="image/jpeg, image/png" value="ima.jpf">
            <img src="../imagenes/<?php echo $imagenPropiedad; ?>" class="imagen-small">
            <?php  //echo "<img src='../imagenes/". $imagenPropiedad."' class='imagen-small'>" 
            ?>

            <label for="descripcion">Descripci??n:</label>
            <textarea id="descripcion" name="descripcion"><?php echo $descripcion; ?></textarea>

        </fieldset>

        <fieldset>

            <legend>Informaci??n Propiedad</legend>

            <label for="habitaciones">Habitaciones:</label>
            <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo $habitaciones; ?>">

            <label for="wc">Ba??os:</label>
            <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9" value="<?php echo $wc; ?>">

            <label for="estacionamiento">Estacionamiento:</label>
            <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 3" min="1" max="9" value="<?php echo $estacionamiento; ?>">

        </fieldset>

        <fieldset>

            <legend>Vendedor</legend>

            <select id="vendedorId" name="vendedorId">
                <option value="">-- Seleccione --</option>
                <?php while ($row = mysqli_fetch_assoc($resultado)) : ?>
                    <option <?php echo $vendedorId === $row['id'] ? 'selected' : ''; ?> value="<?php echo $row['id']; ?>"> <?php echo $row['nombre'] . " " . $row['apellido']; ?> </option>
                <?php endwhile; ?>
                <!-- <option value="1">Cesar</option>
                    <option value="2">Alberto</option> -->
            </select>

        </fieldset>

        <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">

    </form>

</main>

<?php
incluirTemplate('footer');
?>