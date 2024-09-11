
DROP DATABASE IF EXISTS facturacion;

create database facturacion;

use facturacion;

create table formulario(
	id_formulario int not null primary key auto_increment,
	codigo varchar(20) not null unique,
    nombre varchar(255) not null,
    id_bodega int not null,
    id_sucursal int not null,
    id_moneda int not null,
    precio decimal(10, 2) not null,
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
);

-- INSERTADO DE DATOS

INSERT INTO `bodega` (`descripcion`) VALUES ('Bodega Peru');
INSERT INTO `bodega` (`descripcion`) VALUES ('Bodega Chile');
INSERT INTO `bodega` (`descripcion`) VALUES ('Bodega Colombia');
INSERT INTO `bodega` (`descripcion`) VALUES ('Bodega Mexico');


INSERT INTO `material_producto` (`descripcion`) VALUES ('Plástico');
INSERT INTO `material_producto` (`descripcion`) VALUES ('Metal');
INSERT INTO `material_producto` (`descripcion`) VALUES ('Madera');
INSERT INTO `material_producto` (`descripcion`) VALUES ('Vidrio');
INSERT INTO `material_producto` (`descripcion`) VALUES ('Textil');


INSERT INTO `moneda` (`descripcion`) VALUES ('Soles');
INSERT INTO `moneda` (`descripcion`) VALUES ('Peso chileno');
INSERT INTO `moneda` (`descripcion`) VALUES ('Peso colombiano');
INSERT INTO `moneda` (`descripcion`) VALUES ('Peso mexicano');


INSERT INTO `sucursal` (`descripcion`, `id_bodega`) VALUES ('Lima', 1);
INSERT INTO `sucursal` (`descripcion`, `id_bodega`) VALUES ('Arequipa', 1);
INSERT INTO `sucursal` (`descripcion`, `id_bodega`) VALUES ('Cuzco', 1);
INSERT INTO `sucursal` (`descripcion`, `id_bodega`) VALUES ('Huaraz', 1);
INSERT INTO `sucursal` (`descripcion`, `id_bodega`) VALUES ('Santiago', 2);
INSERT INTO `sucursal` (`descripcion`, `id_bodega`) VALUES ('Arica', 2);
INSERT INTO `sucursal` (`descripcion`, `id_bodega`) VALUES ('Antofagasta', 2);
INSERT INTO `sucursal` (`descripcion`, `id_bodega`) VALUES ('Medellin', 3);
INSERT INTO `sucursal` (`descripcion`, `id_bodega`) VALUES ('Bogota', 3);
INSERT INTO `sucursal` (`descripcion`, `id_bodega`) VALUES ('Cucuta', 3);
INSERT INTO `sucursal` (`descripcion`, `id_bodega`) VALUES ('Jalisco', 4);
INSERT INTO `sucursal` (`descripcion`, `id_bodega`) VALUES ('Ciudad de México', 4);
