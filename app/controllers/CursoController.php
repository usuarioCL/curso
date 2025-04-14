<?php

include_once __DIR__ . '/../config/Database.php'; 
include_once __DIR__ . '/../models/Curso.php';
include_once __DIR__ . '/../models/Categoria.php';

class CursoController {
    private $curso;
    private $categoria;

    public function __construct() {
        $database = new Database();
        $db = $database->connect();

        $this->curso = new Curso($db);
        $this->categoria = new Categoria($db);
    }

    // Método para listar todos los cursos
    public function listar() {
        return $this->curso->listar();
    }

    // Método para crear un nuevo curso
    public function crear($titulo, $duracion_horas, $nivel, $precio, $fecha_inicio, $idcategoria) {
        $this->curso->titulo = $titulo;
        $this->curso->duracion_horas = $duracion_horas;
        $this->curso->nivel = $nivel;
        $this->curso->precio = $precio;
        $this->curso->fecha_inicio = $fecha_inicio;
        $this->curso->idcategoria = $idcategoria;
        return $this->curso->crear();
    }

    // Método para actualizar un curso existente
    public function actualizar($id, $titulo, $duracion_horas, $nivel, $precio, $fecha_inicio, $idcategoria) {
        $this->curso->id = $id;
        $this->curso->titulo = $titulo;
        $this->curso->duracion_horas = $duracion_horas;
        $this->curso->nivel = $nivel;
        $this->curso->precio = $precio;
        $this->curso->fecha_inicio = $fecha_inicio;
        $this->curso->idcategoria = $idcategoria;
        return $this->curso->actualizar();
    }
    
    public function eliminar($id) {
        $this->curso->id = $id;
        return $this->curso->eliminar();
    }

    public function obtenerPorId($id) {
        return $this->curso->obtenerPorId($id);
    }
    public function listarCategorias() {
        return $this->categoria->listar()->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>