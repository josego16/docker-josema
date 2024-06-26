<?php

namespace models;

use data\userData;
use responses\response;

require_once '../responses/response.php';
require_once '../data/userData.php';

class user extends userData
{
    /**
     * Método que valida los campos obligatorios a insertar.
     * @return void
     */
    public static function error_register()
    {
        response::result(CODE_RESPONSE_METHOD, response::prepared_result('error', DETAILS_ERROR_METHOD));
    }

    /**
     * Metodo que devuelve todos los usuarios
     * @param $params
     * @return void
     */
    public function get_users($params)
    {
        $users = parent::get_users_db($params);
        response::result(CODE_DATA_OK, response::result_alumns('Ok', $users));
    }

    /**
     * Método que coge todos el array asociativo, comprueba los campos a validar y los inserta.
     * @param $params
     * @return void
     */
    public function insert_user($params)
    {
        if ($this->validate_requered_fields_to_insert($params)) {
            $password_enc = hash('sha256', $params['password']);
            $params['password'] = $password_enc;
            $params['disponible'] = 1;
            $id_new_user = parent::insert_user_db($params);
            if ($id_new_user > 0)
                response::result(CODE_REGISTER_OK, response::prepared_result_insert('ok', $id_new_user));
            else
                response::result(CODE_ERROR_REGISTER, response::prepared_result_insert(DETAILS_ERROR_REGISTER, $id_new_user));
        }
    }

    /**
     * @param $data
     * @return boolean
     */
    private function validate_requered_fields_to_insert($data)
    {
        if (!isset($data['email']) || empty($data['email'])) {
            Response::result(CODE_RESPONSE_NO_LOGIN, Response::prepared_result('error', DETAILS_NO_EMAIL_FIELD));
            return false;
        }

        if (!isset($data['password']) || empty($data['password'])) {
            Response::result(CODE_RESPONSE_NO_LOGIN, Response::prepared_result('error', DETAILS_NO_PASSWORD_FIELD));
            return false;
        }

        return true;
    }

    /**
     * Método que elimina un usuario
     * @param $id
     * @return void
     */
    public function delete_user($id)
    {
        $deleted = parent::delete_user_db($id);
        if ($deleted)
            response::result(CODE_DELETE_OK, response::prepared_result_delete('ok', $id));
        else
            response::result(CODE_ERROR_DELETE, response::prepared_result_delete(DETAILS_ERROR_DELETE, $id));
    }
}