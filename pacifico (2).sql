-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-09-2020 a las 08:42:45
-- Versión del servidor: 10.3.16-MariaDB
-- Versión de PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pacifico`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `compra_new` (IN `codigo` VARCHAR(20), IN `fecha` VARCHAR(30), IN `monto_c` DOUBLE, IN `saldo_a` DOUBLE)  BEGIN

set @id_c = 0;
set @cod_p = '';

select @id_c := id_cliente from cliente where cod_cliente = codigo;
if exists(select @cod_p := id_comp_c from compras_cliente where id_cliente = @id_c order by id_comp_c desc limit 1)then
	select @cod_p := id_comp_c from compras_cliente where id_cliente = @id_c order by id_comp_c desc limit 1;
else
	set @cod_p = '1';
end if;

insert into compras_cliente(cod_compra,llave_compra,estado_compra,monto_compra,fecha_compra,id_cliente)
		values (concat('CMP-N',@cod_p+1),concat('NPMC',@cod_p,'ALL'),'PROCESO',monto_c,fecha,@id_c);
select LAST_INSERT_ID() INTO @id_p;
insert into pago(fecha_pago,saldo_p,metodo,monto_p,id_comp_c)
		values(fecha,saldo_a,'EN EFECTIVO',monto_c,@id_p);
update cliente set saldo = (saldo_a - monto_c) where cod_cliente = codigo;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `prod_compra` (IN `cod_pro` VARCHAR(50), IN `precio` DOUBLE, IN `cantidad_comp` DOUBLE, IN `id_comp` INT)  BEGIN
set @id_p = 0;

select @id_p := id_producto from producto where cod_producto = cod_pro;
insert into produc_compra_client(id_comp_c,id_producto,cant_producto_c,precio_producto_c)
		values(id_comp,@id_p,cantidad_comp,precio);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registrar_compra` (IN `codigo_c` VARCHAR(20), IN `codigo_p` VARCHAR(10), IN `saldo_` DOUBLE, IN `cantidad` INT(11), IN `precio_p` DOUBLE, IN `metodo` VARCHAR(50), IN `monto_p_` DOUBLE, IN `fecha` VARCHAR(30))  BEGIN
set @id_c = 0;
set @cod_p = '';

select @id_c := id_cliente from cliente where cod_cliente = codigo_c;
if exists(select @cod_p := id_comp_c from compras_cliente where id_cliente = @id_c order by id_comp_c desc limit 1)then
	select @cod_p := id_comp_c from compras_cliente where id_cliente = @id_c order by id_comp_c desc limit 1;
else
	set @cod_p = '1';
end if;
insert into compras_cliente(cod_compra,llave_compra,estado_compra,monto_compra,fecha_compra,id_cliente)
		values (concat('CMP-N',@cod_p+1),concat('NPMC',@cod_p,'ALL'),'PROCESO',monto_p_,fecha,@id_c);
select LAST_INSERT_ID() INTO @id_p;
insert into pago(fecha_pago,saldo_p,metodo,monto_p,id_comp_c)
		values(fecha,saldo_,'EN EFECTIVO',monto_p_,@id_p);
set @id_pr = 0;
select @id_pr := id_producto from producto where cod_producto = codigo_p;
insert into produc_compra_client(id_comp_c,id_producto,cant_producto_c,precio_producto_c)
		values(@id_p,@id_pr,cantidad,precio_p);
        
update cliente set saldo = saldo_ where cod_cliente = codigo_c;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registro_clientes` (IN `nombres_` VARCHAR(50), IN `apellidos_` VARCHAR(50), IN `edad_` INT(2), IN `sexo_` VARCHAR(10), IN `direccion_` VARCHAR(100), IN `cel_` INT(9), IN `tel_` INT(10), IN `dni_` INT(8), IN `fecha_` VARCHAR(50), IN `usuario_` VARCHAR(50), IN `clave_` VARCHAR(80), IN `estado_cliente_` VARCHAR(20))  begin
insert into persona(nombres_p,
apellidos_p,
edad,
sexo,
direccion_p,
nro_cel,
nro_tel,
dni,
fecha_r,
usuario,
clave) values(
nombres_,apellidos_,edad_,sexo_,direccion_,cel_,tel_,dni_,fecha_,usuario_,clave_);
select LAST_INSERT_ID() INTO @id_p;
insert into cliente(cod_cliente,saldo,estado_cliente,id_persona) 
values(concat("CL",cast(@id_p as char)),0.0,estado_cliente_,@id_p);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registro_producto` (IN `cod_cat` VARCHAR(50), IN `nombre_cat` VARCHAR(50), IN `descrip_cat` VARCHAR(500), IN `cod_product` VARCHAR(10), IN `fecha_ing_p` VARCHAR(30), IN `cant_produc` INT(11), IN `est_p` VARCHAR(30), IN `est_v` VARCHAR(10), IN `nom_p` VARCHAR(100), IN `descrip_p` VARCHAR(1000), IN `altura_p` DOUBLE, IN `ancho_p` DOUBLE, IN `precio_p` DOUBLE, IN `precio_p_a` DOUBLE, IN `color_p` VARCHAR(50), IN `foto1_` VARCHAR(100), IN `foto2_` VARCHAR(100), IN `foto3_` VARCHAR(100), IN `descu_p` DOUBLE, IN `fecha_ini` VARCHAR(30), IN `fecha_fin` VARCHAR(30), IN `est_cat` INT)  begin
if (est_cat > 0)then
INSERT INTO cat_producto(
    cod_categoria,
    nombre_cat_producto,
    descrip_cat_producto
)values(cod_cat,nombre_cat,descrip_cat);
select LAST_INSERT_ID() INTO @id_cat;

else
set @id_cat= null;
select @id_cat := id_cat_producto from cat_producto where cod_categoria like cod_cat;
end if;
insert into producto(cod_producto,fecha_ingreso_p,cant_producto,estado_producto,estado_venta,id_cat_producto)values(cod_product,fecha_ing_p,cant_produc,est_p,est_v,@id_cat);
select LAST_INSERT_ID() INTO @id_pr;
INSERT INTO det_producto(
    nombre_producto,
    descripcion_producto,
    altura_producto,
    anchura_producto,
    precio_producto,
    precio_producto_almacen,
    color_producto,
    foto1,
    foto2,
    foto3,
    descuento_producto,
    fecha_ini_descuento,
    fecha_fin_descuento,
    id_producto
)values(
    nom_p,
    descrip_p,
    altura_p,
    ancho_p,
    precio_p,
    precio_p_a,
    color_p,foto1_,foto2_,foto3_,descu_p,fecha_ini,fecha_fin,@id_pr);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `valid_user` (IN `user_` VARCHAR(50))  begin
	set @codigo=null;
	if exists (select cod_cliente from persona,cliente where cliente.id_persona = persona.id_persona and usuario = user_)then 
		select cod_cliente into @codigo from persona,cliente where cliente.id_persona = persona.id_persona and usuario = user_;
	elseif exists (select cod_admin from persona,administrador where administrador.id_persona = persona.id_persona and usuario = user_) then
		select cod_admin into @codigo from persona,administrador where administrador.id_persona = persona.id_persona and usuario = user_;
	elseif exists (select cod_administrativo from persona,trabajador,cat_trabajador,administrativo where trabajador.id_persona = persona.id_persona and cat_trabajador.id_trabajador = trabajador.id_trabajador and administrativo.id_cat_trabajador = cat_trabajador.id_cat_trabajador and usuario = user_)then
		select cod_administrativo into @codigo from persona,trabajador,cat_trabajador,administrativo where trabajador.id_persona = persona.id_persona and cat_trabajador.id_trabajador = trabajador.id_trabajador and administrativo.id_cat_trabajador = cat_trabajador.id_cat_trabajador and usuario = user_;
	elseif exists (select cod_almacen from persona,trabajador,cat_trabajador,almacen where trabajador.id_persona = persona.id_persona and cat_trabajador.id_trabajador = trabajador.id_trabajador and almacen.id_cat_trabajador = cat_trabajador.id_cat_trabajador and usuario = user_)then
		select cod_almacen into @codigo from persona,trabajador,cat_trabajador,almacen where trabajador.id_persona = persona.id_persona and cat_trabajador.id_trabajador = trabajador.id_trabajador and almacen.id_cat_trabajador = cat_trabajador.id_cat_trabajador and usuario = user_;
	elseif exists (select cod_repartidor from persona,trabajador,cat_trabajador,repartidor where trabajador.id_persona = persona.id_persona and cat_trabajador.id_trabajador = trabajador.id_trabajador and repartidor.id_cat_trabajador = cat_trabajador.id_cat_trabajador and usuario = user_)then 
		select cod_repartidor into @codigo from persona,trabajador,cat_trabajador,repartidor where trabajador.id_persona = persona.id_persona and cat_trabajador.id_trabajador = trabajador.id_trabajador and repartidor.id_cat_trabajador = cat_trabajador.id_cat_trabajador and usuario = user_;
	end if;

	select @codigo;

