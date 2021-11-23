<?php

require 'includes/config/database.php';
$db = conectarDB();

// si la app falla
$errores = [];

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";

    // RETORNARA SI ES UN EMAIL VALIDO
    // sanitiza la entrada de datos con real_scape
    $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
    // var_dump($email);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if(!$email){
        $errores[] = "El email es obligatorio";
    }
    if(!$password){
        $errores[] = "El Password es obligatorio";
    }
    // echo "<pre>";
    // var_dump($errores);
    // echo "</pre>";

    // revisar si el ususario existe
    if(empty($errores)){
        $query = "SELECT * FROM usuarios WHERE email = '${email}'";
        // guardamos el resultado en la variable
        $resultado = mysqli_query($db, $query);
        // var_dump($resultado);        
        // si el resultado existe
        if($resultado->num_rows){
            // revisar si el password es correcto
            // guardamos toda la informacion del registro encontrado
            $usuario = mysqli_fetch_assoc($resultado);
            // var_dump($usuario['password']);
            // verifica si el password es correcto o no 
            // toma dos valores el insertado en el form y el otro el de la base 
            $auth = password_verify($password, $usuario['password']); 
            // var_dump($auth);
            if($auth){
                //el usuario esta autenticado
                // crea una sesión o reanuda la actual en base a un identificador mediante una peticion get o post
                // o por un coockie
                session_start();

                // se le puede pasar lo que sea a la variable session una vez creada
                $_SESSION['usuario'] = $usuario['email'];
                $_SESSION['login'] = true;
                // llenar el arreglo de la sesion

                // si el usuario se registro entoncs
                header('Location: /admin');

                echo "<pre>";
                var_dump($_SESSION);
                echo "</pre>";
            }else{
                $errores[] = "¡La contraseña es incorrecta!";
            }
        }else{
            $errores[] = "El ususario no existe";
        }
    }

}


require 'includes/funciones.php';
incluirTemplate('header');
?>
<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesión</h1>

    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST">
        <fieldset>
            <legend>Email y Password</legend>

            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" placeholder="Tu Email" required>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Tu Contraseña" required>
        </fieldset>

        <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
    </form>
</main>
<?php
incluirTemplate('footer');
?>