<?php

use models\user;

require_once '../models/user.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    /**
     * Creamos un objeto usuario vacío.
     * Recogemos todos los parámetros recibidos en variable php
     * Insertamos el nuevo usuario devolviendo el id.
     */

    $user = new user();
    $params = json_decode(file_get_contents('php://input'), true);  //obtenemos todos los parámetros en un array asociativo
    $id_new_user = $user->insert_user($params);

} else {
    user::error_register();
}