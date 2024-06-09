<?php

namespace models;
require_once '../data/authData.php';
require_once '../responses/response.php';
require_once '../jwt/JWT.php';

use data\authData;
use Exception;
use Firebase\JWT\JWT;
use responses\response;
use Throwable;

class authModel extends AuthData
{
    private string $id_user = '';
    private int $admin = 0;

    public function sigIn($user)
    {
        if (empty($user['email']) || empty($user['password'])) {
            response::result(CODE_RESPONSE_NO_LOGIN, response::prepared_result('error', DETAILS_NO_LOGIN));
            exit;
        }
        //en este punto, hemos pasado correctamente el email y password
        $user_hash = hash('sha256', $user['password']);  //encriptamos la password.

        $user = parent::login_db($user['email'], $user_hash);  //logueamos al usuario.

        //si no hay un usuario, informamos
        if (sizeof($user) == 0) {
            response::result(CODE_RESPONSE_ERROR_LOGIN, response::prepared_result('error', DETAILS_ERROR_LOGIN));
            exit;
        }

        //recuperamos el único registro que hay y seteamos el id
        $user = $user[0];
        $id_user = $user['id'];
        $token = response::build_token($id_user, $user['email']);
        $jwt = JWT::encode($token, KEY);
        //echo "token generado es $jwt"; exit;
        parent::update_db($id_user, $jwt);
        //aquí se retormna $jwt y se debe devolver al fronted.
        response::result(CODE_LOGIN_OK, response:: prepared_result_token('ok', $jwt));

        return $jwt;

    }

    public function verify_autentication_by_token()
    {
        //comprobamos si nos pasa una api-key
        if (!isset($_SERVER['HTTP_API_KEY'])) {
            // echo "No s eha pasado la apikey";
            response::result(CODE_RESPONSE_ERROR_PERMISSION, response::prepared_result('error', DETAILS_PERMISSION));
            exit;
        }

        //recuperamos la api-key. Sacamos su id, comprobamos si coincide la key en el registro.
        $jwt = $_SERVER['HTTP_API_KEY'];
        try {
            $data_user = JWT::decode($jwt, KEY, array('HS256'));  //decodificamos el token y sacamos el id y email.
            $id = $data_user->data->id;     //necesitamos el id
            //echo "El id decodificdo es $id"; exit;
            $user_token = parent::get_token_by_id_db($id);  //queremos devolver el token grabado en la BBDD de ese ID, para ver si coincide
            // echo $user_token[0];exit;
            if ($user_token != $jwt) {
                throw new Exception();  //lanzamos la excepción para que se capture debajo.
            }

        } catch (Throwable $th) {
            response::result(CODE_RESPONSE_ERROR_PERMISSION, response::prepared_result('error', DETAILS_PERMISSION));
            exit;
        }
        //si llegamos aquí, es porque no ha saltado ninguna excepción y por tanto los token coinciden.
    }

    public function is_admin(){
    }
}