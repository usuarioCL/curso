<?php

include '../../app/controllers/CategoriaController.php';

$categoriaController = new CategoriaController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombreCategoria = $_POST['categoria'];

    if ($categoriaController->crear($nombreCategoria)) {
        header('Location: listar.php');
        exit;
    } else {
        $mensaje = "Error al registrar la categoría.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Categoría</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Registrar Nueva Categoría</h1>
        <?php if (isset($mensaje)): ?>
            <div class="alert alert-danger text-center" role="alert">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>
        <form method="POST" action="" class="mt-4">
            <div class="mb-3">
                <label for="categoria" class="form-label">Nombre de la Categoría:</label>
                <input type="text" name="categoria" id="categoria" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Registrar</button>
            <a href="listar.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>