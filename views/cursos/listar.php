<?php

include '../../app/controllers/CursoController.php';

$cursoController = new CursoController();
$cursos = $cursoController->listar();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Cursos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Cursos</h1>
        <div class="text-end mb-3">
            <a href="registrar.php" class="btn btn-primary">Nuevo Curso</a>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Duración (horas)</th>
                    <th>Nivel</th>
                    <th>Precio</th>
                    <th>Fecha de Inicio</th>
                    <th>Categoría</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $cursos->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['titulo']; ?></td>
                        <td><?php echo $row['duracion_horas']; ?></td>
                        <td><?php echo $row['nivel']; ?></td>
                        <td><?php echo $row['precio']; ?></td>
                        <td><?php echo $row['fecha_inicio']; ?></td>
                        <td><?php echo $row['categoria']; ?></td>
                        <td>
                            <!-- Botón para Editar -->
                            <a href="editar.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                            <!-- Botón para Eliminar -->
                            <a href="eliminar.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este curso?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="../../public/index.php" class="btn btn-secondary mb-3">Volver al Inicio</a>
    </div>
</body>
</html>