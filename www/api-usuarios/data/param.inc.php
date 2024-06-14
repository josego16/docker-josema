<?php
define('DB_HOST', 'db-my_app_user'); //sólo para contenedores.    
//define('DB_HOST', '127.0.0.1');  //para xampp

//define('DB_USER', 'root');  //para xampp, el usurio es santi
define('DB_USER', 'santi');
define('DB_PASSWORD', 'santi');
define('DB_PORT', '3306');
define('DB_NAME', 'my_app_user');
define('DB_TABLE_USER', 'usuarios');

define('KEY', 'clave_secreta_muy_discreta');

define('CODE_RESPONSE_NO_LOGIN', 400);
define('CODE_RESPONSE_METHOD', 401);
define('CODE_RESPONSE_ERROR_LOGIN', 403);
define('CODE_RESPONSE_ERROR_PERMISSION', 403);
define('CODE_LOGIN_OK', 201);
define('CODE_REGISTER_OK', 202);
define('CODE_ERROR_REGISTER', 403);
define('CODE_DATA_OK', 203);


define('DETAILS_NO_LOGIN', 'Los campos password y email son obligatorios');
define('DETAILS_ERROR_LOGIN', 'Los campos password/email son incorrectos');
define('DETAILS_PERMISSION', 'Usted no tiene permisos para esta solicitud');
define('DETAILS_ERROR_METHOD', 'ERROR METHOD');
define('DETAILS_ERROR_REGISTER', 'ha ocurrido algún error al registrar los datos');


define('DETAILS_NO_EMAIL_FIELD', 'El campo email es obligatorio');
define('DETAILS_NO_NAME_FIELD', 'El campo nombre es obligatorio');
define('DETAILS_NO_PASSWORD_FIELD', 'El campo password es obligatorio');

?>