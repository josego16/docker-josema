<?php

/**
 * Función que devuelve la respuesta al cliente en:
 * respuesta en formato json.
 * establece el estado de la respuesta con code.
 * codificamos $response como array asociativo en json.
 * Detiene la ejecución del script después de mandarlo.
 */

namespace responses;
class response
{

    /**
     * @param $code
     * @param $response
     * @return void
     */
    public static function result($code, $response)
    {
        header('Content-type: application/json');
        http_response_code($code);
        echo json_encode($response);
        exit;
    }

    /**
     * @param $result
     * @param $detail
     * @return array
     */
    public static function prepared_result($result, $detail)
    {
        return array('result' => $result, 'detail' => $detail);
    }

    /**
     * @param $result
     * @param $token
     * @return array
     */
    public static function prepared_result_token($result, $token)
    {
        return array('result' => $result, 'token' => $token);
    }

    /**
     * @param $result
     * @param $id
     * @return array
     */
    public static function prepared_result_insert($result, $id)
    {
        return array('result' => $result, 'insert_id' => $id);
    }

    /**
     * @param $result
     * @param $alumns
     * @return array
     */
    public static function result_alumns($result, $alumns)
    {
        return array('result' => $result, 'usuarios' => $alumns);
    }

    /**
     * @param $id
     * @param $email
     * @return array
     */
    public static function build_token($id, $email)
    {
        return array('iat' => time(), 'data' => array('id' => $id, 'email' => $email));
    }
}