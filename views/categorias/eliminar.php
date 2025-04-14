<?php

include '../../app/controllers/CategoriaController.php';

$categoriaController = new CategoriaController();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($categoriaController->eliminar($id)) {
        header('Location: listar.php?mensaje=eliminado');
        exit;
    } else {
        echo "Error al eliminar la categoría.";
    }
} else {
    echo "ID no proporcionado.";
}
?>