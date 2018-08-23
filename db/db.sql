DROP TABLE IF EXISTS area;

CREATE TABLE IF NOT EXISTS area(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(255) NOT NULL,
	PRIMARY KEY (id)
);

DROP TABLE IF EXISTS curso;

CREATE TABLE IF NOT EXISTS curso(
	codigo VARCHAR(10) NOT NULL,
	nombre VARCHAR(255) NOT NULL,
	creditos TINYINT UNSIGNED NOT NULL,
	inicio_rama VARCHAR(1) NOT NULL,
	obligatorio VARCHAR(1) NOT NULL,
	creditos_necesarios INT UNSIGNED DEFAULT 0,
	id_area INT UNSIGNED NOT NULL,
	PRIMARY KEY (codigo),
	FOREIGN KEY (id_area) REFERENCES area(id)
);

DROP TABLE IF EXISTS prerrequisito;

CREATE TABLE IF NOT EXISTS prerrequisito(
	codigo_pre VARCHAR(10) NOT NULL,
	codigo_post VARCHAR(10) NOT NULL,
	PRIMARY KEY (codigo_pre, codigo_post),
	FOREIGN KEY (codigo_pre) REFERENCES curso(codigo),
	FOREIGN KEY (codigo_post) REFERENCES curso(codigo)
);

DROP TABLE IF EXISTS usuario;

CREATE TABLE IF NOT EXISTS usuario(
	carnet INT UNSIGNED NOT NULL,
	nombres VARCHAR(255) NOT NULL,
	apellidos VARCHAR(255) NOT NULL,
	PRIMARY KEY (carnet)
);

DROP TABLE IF EXISTS estado_usuario_curso;

CREATE TABLE IF NOT EXISTS estado_usuario_curso(
	id INT UNSIGNED NOT NULL,
	nombre VARCHAR(50) NOT NULL,
	PRIMARY KEY (id)
);

DROP TABLE IF EXISTS usuario_curso;

CREATE TABLE IF NOT EXISTS usuario_curso(
	carnet INT UNSIGNED NOT NULL,
	codigo_curso VARCHAR(10) NOT NULL,
	id_estado_usuario_curso INT UNSIGNED NOT NULL,
	PRIMARY KEY (carnet, codigo_curso),
	FOREIGN KEY (carnet) REFERENCES usuario(carnet),
	FOREIGN KEY (codigo_curso) REFERENCES curso(codigo),
	FOREIGN KEY (id_estado_usuario_curso) REFERENCES estado_usuario_curso(id)
);

DROP TABLE IF EXISTS tarea;

CREATE TABLE IF NOT EXISTS tarea(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	codigo_curso VARCHAR(10),
	PRIMARY KEY (id),
	FOREIGN KEY (codigo_curso) REFERENCES curso(codigo)
);

INSERT INTO usuario(carnet, nombres, apellidos) VALUES ('209900909', 'USUARIO', 'PRUEBA');

INSERT INTO area (nombre) VALUES ('Metodologia de Sistemas');
INSERT INTO area (nombre) VALUES ('Ciencias de la Computacion');
INSERT INTO area (nombre) VALUES ('Desarrollo de Software');
INSERT INTO area (nombre) VALUES ('Ciencias basicas y complementarias');
INSERT INTO area (nombre) VALUES ('EPS');
INSERT INTO area (nombre) VALUES ('Diplomado en Administracion');
INSERT INTO area (nombre) VALUES ('Humanistica');

