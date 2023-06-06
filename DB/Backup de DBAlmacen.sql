/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.25-MariaDB : Database - almacen
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`almacen` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `almacen`;

/*Table structure for table `categorias` */

DROP TABLE IF EXISTS `categorias`;

CREATE TABLE `categorias` (
  `idcategoria` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(30) NOT NULL,
  PRIMARY KEY (`idcategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `categorias` */

insert  into `categorias`(`idcategoria`,`categoria`) values 
(1,'Portatiles'),
(2,'PC Componentes'),
(3,'Celulares');

/*Table structure for table `marcas` */

DROP TABLE IF EXISTS `marcas`;

CREATE TABLE `marcas` (
  `idmarca` int(11) NOT NULL AUTO_INCREMENT,
  `marca` varchar(30) NOT NULL,
  PRIMARY KEY (`idmarca`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*Data for the table `marcas` */

insert  into `marcas`(`idmarca`,`marca`) values 
(1,'MSI'),
(2,'INTEL'),
(3,'AMD'),
(4,'APPLE'),
(5,'SAMSUNG'),
(6,'LENOVO'),
(7,'LG');

/*Table structure for table `movimientos` */

DROP TABLE IF EXISTS `movimientos`;

CREATE TABLE `movimientos` (
  `idmovimiento` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(30) NOT NULL,
  `descripcion` varchar(30) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `idusuario` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`idmovimiento`),
  KEY `fk_idproducto_movimiento` (`idproducto`),
  KEY `fk_idusuario_produc` (`idusuario`),
  CONSTRAINT `fk_idproducto_movimiento` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`idproducto`),
  CONSTRAINT `fk_idusuario_produc` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;

/*Data for the table `movimientos` */

insert  into `movimientos`(`idmovimiento`,`tipo`,`descripcion`,`idproducto`,`fecha`,`idusuario`,`cantidad`) values 
(1,'SALIDA','Se venderan 10 celulares',3,'2023-06-03 18:46:03',3,10),
(2,'ENTRADA','Resivimos nuevas laptops',2,'2023-06-03 18:50:52',3,50),
(3,'SALIDA','Se necesita un procesador i5',4,'2023-06-03 20:19:49',3,1),
(4,'SALIDA','Se requieren 20 portatiles',2,'2023-06-03 21:17:41',3,20),
(5,'ENTRADA','Ingresan nuevas laptops',2,'2023-06-04 22:52:56',3,20),
(7,'SALIDA','sdgf',2,'2023-06-06 11:12:59',4,3),
(19,'','fsadf',2,'2023-06-06 11:48:51',3,2);

/*Table structure for table `personas` */

DROP TABLE IF EXISTS `personas`;

CREATE TABLE `personas` (
  `idpersona` int(11) NOT NULL AUTO_INCREMENT,
  `apellidos` varchar(30) NOT NULL,
  `nombres` varchar(30) NOT NULL,
  `telefono` varchar(9) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idpersona`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `personas` */

insert  into `personas`(`idpersona`,`apellidos`,`nombres`,`telefono`,`email`) values 
(1,'Medina Llanos','Lucio Israel','970664419','lucio7329@gmail.com'),
(2,'Medina Llanos','Angel Esteban','985235421','angel07@gmail.com'),
(3,'Llanos Ramos','Mirian Elizabeth','946598475','Mirian06@gmail.com'),
(4,'Medina Valenzuela','Israel Lucio','932966075','lucho13@gmail.com');

/*Table structure for table `productos` */

DROP TABLE IF EXISTS `productos`;

CREATE TABLE `productos` (
  `idproducto` int(11) NOT NULL AUTO_INCREMENT,
  `idcategoria` int(11) NOT NULL,
  `idmarca` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `modelo` varchar(30) NOT NULL,
  `precio` decimal(9,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idproducto`),
  KEY `fk_idcatego_produc` (`idcategoria`),
  KEY `fk_idmarca_produc` (`idmarca`),
  CONSTRAINT `fk_idcatego_produc` FOREIGN KEY (`idcategoria`) REFERENCES `categorias` (`idcategoria`),
  CONSTRAINT `fk_idmarca_produc` FOREIGN KEY (`idmarca`) REFERENCES `marcas` (`idmarca`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

/*Data for the table `productos` */

insert  into `productos`(`idproducto`,`idcategoria`,`idmarca`,`descripcion`,`modelo`,`precio`,`stock`,`estado`) values 
(2,1,6,'Laptop de 500GB','Legion Pro',12000.00,10,'1'),
(3,3,5,'Celular color negro de 256GB','Galaxy S23 Ultra',5600.00,10,'1'),
(4,2,2,'Procesador de 6 núcleos y 12 hilos','Intel Core i5 10400f',3000.00,28,'1'),
(5,3,4,'Iphone de color dorado','14 Pro Max',5000.00,60,'1'),
(6,2,1,'Monitor de 24 pulgadas','MSI optix G345',900.00,30,'1'),
(7,2,1,'Teclado mecanico','Logitech',300.00,40,'1'),
(8,3,4,'Iphone de color azul','Iphone 11',4000.00,50,'1'),
(9,3,4,'Iphone color negro','Iphone XS Pro',3000.00,30,'1'),
(10,3,4,'iphone de color plateado','11 pro',2000.00,5,'1');

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `idpersona` int(11) NOT NULL,
  `nombreusuario` varchar(30) NOT NULL,
  `claveacceso` varchar(100) NOT NULL,
  `fechacreacion` datetime NOT NULL DEFAULT current_timestamp(),
  `estado` char(1) NOT NULL DEFAULT '1',
  `nivelacceso` char(3) NOT NULL,
  PRIMARY KEY (`idusuario`),
  KEY `fk_idpersona_usuarios` (`idpersona`),
  CONSTRAINT `fk_idpersona_usuarios` FOREIGN KEY (`idpersona`) REFERENCES `personas` (`idpersona`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `usuarios` */

insert  into `usuarios`(`idusuario`,`idpersona`,`nombreusuario`,`claveacceso`,`fechacreacion`,`estado`,`nivelacceso`) values 
(3,1,'Lucio','$2y$10$2KunXWAGQp0/0SPQnRTftuIUdWF7/11nmwfKfDQBMiu3XIX1jGqFK','2023-06-02 10:36:40','1','ADM'),
(4,3,'Mirian','$2y$10$lEXBZE43Zw3u3NRm6ePts.UgaL5BkH.ejh0iKMn.FLUhTPkTOHgXu','2023-06-02 10:48:32','1','AST'),
(5,4,'Israel','$2y$10$2xjnShh2W9ctDyeFduPmgeXEOYswLtHCJYS20RRNPvOtcN06bLkFq','2023-06-02 10:48:51','1','SPV');

/* Procedure structure for procedure `spu_actualizar_productos` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_actualizar_productos` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_actualizar_productos`(
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
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_buscar_usuarios` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_buscar_usuarios` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_buscar_usuarios`(
	in _nombreusuario	varchar(30)
)
BEGIN
    SELECT U.idusuario, P.idpersona, P.apellidos, P.nombres, U.nombreusuario, U.claveacceso, U.fechacreacion, U.estado, U.nivelacceso
    FROM Usuarios U
    INNER JOIN Personas P ON U.idpersona = P.idpersona
    WHERE estado = 1 and nombreusuario = _nombreusuario;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_eliminar_productos` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_eliminar_productos` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_eliminar_productos`(
	in _idproducto INT
)
BEGIN
	UPDATE Productos set estado = 0 where idproducto = _idproducto;
end */$$
DELIMITER ;

/* Procedure structure for procedure `spu_listar_categorias` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_listar_categorias` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_listar_categorias`()
BEGIN 
	SELECT * FROM Categorias;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_listar_marcas` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_listar_marcas` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_listar_marcas`()
BEGIN 
	SELECT * FROM Marcas;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_listar_movimientos` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_listar_movimientos` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_listar_movimientos`()
BEGIN
    SELECT M.idmovimiento, M.tipo, M.descripcion, P.idproducto, M.fecha, U.nombreusuario, P.stock, M.cantidad
    FROM Movimientos M
    INNER JOIN Productos P ON M.idproducto = P.idproducto
    INNER JOIN Usuarios U ON  M.idusuario = U.idusuario;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_listar_personas` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_listar_personas` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_listar_personas`()
BEGIN 
	SELECT * FROM Personas;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_listar_productos` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_listar_productos` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_listar_productos`()
BEGIN
    SELECT P.idproducto, C.categoria, P.descripcion, P.modelo, M.marca, P.precio, P.stock, P.estado
    FROM Productos P
    INNER JOIN Marcas M ON P.idmarca = M.idmarca 
    INNER JOIN Categorias C ON  P.idcategoria = C.idcategoria
    where estado = 1;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_obtener_productos` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_obtener_productos` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_obtener_productos`(
	IN _idproducto 	INT
)
BEGIN
	SELECT * FROM Productos WHERE idproducto = _idproducto;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_registrar_categorias` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_registrar_categorias` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_registrar_categorias`(
IN _categoria		VARCHAR(30)
)
BEGIN
	INSERT INTO Categorias (categoria) VALUES (_categoria);
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_registrar_marcas` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_registrar_marcas` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_registrar_marcas`(
IN _marca		VARCHAR(30)
)
BEGIN
	INSERT INTO Marcas (marca) VALUES (_marca);
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_registrar_movimientos` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_registrar_movimientos` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_registrar_movimientos`(
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
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_registrar_personas` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_registrar_personas` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_registrar_personas`(
IN _apellidos 			VARCHAR(30),
IN _nombres			VARCHAR(30),
IN _telefono			VARCHAR(9),
IN _email			VARCHAR(30)
)
BEGIN
	INSERT INTO Personas (apellidos, nombres, telefono, email) VALUES (_apellidos, _nombres, _telefono, _email);
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_registrar_productos` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_registrar_productos` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_registrar_productos`(
IN _idcategoria		INT,
IN _idmarca		int,
IN _descripcion 	VARCHAR(100),
IN _modelo		varchar(30),
IN _precio		DECIMAL(9,2),
in _stock		int
)
BEGIN
	INSERT INTO Productos(idcategoria, idmarca, descripcion, modelo, precio, stock) VALUES (_idcategoria, _idmarca, _descripcion, _modelo, _precio, _stock);
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_registrar_usuarios` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_registrar_usuarios` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_registrar_usuarios`(
    IN _idpersona INT,
    IN _nombreusuario VARCHAR(30),
    IN _claveacceso VARCHAR(100),
    in _nivelacceso char(3)
)
BEGIN
    INSERT INTO Usuarios (idpersona, nombreusuario, claveacceso, nivelacceso) VALUES (_idpersona, _nombreusuario, _claveacceso, _nivelacceso);
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_resumen_productos` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_resumen_productos` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_resumen_productos`()
begin
	select stock, count(*) as Movimientos
	from Productos
	group by stock
	order by idproducto desc;
end */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
