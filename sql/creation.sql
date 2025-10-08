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
    histoire_lieux longtext,
    primary key (idL, nom_categorie),
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