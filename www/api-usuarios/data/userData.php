<?php

require_once 'param.inc.php';

class UserData{
    private $connection;

    public function __construct(){
        $par = DB_HOST.", ".DB_USER.", ".DB_PASSWORD.", ".DB_NAME.", ".DB_PORT;
        //echo $par;exit;
        $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);
        if ($this->connection->connect_errno){
            echo 'Error de conexión a la base de datos';
            exit;
        }
        //echo "Conectado"; exit;
    }

    /*
    selecciona todos los usurios de la tabla usuarios
    */
    public function get_users_db(){
        $query = "SELECT email, telefono, nombre, imagen FROM ".DB_TABLE_USER;
        $stmt = $this->connection->prepare($query);
        $stmt->execute();  //ejecutamos la consulta.
        $result = $stmt->get_result();  //recogemos los resultados.
        $array_users = array();
        if ($result->num_rows > 0){
            while ($row_user = $result->fetch_assoc()){
                $array_users[] = $row_user;
            }
        }
       // echo $query; exit;
      /*  $results = $this->connection->query($query);
        $array_users = array();

        foreach($results as $register_user){
            $array_users[] = $register_user;
        }*/
        //echo count($array_users);
        return $array_users;
    }



    /*
    ejemplo Sql = "insert into usuarios (id, nombre, password) values ("","santi","1234");
    $data es un array asociativo 'key'->value
    */
    public function insert_user_db($data){

        $fields = implode(',', array_keys($data));
		$values = '"';  //comienza con unas dobles comillas
		$values .= implode('","', array_values($data)); //cierra dobles comillas, comienza dobles comillas
		$values .= '"'; //Cierra las dobles comillas del último valor.
        
        $query = "INSERT INTO ".DB_TABLE_USER." (".$fields.") VALUES (".$values.")";

        try{

            if ($stmt = $this->connection->prepare($query)){
                if ($stmt->execute()){
                    $insert_id = $this->connection->insert_id;
                }else{
                    throw new Exception ("Error al ejecutar la consulta de insercion");
                }
            }else{ 
                throw new Exception ("Error al preparar la consulta de insercion");
            }
            return $insert_id;

        }catch( Exception $e){
            error_log("Error insert ". $e->getMessage());
            return 0;
        }


        //echo $query; exit;
       /* $this->connection->query($query);

        return $this->connection->insert_id;  //devuelve la id del último registro insertado.
        */
    }

}

?>