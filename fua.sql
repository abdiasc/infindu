-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.30 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Volcando datos para la tabla infindu.archivos: ~0 rows (aproximadamente)

-- Volcando datos para la tabla infindu.archivos_leccion: ~0 rows (aproximadamente)

-- Volcando datos para la tabla infindu.categorias: ~0 rows (aproximadamente)

-- Volcando datos para la tabla infindu.cursos: ~0 rows (aproximadamente)
INSERT INTO `cursos` (`id`, `nombre`, `descripcion`, `creado_por`, `fecha_creacion`, `categoria`, `nivel`, `duracion`, `imagen_portada`, `estado`, `fecha_inicio`, `fecha_fin`, `cupo_maximo`, `visibilidad`) VALUES
	(1, 'Introducción a la Programación con Python', 'Curso básico de programación utilizando Python.', 1, '2025-06-15 03:39:50', 'Programación', 'básico', 72, '/uploads/cursos/684e4086102b4_Basico-de-Python.jpg', 'activo', '2025-06-15', '2025-06-17', 20, 'publico'),
	(2, 'Desarrollo Web con HTML, CSS y JavaScript', 'Aprende a crear sitios web desde cero.', 1, '2025-06-15 03:43:26', 'Programacion', 'básico', 48, '/uploads/cursos/684e415dbb497_103496890_154469989467516_3426973966576564636_n.png', 'activo', '2025-06-17', '2025-06-19', 30, 'publico'),
	(3, 'Programación Orientada a Objetos en Java', 'Curso intermedio sobre POO en Java.', 1, '2025-06-15 03:48:01', 'Programacion', 'intermedio', 72, '/uploads/cursos/684e427150856_maxresdefault.jpg', 'activo', '2025-06-22', '2025-06-21', 50, 'publico'),
	(4, 'Desarrollo de APIs REST con Node.js', 'Construcción de APIs usando Node.js y Express.', 1, '2025-06-15 03:50:40', 'Programacion', 'intermedio', 120, '/uploads/cursos/684e430fce498_0405_Building_a_Node.js-TypeScript_REST_API_Zara_Newsletter___blog-1507ad3436895bfe7cc6cf35e4efb17f.png', 'activo', '2025-06-15', '2025-06-30', 50, 'publico'),
	(5, 'Programación en C para Sistemas Embebidos', 'Curso avanzado en C aplicado a sistemas embebidos.', 1, '2025-06-15 06:10:43', 'Programacion', 'intermedio', 50, '/uploads/cursos/684e63e3129ec_1366_2000 (1).jpg', 'activo', '2025-06-27', '2025-06-29', 20, 'publico'),
	(6, 'Fundamentos de Redes de Computadoras', 'Aprende los conceptos básicos de redes.', 1, '2025-06-15 06:27:14', 'Redes', 'básico', 120, '/uploads/cursos/684e67c201a9d_1646584457400.png', 'activo', '2025-06-16', '2025-07-06', 50, 'publico');

-- Volcando datos para la tabla infindu.estudiantes: ~1 rows (aproximadamente)
INSERT INTO `estudiantes` (`id`, `usuario_id`, `carrera`, `semestre`, `matricula`, `fecha_nacimiento`, `avatar`) VALUES
	(1, 3, 'Informatica industrial', 4, '123456789', '2010-06-15', '/uploads/avatars/avatar_estudiante_684e45955fea5.jpg');

-- Volcando datos para la tabla infindu.estudiante_curso: ~2 rows (aproximadamente)
INSERT INTO `estudiante_curso` (`id`, `estudiante_id`, `curso_id`, `fecha_inscripcion`) VALUES
	(1, 3, 1, '2025-06-15 04:01:52'),
	(2, 3, 2, '2025-06-15 05:26:23'),
	(3, 3, 4, '2025-06-15 06:33:24');

-- Volcando datos para la tabla infindu.lecciones: ~0 rows (aproximadamente)

-- Volcando datos para la tabla infindu.permisos: ~0 rows (aproximadamente)

-- Volcando datos para la tabla infindu.profesores: ~1 rows (aproximadamente)
INSERT INTO `profesores` (`id`, `usuario_id`, `especialidad`, `titulo_academico`, `experiencia_anios`, `fecha_ingreso`, `avatar`, `biografia`) VALUES
	(1, 2, 'Ing. Sistemas', 'Ingeniera', 5, '2020-05-12', '/uploads/avatars/avatar_684e44a79ba93.jpg', 'Profesora Amalia');

-- Volcando datos para la tabla infindu.profesor_curso: ~0 rows (aproximadamente)
INSERT INTO `profesor_curso` (`id`, `profesor_id`, `curso_id`) VALUES
	(1, 2, 1);

-- Volcando datos para la tabla infindu.roles: ~3 rows (aproximadamente)
INSERT INTO `roles` (`id`, `nombre`) VALUES
	(1, 'administrador'),
	(3, 'estudiante'),
	(2, 'profesor');

-- Volcando datos para la tabla infindu.rol_permiso: ~0 rows (aproximadamente)

-- Volcando datos para la tabla infindu.usuarios: ~3 rows (aproximadamente)
INSERT INTO `usuarios` (`id`, `nombre`, `email`, `contraseña`, `fecha_registro`) VALUES
	(1, 'Abdias Cuellar Prado', 'abdiascprado@gmail.com', '$2y$10$ojqm9mfOGR6KYEC6jMSoIedlgY33Vx10Hnti7pERS4SvfHJAubEka', '2025-06-15 03:09:59'),
	(2, 'Amalia Pacci Olivera', 'amalia@correo.com', '$2y$10$N3FGFE2BptmNL1OjsktXbu7TfGa2e5qxrM7zwkhoUKUgvstf.9GJu', '2025-06-15 03:51:54'),
	(3, 'Camila Cuellar Ramos', 'camila@correo.com', '$2y$10$/CiUWjRYKj8rTG60Y8963.xpOOSKWL8IlZWhlQpTuYivSIM8a0C3S', '2025-06-15 03:59:29');

-- Volcando datos para la tabla infindu.usuario_rol: ~3 rows (aproximadamente)
INSERT INTO `usuario_rol` (`usuario_id`, `rol_id`) VALUES
	(1, 1),
	(2, 2),
	(3, 3);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
