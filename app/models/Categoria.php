<?php
class Categoria {
    private $conn;
    private $table = 'categorias';

    public $id;
    public $categoria;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para listar todas las categorías
    public function listar() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Método para crear una nueva categoría
    public function crear() {
        $query = "INSERT INTO " . $this->table . " (categoria) VALUES (:categoria)";
        $stmt = $this->conn->prepare($query);

        // Vincular parámetros
        $stmt->bindParam(':categoria', $this->categoria);

        return $stmt->execute();
    }

    // Método para actualizar una categoría existente
    public function actualizar() {
        $query = "UPDATE " . $this->table . " SET categoria = :categoria WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Vincular parámetros
        $stmt->bindParam(':categoria', $this->categoria);
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }

    // Método para eliminar una categoría
    public function eliminar() {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Vincular parámetros
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }

    // Método para obtener una categoría por su ID
    public function obtenerPorId($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Vincular parámetros
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>