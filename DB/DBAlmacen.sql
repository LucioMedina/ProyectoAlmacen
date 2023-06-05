CREATE DATABASE ALMACEN
USE ALMACEN

--	 TABLAS
CREATE TABLE Personas
(
	idpersona 	INT AUTO_INCREMENT PRIMARY KEY,
	apellidos	VARCHAR(30)		NOT NULL,
	nombres		VARCHAR(30)		NOT NULL,
	telefono	VARCHAR(9)		NOT NULL,
	email 		VARCHAR(30)		NULL
)ENGINE = INNODB;

CREATE TABLE Marcas
(
	idmarca INT AUTO_INCREMENT PRIMARY KEY,
	marca 	VARCHAR(30)	NOT NULL
)ENGINE = INNODB;

CREATE TABLE Usuarios
(
	idusuario 		INT AUTO_INCREMENT PRIMARY KEY,
	idpersona 		INT 		NOT NULL, -- FK
	nombreusuario	VARCHAR(30) NOT NULL,
	claveacceso		VARCHAR(100)	NOT NULL,
	fechacreacion	DATETIME  	NOT NULL DEFAULT NOW(),
	estado			CHAR(1)			NOT NULL DEFAULT 1,
	CONSTRAINT fk_idpersona_usuarios FOREIGN KEY (idpersona) REFERENCES Personas(idpersona)
)ENGINE = INNODB;

-- Agregando campo NIVELACCESO tambien se me olvido
ALTER TABLE Usuarios ADD nivelacceso CHAR(3) NOT NULL; -- ADM = Administrador, SPV = Supervisor, AST = Asistente

CREATE TABLE Categorias
(
	idcategoria 	INT AUTO_INCREMENT PRIMARY KEY,
	categoria 	VARCHAR(30) 	NOT NULL
)ENGINE = INNODB


CREATE TABLE Productos
(
	idproducto 		INT AUTO_INCREMENT PRIMARY KEY,
	idcategoria 		INT 		NOT NULL, -- FK
	idmarca 		INT 		NOT NULL, -- FK
	descripcion		VARCHAR(100) 	NOT NULL,
	modelo			VARCHAR(30)	NOT NULL,
	precio			DECIMAL(9,2) 	NOT NULL,
	stock			INT 		NOT NULL,
	estado 			CHAR(1)		NOT NULL DEFAULT 1,
	CONSTRAINT fk_idcatego_produc FOREIGN KEY (idcategoria) REFERENCES Categorias(idcategoria),
	CONSTRAINT fk_idmarca_produc FOREIGN KEY (idmarca) REFERENCES Marcas(idmarca)
)ENGINE = INNODB;

-- Agregando los campos stock y estado a la tabla productos porque se me olvido xd
ALTER TABLE Productos ADD stock INT NOT NULL;
ALTER TABLE Productos ADD estado CHAR(1) NOT NULL DEFAULT 1;

CREATE TABLE Movimientos
(
	idmovimiento	INT AUTO_INCREMENT PRIMARY KEY,
	tipo		VARCHAR(30)	NOT NULL,
	descripcion 	VARCHAR(30)	NOT NULL,
	idproducto	INT 		NOT NULL,
	fecha 		DATETIME 	NOT NULL DEFAULT NOW(),
	idusuario	INT 		NOT NULL,
	cantidad	INT 		NOT NULL,
	CONSTRAINT fk_idproducto_movimiento FOREIGN KEY (idproducto) REFERENCES Productos(idproducto),
	CONSTRAINT fk_idusuario_produc FOREIGN KEY (idusuario) REFERENCES Usuarios(idusuario)
)ENGINE = INNODB;

ALTER TABLE Movimientos DROP COLUMN saldoactual

-- PROCEDIMIENTOS ALMACENADOS

SELECT * FROM Personas
-- ***************************************************************************************************************************************
-- SP DE PERSONAS	
-- LISTAR
DELIMITER $$
CREATE PROCEDURE spu_listar_personas()
BEGIN 
	SELECT * FROM Personas;
END

CALL spu_listar_personas

