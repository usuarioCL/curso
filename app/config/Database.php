<?php

class Database {
    private $host = 'localhost'; 
    private $dbname = 'curso';   
    private $username = 'root';  
    private $password = '';      
    public $conn;

    public function connect() {
        $this->conn = null;

        try {
            // Crear una nueva conexión PDO
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname;charset=utf8", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Mostrar un mensaje de error si la conexión falla
            echo "Error de conexión: " . $e->getMessage();
        }

        return $this->conn; // Retornar la conexión
    }
}
?>