INSERT INTO curso (codigo, nombre, creditos, inicio_rama, obligatorio, id_area) VALUES ('017','Social Humanistica 1', 4, 'S', 'S', 7);
INSERT INTO curso (codigo, nombre, creditos, inicio_rama, obligatorio, id_area) VALUES ('101','Mate Basica 1', 7, 'S', 'S', 4);
INSERT INTO curso (codigo, nombre, creditos, inicio_rama, obligatorio, id_area) VALUES ('069','Tecnica Complementaria 1', 3,'S', 'S', 4);
INSERT INTO curso (codigo, nombre, creditos, inicio_rama, obligatorio, id_area) VALUES ('039','Deportes 1', 1, 'S', 'N', 4);
INSERT INTO curso (codigo, nombre, creditos, inicio_rama, obligatorio, id_area) VALUES ('348','Quimica General 1', 3, 'S', 'S', 4);
INSERT INTO curso (codigo, nombre, creditos, inicio_rama, obligatorio, id_area) VALUES ('0006','Idioma Tecnico 1', 2, 'S', 'N', 4);

INSERT INTO curso (codigo, nombre, creditos, inicio_rama, obligatorio, id_area) VALUES ('019','Social Humanistica 2', 4, 'N', 'S', 7);
INSERT INTO curso (codigo, nombre, creditos, inicio_rama, obligatorio, id_area) VALUES ('103','Mate Basica 2', 7, 'N', 'S', 4);
INSERT INTO curso (codigo, nombre, creditos, inicio_rama, obligatorio, id_area) VALUES ('005','Tecnicas de Estudio y de Investigacion', 3, 'S', 'S', 4);
INSERT INTO curso (codigo, nombre, creditos, inicio_rama, obligatorio, id_area) VALUES ('040','Deportes 2', 1, 'N', 'N', 4);
INSERT INTO curso (codigo, nombre, creditos, inicio_rama, obligatorio, id_area) VALUES ('147','Fisica Basica', 5, 'S', 'S', 4);
INSERT INTO curso (codigo, nombre, creditos, inicio_rama, obligatorio, id_area) VALUES ('0008','Idioma Tecnico 2', 2, 'N', 'N', 4);

INSERT INTO curso (codigo, nombre, creditos, inicio_rama, obligatorio, creditos_necesarios, id_area) VALUES ('795','Logica de Sistemas', 2, 'S', 'S', 33, 1);
INSERT INTO curso (codigo, nombre, creditos, inicio_rama, obligatorio, creditos_necesarios, id_area) VALUES ('960','Mate Computo 1', 5, 'S', 'S', 33, 2);
INSERT INTO curso (codigo, nombre, creditos, inicio_rama, obligatorio, creditos_necesarios, id_area) VALUES ('770','Intr. a la Prog. y Computacion 1', 4, 'S', 'S', 33, 3);
INSERT INTO curso (codigo, nombre, creditos, inicio_rama, obligatorio, id_area) VALUES ('107','Mate Intermedia 1', 10, 'N', 'S', 4);
INSERT INTO curso (codigo, nombre, creditos, inicio_rama, obligatorio, id_area) VALUES ('150','Fisica 1', 6, 'N', 'S', 4);
INSERT INTO curso (codigo, nombre, creditos, inicio_rama, obligatorio, id_area) VALUES ('0009','Idioma Tecnico 3', 2, 'N', 'N', 4);

INSERT INTO curso (codigo, nombre, creditos, inicio_rama, obligatorio, id_area) VALUES ('732','Estadistica 1', 5, 'S', 'S', 1);
INSERT INTO curso (codigo, nombre, creditos, inicio_rama, obligatorio, id_area) VALUES ('796','Lenguajes Formales y de Prog.', 3, 'S', 'S', 2);
INSERT INTO curso (codigo, nombre, creditos, inicio_rama, obligatorio, id_area) VALUES ('962','Mate Computo 2', 5, 'N', 'S', 2);
INSERT INTO curso (codigo, nombre, creditos, inicio_rama, obligatorio, id_area) VALUES ('771','Intr. a la Prog. y Computacion 2', 5, 'N', 'S', 3);
INSERT INTO curso (codigo, nombre, creditos, inicio_rama, obligatorio, id_area) VALUES ('010','Logica', 2, 'N', 'N', 7);
INSERT INTO curso (codigo, nombre, creditos, inicio_rama, obligatorio, id_area) VALUES ('112','Mate Intermedia 2', 5, 'N', 'S', 4);
INSERT INTO curso (codigo, nombre, creditos, inicio_rama, obligatorio, id_area) VALUES ('114','Mate Intermedia 3', 5, 'N', 'S', 4);
INSERT INTO curso (codigo, nombre, creditos, inicio_rama, obligatorio, id_area) VALUES ('152','Fisica 2', 5, 'N', 'S', 4);
INSERT INTO curso (codigo, nombre, creditos, inicio_rama, obligatorio, id_area) VALUES ('0011','Idioma Tecnico 4', 2, 'N', 'N', 4);
INSERT INTO curso (codigo, nombre, creditos, inicio_rama, obligatorio, id_area) VALUES ('2025','Practica Inicial', 0, 'S', 'S', 5);

