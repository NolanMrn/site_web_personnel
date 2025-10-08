drop table if exists IMAGEGALLERIE;
drop table if exists PARAGRAPHE;
drop table if exists GALLERIE;
drop table if exists STRUCTURE;
drop table if exists DESCRIPTIFLIEUX;
drop table if exists LIEUX;
drop table if exists CATEGORIE;

create table CATEGORIE (
    nom_categorie varchar(30) primary key
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
    nb_paraph_lieux int,
    histoire_lieux longtext,
    primary key (idL, nom_categorie),
    foreign key (nom_categorie) references CATEGORIE(nom_categorie),
    foreign key (idL) references LIEUX(idL)
);

create table GALLERIE (
    idG int auto_increment primary key,
    idL int,
    nom_categorie varchar(30),
    foreign key (nom_categorie) references CATEGORIE(nom_categorie),
    foreign key (idL) references LIEUX(idL)
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
    foreign key (nom_categorie) references CATEGORIE(nom_categorie),
    foreign key (idL) references LIEUX(idL)
);

delimiter | 
create or replace trigger GenererIdLieux before insert on LIEUX for each row
begin 
    declare IdActuel int;

    select ifnull(max(idL), 0) into IdActuel from LIEUX 
    where nom_categorie = NEW.nom_categorie;

    set NEW.idL = IdActuel + 1;
end |
delimiter ;