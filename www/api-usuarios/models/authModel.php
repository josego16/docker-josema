<?php
require_once '../data/authData.php';
require_once '../responses/response.php';
require_once '../jwt/JWT.php';
use Firebase\JWT\JWT;


class Auth extends AuthData{
    private $id_user = '';
    private $admin = 0;



    public function sigIn($user){
        if ( !isset($user['email']) || !isset($user['password']) || empty($user['email']) || empty($user['password']) ){	
			Response::result(CODE_RESPONSE_NO_LOGIN, Response::prepared_result('error', DETAILS_NO_LOGIN));
			exit;
		}

        //en este punto, hemos pasado correctamente el email y password
        $user_hash = hash('sha256', $user['password']);  //encriptamos la password.
      
        $user = parent::login_db($user['email'], $user_hash);  //logueamos al usuario.

        //si no hay un usuario, informamos
        if (sizeof($user) == 0){
            Response::result(CODE_RESPONSE_ERROR_LOGIN, Response::prepared_result('error', DETAILS_ERROR_LOGIN));
            exit;
        }

        //recuperamos el único registro que hay y seteamos el id
        $user = $user[0];
        $id_user = $user['id'];
        //echo "El id del usuario es $id_user y su email es ".$user['email']; exit;
        //construímos de nuevo el token. Lo codificamos, actualizamos y devolvemos.
        $token = Response::build_token($id_user, $user['email']);
        //
       // echo $token['data']['id']." ".$token['data']['email']." y codifico con la privada ".KEY; exit;
        $jwt = JWT::encode($token, KEY);
        //echo "token generado es $jwt"; exit;
        parent::update_db($id_user, $jwt);
        //aquí se retormna $jwt y se debe devolver al fronted.
        Response::result(CODE_LOGIN_OK, Response:: prepared_result_token('ok', $jwt));

        return $jwt;

    }




/*
  La idea es verificar con 
*/
    public function verify_autentication_by_token(){

        //comprobamos si nos pasa una api-key
        if ( !isset($_SERVER['HTTP_API_KEY']) ){
           // echo "No s eha pasado la apikey";
            Response::result(CODE_RESPONSE_ERROR_PERMISSION, Response::prepared_result('error', DETAILS_PERMISSION));
            exit;
        }


        //recuperamos la api-key. Sacamos su id, comprobamos si coincide la key en el registro.
        $jwt = $_SERVER['HTTP_API_KEY'];
        //echo "La api key pasada en la cabecera es la $jwt"; exit;
       // echo "Estamos en la verificación del token mandado por parámetro. $jwt"; exit;
        try{
            $data_user = JWT::decode($jwt, KEY, array('HS256'));  //decodificamos el token y sacamos el id y email.
            $id = $data_user->data->id;     //necesitamos el id
            //echo "El id decodificdo es $id"; exit;
            $user_token = parent::get_token_by_id_db($id);  //queremos devolver el token grabado en la BBDD de ese ID, para ver si coincide
           // echo $user_token[0];exit;
            if ($user_token != $jwt){
                throw new Exception();  //lanzamos la excepción para que se capture debajo.
            }

        } catch(\Throwable $th){
            Response::result(CODE_RESPONSE_ERROR_PERMISSION, Response::prepared_result('error', DETAILS_PERMISSION));
            exit;
        }
        //si llegamos aquí, es porque no ha saltado ninguna excepción y por tanto los token coinciden.
    }




    //  estos métodos no son necesrios.
  /*  public function update_token_for_login_db($id, $email){
        $data_token = Response::build_token($id, $email);
        $new_token = JWT::encode($id, $new_token);
        parent::update_token_to_login_db($id, $jwt);
        return $new_token;

    }


    public function dev_id_for_token($token){
        $data_user = JWT::decode($token, KEY,array('HS256'));
        return $data_token->data->id;
    }

    public function dev_token($token){
        Response::result(CODE_LOGIN_OK, Response::prepared_result_token('ok', $token));
        exit;
    }
*/
}

?>