<?php

use models\authModel;

require_once '../models/authModel.php';

$auth = new authModel(); //Nos creamos un objeto de autenticación.
/*
 * si existe el usuario, devuelve el token
1.- leemos del fichero que nos manda el cliente y obtiene los parámetros convirtiendolos a variable php.En user, tengo un array asociativo con el email y password a loguearse
2.- Comprobamos si existe el usuario. En caso afirmativo, nos devuelve el token, pero actualizado.
*/
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = json_decode(file_get_contents('php://input'), true);
    $auth->sigIn($user);
}