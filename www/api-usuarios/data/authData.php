<?php

namespace data;
use Exception;
use mysqli;

require_once 'param.inc.php';

class authData{
    private mysqli $connection;

    public function __construct()
    {
        $par = DB_HOST . ", " . DB_USER . ", " . DB_PASSWORD . ", " . DB_NAME . ", " . DB_PORT;
        $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);
        if ($this->connection->connect_errno) {
            echo 'Error de conexión a la base de datos';
            exit;
        }
    }

    /*
    Método que devuelve un array asociativo con el id, nombre y email
    */
    public function login_db($email, $password)
    {
        $stmt = $this->connection->prepare("SELECT id, nombre, email FROM " . DB_TABLE_USER . " WHERE email = ? AND password = ?");
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        $result_array = array();
        while ($row = $result->fetch_assoc()) {
            $result_array[] = $row;  //[ ["id" => 1, "nombre" => 'santi', "email"=>'s@s.com'], ["id" => 2, "nombre" => 'sonia', "email"=>'ss@s.com']]
        }
        return $result_array;
    }

    /*
    Método que actualiza el token recibido según el id.
    */
    public function update_db($id, $new_token)
    {
        $query = "UPDATE " . DB_TABLE_USER . " SET token = ? WHERE id = ?";
        try {
            if ($stmt = $this->connection->prepare($query)) {
                $stmt->bind_param("si", $new_token, $id);
                if ($stmt->execute()) {
                    $num_rows = $stmt->affected_rows;
                } else {
                    throw new Exception ("Error al ejecutar la consulta de actualizacion");
                }

            } else {
                throw new Exception ("Error al preparar la consulta de actualizacion");

            }
            return $num_rows;

        } catch (Exception $e) {
            error_log("Error update " . $e->getMessage());
            return 0;
        }

    }

    /*
    Método que devuelve el token según el id recibido
    */
    public function get_token_by_id_db($id)
    {
        $id = intval($id);
        $stmt = $this->connection->prepare("SELECT token FROM " . DB_TABLE_USER . " WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        // Obtener el resultado
        $result = $stmt->get_result();
        $result_array = array();
        while ($row = $result->fetch_assoc()) {
            $result_array[] = $row;
        }
        if (!empty($result_array))
            return $result_array[0]['token'];
        else
            return null;
    }


    public function echo_data($result_array)
    {
        foreach ($result_array as $reg) {
            foreach ($reg as $key => $value) {
                echo ($key) . ': ' . $value . '<br>';
            }
        }
    }

}