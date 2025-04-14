<?php

include '../../app/controllers/CursoController.php';

$cursoController = new CursoController();

// Verificar si se ha proporcionado un ID en la URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $curso = $cursoController->obtenerPorId($id);

    // Si no se encuentra el curso, mostrar un mensaje de error
    if (!$curso) {
        echo "Curso no encontrado.";
        exit;
    }
}

// Procesar el formulario cuando se envíe
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $duracion_horas = $_POST['duracion_horas'];
    $nivel = $_POST['nivel'];
    $precio = $_POST['precio'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $idcategoria = $_POST['idcategoria'];

    if ($cursoController->actualizar($id, $titulo, $duracion_horas, $nivel, $precio, $fecha_inicio, $idcategoria)) {
        header('Location: listar.php');
        exit;
    } else {
        $mensaje = "Error al actualizar el curso.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Curso</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Editar Curso</h1>
        <?php if (isset($mensaje)): ?>
            <div class="alert alert-danger text-center" role="alert">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>
        <form method="POST" action="" class="mt-4">
            <input type="hidden" name="id" value="<?php echo $curso['id']; ?>">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título del Curso:</label>
                <input type="text" name="titulo" id="titulo" class="form-control" value="<?php echo $curso['titulo']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="duracion_horas" class="form-label">Duración (horas):</label>
                <input type="number" name="duracion_horas" id="duracion_horas" class="form-control" value="<?php echo $curso['duracion_horas']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="nivel" class="form-label">Nivel:</label>
                <select name="nivel" id="nivel" class="form-control" required>
                    <option value="Principiante" <?php echo $curso['nivel'] === 'Principiante' ? 'selected' : ''; ?>>Principiante</option>
                    <option value="Intermedio" <?php echo $curso['nivel'] === 'Intermedio' ? 'selected' : ''; ?>>Intermedio</option>
                    <option value="Avanzado" <?php echo $curso['nivel'] === 'Avanzado' ? 'selected' : ''; ?>>Avanzado</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Precio:</label>
                <input type="number" step="0.01" name="precio" id="precio" class="form-control" value="<?php echo $curso['precio']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="fecha_inicio" class="form-label">Fecha de Inicio:</label>
                <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" value="<?php echo $curso['fecha_inicio']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="idcategoria" class="form-label">Categoría:</label>
                <select name="idcategoria" id="idcategoria" class="form-control" required>
                    <?php
                    $categorias = $cursoController->listarCategorias();
                    foreach ($categorias as $categoria) {
                        $selected = $curso['idcategoria'] == $categoria['id'] ? 'selected' : '';
                        echo "<option value='{$categoria['id']}' $selected>{$categoria['categoria']}</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Actualizar</button>
            <a href="listar.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>