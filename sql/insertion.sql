insert into CATEGORIE values ("chateaux", "Votre texte ici");
insert into CATEGORIE values ("Usines", "Votre texte ici");

-- Le Château du Bois --
insert into LIEUX (nom_categorie, slug, nom, date_explo) 
values ("chateaux", "bois", "Le Château du Bois", "2023-12-01");

insert into DESCRIPTIFLIEUX (idL, nom_categorie, chemin_img_banniere, pays,  histoire_lieux)
values (1, "chateaux", "/site_web/img/chateaux/bois/image2.jpeg", "francais",
"Très peu d’informations sont disponibles sur Internet, à l’exception de quelques photos d’archives avec comme date 1890-1950. Par chance, des amis ont eu l’occasion de discuter avec la propriétaire actuelle du domaine, qui nous a confié que sa famille a racheté le domaine, avec le château, en 1971. À cette époque, la bâtisse était déjà à l’abandon. On peut donc en déduire, grâce aux archives, que le château a surement été construit vers 1890 et qu’il a été abandonné dans les années 1950. De plus, elle a précisé que le château avait été utilisé pendant un temps par un vétérinaire qui le louait. Celui-ci s’en servait comme lieu de stockage pour les grains, ce qui explique la présence des machines que l’on peut encore voir à l’intérieur.
Aujourd’hui, le château est en péril : les propriétaires, faute de moyens, le laissent se détériorer progressivement, et sans restauration, il continuera à se dégrader jusqu’à s’effondrer."
);

insert into GALLERIE (idL, nom_categorie) values (1, 'chateaux');
insert into GALLERIE (idL, nom_categorie) values (1, 'chateaux');
insert into GALLERIE (idL, nom_categorie) values (1, 'chateaux');

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
(1, "On remarque, en arrivant sur les lieux, que la végétation a repris ses droits depuis longtemps. Un ancien bassin entoure le château, et plusieurs dépendances se trouvent sur le domaine, sans présenter un grand intérêt."),
(2, "Dans le château, on ne trouve presque aucun tag ni trace de vandalisme ; le lieu semble seulement avoir été marqué par le temps. Le plafond s’effrite et l’ensemble est très dégradé. Les pièces sont vides, à l’exception de deux anciennes machines qui servaient probablement à l’époque au vétérinaire. Celle située à droite est un tarare, utilisé autrefois pour nettoyer le grain."),
(3, "Un seul escalier permet d’accéder à l’étage du château. Malheureusement, une fois arrivé en haut, il est impossible d’avancer davantage en raison du plancher qui s’est effondré à plusieurs endroits.");

insert into STRUCTURE (idL, nom_categorie, ordre_structure, types, ref) VALUES
(1, 'chateaux', 1, 'paragraphe', 1),
(1, 'chateaux', 2, 'galerie', 1),
(1, 'chateaux', 3, 'paragraphe', 2),
(1, 'chateaux', 4, 'galerie', 2),
(1, 'chateaux', 5, 'paragraphe', 3),
(1, 'chateaux', 6, 'galerie', 3);


-- Le Château aux Douves --
insert into LIEUX (nom_categorie, slug, nom, date_explo) 
values ("chateaux", "douves", "Le Château aux Douves", "2023-08-01");

insert into DESCRIPTIFLIEUX (idL, nom_categorie, chemin_img_banniere, pays, histoire_lieux)
values (2, "chateaux", "/site_web/img/chateaux/douves/image1.jpeg", "francais",
"Construit vers 1200 par la famille d’Hangest, le château a été détruit pendant la Guerre de Cent Ans, puis reconstruit sous le règne de Charles V. Pris par les Anglais en 1418, il est repris par les Français en 1449 et rebâti à la Renaissance. Pendant plusieurs siècles, il appartient à la famille de Roncherolles et accueille notamment Henri IV. Aux XIXᵉ et XXᵉ siècles, le château passe entre différentes familles nobles et industrielles.
Inhabité depuis 1998, il s’est fortement dégradé au fil des années. Aujourd’hui, il n’est plus à l’abandon, il a été racheté par un couple dans le but de le restaurer et de le préserver. Pour suivre toutes les actualités du château, vous pouvez consulter leur compte Instagram : @chateau_de_pont_saint_pierre."
);

insert into GALLERIE (idL, nom_categorie) values (2, 'chateaux');
insert into GALLERIE (idL, nom_categorie) values (2, 'chateaux');

