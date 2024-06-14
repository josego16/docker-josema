<?php
require_once '../responses/response.php';
require_once '../data/userData.php';


class User extends UserData{

    /*
    Método que valida los campos obligatorios a insertar.
    */
    private function validate_requered_fields_to_insert($data){
     //   echo "todo bien";exit;
        if ( !isset($data['email']) || empty($data['email']) ){
            Response::result(CODE_RESPONSE_NO_LOGIN, Response::prepared_result('error', DETAILS_NO_EMAIL_FIELD));
        }

        if ( !isset($data['email']) || empty($data['email']) ){
            Response::result(CODE_RESPONSE_NO_LOGIN, Response::prepared_result('error', DETAILS_NO_EMAIL_FIELD));
        }

        if ( !isset($data['password']) || empty($data['password']) ){
            Response::result(CODE_RESPONSE_NO_LOGIN, Response::prepared_result('error', DETAILS_NO_PASSWORD_FIELD));
        }
       
        return true;
    } //fin función






    /*
    Método que devuelve todos los usuarios
    */
    public function get_users($params){

        $users = parent::get_users_db($params);
        /*
        Falta el tema de los ficheros.
        */
        Response::result(CODE_DATA_OK, Response::result_alumns('Ok', $users));
    }




    /*
    Método que coge todos el array asociativo, comprueba los campos a validar y los inserta.
    */
    public function insert_user($params){ 
        if ($this->validate_requered_fields_to_insert($params)){
            $password_enc  = hash('sha256' , $params['password']);
            $params['password'] = $password_enc;
            $params['disponible'] = 1;
          //  echo "Password codificada ". $params['password'];exit;
            $id_new_user = parent::insert_user_db($params);
            if ($id_new_user > 0)
                Response::result(CODE_REGISTER_OK, Response::prepared_result_insert('ok', $id_new_user));
            else
                Response::result(CODE_ERROR_REGISTER, Response::prepared_result_insert(DETAILS_ERROR_REGISTER, $id_new_user));
        }
    }



    public static function error_register(){
        Response::result(CODE_RESPONSE_METHOD, Response::prepared_result('error', DETAILS_ERROR_METHOD));
    }


} //fin clase

?>