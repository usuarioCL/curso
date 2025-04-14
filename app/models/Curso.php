<?php
class Curso {
    private $conn;
    private $table = 'cursos';

    public $id;
    public $titulo;
    public $duracion_horas;
    public $nivel;
    public $precio;
    public $fecha_inicio;
    public $idcategoria;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para listar todos los cursos
    public function listar() {
        $query = "SELECT C.*, CAT.categoria 
                  FROM " . $this->table . " C
                  INNER JOIN categorias CAT ON C.idcategoria = CAT.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Método para crear un nuevo curso
    public function crear() {
        $query = "INSERT INTO " . $this->table . " 
                  (titulo, duracion_horas, nivel, precio, fecha_inicio, idcategoria) 
                  VALUES (:titulo, :duracion_horas, :nivel, :precio, :fecha_inicio, :idcategoria)";
        $stmt = $this->conn->prepare($query);

        // Vincular parámetros
        $stmt->bindParam(':titulo', $this->titulo);
        $stmt->bindParam(':duracion_horas', $this->duracion_horas);
        $stmt->bindParam(':nivel', $this->nivel);
        $stmt->bindParam(':precio', $this->precio);
        $stmt->bindParam(':fecha_inicio', $this->fecha_inicio);
        $stmt->bindParam(':idcategoria', $this->idcategoria);

        return $stmt->execute();
    }

    // Método para actualizar un curso existente
    public function actualizar() {
        $query = "UPDATE " . $this->table . " 
                  SET titulo = :titulo, duracion_horas = :duracion_horas, nivel = :nivel, 
                      precio = :precio, fecha_inicio = :fecha_inicio, idcategoria = :idcategoria 
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Vincular parámetros
        $stmt->bindParam(':titulo', $this->titulo);
        $stmt->bindParam(':duracion_horas', $this->duracion_horas);
        $stmt->bindParam(':nivel', $this->nivel);
        $stmt->bindParam(':precio', $this->precio);
        $stmt->bindParam(':fecha_inicio', $this->fecha_inicio);
        $stmt->bindParam(':idcategoria', $this->idcategoria);
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }

    // Método para eliminar un curso
    public function eliminar() {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Vincular parámetro
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }

    // Método para obtener un curso por su ID
    public function obtenerPorId($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Vincular parámetro
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>