insert into IMAGEGALLERIE (idG, chemin, ordreImg, cadrage) values
(4, '/site_web/img/chateaux/douves/image1.jpeg', 1, "horizontal"),
(4, '/site_web/img/chateaux/douves/image2.jpeg', 2, "horizontal"),
(4, '/site_web/img/chateaux/douves/image3.jpeg', 3, "horizontal"),
(4, '/site_web/img/chateaux/douves/image4.jpeg', 4, "horizontal"),
(4, '/site_web/img/chateaux/douves/image5.jpeg', 5, "vertical"),
(4, '/site_web/img/chateaux/douves/image6.jpeg', 6, "horizontal"),

(5, '/site_web/img/chateaux/douves/image7.jpeg', 1, "vertical"),
(5, '/site_web/img/chateaux/douves/image8.jpeg', 2, "horizontal"),
(5, '/site_web/img/chateaux/douves/image9.jpeg', 3, "horizontal");

insert into PARAGRAPHE (idG, paragraphe) values
(4, "La bâtisse, au style de château fort et entourée d’un vaste parc avec ses douves, est aujourd’hui en très mauvais état. La cour intérieure est envahie par la végétation, et la toiture menace de s’effondrer. Malgré ces dégradations, son allure défensive et impressionnante reste encore bien perceptible."),
(5, "L’intérieur reflète l’état de l’extérieur : les planchers sont très fragilisés par le temps et presque tout l’étage est inaccessible. Un escalier subsiste également, mais également dans un très mauvais état.");

insert into STRUCTURE (idL, nom_categorie, ordre_structure, types, ref) VALUES
(2, 'chateaux', 1, 'paragraphe', 4),
(2, 'chateaux', 2, 'galerie', 4),
(2, 'chateaux', 3, 'paragraphe', 5),
(2, 'chateaux', 4, 'galerie', 5);


-- Le Château colimacon --
insert into LIEUX (nom_categorie, slug, nom, date_explo) 
values ("chateaux", "colimacon", "Le Château Colimaçon", "2024-07-01");

insert into DESCRIPTIFLIEUX (idL, nom_categorie, chemin_img_banniere, pays, histoire_lieux)
values (3, "chateaux", "/site_web/img/chateaux/colimacon/image1.jpeg", "francais", 
"Ce manoir doit son surnom à son grand escalier en colimaçon fait de mosaïques. Abandonné depuis environ cinquante ans, il ne reste plus grand-chose à voir à l’intérieur. L’incendie de 2023, qui a détruit une partie de la toiture, n’a fait qu’aggraver son état déjà fragile.
Aujourd’hui, la maison appartient à un propriétaire iranien qui ne s’en occupe plus, laissant le lieu tomber peu à peu en ruine."
);

insert into GALLERIE (idL, nom_categorie) values (3, 'chateaux');
insert into GALLERIE (idL, nom_categorie) values (3, 'chateaux');
insert into GALLERIE (idL, nom_categorie) values (3, 'chateaux');

insert into IMAGEGALLERIE (idG, chemin, ordreImg, cadrage) values 
(6, '/site_web/img/chateaux/colimacon/image1.jpeg', 1, "horizontal"),
(6, '/site_web/img/chateaux/colimacon/image2.jpeg', 2, "vertical"),
(6, '/site_web/img/chateaux/colimacon/image3.jpeg', 3, "horizontal"),

(7, '/site_web/img/chateaux/colimacon/image4.jpeg', 1, "horizontal"),
(7, '/site_web/img/chateaux/colimacon/image5.jpeg', 2, "vertical"),
(7, '/site_web/img/chateaux/colimacon/image6.jpeg', 3, "vertical"),
(7, '/site_web/img/chateaux/colimacon/image7.jpeg', 4, "vertical"),
(7, '/site_web/img/chateaux/colimacon/image8.jpeg', 5, "vertical"),
(7, '/site_web/img/chateaux/colimacon/image9.jpeg', 6, "horizontal"),

(8, '/site_web/img/chateaux/colimacon/image10.jpeg', 1, "vertical"),
(8, '/site_web/img/chateaux/colimacon/image11.jpeg', 2, "horizontal"),
(8, '/site_web/img/chateaux/colimacon/image12.jpeg', 3, "vertical"),
(8, '/site_web/img/chateaux/colimacon/image13.jpeg', 4, "horizontal"),
(8, '/site_web/img/chateaux/colimacon/image14.jpeg', 5, "horizontal");

insert into PARAGRAPHE (idG, paragraphe) values
(6, "De l’extérieur, avec ses briques rouges et sa tour, cette demeure garde encore un certain charme et se distingue facilement des nombreux chteaux abandonnées que l’on peut croiser un peu partout."),
(7, "Une fois la porte franchie, les pièces vides s’enchaînent, certaines plongées dans l’obscurité à cause de fenêtres murées. On peut tout de même retrouver un imposant escalier en bois massif, épargné par l’incendie. Aux étages, c’est la même ambiance : des pièces vides."),
(8, "Place maintenant à la partie principale du manoir : son escalier en colimaçon. Il traverse tous les étages et mène jusqu’à la terrasse sur le toit. Malheureusement, il est recouvert de nombreux tags.");

