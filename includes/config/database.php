<?php 
// indicamos que esto retornara una coneccion de mysqli
function conectarDB() : mysqli{
    $db = mysqli_connect('localhost','root','','bienes_raices');
    // if($db){
    //     echo"Se conectó";
    // } else{
    //     echo "No Se Conectó";
    // }
    if(!$db){
        echo "No Se Pudo Conectar";
        exit;
    }
    return $db;

}
conectarDB();

?>