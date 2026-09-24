create database gestao_brinquedos_lazza;
use gestao_brinquedos_lazza;

create table brinquedos (
    id_brinquedo int primary key auto_increment,
    nome_brinquedo varchar(100) not null,
    categoria varchar(50) not null,
    faixa_etaria varchar(30) not null,
    preco decimal(10,2) not null,
    quantidade_estoque int not null
);