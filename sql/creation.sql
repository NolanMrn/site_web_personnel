drop table if exists IMAGEGALLERIE;
drop table if exists PARAGRAPHE;
drop table if exists GALLERIE;
drop table if exists STRUCTURE;
drop table if exists DESCRIPTIFLIEUX;
drop table if exists LIEUX;
drop table if exists CATEGORIE;

create table CATEGORIE (
    nom_categorie varchar(30) primary key,
    description_cat longtext
);

create table LIEUX (
    idL int,
    nom_categorie varchar(30),
    slug varchar(30),
    nom varchar(100),
    date_explo date,
    primary key (idL, nom_categorie),
    foreign key (nom_categorie) references CATEGORIE(nom_categorie)
);

create table DESCRIPTIFLIEUX (
    idL int,
    nom_categorie varchar(30),
    chemin_img_banniere varchar(200),
    pays varchar(50),
    histoire_lieux longtext,
    primary key (idL, nom_categorie),
    foreign key (idL, nom_categorie) references LIEUX(idL, nom_categorie)
);

create table GALLERIE (
    idG int auto_increment primary key,
    idL int,
    nom_categorie varchar(30),
    foreign key (idL, nom_categorie) references LIEUX(idL, nom_categorie)
);

create table IMAGEGALLERIE (
    idIG int auto_increment primary key,
    idG int,
    chemin varchar(200),
    ordreImg int,
    cadrage enum('vertical', 'horizontal'),
    foreign key (idG) references GALLERIE(idG)
);

create table PARAGRAPHE (
    idP int auto_increment primary key,
    idG int,
    paragraphe longtext,
    foreign key (idG) references GALLERIE(idG)
);

create table STRUCTURE (
    idS int auto_increment primary key,
    idL int,
    nom_categorie varchar(30),
    ordre_structure int,
    types enum('paragraphe', 'galerie'),
    ref int,
    foreign key (idL, nom_categorie) references LIEUX(idL, nom_categorie)
);