-- REGISTRAR
DELIMITER $$
CREATE PROCEDURE spu_registrar_personas(
IN _apellidos 			VARCHAR(30),
IN _nombres			VARCHAR(30),
IN _telefono			VARCHAR(9),
IN _email			VARCHAR(30)
)
BEGIN
	INSERT INTO Personas (apellidos, nombres, telefono, email) VALUES (_apellidos, _nombres, _telefono, _email);
END

CALL spu_registrar_personas("Llanos Ramos", "Mirian Elizabeth", "987876765", "mirian106@gmail.com");

-- ***************************************************************************************************************************************
-- SP DE USUARIOS
-- LISTAR
/*
DELIMITER $$
CREATE PROCEDURE spu_listar_usuarios()
BEGIN 
	SELECT * FROM Usuarios WHERE estado = 1;
END
*/

DELIMITER $$
CREATE PROCEDURE spu_buscar_usuarios(
	IN _nombreusuario	VARCHAR(30)
)
BEGIN
    SELECT U.idusuario, P.idpersona, P.apellidos, P.nombres, U.nombreusuario, U.claveacceso, U.fechacreacion, U.estado, U.nivelacceso
    FROM Usuarios U
    INNER JOIN Personas P ON U.idpersona = P.idpersona
    WHERE estado = 1 AND nombreusuario = _nombreusuario;
END $$

CALL spu_buscar_usuarios('Lucio');

SELECT * FROM Usuarios

-- REGISTRAR
DELIMITER $$
CREATE PROCEDURE spu_registrar_usuarios(
    IN _idpersona INT,
    IN _nombreusuario VARCHAR(30),
    IN _claveacceso VARCHAR(100),
    IN _nivelacceso CHAR(3)
)
BEGIN
    INSERT INTO Usuarios (idpersona, nombreusuario, claveacceso, nivelacceso) VALUES (_idpersona, _nombreusuario, _claveacceso, _nivelacceso);
END$$

-- LA CONTRASEÑA de Lucio es lucio17
-- LA CONTRASEÑA de Mirian es mirian06
-- LA CONTRASEÑA de Israel es lucho13
CALL spu_registrar_usuarios(1, "Lucio", "$2y$10$2KunXWAGQp0/0SPQnRTftuIUdWF7/11nmwfKfDQBMiu3XIX1jGqFK", "ADM")
CALL spu_registrar_usuarios(3, 'Mirian', '$2y$10$lEXBZE43Zw3u3NRm6ePts.UgaL5BkH.ejh0iKMn.FLUhTPkTOHgXu', 'AST')
CALL spu_registrar_usuarios(2, 'Israel', '$2y$10$2xjnShh2W9ctDyeFduPmgeXEOYswLtHCJYS20RRNPvOtcN06bLkFq', 'SPV')

DELETE FROM Usuarios WHERE idusuario = 2
SELECT * FROM Usuarios
UPDATE Usuarios SET estado = 1
-- ***************************************************************************************************************************************
-- SP DE CATEGORIAS
-- LISTAR
DELIMITER $$
CREATE PROCEDURE spu_listar_categorias()
BEGIN 
	SELECT * FROM Categorias;
END

CALL spu_listar_categorias

-- REGISTRAR
DELIMITER $$
CREATE PROCEDURE spu_registrar_categorias(
IN _categoria		VARCHAR(30)
)
BEGIN
	INSERT INTO Categorias (categoria) VALUES (_categoria);
END

CALL spu_registrar_categorias("Portatiles")

-- ***************************************************************************************************************************************
-- SP DE MARCAS
-- LISTAR
DELIMITER $$
CREATE PROCEDURE spu_listar_marcas()
BEGIN 
	SELECT * FROM Marcas;
END

CALL spu_listar_marcas

-- REGISTRAR
DELIMITER $$
CREATE PROCEDURE spu_registrar_marcas(
IN _marca		VARCHAR(30)
)
BEGIN
	INSERT INTO Marcas (marca) VALUES (_marca);
END

CALL spu_registrar_marcas('INTEL')

