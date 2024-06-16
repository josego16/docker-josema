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
        $input = file_get_contents('php://input');
        $params = json_decode($input, true);
        $user->insert_user($params);
        break;
    case 'DELETE':
        $id = $_GET['id']; //obtenemos el id del usuario a eliminar
        $user->delete_user($id);
        break;
    case 'PUT':
        break;
}