<?php

/*
función que devuelve la respuesta al cliente en:
1.- respuesta en formato json
2.- establece el estado de la respuesta con code
3.- codificamos $response como array asociativo en json.
4.- Detiene la ejecución del script después de mandarlo.
*/

namespace responses;
class response
{
    public static function result($code, $response)
    {
        header('Content-type: application/json');
        http_response_code($code);
        echo json_encode($response);
        exit;
    }

    public static function prepared_result($result, $detail)
    {
        return array(
            'result' => $result,
            'detail' => $detail
        );
    }

    public static function prepared_result_token($result, $token)
    {
        return array(
            'result' => $result,
            'token' => $token
        );
    }

    public static function prepared_result_insert($result, $id)
    {
        return array(
            'result' => $result,
            'insert_id' => $id
        );
    }

    public static function result_alumns($result, $alumns)
    {
        return array(
            'result' => $result,
            'usuarios' => $alumns
        );
    }

    public static function build_token($id, $email)
    {
        return array(
            'iat' => time(),
            'data' => array(
                'id' => $id,
                'email' => $email
            )
        );
    }
}