<?php

use models\authModel;

require_once '../models/authModel.php';

$auth = new authModel(); //Nos creamos un objeto de autenticación.

/**
 * Si existe el usuario, devuelve el token.
 * Leemos del fichero que nos manda el cliente y obtiene los parámetros convirtiendolos a variable php.En user, tengo un array asociativo con el email y password a loguearse.
 * Comprobamos si existe el usuario.
 * En caso afirmativo, nos devuelve el token actualizado.
 */

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = json_decode(file_get_contents('php://input'), true);
    $auth->sigIn($user);
}