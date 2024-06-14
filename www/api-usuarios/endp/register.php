<?php
//require_once '../models/authModel.php';
require_once '../models/user.php';


if ( $_SERVER['REQUEST_METHOD'] == 'POST' ){
    /*
    1.- Creamos un objeto usuario vacío.
    2.- Recogemos todos los parámetros recibidos en variable php
    3.- Insertamos el nuevo usuario devolviendo el id.
    */

    $user = new User();
    $params = json_decode(file_get_contents('php://input'), true);  //obtenemos todos los parámetros en un array asociativo
    $id_new_user = $user->insert_user($params);
        
}else{
    User::error_register();
}

?>