insert into STRUCTURE (idL, nom_categorie, ordre_structure, types, ref) VALUES
(3, 'chateaux', 1, 'paragraphe', 6),
(3, 'chateaux', 2, 'galerie', 6),
(3, 'chateaux', 3, 'paragraphe', 7),
(3, 'chateaux', 4, 'galerie', 7),
(3, 'chateaux', 5, 'paragraphe', 8),
(3, 'chateaux', 6, 'galerie', 8);


-- Le Château de Fruminet --
-- insert into LIEUX (nom_categorie, slug, nom, date_explo) 
-- values ("chateaux", "fruminet", "Le Château de Fruminet", "2024-07-01");

-- insert into DESCRIPTIFLIEUX (idL, nom_categorie, chemin_img_banniere, pays, histoire_lieux)
-- values (4, "chateaux", "/site_web/img/chateaux/fruminet/image1.jpeg", "francais",
-- "Édifié dans les années 1860, ce château de style Second Empire laisse encore deviner sa splendeur 
-- passée, malgré son état de délabrement avancé. Au fil du temps, il connut plusieurs vies : il devint 
-- d’abord un parc d’artillerie pour l’armée française, puis servit de prison durant les deux guerres 
-- mondiales. Par la suite, il fut transformé en centre administratif pour l’ancienne prison voisine 
-- aujourd’hui entièrement démolie.\n
-- Abandonné depuis 2004, le château fut ravagé par un violent incendie en 2010, qui détruisit la toiture 
-- ainsi que les planchers. Aujourd’hui, l’édifice est complètement ouvert et recouvert de tags. Malgré 
-- tout, certaines pièces conservent un charme photogénique grâce aux sculptures et aux ornements qui 
-- décorent encore les murs."
-- );

-- insert into GALLERIE (idL, nom_categorie) values (4, 'chateaux');
-- insert into GALLERIE (idL, nom_categorie) values (4, 'chateaux');
-- insert into GALLERIE (idL, nom_categorie) values (4, 'chateaux');

-- insert into IMAGEGALLERIE (idG, chemin, ordreImg, cadrage) values
-- (9, '/site_web/img/chateaux/fruminet/image1.jpeg', 1, "horizontal"),
-- (9, '/site_web/img/chateaux/fruminet/image2.jpeg', 2, "vertical"),
-- (9, '/site_web/img/chateaux/fruminet/image3.jpeg', 3, "horizontal"),

-- (10, '/site_web/img/chateaux/fruminet/image4.jpeg', 1, "vertical"),
-- (10, '/site_web/img/chateaux/fruminet/image5.jpeg', 2, "horizontal"),
-- (10, '/site_web/img/chateaux/fruminet/image6.jpeg', 3, "horizontal"),

-- (11, '/site_web/img/chateaux/fruminet/image7.jpeg', 1, "horizontal"),
-- (11, '/site_web/img/chateaux/fruminet/image8.jpeg', 2, "horizontal"),
-- (11, '/site_web/img/chateaux/fruminet/image9.jpeg', 3, "vertical");

-- insert into PARAGRAPHE (idG, paragraphe) values
-- (9, "Situé dans une petite forêt en bordure de ville, le squelette de l’édifice est désormais 
-- enveloppé par une végétation qui a repris ses droits autour de la bâtisse. Malheureusement, 
-- lors de mon passage, la marquise qui surplombait l’entrée s’était effondrée."),
-- (10, "À l’intérieur, toutes les pièces sont désertes. Un vaste couloir parcourt toute la longueur 
-- du château et donne accès à plusieurs salles, dont la plus remarquable se situe juste en face de 
-- l’entrée principale. Des ornements subsistent sur les murs et le plafond, mêlés au délabré et 
-- aux graffitis, ce qui rend la pièce encore majestueuse."),
-- (11, "Quelques autres pièces méritent également d’être vues. Enfin, on y trouve un escalier menant 
-- aux étages, qui, à cause de l’incendie, n’est plus praticable."
-- );

-- insert into STRUCTURE (idL, nom_categorie, ordre_structure, types, ref) VALUES
-- (4, 'chateaux', 1, 'paragraphe', 9),
-- (4, 'chateaux', 2, 'galerie', 9),
-- (4, 'chateaux', 3, 'paragraphe', 10),
-- (4, 'chateaux', 4, 'galerie', 10),
-- (4, 'chateaux', 5, 'paragraphe', 11),
-- (4, 'chateaux', 6, 'galerie', 11);