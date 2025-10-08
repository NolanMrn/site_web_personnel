insert into CATEGORIE values ("Châteaux");
insert into CATEGORIE values ("Usines");

-- Le Château du Bois --
insert into LIEUX (nom_categorie, slug, nom, date_explo) 
values ("Châteaux", "bois", "Le Château du Bois", "2023-12-01");

insert into DESCRIPTIFLIEUX (idL, nom_categorie, nb_paraph_lieux, histoire_lieux)
values (1, "Châteaux", 3, 
"Très peu d’informations sont disponibles sur Internet, à l’exception de quelques photos 
d’archives avec comme date 1890-1950. Par chance, des amis ont eu l’occasion de discuter 
avec la propriétaire actuelle du domaine, qui nous a confié que sa famille a racheté le 
domaine, avec le château, en 1971. À cette époque, la bâtisse était déjà à l’abandon. On 
peut donc en déduire, grâce aux archives, que le château a surement été construit vers 
1890 et qu’il a été abandonné dans les années 1950. De plus, elle a précisé que le château 
avait été utilisé pendant un temps par un vétérinaire qui le louait. Celui-ci s’en servait 
comme lieu de stockage pour les grains, ce qui explique la présence des machines que l’on 
peut encore voir à l’intérieur.</br>
Aujourd’hui, le château est en péril : les propriétaires, faute de moyens, le laissent se 
détériorer progressivement, et sans restauration, il continuera à se dégrader jusqu’à 
s’effondrer."
);

insert into GALLERIE (idL, nom_categorie) values (1, 'Châteaux');
insert into GALLERIE (idL, nom_categorie) values (1, 'Châteaux');
insert into GALLERIE (idL, nom_categorie) values (1, 'Châteaux');

insert into IMAGEGALLERIE (idG, chemin, ordreImg, cadrage) values
(1, '/site_web/img/chateaux/bois/image1.jpeg', 1, "horizontal"),
(1, '/site_web/img/chateaux/bois/image2.jpeg', 2, "horizontal"),
(1, '/site_web/img/chateaux/bois/image3.jpeg', 3, "horizontal"),

(2, '/site_web/img/chateaux/bois/image4.jpeg', 1, "vertical"),
(2, '/site_web/img/chateaux/bois/image5.jpeg', 2, "horizontal"),
(2, '/site_web/img/chateaux/bois/image6.jpeg', 3, "horizontal"),
(2, '/site_web/img/chateaux/bois/image7.jpeg', 4, "horizontal"),
(2, '/site_web/img/chateaux/bois/image8.jpeg', 5, "horizontal"),
(2, '/site_web/img/chateaux/bois/image9.jpeg', 6, "horizontal"),

(3, '/site_web/img/chateaux/bois/image10.jpeg', 1, "vertical"),
(3, '/site_web/img/chateaux/bois/image11.jpeg', 2, "vertical"),
(3, '/site_web/img/chateaux/bois/image12.jpeg', 3, "vertical");

insert into PARAGRAPHE (idG, paragraphe) values
(1, "On remarque, en arrivant sur les lieux, que la végétation a repris ses droits depuis 
longtemps. Un ancien bassin entoure le château, et plusieurs dépendances se trouvent sur 
le domaine, sans présenter un grand intérêt."),
(2, "Dans le château, on ne trouve presque aucun tag ni trace de vandalisme ; le lieu semble 
seulement avoir été marqué par le temps. Le plafond s’effrite et l’ensemble est très 
dégradé. Les pièces sont vides, à l’exception de deux anciennes machines qui servaient 
probablement à l’époque au vétérinaire. Celle située à droite est un tarare, utilisé 
autrefois pour nettoyer le grain."),
(3, "Un seul escalier permet d’accéder à l’étage du château. Malheureusement, une fois arrivé 
en haut, il est impossible d’avancer davantage en raison du plancher qui s’est effondré à 
plusieurs endroits.");

insert into STRUCTURE (idL, nom_categorie, ordre_structure, types, ref) VALUES
(1, 'Châteaux', 1, 'paragraphe', 1),
(1, 'Châteaux', 2, 'galerie', 1),
(1, 'Châteaux', 3, 'paragraphe', 2),
(1, 'Châteaux', 4, 'galerie', 2),
(1, 'Châteaux', 5, 'paragraphe', 3),
(1, 'Châteaux', 6, 'galerie', 3);



insert into LIEUX (nom_categorie, slug, nom, date_explo) 
values ("Châteaux", "douves", "Le Château aux Douves", "2023-08-01");


insert into LIEUX (nom_categorie, slug, nom, date_explo) 
values ("Usines", "gattes", "La Cimenterie des Gattes", "2025-04-01");


