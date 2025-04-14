<?php

include '../../app/controllers/CursoController.php';

$cursoController = new CursoController();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($cursoController->eliminar($id)) {
        header('Location: listar.php?mensaje=eliminado');
        exit;
    } else {
        echo "Error al eliminar el curso.";
    }
} else {
    echo "ID no proporcionado.";
}
?>