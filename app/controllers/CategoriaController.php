<?php

include_once __DIR__ . '/../config/Database.php';
include_once __DIR__ . '/../models/Categoria.php';

class CategoriaController {
    private $categoria;

    public function __construct() {
        // Crear una instancia de la conexión a la base de datos
        $database = new Database();
        $db = $database->connect();

        // Crear una instancia del modelo Categoria
        $this->categoria = new Categoria($db);
    }

    // Método para listar todas las categorías
    public function listar() {
        return $this->categoria->listar();
    }

    // Método para crear una nueva categoría
    public function crear($categoria) {
        $this->categoria->categoria = $categoria;
        return $this->categoria->crear();
    }

    // Método para actualizar una categoría existente
    public function actualizar($id, $categoria) {
        $this->categoria->id = $id;
        $this->categoria->categoria = $categoria;
        return $this->categoria->actualizar();
    }

    // Método para eliminar una categoría
    public function eliminar($id) {
        $this->categoria->id = $id;
        return $this->categoria->eliminar();
    }

    // Método para obtener una categoría por su ID
    public function obtenerPorId($id) {
        return $this->categoria->obtenerPorId($id);
    }
}
?>