INSERT INTO prerrequisito (codigo_pre, codigo_post) VALUES ('017','019');
INSERT INTO prerrequisito (codigo_pre, codigo_post) VALUES ('101','103');
INSERT INTO prerrequisito (codigo_pre, codigo_post) VALUES ('101','147');
INSERT INTO prerrequisito (codigo_pre, codigo_post) VALUES ('039','040');
INSERT INTO prerrequisito (codigo_pre, codigo_post) VALUES ('0006','0008');

INSERT INTO prerrequisito (codigo_pre, codigo_post) VALUES ('103','960');
INSERT INTO prerrequisito (codigo_pre, codigo_post) VALUES ('103','770');
INSERT INTO prerrequisito (codigo_pre, codigo_post) VALUES ('103','107');
INSERT INTO prerrequisito (codigo_pre, codigo_post) VALUES ('103','150');
INSERT INTO prerrequisito (codigo_pre, codigo_post) VALUES ('147','150');
INSERT INTO prerrequisito (codigo_pre, codigo_post) VALUES ('0008','0009');

INSERT INTO prerrequisito (codigo_pre, codigo_post) VALUES ('107','732');
INSERT INTO prerrequisito (codigo_pre, codigo_post) VALUES ('005','732');
INSERT INTO prerrequisito (codigo_pre, codigo_post) VALUES ('770','796');
INSERT INTO prerrequisito (codigo_pre, codigo_post) VALUES ('795','796');
INSERT INTO prerrequisito (codigo_pre, codigo_post) VALUES ('960','796');
INSERT INTO prerrequisito (codigo_pre, codigo_post) VALUES ('960','962');
INSERT INTO prerrequisito (codigo_pre, codigo_post) VALUES ('770','962');
INSERT INTO prerrequisito (codigo_pre, codigo_post) VALUES ('795','962');
INSERT INTO prerrequisito (codigo_pre, codigo_post) VALUES ('960','771');
INSERT INTO prerrequisito (codigo_pre, codigo_post) VALUES ('770','771');
INSERT INTO prerrequisito (codigo_pre, codigo_post) VALUES ('795','771');
INSERT INTO prerrequisito (codigo_pre, codigo_post) VALUES ('107','771');
INSERT INTO prerrequisito (codigo_pre, codigo_post) VALUES ('019','010');
INSERT INTO prerrequisito (codigo_pre, codigo_post) VALUES ('107','112');
INSERT INTO prerrequisito (codigo_pre, codigo_post) VALUES ('107','114');
INSERT INTO prerrequisito (codigo_pre, codigo_post) VALUES ('107','152');
INSERT INTO prerrequisito (codigo_pre, codigo_post) VALUES ('150','152');
INSERT INTO prerrequisito (codigo_pre, codigo_post) VALUES ('0009','0011');
INSERT INTO prerrequisito (codigo_pre, codigo_post) VALUES ('103','2025');
INSERT INTO prerrequisito (codigo_pre, codigo_post) VALUES ('770','2025');
