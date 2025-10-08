insert into CATEGORIE values ("Châteaux");
insert into CATEGORIE values ("Usines");

-- Le Château du Bois --
insert into LIEUX (nom_categorie, slug, nom, date_explo) 
values ("Châteaux", "bois", "Le Château du Bois", "2023-12-01");

insert into DESCRIPTIFLIEUX (idL, nom_categorie, nb_paraph_lieux, histoire_lieux, paragraphe1, 
    paragraphe2, paragraphe3)
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
s’effondrer.",

"On remarque, en arrivant sur les lieux, que la végétation a repris ses droits depuis 
longtemps. Un ancien bassin entoure le château, et plusieurs dépendances se trouvent sur 
le domaine, sans présenter un grand intérêt.",

"Dans le château, on ne trouve presque aucun tag ni trace de vandalisme ; le lieu semble 
seulement avoir été marqué par le temps. Le plafond s’effrite et l’ensemble est très 
dégradé. Les pièces sont vides, à l’exception de deux anciennes machines qui servaient 
probablement à l’époque au vétérinaire. Celle située à droite est un tarare, utilisé 
autrefois pour nettoyer le grain.",

"Un seul escalier permet d’accéder à l’étage du château. Malheureusement, une fois arrivé 
en haut, il est impossible d’avancer davantage en raison du plancher qui s’est effondré à 
plusieurs endroits."
);



insert into LIEUX (nom_categorie, slug, nom, date_explo) 
values ("Châteaux", "douves", "Le Château aux Douves", "2023-08-01");


insert into LIEUX (nom_categorie, slug, nom, date_explo) 
values ("Usines", "gattes", "La Cimenterie des Gattes", "2025-04-01");


