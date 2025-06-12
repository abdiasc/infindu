
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    contraseña VARCHAR(255),
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) UNIQUE
);

CREATE TABLE usuario_rol (
    usuario_id INT,
    rol_id INT,
    PRIMARY KEY (usuario_id, rol_id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (rol_id) REFERENCES roles(id)
);

CREATE TABLE permisos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) UNIQUE,
    descripcion TEXT
);

CREATE TABLE rol_permiso (
    rol_id INT,
    permiso_id INT,
    PRIMARY KEY (rol_id, permiso_id),
    FOREIGN KEY (rol_id) REFERENCES roles(id),
    FOREIGN KEY (permiso_id) REFERENCES permisos(id)
);

CREATE TABLE cursos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150),
    descripcion TEXT,
    creado_por INT,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (creado_por) REFERENCES usuarios(id)
);


CREATE TABLE cursos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL,
    descripcion TEXT,
    creado_por INT NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    -- Nuevos campos
    categoria VARCHAR(100),                    -- Categoría del curso, ej: "Programación", "Matemáticas"
    nivel ENUM('básico', 'intermedio', 'avanzado') DEFAULT 'básico', -- Nivel de dificultad
    duracion INT,                              -- Duración del curso en horas
    imagen_portada VARCHAR(255),               -- Ruta de la imagen del curso
    estado ENUM('activo', 'inactivo') DEFAULT 'activo', -- Control de visibilidad/estado
    fecha_inicio DATE,                         -- Cuándo inicia el curso
    fecha_fin DATE,                            -- Cuándo termina (si aplica)
    cupo_maximo INT,                           -- Límite de estudiantes
    visibilidad ENUM('publico', 'privado') DEFAULT 'publico', -- Control de visibilidad en el sitio
    
    FOREIGN KEY (creado_por) REFERENCES usuarios(id)
);



CREATE TABLE profesor_curso (
    id INT AUTO_INCREMENT PRIMARY KEY,
    profesor_id INT,
    curso_id INT,
    FOREIGN KEY (profesor_id) REFERENCES usuarios(id),
    FOREIGN KEY (curso_id) REFERENCES cursos(id),
    UNIQUE (profesor_id, curso_id)
);

CREATE TABLE estudiante_curso (
    id INT AUTO_INCREMENT PRIMARY KEY,
    estudiante_id INT,
    curso_id INT,
    fecha_inscripcion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (estudiante_id) REFERENCES usuarios(id),
    FOREIGN KEY (curso_id) REFERENCES cursos(id),
    UNIQUE (estudiante_id, curso_id)
);

CREATE TABLE archivos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    curso_id INT,
    profesor_id INT,
    nombre_archivo VARCHAR(255),
    ruta_archivo VARCHAR(255),
    fecha_subida TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (curso_id) REFERENCES cursos(id),
    FOREIGN KEY (profesor_id) REFERENCES usuarios(id)
);


-- Insertar roles y permisos


INSERT INTO roles (nombre) VALUES ('administrador'), ('profesor'), ('estudiante');

INSERT INTO permisos (nombre, descripcion) VALUES
('crear_curso', 'Crear nuevos cursos'),
('asignar_profesor', 'Asignar profesores a cursos'),
('subir_archivo', 'Subir archivos a un curso'),
('ver_curso', 'Ver contenido del curso'),
('descargar_archivo', 'Descargar archivos del curso');


-- 3 Asignar permisos a roles


-- Administrador: todos los permisos
INSERT INTO rol_permiso (rol_id, permiso_id)
SELECT 1, id FROM permisos;

-- Profesor: subir archivos, ver cursos
INSERT INTO rol_permiso (rol_id, permiso_id)
SELECT 2, id FROM permisos WHERE nombre IN ('subir_archivo', 'ver_curso');

-- Estudiante: ver curso, descargar archivos
INSERT INTO rol_permiso (rol_id, permiso_id)
SELECT 3, id FROM permisos WHERE nombre IN ('ver_curso', 'descargar_archivo');


-- 4. Insertar usuarios

INSERT INTO usuarios (nombre, email, contraseña) VALUES
('Ana Admin', 'admin@plataforma.com', '1234'),
('Pedro Profesor', 'profesor@plataforma.com', 'abcd'),
('Elena Estudiante', 'estudiante@plataforma.com', 'pass');


-- 5. Asignar roles a usuarios

-- Ana es administrador
INSERT INTO usuario_rol (usuario_id, rol_id) VALUES (1, 1);

-- Pedro es profesor
INSERT INTO usuario_rol (usuario_id, rol_id) VALUES (2, 2);

-- Elena es estudiante
INSERT INTO usuario_rol (usuario_id, rol_id) VALUES (3, 3);

-- 6. Crear curso y asignaciones


-- Crear curso por el administrador
INSERT INTO cursos (nombre, descripcion, creado_por)
VALUES ('Programación Web', 'Curso de desarrollo web moderno', 1);

-- Asignar al profesor Pedro al curso
INSERT INTO profesor_curso (profesor_id, curso_id)
VALUES (2, 1);

-- Inscribir a la estudiante Elena
INSERT INTO estudiante_curso (estudiante_id, curso_id)
VALUES (3, 1);


-- 7. Subir archivo al curso


INSERT INTO archivos (curso_id, profesor_id, nombre_archivo, ruta_archivo)
VALUES (1, 2, 'introduccion.pdf', '/uploads/introduccion.pdf');


-- Crear curso por el administrador
INSERT INTO cursos (nombre, descripcion, creado_por)
VALUES ('PHP Basico', 'Curso de programacion en PHP', 1);