<?php
include '../../app/controllers/CursoController.php';

$cursoController = new CursoController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $duracion_horas = $_POST['duracion_horas'];
    $nivel = $_POST['nivel'];
    $precio = $_POST['precio'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $idcategoria = $_POST['idcategoria'];

    if ($cursoController->crear($titulo, $duracion_horas, $nivel, $precio, $fecha_inicio, $idcategoria)) {
        header('Location: listar.php');
        exit;
    } else {
        $mensaje = "Error al registrar el curso.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Curso</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Registrar Nuevo Curso</h1>
        <?php if (isset($mensaje)): ?>
            <div class="alert alert-danger text-center" role="alert">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>
        <form method="POST" action="" class="mt-4">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título del Curso:</label>
                <input type="text" name="titulo" id="titulo" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="duracion_horas" class="form-label">Duración (horas):</label>
                <input type="number" name="duracion_horas" id="duracion_horas" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="nivel" class="form-label">Nivel:</label>
                <select name="nivel" id="nivel" class="form-control" required>
                    <option value="Principiante">Principiante</option>
                    <option value="Intermedio">Intermedio</option>
                    <option value="Avanzado">Avanzado</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Precio:</label>
                <input type="number" step="0.01" name="precio" id="precio" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="fecha_inicio" class="form-label">Fecha de Inicio:</label>
                <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="idcategoria" class="form-label">Categoría:</label>
                <select name="idcategoria" id="idcategoria" class="form-control" required>
                    <?php
                    $categorias = $cursoController->listarCategorias();
                    foreach ($categorias as $categoria) {
                        echo "<option value='{$categoria['id']}'>{$categoria['categoria']}</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Registrar</button>
            <a href="listar.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>