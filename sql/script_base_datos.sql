create database facturacion;

use facturacion;

create table formulario(
	id_formulario int not null primary key auto_increment,
	codigo varchar(20) not null unique,
    nombre varchar(255) not null,
    id_bodega int not null,
    id_sucursal int not null,
    id_moneda int not null,
    precio double not null,
    descripcion text not null,
    estado char(1) default 1
);
create table det_formulario_producto(
	id_det_for_producto int not null primary key auto_increment,
    id_formulario int not null,
    id_materialProducto int not null,
    estado char(1) default 1
);
create table material_producto(
	id_materialProducto int not null primary key auto_increment,
    descripcion varchar(255) not null,
    estado char(1) default 1
) AUTO_INCREMENT=10;

create table bodega(
	id_bodega int not null primary key auto_increment,
    descripcion varchar(255) not null,
    estado char(1) default 1
);

create table sucursal(
	id_sucursal int not null primary key auto_increment,
    descripcion varchar(255) not null,
    id_bodega int not null,
    estado char(1) default 1
);

create table moneda(
	id_moneda int not null primary key auto_increment,
    descripcion varchar(255) not null,
    estado char(1) default 1
)


INSERT INTO `bodega` (`id_bodega`, `descripcion`, `estado`) VALUES (1, 'Bodega Peru', '1');
INSERT INTO `bodega` (`id_bodega`, `descripcion`, `estado`) VALUES (2, 'Bodega Chile', '1');
INSERT INTO `bodega` (`id_bodega`, `descripcion`, `estado`) VALUES (3, 'Bodega Colombia', '1');
INSERT INTO `bodega` (`id_bodega`, `descripcion`, `estado`) VALUES (4, 'Bodega Mexico', '1');


INSERT INTO `material_producto` (`id_materialProducto`, `descripcion`, `estado`) VALUES (10, 'Plástico', '1');
INSERT INTO `material_producto` (`id_materialProducto`, `descripcion`, `estado`) VALUES (11, 'Metal', '1');
INSERT INTO `material_producto` (`id_materialProducto`, `descripcion`, `estado`) VALUES (12, 'Madera', '1');
INSERT INTO `material_producto` (`id_materialProducto`, `descripcion`, `estado`) VALUES (13, 'Vidrio', '1');
INSERT INTO `material_producto` (`id_materialProducto`, `descripcion`, `estado`) VALUES (14, 'Textil', '1');


INSERT INTO `moneda` (`id_moneda`, `descripcion`, `estado`) VALUES (1, 'Soles', '1');
INSERT INTO `moneda` (`id_moneda`, `descripcion`, `estado`) VALUES (2, 'Peso chileno', '1');
INSERT INTO `moneda` (`id_moneda`, `descripcion`, `estado`) VALUES (3, 'Peso colombiano', '1');
INSERT INTO `moneda` (`id_moneda`, `descripcion`, `estado`) VALUES (4, 'Peso mexicano', '1');


INSERT INTO `sucursal` (`id_sucursal`, `descripcion`, `id_bodega`, `estado`) VALUES (1, 'Lima', 1, '1');
INSERT INTO `sucursal` (`id_sucursal`, `descripcion`, `id_bodega`, `estado`) VALUES (2, 'Arequipa', 1, '1');
INSERT INTO `sucursal` (`id_sucursal`, `descripcion`, `id_bodega`, `estado`) VALUES (3, 'Cuzco', 1, '1');
INSERT INTO `sucursal` (`id_sucursal`, `descripcion`, `id_bodega`, `estado`) VALUES (4, 'Huaraz', 1, '1');
INSERT INTO `sucursal` (`id_sucursal`, `descripcion`, `id_bodega`, `estado`) VALUES (5, 'Santiago', 2, '1');
INSERT INTO `sucursal` (`id_sucursal`, `descripcion`, `id_bodega`, `estado`) VALUES (6, 'Arica', 2, '1');
INSERT INTO `sucursal` (`id_sucursal`, `descripcion`, `id_bodega`, `estado`) VALUES (7, 'Antofagasta', 2, '1');
INSERT INTO `sucursal` (`id_sucursal`, `descripcion`, `id_bodega`, `estado`) VALUES (8, 'Medellin', 3, '1');
INSERT INTO `sucursal` (`id_sucursal`, `descripcion`, `id_bodega`, `estado`) VALUES (9, 'Bogota', 3, '1');
INSERT INTO `sucursal` (`id_sucursal`, `descripcion`, `id_bodega`, `estado`) VALUES (10, 'Cucuta', 3, '1');
INSERT INTO `sucursal` (`id_sucursal`, `descripcion`, `id_bodega`, `estado`) VALUES (11, 'Jalisco', 4, '1');
INSERT INTO `sucursal` (`id_sucursal`, `descripcion`, `id_bodega`, `estado`) VALUES (12, 'Ciudad de México', 4, '1');
