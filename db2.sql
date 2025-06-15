CREATE DATABASE `infindu`


-- Tabla de usuarios
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    contraseña VARCHAR(255),
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de roles
CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) UNIQUE
);

-- Relación muchos a muchos entre usuarios y roles
CREATE TABLE usuario_rol (
    usuario_id INT,
    rol_id INT,
    PRIMARY KEY (usuario_id, rol_id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (rol_id) REFERENCES roles(id) ON DELETE CASCADE
);

-- Tabla de permisos
CREATE TABLE permisos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) UNIQUE,
    descripcion TEXT
);

-- Relación muchos a muchos entre roles y permisos
CREATE TABLE rol_permiso (
    rol_id INT,
    permiso_id INT,
    PRIMARY KEY (rol_id, permiso_id),
    FOREIGN KEY (rol_id) REFERENCES roles(id) ON DELETE CASCADE,
    FOREIGN KEY (permiso_id) REFERENCES permisos(id) ON DELETE CASCADE
);

-- Tabla de cursos (versión completa y única)
CREATE TABLE cursos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL,
    descripcion TEXT,
    creado_por INT,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    categoria VARCHAR(100),
    nivel ENUM('básico', 'intermedio', 'avanzado') DEFAULT 'básico',
    duracion INT,
    imagen_portada VARCHAR(255),
    estado ENUM('activo', 'inactivo') DEFAULT 'activo',
    fecha_inicio DATE,
    fecha_fin DATE,
    cupo_maximo INT,
    visibilidad ENUM('publico', 'privado') DEFAULT 'publico',

    FOREIGN KEY (creado_por) REFERENCES usuarios(id) ON DELETE SET NULL
);

-- Relación profesor-curso
CREATE TABLE profesor_curso (
    id INT AUTO_INCREMENT PRIMARY KEY,
    profesor_id INT,
    curso_id INT,
    UNIQUE (profesor_id, curso_id),
    FOREIGN KEY (profesor_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (curso_id) REFERENCES cursos(id) ON DELETE CASCADE
);

-- Relación estudiante-curso
CREATE TABLE estudiante_curso (
    id INT AUTO_INCREMENT PRIMARY KEY,
    estudiante_id INT,
    curso_id INT,
    fecha_inscripcion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE (estudiante_id, curso_id),
    FOREIGN KEY (estudiante_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (curso_id) REFERENCES cursos(id) ON DELETE CASCADE
);

-- Tabla de archivos subidos por profesores
CREATE TABLE archivos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    curso_id INT,
    profesor_id INT,
    nombre_archivo VARCHAR(255),
    ruta_archivo VARCHAR(255),
    fecha_subida TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (curso_id) REFERENCES cursos(id) ON DELETE CASCADE,
    FOREIGN KEY (profesor_id) REFERENCES usuarios(id) ON DELETE CASCADE
);


-- Tabla de lecciones
CREATE TABLE lecciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    curso_id INT NOT NULL,
    titulo VARCHAR(255) NOT NULL,
    contenido TEXT,
    url_video VARCHAR(255),
    orden INT DEFAULT 1, -- Para ordenar las lecciones dentro del curso
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (curso_id) REFERENCES cursos(id) ON DELETE CASCADE
);

-- Tabla de archivos asociados a una lección
CREATE TABLE archivos_leccion (
    id INT AUTO_INCREMENT PRIMARY KEY,
    leccion_id INT NOT NULL,
    nombre_archivo VARCHAR(255),
    ruta_archivo VARCHAR(255),
    fecha_subida TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (leccion_id) REFERENCES lecciones(id) ON DELETE CASCADE
);



-- ALTER TABLE lecciones
-- ADD descripcion_corta VARCHAR(255),
-- ADD tipo_contenido ENUM('video', 'lectura', 'quiz', 'práctica') DEFAULT 'video',
-- ADD recurso_adicional VARCHAR(255),
-- ADD duracion_aproximada INT,
-- ADD estado ENUM('borrador', 'publicada', 'oculta') DEFAULT 'publicada',
-- ADD fecha_disponible DATE,
-- ADD es_obligatoria BOOLEAN DEFAULT TRUE,
-- ADD slug VARCHAR(255),
-- ADD autor VARCHAR(100),
-- ADD quiz_id INT;





INSERT INTO roles (nombre) VALUES ('administrador'), ('profesor'), ('estudiante');

-- INSERT INTO permisos (nombre, descripcion) VALUES
-- ('crear_curso', 'Crear nuevos cursos'),
-- ('asignar_profesor', 'Asignar profesores a cursos'),
-- ('subir_archivo', 'Subir archivos a un curso'),
-- ('ver_curso', 'Ver contenido del curso'),
-- ('descargar_archivo', 'Descargar archivos del curso');




-- Tabla de información adicional de estudiantes
CREATE TABLE estudiantes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT UNIQUE,
    carrera VARCHAR(100),
    semestre INT,
    matricula VARCHAR(50),
    fecha_nacimiento DATE,
    avatar VARCHAR(255),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

-- Tabla de información adicional de profesores
CREATE TABLE profesores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT UNIQUE,
    especialidad VARCHAR(100),
    titulo_academico VARCHAR(100),
    experiencia_anios INT,
    fecha_ingreso DATE,
    avatar VARCHAR(255),
    biografia TEXT,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);


-- ALTER TABLE profesores ADD biografia TEXT;



-- ALTER TABLE estudiantes
-- ADD COLUMN avatar VARCHAR(255) AFTER fecha_nacimiento;

-- ALTER TABLE profesores
-- ADD COLUMN avatar VARCHAR(255) AFTER fecha_ingreso;

CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) UNIQUE,
    color VARCHAR(20),
    descripcion TEXT
);


