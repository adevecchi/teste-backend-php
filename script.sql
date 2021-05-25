drop database if exists Hogwarts;

create database Hogwarts
	character set utf8
    collate utf8_general_ci;

use Hogwarts;

create table Categorias (
	CategoriaId int not null auto_increment,
    Nome varchar(40) not null,
    constraint Pk_Categorias primary key (CategoriaId)
);

create table Produtos (
	ProdutoId int not null auto_increment,
    Nome varchar(80) not null,
    Quantidade int not null,
    CategoriaId int default null,
    constraint Pk_Produtos primary key (ProdutoId),
    constraint Fk_CategoriaId foreign key (CategoriaId) references Categorias (CategoriaId)
);

create table Compras (
	CompraId int not null auto_increment,
    Mes varchar(10) not null,
    ProdutoId int default null,
    constraint Pk_Compras primary key (CompraId),
    constraint Fk_ProdutoId foreign key (ProdutoId) references Produtos (ProdutoId)
);
