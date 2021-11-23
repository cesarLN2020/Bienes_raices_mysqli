<?php 

    //importar coneccion
    require 'includes/config/database.php';
    $db = conectarDB();

    //crear un email y password
    $email = "correo@correo.com";
    $password = "123456";

    // como hashear passwords
    // md5 ya no se recomienda para seguridad aunque asi era antes
    // var_dump(md5($password));
    
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // var_dump($passwordHash);

    //crear un query para agregar el usuario
    $query = "INSERT INTO usuarios (email, password) VALUES ('${email}','${passwordHash}')";            
    echo $query;

    // exit;
    //agregarlo a la BD
    mysqli_query($db, $query);

?>