<?php

require '../../includes/funciones.php';

$auth = estaAutenticado();

// si no esta definida se redirecciona a otro lugar
if (!$auth) {
    header('Location: /');
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

// consultar para obtener los vendedores
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);

$errores = [];

$titulo = '';
$precio = '';
$descripcion = '';
$habitaciones = '';
$wc = '';
$estacionamiento = '';
$vendedorId = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "<pre>";
    // var_dump($_POST);
    // var_dump($_POST['titulo']);
    echo "</pre>";

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
        $errores[] = "Debes añadir un titulo";
    }
    if (!$precio) {
        $errores[] = "Debes añadir un precio";
    }
    // strlen revisa cuantos caracteres trae
    if (strlen($descripcion) < 50) {
        $errores[] = "La descripcion debe tener al menos 50 caracteres";
    }
    if (!$habitaciones) {
        $errores[] = "Debes añadir una habitacion";
    }
    if (!$wc) {
        $errores[] = "El numero de baños es obligatorio";
    }
    if (!$estacionamiento) {
        $errores[] = "El numero de estacionamientos es obligatorio";
    }
    if (!$vendedorId) {
        $errores[] = "Elige un vendedor";
    }
    if (!$imagen['name'] || $imagen['error']) {
        $errores[] = 'La imagen es Obligatoria';
    }

    // validar img por tamaño (1mb)
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

        /////// Generr un nombre unico
        $nombreImg = md5(uniqid(rand(), true)) . ".jpg";
        // var_dump($nombreImg);
        // toma la variable y el nombre, luego la ruta y luego el nombre para guardar
        // move_uploaded_file($imagen['tmp_name'], $ruta_imagen . "/archivo.jpg");
        move_uploaded_file($imagen['tmp_name'], $ruta_imagen . $nombreImg);

        // exit;


        // INSERTAR EN LA BASE DE DATOS
        $query = "INSERT INTO propiedades (titulo, precio, imagen,descripcion, habitaciones, wc, estacionamiento, creado, vendedorId) VALUES ('$titulo','$precio', '$nombreImg','$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$creado', '$vendedorId')";

        // echo $query;

        $resultado = mysqli_query($db, $query);

        if ($resultado) {
            // echo "Insertado Correctamente";
            //redireccionar
            // header('Location: /admin?mensaje=Registrado Correctamente');
            header('Location: /admin?resultado=1');
        } else {
            echo "Error";
        }
    }
}

incluirTemplate('header');
?>
<main class="contenedor seccion">
    <h1>Titulo Página</h1>
    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form action="crear.php" class="formulario" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Información Personal</legend>

            <label for="titulo">Titulo:</label>
            <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo; ?>">

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" value="<?php echo $precio; ?>">

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" name="imagen" accept="image/jpeg, image/png">

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion"><?php echo $descripcion; ?></textarea>

        </fieldset>

        <fieldset>

            <legend>Información Propiedad</legend>

            <label for="habitaciones">Habitaciones:</label>
            <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo $habitaciones; ?>">

            <label for="wc">Baños:</label>
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

        <input type="submit" value="Crear Propiedad" class="boton boton-verde">

    </form>

</main>

<?php
incluirTemplate('footer');
?>