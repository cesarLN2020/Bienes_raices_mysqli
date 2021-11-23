<?php
require '../includes/funciones.php';

$auth = estaAutenticado();

// si no esta definida se redirecciona a otro lugar
if (!$auth) {
    header('Location: /');
}

// echo "<pre>";
// var_dump($_POST);
// echo "</pre>";

// importar la coneccion
include '../includes/config/database.php';
$db = conectarDB();

$query = "SELECT * FROM propiedades";
$result = mysqli_query($db, $query);


// para validar si el resultado esta o no antes se usaba isset
$resultado = isset($_GET['resultado']);
// ahora si no esta agrega null
$resultado = $_GET['resultado'] ?? null;
// exit;

// lee el servidor cuando se le precione en eliminar 
// y si llega post entonces crea la variable
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    // validamos que sea un bool asi no se podra tan facil 
    // inyectar codigo
    if ($id) {

        // elimina el archivo
        $query = "SELECT * FROM propiedades WHERE id=${id}";
        $resultado = mysqli_query($db, $query);
        $propiedad = mysqli_fetch_assoc($resultado);
        unlink('imagenes/' . $propiedad['imagen']);
        // elimina la propiedad
        // exit;
        $query = "DELETE FROM propiedades WHERE id=${id}";
        // echo $query;
        $resultado = mysqli_query($db, $query);
        if ($resultado) {
            header('Location: /admin?resultado=3');
        }
    }
}

incluirTemplate('header');

?>
<main class="contenedor seccion">
    <h1>Administrador de bienes raices</h1>
    <!-- intval convierte la variable en entero ya que el get trae string -->
    <?php if (intval($resultado) === 1) : ?>
        <p class="alerta exito">Anuncio Creado Correctamente</p>
    <?php elseif (intval($resultado) === 2) : ?>
        <p class="alerta exito">Anuncio Actualizado Correctamente</p>
    <?php elseif (intval($resultado) === 3) : ?>
        <p class="alerta exito">Anuncio Eliminado Correctamente</p>
    <?php endif; ?>
    <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>

    <table class="propiedades">
        <thead>
            <tr>
                <th>Id</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($propiedad = mysqli_fetch_assoc($result)) : ?>
                
                <tr>
                    <td> <?php echo $propiedad['id']; ?> </td>
                    <td> <?php echo $propiedad['titulo']; ?> </td>
                    <td><img src="../admin/imagenes/<?php echo $propiedad['imagen']; ?>" class="imagen-tabla" alt=""></td>
                    <td>$ <?php echo $propiedad['precio']; ?> </td>
                    <td>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $propiedad['id']; ?>">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="admin/propiedades/actualizar.php?id=<?php echo $propiedad['id']; ?>" class="boton-verde-block">Actualizar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</main>
<?php
// cerrar la coneccion
// mysqli_close($db);
incluirTemplate('footer');
?>