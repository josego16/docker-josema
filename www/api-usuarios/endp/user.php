<?php

use models\authModel;
use models\user;

require_once '../models/user.php';
require_once '../models/authModel.php';

$auth = new authModel();
$auth->verify_autentication_by_token(); //verificamos si está logueado
$user = new user();  //Creamos un objeto User

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $params = $_GET; //obtenemos los parámetros pasados por get.
        $user->get_users($params);
        break;
    case 'POST':
        $params = $_POST; //obtenemos los parámetros pasados por post.
        $user->insert_user($params);
        break;
    case 'DELETE':
    case 'PUT':
        break;
}