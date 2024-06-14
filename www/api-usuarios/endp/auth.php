<?php


require_once '../models/authModel.php';

$auth = new Auth(); //Nos creamos un objeto de autenticación.
/*

*/
switch ($_SERVER['REQUEST_METHOD']){
    case 'POST':
        /*
        1.- leemos del fichero que nos manda el cliente y obtiene los parámetros convirtiendolos a variable php.En user, tengo un array asociativo con el email y password a loguearse
        2.- Comprobamos si existe el usuario. En caso afirmativo, nos devuelve el token, pero actualizado.
        */
        $user = json_decode(file_get_contents('php://input'), true);
        $auth->sigIn($user);  //si existe el usuario, devuelve el token
    

}



?>