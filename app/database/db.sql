CREATE DATABASE curso;
USE curso;

-- Tabla categorias
CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    categoria VARCHAR(100) NOT NULL,
    creado DATETIME NOT NULL DEFAULT NOW(),
    modificado DATETIME NULL,
    CONSTRAINT uk_categoria UNIQUE (categoria)
) ENGINE = INNODB;

-- Tabla cursos
CREATE TABLE cursos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    idcategoria INT NOT NULL,
    titulo VARCHAR(255) NOT NULL,
    duracion_horas INT NOT NULL,
    nivel VARCHAR(50) NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    fecha_inicio DATE NOT NULL,
    creado DATETIME NOT NULL DEFAULT NOW(),
    modificado DATETIME NULL,
    CONSTRAINT fk_idcategoria FOREIGN KEY (idcategoria) REFERENCES categorias (id)
) ENGINE = INNODB;

-- Insertar datos de ejemplo
INSERT INTO categorias (categoria) VALUES
    ('Programación'),
    ('Diseño Gráfico'),
    ('Marketing Digital'),
    ('Ciberseguridad');

INSERT INTO cursos (idcategoria, titulo, duracion_horas, nivel, precio, fecha_inicio) VALUES
    (1, 'Curso de PHP Básico', 40, 'Principiante', 150.00, '2025-05-01'),
    (1, 'Curso de JavaScript Avanzado', 60, 'Avanzado', 250.00, '2025-06-01'),
    (2, 'Diseño UX/UI', 30, 'Intermedio', 200.00, '2025-05-15'),
    (3, 'SEO para Principiantes', 20, 'Principiante', 100.00, '2025-04-20');
    
    
CREATE VIEW vista_cursos_todos AS
SELECT
    C.id,
    CAT.categoria,
    C.titulo,
    C.duracion_horas,
    C.nivel,
    C.precio,
    C.fecha_inicio
FROM cursos C
INNER JOIN categorias CAT ON C.idcategoria = CAT.id
ORDER BY C.id;

DELIMITER //
CREATE PROCEDURE spu_cursos_filtrar_nivel(IN _nivel VARCHAR(50))
BEGIN
    SELECT * FROM vista_cursos_todos WHERE nivel = _nivel;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE spu_cursos_registrar(
    IN _idcategoria INT,
    IN _titulo VARCHAR(255),
    IN _duracion_horas INT,
    IN _nivel VARCHAR(50),
    IN _precio DECIMAL(10, 2),
    IN _fecha_inicio DATE
)
BEGIN
    INSERT INTO cursos (idcategoria, titulo, duracion_horas, nivel, precio, fecha_inicio)
    VALUES (_idcategoria, _titulo, _duracion_horas, _nivel, _precio, _fecha_inicio);
END //
DELIMITER ;


DELIMITER //
CREATE TRIGGER cursos_actualizar_fecha_modificacion
BEFORE UPDATE ON cursos
FOR EACH ROW
BEGIN
    SET NEW.modificado = NOW();
END //
DELIMITER ;

select * from vista_cursos_todos;