-- ***************************************************************************************************************************************
-- SP DE PRODUCTOS
-- LISTAR
DELIMITER $$
CREATE PROCEDURE spu_listar_productos()
BEGIN
    SELECT P.idproducto, C.categoria, P.descripcion, P.modelo, M.marca, P.precio, P.stock, P.estado
    FROM Productos P
    INNER JOIN Marcas M ON P.idmarca = M.idmarca 
    INNER JOIN Categorias C ON  P.idcategoria = C.idcategoria
    WHERE estado = 1;
END $$

CALL spu_listar_productos
SELECT * FROM Productos
-- REGISTRAR
DELIMITER $$
CREATE PROCEDURE spu_registrar_productos(
IN _idcategoria		INT,
IN _idmarca		INT,
IN _descripcion 	VARCHAR(100),
IN _modelo		VARCHAR(30),
IN _precio		DECIMAL(9,2),
IN _stock		INT
)
BEGIN
	INSERT INTO Productos(idcategoria, idmarca, descripcion, modelo, precio, stock) VALUES (_idcategoria, _idmarca, _descripcion, _modelo, _precio, _stock);
END

CALL spu_registrar_productos(1, 3, "Iphone color dorado", "Iphone 14 Pro Max", 5000, 50)
CALL spu_registrar_productos(3, 2, "Portatil de 500GB", "MSI Super Pro G424", 12000, 20)
CALL spu_registrar_productos(1, 3, "Iphone color dorado", "Iphone 14 Pro Max", 5000, 50)

DELETE FROM Productos WHERE idproducto=1;

-- ELIMINAR
DELIMITER $$
CREATE PROCEDURE spu_eliminar_productos(
	IN _idproducto INT
)
BEGIN
	UPDATE Productos SET estado = 0 WHERE idproducto = _idproducto;
END $$

-- ACTUALIZAR
DELIMITER $$
CREATE PROCEDURE spu_actualizar_productos(
	IN _idproducto		INT,
	IN _descripcion 	VARCHAR(100),
	IN _modelo		VARCHAR(30),
	IN _precio		DECIMAL(9,2),
	IN _stock 		INT
)
BEGIN
	UPDATE Productos SET
		descripcion = _descripcion,
		modelo = _modelo,
		precio = _precio,
		stock = _stock
	WHERE idproducto = _idproducto;
END $$

CALL spu_actualizar_productos(2,"Portatil color azul de 16 pulgadas", "Legion Pro", 11990, 50)

-- OBTENER (Buscador)
DELIMITER $$
CREATE PROCEDURE spu_obtener_productos(
	IN _idproducto 	INT
)
BEGIN
	SELECT * FROM Productos WHERE idproducto = _idproducto;
END $$

CALL spu_obtener_productos(2)

-- SP DE MOVIMIENTOS
-- LISTAR
DELIMITER $$
CREATE PROCEDURE spu_listar_movimientos()
BEGIN
    SELECT M.idmovimiento, M.tipo, M.descripcion, P.idproducto, M.fecha, U.nombreusuario, P.stock, M.cantidad
    FROM Movimientos M
    INNER JOIN Productos P ON M.idproducto = P.idproducto
    INNER JOIN Usuarios U ON  M.idusuario = U.idusuario;
END $$

CALL spu_listar_movimientos

-- REGISTRAR
DELIMITER $$
CREATE PROCEDURE spu_registrar_movimientos(
    IN _idproducto    INT,
    IN _idusuario     INT,
    IN _tipo          VARCHAR(30),
    IN _descripcion   VARCHAR(30),
    IN _cantidad      INT
)
BEGIN
    INSERT INTO Movimientos (idproducto, idusuario, tipo, descripcion, cantidad)
    VALUES (_idproducto, _idusuario, _tipo, _descripcion, _cantidad);

    IF _tipo = 'ENTRADA' THEN
        UPDATE Productos
        SET stock = stock + _cantidad
        WHERE idproducto = _idproducto;
    ELSEIF _tipo = 'SALIDA' THEN
        UPDATE Productos
        SET stock = stock - _cantidad
        WHERE idproducto = _idproducto;
    END IF;
END $$

SELECT * FROM Productos

CALL spu_listar_productos()

CALL spu_registrar_movimientos(2, 3, 'ENTRADA', 'Resivimos nuevas laptops', 50);

UPDATE Productos SET estado = '1' WHERE estado = '0'