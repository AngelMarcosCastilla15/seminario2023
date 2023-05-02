CREATE DATABASE dbajax;
USE dbajax;

CREATE TABLE productos 
(
	idproducto 		INT AUTO_INCREMENT PRIMARY KEY,
	nombre 			VARCHAR(50)		NOT NULL,
	marca 			VARCHAR(50) 	NOT NULL,
	precio 			DECIMAL(7,2)	NOT NULL,
	create_at		DATETIME 		NOT NULL DEFAULT NOW(),
	update_at		DATETIME 		NULL
)ENGINE = INNODB;

INSERT INTO productos (nombre, marca, precio)
	VALUES
		('Teclado standard', 'Logitech', 45),
		('SSD 240Gb', 'Samsung', 100),
		('Audífonos M100', 'Micronics', 30);
		
SELECT * FROM productos;

-- Agregamos una restricción UNIQUE (generar errores)
ALTER TABLE productos ADD CONSTRAINT uk_nombre UNIQUE (nombre, marca);

-- Comprobando...
INSERT INTO productos (nombre, marca, precio)
	VALUES
		('Teclado standard', 'Logitech', 45);

CREATE TABLE personas(
	idpersona	INT AUTO_INCREMENT PRIMARY KEY,
	nombres	VARCHAR(30) NOT NULL,
	apellidos	VARCHAR(30) NOT NULL,
	fotografia  VARCHAR(90) NULL,
	create_at	DATETIME NOT NULL DEFAULT NOW(),
	update_up	DATETIME NULL	
)ENGINE = INNODB;

