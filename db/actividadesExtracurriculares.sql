
use  analisis11;
select * from area;
select *
from curso
where area=8;

INSERT INTO area (nombre) Values ('Actvidades extracurriculares');
INSERT INTO curso (codigo, nombre, creditos, inicio_rama, obligatorio, area) values ('5000','Participacion en congreso estudiantil',1,'N','N',8);
INSERT INTO curso (codigo, nombre, creditos, inicio_rama, obligatorio, area) values ('5001','Miembro activo de AEI',1,'N','N',8);
INSERT INTO curso (codigo, nombre, creditos, inicio_rama, obligatorio, area) values ('5002','Participacion en congreso estudiantil',1,'N','N',8);
INSERT INTO curso (codigo, nombre, creditos, inicio_rama, obligatorio, area) values ('5003','Ayudante en elecciones de AEU',1,'N','N',8);
INSERT INTO curso (codigo, nombre, creditos, inicio_rama, obligatorio, area) values ('5004','Participacion en olimpiadas interuniversitarias',1,'N','N',8);
INSERT INTO curso (codigo, nombre, creditos, inicio_rama, obligatorio, area) values ('5005','Ayudante de congreso estudiantil',1,'N','N',8);
INSERT INTO curso (codigo, nombre, creditos, inicio_rama, obligatorio, area) values ('5006','Tutor de matematicas preuniversitarias',1,'N','N',8);

INSERT INTO curso (codigo, nombre, creditos, inicio_rama, obligatorio, area) values ('5007','Actividad extra 1',1,'N','N',8);
INSERT INTO curso (codigo, nombre, creditos, inicio_rama, obligatorio, area) values ('5008','Actividad extra 2',1,'N','N',8);

INSERT INTO usuario_curso (usuario, curso, estado_curso) VALUES ('209900909', '5000', 1);
INSERT INTO usuario_curso (usuario, curso, estado_curso) VALUES ('209900909', '5001', 1);
INSERT INTO usuario_curso (usuario, curso, estado_curso) VALUES ('209900909', '5002', 1);
INSERT INTO usuario_curso (usuario, curso, estado_curso) VALUES ('209900909', '5003', 1);
INSERT INTO usuario_curso (usuario, curso, estado_curso) VALUES ('209900909', '5004', 1);
INSERT INTO usuario_curso (usuario, curso, estado_curso) VALUES ('209900909', '5005', 1);
INSERT INTO usuario_curso (usuario, curso, estado_curso) VALUES ('209900909', '5006', 1);
INSERT INTO usuario_curso (usuario, curso, estado_curso) VALUES ('209900909', '5007', 1);
INSERT INTO usuario_curso (usuario, curso, estado_curso) VALUES ('209900909', '5008', 1);

select * 
from usuario_curso
where curso in (select codigo 
	from curso
    where area=8);
    
SELECT nombre from curso where area = 8;