end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `id_admi` int(11) NOT NULL,
  `titulo` varchar(50) DEFAULT NULL,
  `cod_admin` varchar(10) NOT NULL,
  `id_persona` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id_admi`, `titulo`, `cod_admin`, `id_persona`) VALUES
(1, 'Ing.', 'AD-P-1', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrativo`
--

CREATE TABLE `administrativo` (
  `id_administrativo` int(11) NOT NULL,
  `cod_administrativo` varchar(10) NOT NULL,
  `cargo` varchar(20) DEFAULT NULL,
  `id_cat_trabajador` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `administrativo`
--

INSERT INTO `administrativo` (`id_administrativo`, `cod_administrativo`, `cargo`, `id_cat_trabajador`) VALUES
(1, 'AM-1', 'CONTADOR', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen`
--

CREATE TABLE `almacen` (
  `id_almacen` int(11) NOT NULL,
  `cod_almacen` varchar(10) NOT NULL,
  `id_cat_trabajador` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `almacen`
--

INSERT INTO `almacen` (`id_almacen`, `cod_almacen`, `id_cat_trabajador`) VALUES
(1, 'AL-1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_producto`
--

CREATE TABLE `cat_producto` (
  `id_cat_producto` int(11) NOT NULL,
  `cod_categoria` varchar(50) NOT NULL,
  `nombre_cat_producto` varchar(50) DEFAULT NULL,
  `descrip_cat_producto` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cat_producto`
--

INSERT INTO `cat_producto` (`id_cat_producto`, `cod_categoria`, `nombre_cat_producto`, `descrip_cat_producto`) VALUES
(1, 'CCP', 'Conservas y Comida Preparada', 'Descubra la gran variedad, calidad y facilidad de los preparados ecológicos. Donde la rapidez no está reñida con la calidad.'),
(2, 'ZB', 'Zumos y Bebidas', 'Zumos elaborados de forma artesana que garantiza la máxima calidad y nos permite la conservación de todo su sabor y valor nutritivo. Zumos que aportan un mayor número de vitaminas naturales.\nDescubre la increíble calidad de los vinos ecológicos.'),
(3, 'APL', 'Aceite, Pasta y Legumbres', 'Aceites de altísima calidad, en aroma y sabor; de las variedades hojiblanca y alberquina, obtenidos de la extracción en frio utilizando únicamente procesos mecánicos (eco).'),
(4, 'LC', 'Lacteos', 'productos hechos a partir de la leche o que derivan de la misma, como ser queso, yogurt, manteca, crema de leche');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_trabajador`
--

CREATE TABLE `cat_trabajador` (
  `id_cat_trabajador` int(11) NOT NULL,
  `nombre_categoria` varchar(50) DEFAULT NULL,
  `cod_categoria` varchar(30) DEFAULT NULL,
  `id_trabajador` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cat_trabajador`
--

INSERT INTO `cat_trabajador` (`id_cat_trabajador`, `nombre_categoria`, `cod_categoria`, `id_trabajador`) VALUES
(1, 'Encargado de Almacen', 'EAT-P', 4),
(3, 'Personal de Entregas', 'PERT-P', 3),
(4, 'Administrativo Contable', 'ACT-P', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `cod_cliente` varchar(20) DEFAULT NULL,
  `saldo` double NOT NULL,
  `cat_cliente` varchar(10) DEFAULT NULL,
  `estado_cliente` varchar(20) NOT NULL,
  `id_persona` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `cod_cliente`, `saldo`, `cat_cliente`, `estado_cliente`, `id_persona`) VALUES
(1, 'CL1', 50, 'CL1-A', 'HABILITADO', 1),
(2, 'CL2', 160.54999999999998, 'CL1-B', 'HABILITADO', 2),
(3, 'CL3', 20, 'CL1-C', 'HABILITADO', 3),
(4, 'CL8', 0, NULL, 'HABILITADO', 8),
(5, 'CL9', 0, NULL, 'HABILITADO', 9),
(6, 'CL10', 0, NULL, 'HABILITADO', 10),
(7, 'CL12', 0, NULL, 'HABILITADO', 12),
(8, 'CL13', 0, NULL, 'HABILITADO', 13),
(9, 'CL14', 0, NULL, 'HABILITADO', 14),
(10, 'CL15', 0, NULL, 'HABILITADO', 15),
(11, 'CL16', 0, NULL, 'HABILITADO', 16);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `compras`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `compras` (
`cod_cliente` varchar(20)
,`cod_compra` varchar(10)
,`llave_compra` varchar(10)
,`estado_compra` varchar(20)
,`monto_compra` double
,`fecha_compra` varchar(30)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras_almacen`
--

CREATE TABLE `compras_almacen` (
  `id_comp_alm` int(11) NOT NULL,
  `cod_compra_alm` varchar(10) DEFAULT NULL,
  `estado_compra_alm` varchar(20) DEFAULT NULL,
  `fecha_comp_alm` varchar(30) DEFAULT NULL,
  `monto_compra_alm` double DEFAULT NULL,
  `id_almacen` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compras_almacen`
--

INSERT INTO `compras_almacen` (`id_comp_alm`, `cod_compra_alm`, `estado_compra_alm`, `fecha_comp_alm`, `monto_compra_alm`, `id_almacen`) VALUES
(1, 'CMP-AN1', 'APROBADO', '7/7/2020 15:30:20', 41.5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras_cliente`
--

CREATE TABLE `compras_cliente` (
  `id_comp_c` int(11) NOT NULL,
  `cod_compra` varchar(10) DEFAULT NULL,
  `llave_compra` varchar(10) DEFAULT NULL,
  `estado_compra` varchar(20) DEFAULT NULL,
  `monto_compra` double DEFAULT NULL,
  `fecha_compra` varchar(30) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compras_cliente`
--

INSERT INTO `compras_cliente` (`id_comp_c`, `cod_compra`, `llave_compra`, `estado_compra`, `monto_compra`, `fecha_compra`, `id_cliente`) VALUES
(1, 'CMP-N1', 'NPMCA1ALL', 'PROCESO', 5.8, '7/7/2020 19:24:59', 2),
(2, 'CMP-N2', 'NPMCB2BLL', 'COMPLETADO', 4.5, '7/7/2020 20:30:00', 2),
(3, 'CMP-N3', 'NPMC2ALL', 'PROCESO', 4.65, '2020-09-07 02:07:54', 2),
(4, 'CMP-N4', 'NPMC3ALL', 'PROCESO', 5, '2020-09-07 02:12:26', 2),
(5, 'CMP-N5', 'NPMC4ALL', 'PROCESO', 0.6, '2020-09-07 02:17:54', 2),
(6, 'CMP-N6', 'NPMC5ALL', 'PROCESO', 0.6, '2020-09-07 02:48:06', 2),
(32, 'CMP-N7', 'NPMC6ALL', 'PROCESO', 21.8, '2020-09-07 06:40:51', 2);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `contador_compras`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `contador_compras` (
`compras` bigint(21)
,`cod_cliente` varchar(20)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `contador_recargas`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `contador_recargas` (
`recargas` bigint(21)
,`cod_cliente` varchar(20)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dat_cliente`
--

CREATE TABLE `dat_cliente` (
  `id_dat_cliente` int(11) NOT NULL,
  `distrito_c` varchar(30) DEFAULT NULL,
  `provincia_c` varchar(30) DEFAULT NULL,
  `departamento_c` varchar(30) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `dat_cliente`
--

INSERT INTO `dat_cliente` (`id_dat_cliente`, `distrito_c`, `provincia_c`, `departamento_c`, `id_cliente`) VALUES
(1, 'TAMBOPATA', 'TAMBOPATA', 'MADRE DE DIOS', 1),
(2, 'TAMBOPATA', 'TAMBOPATA', 'MADRE DE DIOS', 2),
(3, 'TAMBOPATA', 'TAMBOPATA', 'MADRE DE DIOS', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `det_producto`
--

CREATE TABLE `det_producto` (
  `id_det_producto` int(11) NOT NULL,
  `nombre_producto` varchar(100) DEFAULT NULL,
  `descripcion_producto` varchar(1000) DEFAULT NULL,
  `altura_producto` double DEFAULT NULL,
  `anchura_producto` double DEFAULT NULL,
  `precio_producto` double DEFAULT NULL,
  `precio_producto_almacen` double NOT NULL,
  `color_producto` varchar(50) DEFAULT NULL,
  `foto1` varchar(100) NOT NULL,
  `foto2` varchar(100) NOT NULL,
  `foto3` varchar(100) NOT NULL,
  `descuento_producto` double DEFAULT NULL,
  `fecha_ini_descuento` varchar(30) DEFAULT NULL,
  `fecha_fin_descuento` varchar(30) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `det_producto`
--

INSERT INTO `det_producto` (`id_det_producto`, `nombre_producto`, `descripcion_producto`, `altura_producto`, `anchura_producto`, `precio_producto`, `precio_producto_almacen`, `color_producto`, `foto1`, `foto2`, `foto3`, `descuento_producto`, `fecha_ini_descuento`, `fecha_fin_descuento`, `id_producto`) VALUES
(1, 'Yogurt Gloria 1L', 'Yogurt de fresas y leche gloria de 1L. envace plastico,bottela ecoamigable', 22.5, 5.4, 5, 0, 'Blanco', '', '', '', 0.05, '2020-07-07 18:39:04', '2020-07-09 18:39:04', 7),
(2, 'Yogurt Live 500ml', 'Yogurt de leche Live de 500ml. envace plastico,bottela ecoamigable', 10, 4.9, 1.5, 0, 'Blanco', '', '', '', 0.2, '2020-07-07 18:39:04', '2020-09-07 18:39:04', 8),
(3, 'Aceite Soya 1L', 'Aceite vegetal ára frituras y ensaladas Soya  de 1L amigable con el paladar', 20, 6, 5, 0, 'Blanco', '', '', '', 0.07, '2020-07-07 18:39:04', '2020-09-07 18:39:04', 6),
(4, 'Atun A1', 'Atun enlatado y triturado para ensaladas, concerva enlatada de 200g.', 3, 10, 3, 0, 'Blanco', '', '', '', 0, '2020-07-07 18:39:04', '2020-09-07 18:39:04', 5),
(5, 'Yogur Nestle 125g.', 'Yogur envasado portátil ideal para refrigerios y combinarlos con cereales', 4, 125, 0.6, 0.4, 'Cleste', '', '', '', NULL, NULL, NULL, 9),
(6, 'Yogur Nestle 1L', 'Yogur de leche El clásico Yogur Natural Nestlé disponible en formato ahorro.', 8, 125, 5, 4.7, 'Azul,Blanco', '', '', '', NULL, NULL, NULL, 10),
(9, 'Leche Gloria 400g', 'Es una leche evaporada enriquecida con vitaminas A y D fuente natural de proteínas y minerales como el calcio y el fósforo. Las proteínas son nutrientes que promueven el crecimiento y contribuyen a conservar la masa muscular y los minerales calcio y fósforo ayudan a mantener los huesos y dientes.', 0, 0, 3.2, 2.8, 'Azul', '3P.jpg', '2P.jpg', '1P.jpg', 0, '', '', 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envio`
--

CREATE TABLE `envio` (
  `id_envio` int(11) NOT NULL,
  `id_repartidor` int(11) DEFAULT NULL,
  `id_comp_c` int(11) DEFAULT NULL,
  `estado_alm` varchar(30) DEFAULT NULL,
  `fecha_envio` varchar(30) DEFAULT NULL,
  `fecha_llegada` varchar(30) DEFAULT NULL,
  `firma_c` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `envio`
--

INSERT INTO `envio` (`id_envio`, `id_repartidor`, `id_comp_c`, `estado_alm`, `fecha_envio`, `fecha_llegada`, `firma_c`) VALUES
(1, 1, 2, 'ENVIADO', '7/7/2020 20:35:00', '7/7/2020 20:55:00', 'NPMCB2BLL');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `lista_compras`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `lista_compras` (
`cod_cliente` varchar(20)
,`cod_compra` varchar(10)
,`cant_producto` int(11)
,`precio_producto_c` double
,`nombre_producto` varchar(100)
,`foto1` varchar(100)
,`estado_compra` varchar(20)
,`cod_producto` varchar(10)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `lista_compras_c`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `lista_compras_c` (
`cod_cliente` varchar(20)
,`cod_compra` varchar(10)
,`cant_producto_c` int(11)
,`precio_producto_c` double
,`nombre_producto` varchar(100)
,`foto1` varchar(100)
,`saldo_p` double
,`metodo` varchar(50)
,`monto_p` double
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE `pago` (
  `id_pago` int(11) NOT NULL,
  `fecha_pago` varchar(30) DEFAULT NULL,
  `saldo_p` double DEFAULT NULL,
  `metodo` varchar(50) DEFAULT NULL,
  `monto_p` double DEFAULT NULL,
  `id_comp_c` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pago`
--

INSERT INTO `pago` (`id_pago`, `fecha_pago`, `saldo_p`, `metodo`, `monto_p`, `id_comp_c`) VALUES
(2, '7/7/2020 19:30:17', 0, 'EN EFECTIVO', 4.5, 2),
(3, '2020-09-07 02:07:54', 10.35, 'EN EFECTIVO', NULL, 3),
(4, '2020-09-07 02:12:26', 5.35, 'EN EFECTIVO', NULL, 4),
(5, '2020-09-07 02:17:54', 4.75, 'EN EFECTIVO', 0.6, 5),
(6, '2020-09-07 02:48:06', 4.15, 'EN EFECTIVO', 0.6, 6),
(22, '2020-09-07 06:40:51', 182.35, 'EN EFECTIVO', 21.8, 32);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `perfil_admi`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `perfil_admi` (
`nombres_p` varchar(50)
,`apellidos_p` varchar(50)
,`edad` int(2)
,`sexo` varchar(10)
,`direccion_p` varchar(100)
,`nro_cel` int(9)
,`nro_tel` int(10)
,`dni` int(8)
,`fecha_r` varchar(50)
,`usuario` varchar(50)
,`clave` varchar(80)
,`titulo` varchar(50)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `perfil_cliente`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `perfil_cliente` (
`nombres_p` varchar(50)
,`apellidos_p` varchar(50)
,`edad` int(2)
,`sexo` varchar(10)
,`direccion_p` varchar(100)
,`nro_cel` int(9)
,`nro_tel` int(10)
,`dni` int(8)
,`fecha_r` varchar(50)
,`usuario` varchar(50)
,`clave` varchar(80)
,`cod_cliente` varchar(20)
,`saldo` double
,`estado_cliente` varchar(20)
,`distrito_c` varchar(30)
,`provincia_c` varchar(30)
,`departamento_c` varchar(30)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `perfil_trabajador_admi`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `perfil_trabajador_admi` (
`nombres_p` varchar(50)
,`apellidos_p` varchar(50)
,`edad` int(2)
,`sexo` varchar(10)
,`direccion_p` varchar(100)
,`nro_cel` int(9)
,`nro_tel` int(10)
,`dni` int(8)
,`fecha_r` varchar(50)
,`usuario` varchar(50)
,`clave` varchar(80)
,`cod_trabajador` varchar(10)
,`estado` varchar(20)
,`ruc_t` bigint(20)
,`sueldo_t` double
,`nombre_categoria` varchar(50)
,`cod_categoria` varchar(30)
,`cargo` varchar(20)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `perfil_trabajador_almacen`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `perfil_trabajador_almacen` (
`nombres_p` varchar(50)
,`apellidos_p` varchar(50)
,`edad` int(2)
,`sexo` varchar(10)
,`direccion_p` varchar(100)
,`nro_cel` int(9)
,`nro_tel` int(10)
,`dni` int(8)
,`fecha_r` varchar(50)
,`usuario` varchar(50)
,`clave` varchar(80)
,`cod_trabajador` varchar(10)
,`estado` varchar(20)
,`ruc_t` bigint(20)
,`sueldo_t` double
,`nombre_categoria` varchar(50)
,`cod_categoria` varchar(30)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `perfil_trabajador_repartidor`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `perfil_trabajador_repartidor` (
`nombres_p` varchar(50)
,`apellidos_p` varchar(50)
,`edad` int(2)
,`sexo` varchar(10)
,`direccion_p` varchar(100)
,`nro_cel` int(9)
,`nro_tel` int(10)
,`dni` int(8)
,`fecha_r` varchar(50)
,`usuario` varchar(50)
,`clave` varchar(80)
,`cod_trabajador` varchar(10)
,`estado` varchar(20)
,`ruc_t` bigint(20)
,`sueldo_t` double
,`nombre_categoria` varchar(50)
,`cod_categoria` varchar(30)
,`estado_doc` varchar(20)
,`placa_v` varchar(10)
,`modelo_v` varchar(50)
,`color_v` varchar(20)
,`nro_ruedas` int(2)
,`estado_v` varchar(10)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id_persona` int(11) NOT NULL,
  `nombres_p` varchar(50) DEFAULT NULL,
  `apellidos_p` varchar(50) DEFAULT NULL,
  `edad` int(2) DEFAULT NULL,
  `sexo` varchar(10) DEFAULT NULL,
  `direccion_p` varchar(100) DEFAULT NULL,
  `nro_cel` int(9) DEFAULT NULL,
  `nro_tel` int(10) DEFAULT NULL,
  `dni` int(8) DEFAULT NULL,
  `fecha_r` varchar(50) DEFAULT NULL,
  `usuario` varchar(50) DEFAULT NULL,
  `clave` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id_persona`, `nombres_p`, `apellidos_p`, `edad`, `sexo`, `direccion_p`, `nro_cel`, `nro_tel`, `dni`, `fecha_r`, `usuario`, `clave`) VALUES
(1, 'Fernando', 'Flores Condori', 20, 'MASCULINO', 'Jr. gonzales Prada', 987654321, 82752499, 75206432, '2020-07-07 13:01:23', 'cliente1@pacifico.com', '$2y$12$sY1KufZwUdztY/WxV4xPBeneyNaqrsV.FW.11wi2GWX6888.eR7aq'),
(2, 'Erik', 'Lopez Palomino', 20, '0', 'Av. Gonzales Prada', 987654333, 82752489, 75206435, '2020-07-07 13:01:23', 'cliente2@pacifico.com', '$2y$12$tiyUGQgIwa/e78z3szhoH.YhfjLcKtvt4U50m/Cx.wiRt0KSGxHA6'),
(3, 'Yoshiro', 'Lopez Palomino', 23, 'MASCULINO', 'Av. Leon Velarde', 987654931, 82752789, 75206433, '2020-07-07 13:01:23', 'cliente3@pacifico.com', '$2y$12$8FhJMtt86wqvFMdF2qubKeat9whclp2A5CkKHqpcDnghzUQKUWcWy'),
(4, 'Christian', 'Perez Gomez', 21, 'MASCULINO', 'Av. Leon Velarde', 987652931, 82753789, 75206233, '2020-07-07 13:01:23', 'empleado1@pacifico.com', '$2y$12$UHXfc9g0B6hXZ365Te30nuMXNAUD/wL0GnsSTH4kGH3IM3L2m1V4K'),
(5, 'Henrri', 'Ortega Quiñones', 29, 'MASCULINO', 'Av. Leon Velarde', 987652991, 82753719, 75206237, '2020-07-07 13:01:23', 'empleado2@pacifico.com', '$2y$12$UaIMR4O0SPmo.ctEAQKtdeSwb3Rii6MR7hdRdjwA2rUpC2Jv.C2wC'),
(6, 'Elice', 'Quispe Contreras', 20, 'FEMENINO', 'Av. Leon Velarde', 987652991, 82793719, 75209237, '2020-07-07 13:01:23', 'empleado3@pacifico.com', '$2y$12$TY4iSBH6GHd77o.uD9xNp.V0BRregw6Lt6Dqip2mjcl7wBsen2bX.'),
(7, 'Laura', 'Torres Viciagui', 27, 'FEMENINO', 'Av. Leon Velarde', 987152991, 82193719, 75219237, '2020-07-07 13:01:23', 'Admin@pacifico.com', '$2y$12$sY1KufZwUdztY/WxV4xPBeneyNaqrsV.FW.11wi2GWX6888.eR7aq'),
(8, 'Pedro', 'Estrada L', 20, 'MASCULINO', 'Jr. gonzales Prada', 987654321, 82752499, 75906432, '2020-07-07 13:01:23', 'clienteasd@pacifico.com', '$2y$12$jYY4vbgl7p7gAX3fUjCHDOTBRBs21nzT.fu0bhY8.KkJAI3Hul0Zq'),
(9, 'Maria', 'Cardoso Lopez', 27, 'Femenino', 'Jr. gonzales Prada', 987654721, 82759499, 45906432, '2020-07-07 13:01:23', 'cliente9@pacifico.com', '$2y$12$Fm01bAqBWAqaZExds6WFo.t1U64WBCLErnzxOHmuEDRVnmNae4Hp6'),
(10, 'Maria', 'Cardoso Lopez', 27, 'Femenino', 'Jr. gonzales Prada', 987654721, 82759499, 45902432, '2020-07-07 13:01:23', 'cliente10@pacifico.com', '$2y$12$KrjmuK9794/9Ha2cLi834O0mUzR0pZOJRZ0i7YCycxA3UOIxFbqBa'),
(12, 'Erik', 'Paredes', 0, 'Masculino', 'Av. Ernesto rivero', 1, 1, 1, '1', 'paredes@pacifico.com', '$2y$12$AMhxbbdOM91/BtH2bD4kRedoYhTbJCelsuiK0B1xU5/DXEAknZ9OW'),
(13, 'Karen', 'molina', 25, 'Femenino', 'Av. Leon Velarde', 953624167, 461253, 95431672, '2020-08-16 17:53:31', 'molina@pacifico.com', '$2y$12$Q7Jg081dBHqDbW.39sRJresWn0sGtX0C5JNi52a/BWQIl.CjLkleK'),
(14, 'Elver', 'Corahua', 30, 'Masculino', 'Jr. Los Robles', 945126357, 461253, 46127359, '2020-08-16 17:58:09', 'cor@pacifico.com', '$2y$12$82ferQ5tIkpj5qTqtnwK4exEk7OxAyXgL06dfux7D8zmo1p2g6NWO'),
(15, 'Giuliana', 'sahuarico ochoa', 26, 'Femenino', '', 958613746, 956432, 49267681, '2020-08-17 08:23:58', 'emp@pacifico.com', '$2y$12$ivL6g.IcmxabLMDOYTj40uNtPay7CUlgoJxSFvrxfYdWCtWhG2UXC'),
(16, 'Sandro', 'Martinez', 36, 'Masculino', 'Av. sdads', 53534554, 45544445, 5656565, '2020-08-19 16:46:52', 'asdssss@asd.com', '$2y$12$2AZgPzyWr10gX5XjEF771udhLoOARoNg03GwFntDr6n09FZH1EzPO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `cod_producto` varchar(10) DEFAULT NULL,
  `fecha_ingreso_p` varchar(30) DEFAULT NULL,
  `cant_producto` int(11) DEFAULT NULL,
  `estado_producto` varchar(30) DEFAULT NULL,
  `estado_venta` varchar(10) DEFAULT NULL,
  `id_cat_producto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `cod_producto`, `fecha_ingreso_p`, `cant_producto`, `estado_producto`, `estado_venta`, `id_cat_producto`) VALUES
(5, 'CCP-A1', '7/7/2020 15:33:39', 3, 'EN STOCK', 'NO VIGENTE', 1),
(6, 'APL-AS', '7/7/2020 15:33:39', 2, 'EN STOCK', 'VIGENTE', 3),
(7, 'ZB-YG', '7/7/2020 15:33:39', 1, 'AGOTADO', 'VIGENTE', 2),
(8, 'ZB-YL', '7/7/2020 15:33:39', 1, 'AGOTADO', 'NO VIGENTE', 2),
(9, 'ZB-YNP', '26/8/2020 18:51:32', 1, 'EN STOCK', 'VIGENTE', 2),
(10, 'ZB-YN', '26/8/2020 18:51:32', 1, 'EN STOCK', 'VIGENTE', 2),
(11, 'LC-LG', '2020-09-06 15:32:47', 10, 'EN STOCK', 'NO VIGENTE', 4);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `productos_almacen`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `productos_almacen` (
`nombre_cat_producto` varchar(50)
,`cod_producto` varchar(10)
,`cant_producto` int(11)
,`estado_producto` varchar(30)
,`estado_venta` varchar(10)
,`nombre_producto` varchar(100)
,`descripcion_producto` varchar(1000)
,`foto1` varchar(100)
,`descuento_producto` double
,`fecha_fin_descuento` varchar(30)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `productos_index`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `productos_index` (
`cod_categoria` varchar(50)
,`nombre_cat_producto` varchar(50)
,`cod_producto` varchar(10)
,`estado_producto` varchar(30)
,`estado_venta` varchar(10)
,`nombre_producto` varchar(100)
,`descripcion_producto` varchar(1000)
,`precio_producto` double
,`foto1` varchar(100)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `productos_search`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `productos_search` (
`cod_categoria` varchar(50)
,`nombre_cat_producto` varchar(50)
,`cod_producto` varchar(10)
,`estado_producto` varchar(30)
,`estado_venta` varchar(10)
,`nombre_producto` varchar(100)
,`descripcion_producto` varchar(1000)
,`precio_producto` double
,`foto1` varchar(100)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `producto_view`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `producto_view` (
`cod_categoria` varchar(50)
,`nombre_cat_producto` varchar(50)
,`cod_producto` varchar(10)
,`cant_producto` int(11)
,`estado_producto` varchar(30)
,`nombre_producto` varchar(100)
,`descripcion_producto` varchar(1000)
,`altura_producto` double
,`anchura_producto` double
,`precio_producto` double
,`color_producto` varchar(50)
,`foto1` varchar(100)
,`foto2` varchar(100)
,`foto3` varchar(100)
,`descuento_producto` double
,`fecha_ini_descuento` varchar(30)
,`fecha_fin_descuento` varchar(30)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `produc_compra_almacen`
--

CREATE TABLE `produc_compra_almacen` (
  `id_produc_comp_alm` int(11) NOT NULL,
  `id_comp_alm` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `cant_producto_alm` int(11) DEFAULT NULL,
  `precio_producto_alm` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `produc_compra_almacen`
--

INSERT INTO `produc_compra_almacen` (`id_produc_comp_alm`, `id_comp_alm`, `id_producto`, `cant_producto_alm`, `precio_producto_alm`) VALUES
(1, 1, 7, 4, 4),
(2, 1, 8, 4, 1.1),
(3, 1, 5, 3, 2.9),
(4, 1, 6, 3, 4.1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `produc_compra_client`
--

CREATE TABLE `produc_compra_client` (
  `id_produc_comp` int(11) NOT NULL,
  `id_comp_c` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `cant_producto_c` int(11) DEFAULT NULL,
  `precio_producto_c` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `produc_compra_client`
--

INSERT INTO `produc_compra_client` (`id_produc_comp`, `id_comp_c`, `id_producto`, `cant_producto_c`, `precio_producto_c`) VALUES
(1, 1, 7, 1, 4.5),
(2, 1, 8, 1, 1.3),
(3, 2, 7, 1, 4.5),
(4, 3, 6, 1, 4.65),
(5, 4, 10, 1, 5),
(6, 5, 9, 1, 0.6),
(7, 6, 9, 1, 0.6),
(12, 6, 7, 2, 5),
(13, 6, 9, 3, 0.6),
(14, 6, 10, 1, 5),
(15, 6, 6, 1, 5);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `promocion_producto`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `promocion_producto` (
`nombre_producto` varchar(100)
,`foto1` varchar(100)
,`descuento_producto` double
,`cod_producto` varchar(10)
,`fecha_ini_descuento` varchar(30)
,`fecha_fin_descuento` varchar(30)
,`precio_producto` double
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id_prov` int(11) NOT NULL,
  `nombre_prov` varchar(50) DEFAULT NULL,
  `ruc_prov` bigint(20) DEFAULT NULL,
  `cod_producto` varchar(10) DEFAULT NULL,
  `direccion_prov` varchar(50) DEFAULT NULL,
  `distrito_prov` varchar(30) DEFAULT NULL,
  `provincia_prov` varchar(30) DEFAULT NULL,
  `departamento_prov` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id_prov`, `nombre_prov`, `ruc_prov`, `cod_producto`, `direccion_prov`, `distrito_prov`, `provincia_prov`, `departamento_prov`) VALUES
(1, 'ALICORP S.A.A.', 20414989277, 'ZB-YG', 'Jr 26 De Diciembre Nro 386', 'TAMBOPATA', 'TAMBOPATA', 'MADRE DE DIOS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recarga`
--

CREATE TABLE `recarga` (
  `id_recarga` int(11) NOT NULL,
  `monto_recarga` double DEFAULT NULL,
  `boucher` varchar(50) DEFAULT NULL,
  `estado_recarga` varchar(20) DEFAULT NULL,
  `fecha_recarga` varchar(20) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `recarga`
--

INSERT INTO `recarga` (`id_recarga`, `monto_recarga`, `boucher`, `estado_recarga`, `fecha_recarga`, `id_cliente`) VALUES
(1, 50, 'IMG-RECARGA-C1.JPG', 'COMPLETADO', '7/7/2020 20:12:56', 1),
(2, 20, 'IMG-RECARGA-C3.JPG', 'COMPLETADO', '8/7/2020 13:13:12', 3),
(3, 30, 'IMG-RECARGA-C2.JPG', 'PROCESO', '8/7/2020 7:13:12', 2),
(4, 15, 'giphy.gif', 'COMPLETADO', '2020-09-06 20:29:01', 2),
(5, 200, '678927-MLM31767026195_082019-O.png', 'COMPLETADO', '2020-09-07 05:56:10', 2);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `recargas`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `recargas` (
`cod_cliente` varchar(20)
,`monto_recarga` double
,`boucher` varchar(50)
,`estado_recarga` varchar(20)
,`fecha_recarga` varchar(20)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `repartidor`
--

CREATE TABLE `repartidor` (
  `id_repartidor` int(11) NOT NULL,
  `cod_repartidor` varchar(10) NOT NULL,
  `estado_doc` varchar(20) DEFAULT NULL,
  `id_cat_trabajador` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `repartidor`
--

INSERT INTO `repartidor` (`id_repartidor`, `cod_repartidor`, `estado_doc`, `id_cat_trabajador`) VALUES
(1, 'RP-1', 'EN-REGLA', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajador`
--

CREATE TABLE `trabajador` (
  `id_trabajador` int(11) NOT NULL,
  `cod_trabajador` varchar(10) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL,
  `ruc_t` bigint(20) DEFAULT NULL,
  `sueldo_t` double DEFAULT NULL,
  `id_persona` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `trabajador`
--

INSERT INTO `trabajador` (`id_trabajador`, `cod_trabajador`, `estado`, `ruc_t`, `sueldo_t`, `id_persona`) VALUES
(2, 'TR-P-4', 'ACTIVO', 10726967577, 1350, 4),
(3, 'TR-P-5', 'ACTIVO', 10752062377, 1300, 5),
(4, 'TR-P-6', 'ACTIVO', 10752092371, 1300, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo`
--

CREATE TABLE `vehiculo` (
  `id_vehiculo` int(11) NOT NULL,
  `placa_v` varchar(10) DEFAULT NULL,
  `modelo_v` varchar(50) DEFAULT NULL,
  `color_v` varchar(20) DEFAULT NULL,
  `nro_ruedas` int(2) DEFAULT NULL,
  `estado_v` varchar(10) DEFAULT NULL,
  `id_repartidor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vehiculo`
--

INSERT INTO `vehiculo` (`id_vehiculo`, `placa_v`, `modelo_v`, `color_v`, `nro_ruedas`, `estado_v`, `id_repartidor`) VALUES
(1, 'XT-50A', 'Hyosung Aquila Bobber GV300S 2020', 'NEGRO', 2, 'OPERATIVO', 1);

-- --------------------------------------------------------

--
-- Estructura para la vista `compras`
--
DROP TABLE IF EXISTS `compras`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `compras`  AS  select `cliente`.`cod_cliente` AS `cod_cliente`,`compras_cliente`.`cod_compra` AS `cod_compra`,`compras_cliente`.`llave_compra` AS `llave_compra`,`compras_cliente`.`estado_compra` AS `estado_compra`,`compras_cliente`.`monto_compra` AS `monto_compra`,`compras_cliente`.`fecha_compra` AS `fecha_compra` from (`cliente` join `compras_cliente`) where `compras_cliente`.`id_cliente` = `cliente`.`id_cliente` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `contador_compras`
--
DROP TABLE IF EXISTS `contador_compras`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `contador_compras`  AS  select count(0) AS `compras`,`cliente`.`cod_cliente` AS `cod_cliente` from (`cliente` join `compras_cliente`) where `compras_cliente`.`id_cliente` = `cliente`.`id_cliente` group by `cliente`.`cod_cliente` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `contador_recargas`
--
DROP TABLE IF EXISTS `contador_recargas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `contador_recargas`  AS  select count(0) AS `recargas`,`cliente`.`cod_cliente` AS `cod_cliente` from (`cliente` join `recarga`) where `recarga`.`id_cliente` = `cliente`.`id_cliente` group by `cliente`.`cod_cliente` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `lista_compras`
--
DROP TABLE IF EXISTS `lista_compras`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `lista_compras`  AS  select `cliente`.`cod_cliente` AS `cod_cliente`,`compras_cliente`.`cod_compra` AS `cod_compra`,`producto`.`cant_producto` AS `cant_producto`,`produc_compra_client`.`precio_producto_c` AS `precio_producto_c`,`det_producto`.`nombre_producto` AS `nombre_producto`,`det_producto`.`foto1` AS `foto1`,`compras_cliente`.`estado_compra` AS `estado_compra`,`producto`.`cod_producto` AS `cod_producto` from ((((`cliente` join `compras_cliente`) join `producto`) join `produc_compra_client`) join `det_producto`) where `compras_cliente`.`id_cliente` = `cliente`.`id_cliente` and `produc_compra_client`.`id_comp_c` = `compras_cliente`.`id_comp_c` and `produc_compra_client`.`id_producto` = `producto`.`id_producto` and `det_producto`.`id_producto` = `producto`.`id_producto` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `lista_compras_c`
--
DROP TABLE IF EXISTS `lista_compras_c`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `lista_compras_c`  AS  select `cliente`.`cod_cliente` AS `cod_cliente`,`compras_cliente`.`cod_compra` AS `cod_compra`,`produc_compra_client`.`cant_producto_c` AS `cant_producto_c`,`produc_compra_client`.`precio_producto_c` AS `precio_producto_c`,`det_producto`.`nombre_producto` AS `nombre_producto`,`det_producto`.`foto1` AS `foto1`,`pago`.`saldo_p` AS `saldo_p`,`pago`.`metodo` AS `metodo`,`pago`.`monto_p` AS `monto_p` from (((((`cliente` join `producto`) join `det_producto`) join `compras_cliente`) join `produc_compra_client`) join `pago`) where `compras_cliente`.`id_cliente` = `cliente`.`id_cliente` and `produc_compra_client`.`id_comp_c` = `compras_cliente`.`id_comp_c` and `produc_compra_client`.`id_producto` = `producto`.`id_producto` and `det_producto`.`id_producto` = `producto`.`id_producto` and `pago`.`id_comp_c` = `compras_cliente`.`id_comp_c` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `perfil_admi`
--
DROP TABLE IF EXISTS `perfil_admi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `perfil_admi`  AS  select `persona`.`nombres_p` AS `nombres_p`,`persona`.`apellidos_p` AS `apellidos_p`,`persona`.`edad` AS `edad`,`persona`.`sexo` AS `sexo`,`persona`.`direccion_p` AS `direccion_p`,`persona`.`nro_cel` AS `nro_cel`,`persona`.`nro_tel` AS `nro_tel`,`persona`.`dni` AS `dni`,`persona`.`fecha_r` AS `fecha_r`,`persona`.`usuario` AS `usuario`,`persona`.`clave` AS `clave`,`administrador`.`titulo` AS `titulo` from (`persona` join `administrador`) where `administrador`.`id_persona` = `persona`.`id_persona` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `perfil_cliente`
--
DROP TABLE IF EXISTS `perfil_cliente`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `perfil_cliente`  AS  select `persona`.`nombres_p` AS `nombres_p`,`persona`.`apellidos_p` AS `apellidos_p`,`persona`.`edad` AS `edad`,`persona`.`sexo` AS `sexo`,`persona`.`direccion_p` AS `direccion_p`,`persona`.`nro_cel` AS `nro_cel`,`persona`.`nro_tel` AS `nro_tel`,`persona`.`dni` AS `dni`,`persona`.`fecha_r` AS `fecha_r`,`persona`.`usuario` AS `usuario`,`persona`.`clave` AS `clave`,`cliente`.`cod_cliente` AS `cod_cliente`,`cliente`.`saldo` AS `saldo`,`cliente`.`estado_cliente` AS `estado_cliente`,`dat_cliente`.`distrito_c` AS `distrito_c`,`dat_cliente`.`provincia_c` AS `provincia_c`,`dat_cliente`.`departamento_c` AS `departamento_c` from ((`persona` join `cliente`) join `dat_cliente`) where `cliente`.`id_persona` = `persona`.`id_persona` and `dat_cliente`.`id_cliente` = `cliente`.`id_cliente` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `perfil_trabajador_admi`
--
DROP TABLE IF EXISTS `perfil_trabajador_admi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `perfil_trabajador_admi`  AS  select `persona`.`nombres_p` AS `nombres_p`,`persona`.`apellidos_p` AS `apellidos_p`,`persona`.`edad` AS `edad`,`persona`.`sexo` AS `sexo`,`persona`.`direccion_p` AS `direccion_p`,`persona`.`nro_cel` AS `nro_cel`,`persona`.`nro_tel` AS `nro_tel`,`persona`.`dni` AS `dni`,`persona`.`fecha_r` AS `fecha_r`,`persona`.`usuario` AS `usuario`,`persona`.`clave` AS `clave`,`trabajador`.`cod_trabajador` AS `cod_trabajador`,`trabajador`.`estado` AS `estado`,`trabajador`.`ruc_t` AS `ruc_t`,`trabajador`.`sueldo_t` AS `sueldo_t`,`cat_trabajador`.`nombre_categoria` AS `nombre_categoria`,`cat_trabajador`.`cod_categoria` AS `cod_categoria`,`administrativo`.`cargo` AS `cargo` from (((`persona` join `trabajador`) join `cat_trabajador`) join `administrativo`) where `trabajador`.`id_persona` = `persona`.`id_persona` and `cat_trabajador`.`id_trabajador` = `trabajador`.`id_trabajador` and `administrativo`.`id_cat_trabajador` = `cat_trabajador`.`id_cat_trabajador` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `perfil_trabajador_almacen`
--
DROP TABLE IF EXISTS `perfil_trabajador_almacen`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `perfil_trabajador_almacen`  AS  select `persona`.`nombres_p` AS `nombres_p`,`persona`.`apellidos_p` AS `apellidos_p`,`persona`.`edad` AS `edad`,`persona`.`sexo` AS `sexo`,`persona`.`direccion_p` AS `direccion_p`,`persona`.`nro_cel` AS `nro_cel`,`persona`.`nro_tel` AS `nro_tel`,`persona`.`dni` AS `dni`,`persona`.`fecha_r` AS `fecha_r`,`persona`.`usuario` AS `usuario`,`persona`.`clave` AS `clave`,`trabajador`.`cod_trabajador` AS `cod_trabajador`,`trabajador`.`estado` AS `estado`,`trabajador`.`ruc_t` AS `ruc_t`,`trabajador`.`sueldo_t` AS `sueldo_t`,`cat_trabajador`.`nombre_categoria` AS `nombre_categoria`,`cat_trabajador`.`cod_categoria` AS `cod_categoria` from (((`persona` join `trabajador`) join `cat_trabajador`) join `almacen`) where `trabajador`.`id_persona` = `persona`.`id_persona` and `cat_trabajador`.`id_trabajador` = `trabajador`.`id_trabajador` and `almacen`.`id_cat_trabajador` = `cat_trabajador`.`id_cat_trabajador` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `perfil_trabajador_repartidor`
--
DROP TABLE IF EXISTS `perfil_trabajador_repartidor`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `perfil_trabajador_repartidor`  AS  select `persona`.`nombres_p` AS `nombres_p`,`persona`.`apellidos_p` AS `apellidos_p`,`persona`.`edad` AS `edad`,`persona`.`sexo` AS `sexo`,`persona`.`direccion_p` AS `direccion_p`,`persona`.`nro_cel` AS `nro_cel`,`persona`.`nro_tel` AS `nro_tel`,`persona`.`dni` AS `dni`,`persona`.`fecha_r` AS `fecha_r`,`persona`.`usuario` AS `usuario`,`persona`.`clave` AS `clave`,`trabajador`.`cod_trabajador` AS `cod_trabajador`,`trabajador`.`estado` AS `estado`,`trabajador`.`ruc_t` AS `ruc_t`,`trabajador`.`sueldo_t` AS `sueldo_t`,`cat_trabajador`.`nombre_categoria` AS `nombre_categoria`,`cat_trabajador`.`cod_categoria` AS `cod_categoria`,`repartidor`.`estado_doc` AS `estado_doc`,`vehiculo`.`placa_v` AS `placa_v`,`vehiculo`.`modelo_v` AS `modelo_v`,`vehiculo`.`color_v` AS `color_v`,`vehiculo`.`nro_ruedas` AS `nro_ruedas`,`vehiculo`.`estado_v` AS `estado_v` from ((((`persona` join `trabajador`) join `cat_trabajador`) join `repartidor`) join `vehiculo`) where `trabajador`.`id_persona` = `persona`.`id_persona` and `cat_trabajador`.`id_trabajador` = `trabajador`.`id_trabajador` and `repartidor`.`id_cat_trabajador` = `cat_trabajador`.`id_cat_trabajador` and `vehiculo`.`id_repartidor` = `repartidor`.`id_repartidor` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `productos_almacen`
--
DROP TABLE IF EXISTS `productos_almacen`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `productos_almacen`  AS  select `cat_producto`.`nombre_cat_producto` AS `nombre_cat_producto`,`producto`.`cod_producto` AS `cod_producto`,`producto`.`cant_producto` AS `cant_producto`,`producto`.`estado_producto` AS `estado_producto`,`producto`.`estado_venta` AS `estado_venta`,`det_producto`.`nombre_producto` AS `nombre_producto`,`det_producto`.`descripcion_producto` AS `descripcion_producto`,`det_producto`.`foto1` AS `foto1`,`det_producto`.`descuento_producto` AS `descuento_producto`,`det_producto`.`fecha_fin_descuento` AS `fecha_fin_descuento` from ((`cat_producto` join `producto`) join `det_producto`) where `producto`.`id_cat_producto` = `cat_producto`.`id_cat_producto` and `det_producto`.`id_producto` = `producto`.`id_producto` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `productos_index`
--
DROP TABLE IF EXISTS `productos_index`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `productos_index`  AS  select `cat_producto`.`cod_categoria` AS `cod_categoria`,`cat_producto`.`nombre_cat_producto` AS `nombre_cat_producto`,`producto`.`cod_producto` AS `cod_producto`,`producto`.`estado_producto` AS `estado_producto`,`producto`.`estado_venta` AS `estado_venta`,`det_producto`.`nombre_producto` AS `nombre_producto`,`det_producto`.`descripcion_producto` AS `descripcion_producto`,`det_producto`.`precio_producto` AS `precio_producto`,`det_producto`.`foto1` AS `foto1` from ((`cat_producto` join `producto`) join `det_producto`) where `producto`.`id_cat_producto` = `cat_producto`.`id_cat_producto` and `det_producto`.`id_producto` = `producto`.`id_producto` order by `cat_producto`.`cod_categoria` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `productos_search`
--
DROP TABLE IF EXISTS `productos_search`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `productos_search`  AS  select `cat_producto`.`cod_categoria` AS `cod_categoria`,`cat_producto`.`nombre_cat_producto` AS `nombre_cat_producto`,`producto`.`cod_producto` AS `cod_producto`,`producto`.`estado_producto` AS `estado_producto`,`producto`.`estado_venta` AS `estado_venta`,`det_producto`.`nombre_producto` AS `nombre_producto`,`det_producto`.`descripcion_producto` AS `descripcion_producto`,`det_producto`.`precio_producto` AS `precio_producto`,`det_producto`.`foto1` AS `foto1` from ((`cat_producto` join `producto`) join `det_producto`) where `producto`.`id_cat_producto` = `cat_producto`.`id_cat_producto` and `det_producto`.`id_producto` = `producto`.`id_producto` and `producto`.`estado_venta` = 'VIGENTE' order by `cat_producto`.`cod_categoria` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `producto_view`
--
DROP TABLE IF EXISTS `producto_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `producto_view`  AS  select `cat_producto`.`cod_categoria` AS `cod_categoria`,`cat_producto`.`nombre_cat_producto` AS `nombre_cat_producto`,`producto`.`cod_producto` AS `cod_producto`,`producto`.`cant_producto` AS `cant_producto`,`producto`.`estado_producto` AS `estado_producto`,`det_producto`.`nombre_producto` AS `nombre_producto`,`det_producto`.`descripcion_producto` AS `descripcion_producto`,`det_producto`.`altura_producto` AS `altura_producto`,`det_producto`.`anchura_producto` AS `anchura_producto`,`det_producto`.`precio_producto` AS `precio_producto`,`det_producto`.`color_producto` AS `color_producto`,`det_producto`.`foto1` AS `foto1`,`det_producto`.`foto2` AS `foto2`,`det_producto`.`foto3` AS `foto3`,`det_producto`.`descuento_producto` AS `descuento_producto`,`det_producto`.`fecha_ini_descuento` AS `fecha_ini_descuento`,`det_producto`.`fecha_fin_descuento` AS `fecha_fin_descuento` from ((`cat_producto` join `producto`) join `det_producto`) where `producto`.`id_cat_producto` = `cat_producto`.`id_cat_producto` and `det_producto`.`id_producto` = `producto`.`id_producto` and `producto`.`estado_venta` = 'VIGENTE' ;

-- --------------------------------------------------------

--
-- Estructura para la vista `promocion_producto`
--
DROP TABLE IF EXISTS `promocion_producto`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `promocion_producto`  AS  select `det_producto`.`nombre_producto` AS `nombre_producto`,`det_producto`.`foto1` AS `foto1`,`det_producto`.`descuento_producto` AS `descuento_producto`,`producto`.`cod_producto` AS `cod_producto`,`det_producto`.`fecha_ini_descuento` AS `fecha_ini_descuento`,`det_producto`.`fecha_fin_descuento` AS `fecha_fin_descuento`,`det_producto`.`precio_producto` AS `precio_producto` from (`producto` join `det_producto`) where `det_producto`.`id_producto` = `producto`.`id_producto` and `producto`.`estado_venta` = 'VIGENTE' and `det_producto`.`fecha_fin_descuento` > 0 order by `det_producto`.`fecha_fin_descuento` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `recargas`
--
DROP TABLE IF EXISTS `recargas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `recargas`  AS  select `cliente`.`cod_cliente` AS `cod_cliente`,`recarga`.`monto_recarga` AS `monto_recarga`,`recarga`.`boucher` AS `boucher`,`recarga`.`estado_recarga` AS `estado_recarga`,`recarga`.`fecha_recarga` AS `fecha_recarga` from (`cliente` join `recarga`) where `recarga`.`id_cliente` = `cliente`.`id_cliente` ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id_admi`),
  ADD KEY `id_persona` (`id_persona`);

--
-- Indices de la tabla `administrativo`
--
ALTER TABLE `administrativo`
  ADD PRIMARY KEY (`id_administrativo`),
  ADD KEY `id_cat_trabajador` (`id_cat_trabajador`);

--
-- Indices de la tabla `almacen`
--
ALTER TABLE `almacen`
  ADD PRIMARY KEY (`id_almacen`),
  ADD KEY `id_cat_trabajador` (`id_cat_trabajador`);

--
-- Indices de la tabla `cat_producto`
--
ALTER TABLE `cat_producto`
  ADD PRIMARY KEY (`id_cat_producto`);

--
-- Indices de la tabla `cat_trabajador`
--
ALTER TABLE `cat_trabajador`
  ADD PRIMARY KEY (`id_cat_trabajador`),
  ADD KEY `id_trabajador` (`id_trabajador`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `id_persona` (`id_persona`);

--
-- Indices de la tabla `compras_almacen`
--
ALTER TABLE `compras_almacen`
  ADD PRIMARY KEY (`id_comp_alm`),
  ADD KEY `id_almacen` (`id_almacen`);

--
-- Indices de la tabla `compras_cliente`
--
ALTER TABLE `compras_cliente`
  ADD PRIMARY KEY (`id_comp_c`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `dat_cliente`
--
ALTER TABLE `dat_cliente`
  ADD PRIMARY KEY (`id_dat_cliente`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `det_producto`
--
ALTER TABLE `det_producto`
  ADD PRIMARY KEY (`id_det_producto`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `envio`
--
ALTER TABLE `envio`
  ADD PRIMARY KEY (`id_envio`),
  ADD KEY `id_repartidor` (`id_repartidor`),
  ADD KEY `id_comp_c` (`id_comp_c`);

--
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`id_pago`),
  ADD KEY `id_comp_c` (`id_comp_c`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id_persona`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_cat_producto` (`id_cat_producto`);

--
-- Indices de la tabla `produc_compra_almacen`
--
ALTER TABLE `produc_compra_almacen`
  ADD PRIMARY KEY (`id_produc_comp_alm`),
  ADD KEY `id_comp_alm` (`id_comp_alm`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `produc_compra_client`
--
ALTER TABLE `produc_compra_client`
  ADD PRIMARY KEY (`id_produc_comp`),
  ADD KEY `id_comp_c` (`id_comp_c`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id_prov`);

--
-- Indices de la tabla `recarga`
--
ALTER TABLE `recarga`
  ADD PRIMARY KEY (`id_recarga`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `repartidor`
--
ALTER TABLE `repartidor`
  ADD PRIMARY KEY (`id_repartidor`),
  ADD KEY `id_cat_trabajador` (`id_cat_trabajador`);

--
-- Indices de la tabla `trabajador`
--
ALTER TABLE `trabajador`
  ADD PRIMARY KEY (`id_trabajador`),
  ADD KEY `id_persona` (`id_persona`);

--
-- Indices de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD PRIMARY KEY (`id_vehiculo`),
  ADD KEY `id_repartidor` (`id_repartidor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id_admi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `administrativo`
--
ALTER TABLE `administrativo`
  MODIFY `id_administrativo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `almacen`
--
ALTER TABLE `almacen`
  MODIFY `id_almacen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cat_producto`
--
ALTER TABLE `cat_producto`
  MODIFY `id_cat_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `cat_trabajador`
--
ALTER TABLE `cat_trabajador`
  MODIFY `id_cat_trabajador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `compras_almacen`
--
ALTER TABLE `compras_almacen`
  MODIFY `id_comp_alm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `compras_cliente`
--
ALTER TABLE `compras_cliente`
  MODIFY `id_comp_c` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `dat_cliente`
--
ALTER TABLE `dat_cliente`
  MODIFY `id_dat_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `det_producto`
--
ALTER TABLE `det_producto`
  MODIFY `id_det_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `envio`
--
ALTER TABLE `envio`
  MODIFY `id_envio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `pago`
--
ALTER TABLE `pago`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `produc_compra_almacen`
--
ALTER TABLE `produc_compra_almacen`
  MODIFY `id_produc_comp_alm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `produc_compra_client`
--
ALTER TABLE `produc_compra_client`
  MODIFY `id_produc_comp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_prov` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `recarga`
--
ALTER TABLE `recarga`
  MODIFY `id_recarga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `repartidor`
--
ALTER TABLE `repartidor`
  MODIFY `id_repartidor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `trabajador`
--
ALTER TABLE `trabajador`
  MODIFY `id_trabajador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  MODIFY `id_vehiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD CONSTRAINT `administrador_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`);

--
-- Filtros para la tabla `administrativo`
--
ALTER TABLE `administrativo`
  ADD CONSTRAINT `administrativo_ibfk_1` FOREIGN KEY (`id_cat_trabajador`) REFERENCES `cat_trabajador` (`id_cat_trabajador`);

--
-- Filtros para la tabla `almacen`
--
ALTER TABLE `almacen`
  ADD CONSTRAINT `almacen_ibfk_1` FOREIGN KEY (`id_cat_trabajador`) REFERENCES `cat_trabajador` (`id_cat_trabajador`);

--
-- Filtros para la tabla `cat_trabajador`
--
ALTER TABLE `cat_trabajador`
  ADD CONSTRAINT `cat_trabajador_ibfk_1` FOREIGN KEY (`id_trabajador`) REFERENCES `trabajador` (`id_trabajador`);

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`);

--
-- Filtros para la tabla `compras_almacen`
--
ALTER TABLE `compras_almacen`
  ADD CONSTRAINT `compras_almacen_ibfk_1` FOREIGN KEY (`id_almacen`) REFERENCES `almacen` (`id_almacen`);

--
-- Filtros para la tabla `compras_cliente`
--
ALTER TABLE `compras_cliente`
  ADD CONSTRAINT `compras_cliente_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`);

--
-- Filtros para la tabla `dat_cliente`
--
ALTER TABLE `dat_cliente`
  ADD CONSTRAINT `dat_cliente_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`);

--
-- Filtros para la tabla `det_producto`
--
ALTER TABLE `det_producto`
  ADD CONSTRAINT `det_producto_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`);

--
-- Filtros para la tabla `envio`
--
ALTER TABLE `envio`
  ADD CONSTRAINT `envio_ibfk_1` FOREIGN KEY (`id_repartidor`) REFERENCES `repartidor` (`id_repartidor`),
  ADD CONSTRAINT `envio_ibfk_2` FOREIGN KEY (`id_comp_c`) REFERENCES `compras_cliente` (`id_comp_c`);

--
-- Filtros para la tabla `pago`
--
ALTER TABLE `pago`
  ADD CONSTRAINT `pago_ibfk_1` FOREIGN KEY (`id_comp_c`) REFERENCES `compras_cliente` (`id_comp_c`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`id_cat_producto`) REFERENCES `cat_producto` (`id_cat_producto`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `produc_compra_almacen`
--
ALTER TABLE `produc_compra_almacen`
  ADD CONSTRAINT `produc_compra_almacen_ibfk_1` FOREIGN KEY (`id_comp_alm`) REFERENCES `compras_almacen` (`id_comp_alm`),
  ADD CONSTRAINT `produc_compra_almacen_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`);

--
-- Filtros para la tabla `produc_compra_client`
--
ALTER TABLE `produc_compra_client`
  ADD CONSTRAINT `produc_compra_client_ibfk_1` FOREIGN KEY (`id_comp_c`) REFERENCES `compras_cliente` (`id_comp_c`),
  ADD CONSTRAINT `produc_compra_client_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`);

--
-- Filtros para la tabla `recarga`
--
ALTER TABLE `recarga`
  ADD CONSTRAINT `recarga_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`);

--
-- Filtros para la tabla `repartidor`
--
ALTER TABLE `repartidor`
  ADD CONSTRAINT `repartidor_ibfk_1` FOREIGN KEY (`id_cat_trabajador`) REFERENCES `cat_trabajador` (`id_cat_trabajador`);

--
-- Filtros para la tabla `trabajador`
--
ALTER TABLE `trabajador`
  ADD CONSTRAINT `trabajador_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`);

--
-- Filtros para la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD CONSTRAINT `vehiculo_ibfk_1` FOREIGN KEY (`id_repartidor`) REFERENCES `repartidor` (`id_repartidor`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
