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


