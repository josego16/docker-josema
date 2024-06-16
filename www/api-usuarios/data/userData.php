<?php

namespace data;

use Exception;
use mysqli;

require_once 'param.inc.php';

class userData
{
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

    /**
     * selecciona todos los usurios de la tabla usuarios
     * @return array
     */
    public function get_users_db()
    {
        $query = "SELECT email, telefono, nombre, imagen FROM " . DB_TABLE_USER;
        $stmt = $this->connection->prepare($query);
        $stmt->execute();  //ejecutamos la consulta.
        $result = $stmt->get_result();  //recogemos los resultados.
        $array_users = array();
        if ($result->num_rows > 0) {
            while ($row_user = $result->fetch_assoc()) {
                $array_users[] = $row_user;
            }
        }
        return $array_users;
    }

    /**
     * ejemplo Sql = "insert into usuarios (id, nombre, password) values ("","santi","1234");
     * @param $data
     * @return int|string
     */
    public function insert_user_db($data)
    {
        $fields = implode(',', array_keys($data));
        $values = '"';  //comienza con unas dobles comillas
        $values .= implode('","', array_values($data)); //cierra dobles comillas, comienza dobles comillas
        $values .= '"'; //Cierra las dobles comillas del último valor.

        $query = "INSERT INTO " . DB_TABLE_USER . " (" . $fields . ") VALUES (" . $values . ")";

        try {

            if ($stmt = $this->connection->prepare($query)) {
                if ($stmt->execute()) {
                    $insert_id = $this->connection->insert_id;
                } else {
                    throw new Exception ("Error al ejecutar la consulta de insercion");
                }
            } else {
                throw new Exception ("Error al preparar la consulta de insercion");
            }
            return $insert_id;
        } catch (Exception $e) {
            error_log("Error insert " . $e->getMessage());
            return 0;
        }
    }

    public function update_user_db($id_user, $params)
    {
        $fields = array();
        foreach ($params as $key => $value) {
            $fields[] = "$key = ?";
        }
        $fields_str = implode(', ', $fields);

        $query = "UPDATE " . DB_TABLE_USER . " SET $fields_str WHERE id = ?";
        $stmt = $this->connection->prepare($query);

        $values = array_values($params);
        $values[] = $id_user;

        $stmt->bind_param(str_repeat('s', count($values)), ...$values);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function delete_user_db($id)
    {
        $query = "DELETE FROM " . DB_TABLE_USER . " WHERE id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
}