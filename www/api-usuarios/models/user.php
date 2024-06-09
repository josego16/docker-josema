<?php

namespace models;

use data\userData;
use responses\response;

require_once '../responses/response.php';
require_once '../data/userData.php';

class user extends userData
{
    /*
    Método que valida los campos obligatorios a insertar.
    */
    public static function error_register()
    {
        response::result(CODE_RESPONSE_METHOD, response::prepared_result('error', DETAILS_ERROR_METHOD));
    }

    /*
    Método que devuelve todos los usuarios
    */
    public function get_users($params)
    {

        $users = parent::get_users_db($params);
        /*
        Falta el tema de los ficheros.
        */
        response::result(CODE_DATA_OK, response::result_alumns('Ok', $users));
    }

    /*
    Método que coge todos el array asociativo, comprueba los campos a validar y los inserta.
    */
    public function insert_user($params)
    {
        if ($this->validate_requered_fields_to_insert($params)) {
            $password_enc = hash('sha256', $params['password']);
            $params['password'] = $password_enc;
            $params['disponible'] = 1;
            //  echo "Password codificada ". $params['password'];exit;
            $id_new_user = parent::insert_user_db($params);
            if ($id_new_user > 0)
                response::result(CODE_REGISTER_OK, response::prepared_result_insert('ok', $id_new_user));
            else
                response::result(CODE_ERROR_REGISTER, response::prepared_result_insert(DETAILS_ERROR_REGISTER, $id_new_user));
        }
    }

    public function delete_user()
    {
    }

    public function update_user()
    {
    }

    private function validate_requered_fields_to_insert($data)
    {
        //   echo "todo bien";exit;
        if (empty($data['email'])) {
            response::result(CODE_RESPONSE_NO_LOGIN, response::prepared_result('error', DETAILS_NO_EMAIL_FIELD));
        }

        if (empty($data['email'])) {
            response::result(CODE_RESPONSE_NO_LOGIN, response::prepared_result('error', DETAILS_NO_EMAIL_FIELD));
        }

        if (empty($data['password'])) {
            response::result(CODE_RESPONSE_NO_LOGIN, response::prepared_result('error', DETAILS_NO_PASSWORD_FIELD));
        }
        return true;
    }

}