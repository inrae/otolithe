-- Database generated with pgModeler (PostgreSQL Database Modeler).
-- pgModeler version: 1.1.3
-- PostgreSQL version: 13.0
-- Project Site: pgmodeler.io
-- Model Author: Éric Quinton
-- object: otolithe | type: ROLE --
-- DROP ROLE IF EXISTS otolithe;


-- object: otolithe | type: SCHEMA --
-- DROP SCHEMA IF EXISTS otolithe CASCADE;
CREATE SCHEMA otolithe;
-- ddl-end --
ALTER SCHEMA otolithe OWNER TO otolithe;
-- ddl-end --

-- object: gacl | type: SCHEMA --
-- DROP SCHEMA IF EXISTS gacl CASCADE;
CREATE SCHEMA gacl;
-- ddl-end --
ALTER SCHEMA gacl OWNER TO otolithe;
-- ddl-end --

SET search_path TO pg_catalog,public,otolithe,gacl;
-- ddl-end --

-- object: postgis | type: EXTENSION --
-- DROP EXTENSION IF EXISTS postgis CASCADE;
CREATE EXTENSION postgis
WITH SCHEMA public
VERSION '2.3.3';
-- ddl-end --
COMMENT ON EXTENSION postgis IS E'PostGIS geometry, geography, and raster spatial types and functions';
-- ddl-end --

-- object: otolithe.espece_espece_id_seq | type: SEQUENCE --
-- DROP SEQUENCE IF EXISTS otolithe.espece_espece_id_seq CASCADE;
CREATE SEQUENCE otolithe.espece_espece_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 9223372036854775807
	START WITH 1
	CACHE 1
	NO CYCLE
	OWNED BY NONE;

-- ddl-end --
ALTER SEQUENCE otolithe.espece_espece_id_seq OWNER TO otolithe;
-- ddl-end --

-- object: otolithe.espece | type: TABLE --
-- DROP TABLE IF EXISTS otolithe.espece CASCADE;
CREATE TABLE otolithe.espece (
	espece_id integer NOT NULL DEFAULT nextval('otolithe.espece_espece_id_seq'::regclass),
	nom_id character varying NOT NULL,
	nom_fr character varying,
	CONSTRAINT espece_pkey PRIMARY KEY (espece_id)
);
-- ddl-end --
COMMENT ON TABLE otolithe.espece IS E'Liste des especes';
-- ddl-end --
ALTER TABLE otolithe.espece OWNER TO otolithe;
-- ddl-end --

INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Abramis brama', E'Brème d''eau douce');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Abramis sp.', E'Brèmes d''eau douce nca');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Acipenser baerii', E'Esturgeon de Sibérie');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Acipenser sp.', E'Esturgeons');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Acipenser sturio', E'Esturgeon commun');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Acipenseridae', E'Esturgeons nca');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Acipenseriformes', DEFAULT);
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Agonus cataphractus', E'Souris de mer');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Alburnus alburnus', E'Ablette');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Alosa alosa', E'Alose vraie (=Grande alose)');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Alosa alosa, Alosa fallax', E'Aloses vraie et feinte');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Alosa fallax', E'Alose feinte');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Alosa sp.', E'Aloses nca');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Ammodytes tobianus', E'Equille');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Anguilla anguilla', E'Anguille d''Europe');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Anguilla sp.', E'Anguilles nca');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Anguillidae', E'Anguilles');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Argyrosomus regius', E'Maigre commun');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Argyrosomus sp.', DEFAULT);
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Atherina boyeri', E'Joêl');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Atherina presbyter', E'Prêtre');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Atherina sp.', DEFAULT);
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Atherinidae', E'Athérinidés nca');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Barbatula barbatula', E'Loche franche');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Barbus barbus', E'Barbeau fluviatile');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Barbus sp.', DEFAULT);
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Belone belone', E'Orphie');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Belone sp.', DEFAULT);
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Blicca bjoerkna', E'Brème bordelière');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Boops boops', E'Bogue');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Buglossidium luteum', E'Petite sole jaune');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Callionymus phaeton', E'Callionyme paille-en-queue');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Callionymus risso', E'Callionyme bélène');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Callionymus sp.', E'Callionymes');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Carassius auratus', E'Poisson rouge(=Cyprin doré)');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Carassius carassius', E'Carassin(=Cyprin)');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Carassius sp.', DEFAULT);
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Carcinus maenas', E'Crabe vert');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Chelon labrosus', E'Mulet lippu');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Chelon sp.', DEFAULT);
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Chondrostoma nasus', E'Nase commun');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Ciliata mustela', E'Motelle à cinq barbillons');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Ciliata sp.', E'Motelle');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Clupea harengus', E'Hareng de l''Atlantique');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Clupea sp.', DEFAULT);
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Cobitis taenia', E'Loche de rivière');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Conger conger', E'Congre d''Europe');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Cottus gobio', E'Chabot');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Cottus sp.', DEFAULT);
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Crangon crangon', E'Crevette grise');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Crangon sp.', E'Crevettes crangon nca');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Crangonidae', E'Crevettes crangonidés nca');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Crassostrea gigas', E'Huître creuse du Pacifique');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Ctenolabrus rupestris', E'Rouquié');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Umbrina sp.', DEFAULT);
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Cyprinidae', E'Cyprinidés nca');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Cypriniformes', DEFAULT);
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Cyprinus carpio', E'Carpe commune');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Cyprinus sp.', DEFAULT);
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Dasyatis pastinaca', E'Pastenague');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Dasyatis sp.', E'Pastenagues nca');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Dicentrarchus labrax', E'Bar européen');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Dicentrarchus punctatus', E'Bar tacheté');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Dicentrarchus sp.', E'Bars nca');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Dicologlossa cuneata', E'Cèteau');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Diplodus sargus', E'Sar commun');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Diplodus vulgaris', E'Sar à tête noire');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Echiichthys vipera', E'Petite vive');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Engraulis encrasicolus', E'Anchois');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Engraulis sp.', E'Anchois nca');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Enophrys bubalis', E'chabot buffle');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Eriocheir sinensis', E'Crabe chinois');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Esox lucius', E'Brochet du Nord');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Gadus morhua', E'Morue de l''Atlantique');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Galeorhinus galeus', E'Requin-hâ');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Gambusia affinis', E'Gambusie');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Gambusia sp.', DEFAULT);
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Gasterosteus aculeatus', E'Epinoche à trois épines');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Gasterosteus sp.', E'Epinoches');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Gobio gobio', E'Goujon');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Gobius niger', E'Gobie noir');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Gobiusculus flavescens', E'Gobie nageur');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Gymnocephalus cernuus', E'Grémille');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Hippocampus erectus', E'Hippocampe rayé');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Hippocampus hippocampus', E'Hippocampe à museau court');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Hippocampus ingens', DEFAULT);
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Hippocampus ramulosus', E'Hippocampe moucheté');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Hippocampus reidi', DEFAULT);
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Hippocampus sp.', DEFAULT);
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Hippocampus zosterae', E'Hippocampe Atlantique ouest');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Hyperoplus lanceolatus', E'Lançon commun');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Ictalurus melas', E'Poisson chat');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Ictalurus punctatus', E'Barbue d''Amérique');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Ictalurus sp.', E'Barbottes nca');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Labrus bergylta', E'Vieille commune');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Lampetra fluviatilis', E'Lamproie de rivière');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Lampetra planeri', E'Lamproie de Planer');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Lampetra sp.', DEFAULT);
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Lepomis gibbosus', E'Perche soleil');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Lepomis sp.', DEFAULT);
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Leucaspius delineatus', E'Able de Heckel');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Leuciscus cephalus', E'Chevaine');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Liza aurata', E'Mulet doré');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Liza ramada', E'Mulet porc');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Liza sp.', DEFAULT);
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Lophius piscatorius', E'Baudroie commune');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Merlangius merlangus', E'Merlan');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Merluccius merluccius', E'Merlu européen');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Micropterus salmoides', E'Black bass');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Misgurnus fossilis', E'Loche d''étang');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Mugil liza', E'Mulet lebranche');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Mugil sp.', DEFAULT);
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Mugilidae', E'Mulets nca');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Mullus sp.', E'Rougets nca');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Mullus surmuletus', E'Rouget de roche');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Myoxocephalus scorpius', E'Chaboisseau à épines courtes');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Nerophis ophidion', E'Nérophis tête bleue');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'NoName', DEFAULT);
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Orconectes limosus', E'Ecrevisse américaine');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Osmerus eperlanus', E'Eperlan européen');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Osmerus mordax', E'Eperlan arc-en-ciel');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Osmerus mordax dentex', DEFAULT);
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Osmerus mordax mordax', DEFAULT);
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Osmerus sp.', DEFAULT);
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Osmerus sp., Hypomesus sp.', E'Eperlans nca');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Pachygrapsus transversus', E'Anglette africaine');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Palaemon longirostris', E'crevette blanche');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Palaemon longirostris, P. serratus', E'crevettes blanche et rose');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Palaemon serratus', E'Bouquet commun');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Palaemon sp.', DEFAULT);
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Palaemonidae', E'Crevettes d''eau douce nca');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Perca fluviatilis', E'Perche européenne');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Petromyzon marinus', E'Lamproie marine');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Petromyzon marinus, Lampetra fluviatilis', E'lamproie marine et lamproie de rivière');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Petromyzon sp.', DEFAULT);
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Petromyzontiformes', DEFAULT);
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Petromyzontidae', E'Lamproies nca');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Pholis gunnellus', E'Gonelle');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Phoxinus phoxinus', E'Arlequin');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Phoxinus sp.', DEFAULT);
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Platichthys flesus', E'Flet d''Europe');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Platichthys flesus flesus', DEFAULT);
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Platichthys flesus italicus', DEFAULT);
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Platichthys flesus luscus', DEFAULT);
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Platichthys sp.', DEFAULT);
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Pleuronectes platessa', E'Plie d''Europe');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Pleuronectes sp.', DEFAULT);
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Pollachius pollachius', E'Lieu jaune');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Pomatoschistus microps', E'Gobie tacheté');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Pomatoschistus minutus', E'Gobie buhotte');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Pomatoschistus pictus', E'Gobie varié');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Pomatoschistus sp.', DEFAULT);
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Procambarus clarkii', E'Ecrevisse rouge de marais');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Procambarus sp.', DEFAULT);
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Psetta maxima', E'Turbot');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Psetta sp.', DEFAULT);
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Pungitius pungitius', E'Epinochette');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Raja clavata', E'Raie bouclée');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Raja naevus', E'Raie fleurie');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Raja undulata', E'Raie brunette');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Rhodeus sericeus', E'Bouvière');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Rutilus rutilus', E'Gardon');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Rutilus sp.', E'Gardons nca');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Salmo salar', E'Saumon de l''Atlantique');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Salmo sp.', E'Truites nca');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Salmo trutta', E'Truite de mer');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Salmonidae', DEFAULT);
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Sardina pilchardus', E'Sardine commune');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Scardinius erythrophthalmus', E'Rotengle');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Scomber scombrus', E'Maquereau commun');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Scophthalmus maximus', E'Turbot');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Scophthalmus rhombus', E'Barbue');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Scophthalmus sp.', DEFAULT);
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Scyliorhinus canicula', E'Petite roussette');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Scyliorhinus stellaris', E'Grande roussette');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Sepia officinalis', E'Seiche commune');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Silurus glanis', E'Silure glane');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Silurus sp.', DEFAULT);
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Solea lascaris', E'Sole-pole');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Solea senegalensis', E'Sole sénégalaise');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Solea solea', E'Sole commune');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Solea sp.', DEFAULT);
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Solea vulgaris', E'Sole commune');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Sparus aurata', E'Dorade royale');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Spondyliosoma cantharus', E'Dorade grise');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Sprattus sp.', DEFAULT);
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Sprattus sprattus', E'Sprat');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Stizostedion lucioperca', E'Sandre');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Stizostedion sp.', E'Sandres nca');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Symphodus melops', E'Crénilabre melops');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Symphodus roissali', E'Crénilabre langaneu');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Syngnathus acus', E'Syngnathe aiguille');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Syngnathus rostellatus', E'Syngnathe de Duméril');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Syngnathus sp.', E'Syngnathes');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Tinca sp.', DEFAULT);
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Tinca tinca', E'Tanche');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Torpedo marmorata', E'Torpille marbrée');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Trachurus trachurus', E'Chinchard d''Europe');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Trigla lucerna', E'Grondin perlon');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Trigla sp.', E'Grondins nca');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Triglidae', E'Grondins, cavillones nca');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Trisopterus luscus', E'Tacaud commun');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Trisopterus minutus', E'Capelan de Méditerranée');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Umbrina canariensis', E'Ombrine bronze');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Umbrina cirrosa', E'Ombrine côtière');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Pseudorasbora parva', E'Pseudorasbora');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Callionymus lyra', E'Callionyme lyre');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Alburnoides bipunctatus', E'Spirlin');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Ammodytes marinus', E'Lançon équille');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Ammodytes semisquamatus', E'Lançon aiguille');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Aphia minuta', E'Nonnat');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Arnoglossus laterna', E'Arnoglosse de Méditerranée');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Arnoglossus thori', E'Arnoglosse tacheté');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Aspitrigla cuculus', E'Grondin rouge');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Balistes carolinensis', E'Baliste');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Blennius fluviatilis', E'Blennie fluviatile');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Callionymus reticulatus', E'Callionyme réticulé');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Carassius gibelio', E'Carassin argenté');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Centrolabrus exoletus', E'Petite vieille');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Ciliata septentrionalis', E'Motelle à moustaches');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Coris julis', E'Girelle');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Crystallogobius linearis', E'Gobie cristal');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Cyclopterus lumpus', E'Lompe');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Diplodus annularis', E'Sparaillon commun');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Diplodus cervinus', E'Sar à grosses lèvres');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Enchelyopus cimbrius', E'Motelle à quatre barbillons');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Entelurus aequoreus', E'Entélure');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Eutrigla gurnardus', E'Grondin gris');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Gaidropsarus mediterraneus', E'Motelle de Méditerranée');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Gaidropsarus vulgaris', E'Motelle commune');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Galeus melastomus', E'Chien espagnol');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Gobius cobitis', E'Gobie céphalote');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Gobius cruentatus', E'Gobie ensanglanté');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Gobius geniporus', E'Gobie à joues poreuses');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Gobius paganellus', E'Gobie paganel');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Gobius roulei', E'Gobie paganel gros oeil');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Hippocampus guttulatus', E'Cheval marin');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Hippoglossoides platessoides', E'Balai de l''Atlantique');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Labrus merula', E'Merle');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Labrus mixtus', E'Coquette');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Lepadogaster candolii', E'Gluette petite queue');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Lepadogaster lepadogaster', E'Gluette barbier');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Lepidorhombus whiffiagonis', E'Cardine franche');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Lesueurigobius friesii', E'Gobie raôlet');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Leuciscus idus', E'Ide mélanote');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Leuciscus leuciscus', E'Vandoise');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Leuroraja naevus', E'Raie fleurie');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Limanda limanda', E'Limande');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Liparis liparis', E'Limace de mer');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Liparis montagui', E'Limace anicotte');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Lipophrys pholis', E'Blennie mordocet');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Lithognathus mormyrus', E'Marbré');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Liza saliens', E'Mulet sauteur');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Maurolicus muelleri', E'Brossé améthyste');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Melanogrammus aeglefinus', E'Eglefin');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Micrenophrys lilljeborgi', E'Chabot têtu');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Micromesistius poutassou', E'Merlan bleu');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Microstomus kitt', E'Limande sole');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Molva molva', E'Lingue');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Mugil cephalus', E'Mulet à grosse tête');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Mullus barbatus', E'Rouget de vase');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Mustelus asterias', E'Emissole tachetée');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Mustelus mustelus', E'Emissole lisse');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Myxine glutinosa', E'Myxine');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Nerophis lumbriciformis', E'Nérophis petit nez');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Oblada melanura', E'Oblade');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Oncorhynchus mykiss', E'Truite arc-en-ciel');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Parablennius gattorugine', E'Blennie cabot');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Parablennius sanguinolentus', E'Baveuse');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Pollachius virens', E'Lieu noir');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Pomatoschistus lozanoi', E'Gobie rouillé');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Raja brachyura', E'Raie lisse');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Raja microocellata', E'Raie mélée');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Raniceps raninus', E'Trident');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Rhodeus amarus', E'Bouvière');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Salaria pavo', E'Blennie paon');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Spinachia spinachia', E'Epinoche de mer');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Squalus acanthias', E'Aiguillat commun');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Syngnathus abaster', E'Syngnathe gorge claire');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Syngnathus taenionotus', E'Syngnathe taenionotus');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Syngnathus typhle', E'Siphonostome');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Taurulus bubalis', E'Chabot buffle');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Telestes souffia', E'Blageon');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Thymallus thymallus', E'Ombre commun');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Trachinus draco', E'Grande vive');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Trigla lyra', E'Grondin lyre');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Trisopterus esmarkii', E'Tacaud norvégien');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Zeugopterus punctatus', E'Targeur');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Zeus faber', E'Saint Pierre');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Zoarces viviparus', E'Loquette d''Europe');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Zosterisessor ophiocephalus', E'Gobie lotte');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Abramis brama, Blicca bjoerkna', E'Brèmes');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Syngnathidae', E'Syngnathes');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Clupeidae', E'Harengs, sardines nca');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Gadidae', E'Gadidés');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Gobiidae', E'Gobidés');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Sciaena umbra', E'Corb commun');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Sardinella aurita', E'Allache');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Palaemon macrodactylus', E'Bouquet migrateur');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Alloteuthis sp.', E'calmar');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Alloteuthis subulata', E'Casseron commun');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Atelecyclus rotundatus', E'crabe');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Atyaephyra desmaresti,Palemon varians', E'crevettes divers');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Bivalves', E'bivalves');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Cancer pagurus', E'Tourteau');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Carcinus aestuarii', E'Crabe vert de la Méditerranée');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Dromia sp.', E'Dormeur');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Dromia personata', E'Crabe dormeur');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Galathea strigosa', E'Galathée striée');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Gammaridae', E'Gammares');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Goneplax rhomboides', E'crabe');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Liocarcinus depurator', E'Etrille pattes bleues');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Liocarcinus holsatus', E'Etrille');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Loliginidae', E'Calmars côtiers nca');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Loligo sp.', E'Calmars nca');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Macoma balthica', E'Telline de la Baltique');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Loligo vulgaris', E'Encornet');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Macropodia sp.', E'Macropodia');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Necora puber', E'Etrille commune');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Pachygrapsus marmoratus', E'Grapse marbré');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Pachygrapsus sp.', E'crabe');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Palaemon elegans', E'Bouquet flaque');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Palaemonetes varians', E'Bouquet atlantique des canaux');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Panopeus africanus', E'Crabe caillou africain');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Penaeus japonicus', E'Crevette kuruma');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Penaeus kerathurus', E'Caramote');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Pilumnus hirtellus', E'Crabe rouge poilu');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Pisidia longicornis', E'crabe');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Planes minutus', E'crabe');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Pleuronectidae', E'Plies nca');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Porcellana platycheles', E'crabe');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Portumnus latipes', E'Etrille elegante');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Processa edulis', E'Guernade nica');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Salmo trutta trutta', E'Truite de mer brune');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Salmo trutta fario', E'Truite fario');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Sepia sp.', E'Seiches');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Sepiola atlantica', E'Sépiole grandes oreilles');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Sepiola sp.', E'Sépioles');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Zebrus zebrus', E'Gobie zébré');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Aphanius fasciatus', E'Aphanius de Corse');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Microchirus variegatus', E'Sole perdrix');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Palaemon adspersus', DEFAULT);
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Pomatoschistus marmoratus', E'Gobie marbré');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Symphodus cinereus', E'Crénilabre balafré');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Symphodus tinca', E'Crénilabre paon');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Rajelle fyllae', E'Raie ronde');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Sarpa salpa', E'Saupe');
-- ddl-end --
INSERT INTO otolithe.espece (nom_id, nom_fr) VALUES (E'Meduse sp.', E'Meduse');
-- ddl-end --

-- object: otolithe.experimentation_exp_id_seq | type: SEQUENCE --
-- DROP SEQUENCE IF EXISTS otolithe.experimentation_exp_id_seq CASCADE;
CREATE SEQUENCE otolithe.experimentation_exp_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 9223372036854775807
	START WITH 1
	CACHE 1
	NO CYCLE
	OWNED BY NONE;

-- ddl-end --
ALTER SEQUENCE otolithe.experimentation_exp_id_seq OWNER TO otolithe;
-- ddl-end --

-- object: otolithe.experimentation | type: TABLE --
-- DROP TABLE IF EXISTS otolithe.experimentation CASCADE;
CREATE TABLE otolithe.experimentation (
	exp_id integer NOT NULL DEFAULT nextval('otolithe.experimentation_exp_id_seq'::regclass),
	exp_nom character varying NOT NULL,
	exp_description character varying,
	exp_debut date,
	exp_fin date,
	CONSTRAINT pk_experimentation PRIMARY KEY (exp_id)
);
-- ddl-end --
COMMENT ON TABLE otolithe.experimentation IS E'Experimentation a laquelle est rattache le poisson';
-- ddl-end --
ALTER TABLE otolithe.experimentation OWNER TO otolithe;
-- ddl-end --

-- object: otolithe.final_stripe_final_stripe_id_seq | type: SEQUENCE --
-- DROP SEQUENCE IF EXISTS otolithe.final_stripe_final_stripe_id_seq CASCADE;
CREATE SEQUENCE otolithe.final_stripe_final_stripe_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 9223372036854775807
	START WITH 1
	CACHE 1
	NO CYCLE
	OWNED BY NONE;

-- ddl-end --
ALTER SEQUENCE otolithe.final_stripe_final_stripe_id_seq OWNER TO otolithe;
-- ddl-end --

-- object: otolithe.final_stripe | type: TABLE --
-- DROP TABLE IF EXISTS otolithe.final_stripe CASCADE;
CREATE TABLE otolithe.final_stripe (
	final_stripe_id integer NOT NULL DEFAULT nextval('otolithe.final_stripe_final_stripe_id_seq'::regclass),
	final_stripe_code character varying NOT NULL,
	final_stripe_libelle character varying NOT NULL,
	CONSTRAINT final_stripe_pk PRIMARY KEY (final_stripe_id)
);
-- ddl-end --
COMMENT ON TABLE otolithe.final_stripe IS E'Natures de la strie finale';
-- ddl-end --
COMMENT ON COLUMN otolithe.final_stripe.final_stripe_code IS E'Code utilisé';
-- ddl-end --
ALTER TABLE otolithe.final_stripe OWNER TO otolithe;
-- ddl-end --

INSERT INTO otolithe.final_stripe (final_stripe_code, final_stripe_libelle) VALUES (E'HS', E'Hialine stripe');
-- ddl-end --
INSERT INTO otolithe.final_stripe (final_stripe_code, final_stripe_libelle) VALUES (E'DS', E'Dark stripe');
-- ddl-end --
INSERT INTO otolithe.final_stripe (final_stripe_code, final_stripe_libelle) VALUES (E'IN', E'Indefinite');
-- ddl-end --

-- object: otolithe.individu_individu_id_seq | type: SEQUENCE --
-- DROP SEQUENCE IF EXISTS otolithe.individu_individu_id_seq CASCADE;
CREATE SEQUENCE otolithe.individu_individu_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 9223372036854775807
	START WITH 1
	CACHE 1
	NO CYCLE
	OWNED BY NONE;

-- ddl-end --
ALTER SEQUENCE otolithe.individu_individu_id_seq OWNER TO otolithe;
-- ddl-end --

-- object: otolithe.individu | type: TABLE --
-- DROP TABLE IF EXISTS otolithe.individu CASCADE;
CREATE TABLE otolithe.individu (
	individu_id integer NOT NULL DEFAULT nextval('otolithe.individu_individu_id_seq'::regclass),
	espece_id integer NOT NULL,
	peche_id integer,
	sexe_id integer,
	codeindividu character varying,
	poids double precision,
	remarque character varying,
	parasite character varying,
	age integer,
	longueur double precision,
	tag character varying,
	uuid uuid DEFAULT gen_random_uuid(),
	wgs84_x double precision,
	wgs84_y double precision,
	CONSTRAINT pk_individu PRIMARY KEY (individu_id)
);
-- ddl-end --
COMMENT ON COLUMN otolithe.individu.wgs84_x IS E'Longitude of the capture, in wgs84';
-- ddl-end --
COMMENT ON COLUMN otolithe.individu.wgs84_y IS E'Latitude of the capture, in wgs84';
-- ddl-end --
ALTER TABLE otolithe.individu OWNER TO otolithe;
-- ddl-end --

-- object: otolithe.individu_experimentation | type: TABLE --
-- DROP TABLE IF EXISTS otolithe.individu_experimentation CASCADE;
CREATE TABLE otolithe.individu_experimentation (
	individu_id integer NOT NULL,
	exp_id integer NOT NULL,
	CONSTRAINT individu_experimentation_pk PRIMARY KEY (individu_id,exp_id)
);
-- ddl-end --
ALTER TABLE otolithe.individu_experimentation OWNER TO otolithe;
-- ddl-end --

-- object: otolithe.lecteur_lecteur_id_seq | type: SEQUENCE --
-- DROP SEQUENCE IF EXISTS otolithe.lecteur_lecteur_id_seq CASCADE;
CREATE SEQUENCE otolithe.lecteur_lecteur_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 9223372036854775807
	START WITH 1
	CACHE 1
	NO CYCLE
	OWNED BY NONE;

-- ddl-end --
ALTER SEQUENCE otolithe.lecteur_lecteur_id_seq OWNER TO otolithe;
-- ddl-end --

-- object: otolithe.lecteur | type: TABLE --
-- DROP TABLE IF EXISTS otolithe.lecteur CASCADE;
CREATE TABLE otolithe.lecteur (
	lecteur_id integer NOT NULL DEFAULT nextval('otolithe.lecteur_lecteur_id_seq'::regclass),
	login character varying NOT NULL,
	lecteur_nom character varying,
	lecteur_prenom character varying,
	CONSTRAINT pk_lecteur PRIMARY KEY (lecteur_id)
);
-- ddl-end --
COMMENT ON TABLE otolithe.lecteur IS E'personne realisant la lecture d''une photo';
-- ddl-end --
ALTER TABLE otolithe.lecteur OWNER TO otolithe;
-- ddl-end --

-- object: otolithe.lecteur_experimentation | type: TABLE --
-- DROP TABLE IF EXISTS otolithe.lecteur_experimentation CASCADE;
CREATE TABLE otolithe.lecteur_experimentation (
	lecteur_id integer NOT NULL,
	exp_id integer NOT NULL,
	CONSTRAINT lecteur_experimentation_pk PRIMARY KEY (lecteur_id,exp_id)
);
-- ddl-end --
COMMENT ON TABLE otolithe.lecteur_experimentation IS E'Table des experimentations autorisees pour un lecteur';
-- ddl-end --
ALTER TABLE otolithe.lecteur_experimentation OWNER TO otolithe;
-- ddl-end --

-- object: otolithe.lumieretype | type: TABLE --
-- DROP TABLE IF EXISTS otolithe.lumieretype CASCADE;
CREATE TABLE otolithe.lumieretype (
	lumieretype_id integer NOT NULL,
	lumieretype_libelle character varying NOT NULL,
	CONSTRAINT pk_lumieretype PRIMARY KEY (lumieretype_id)
);
-- ddl-end --
ALTER TABLE otolithe.lumieretype OWNER TO otolithe;
-- ddl-end --

INSERT INTO otolithe.lumieretype (lumieretype_libelle) VALUES (E'Reflected light');
-- ddl-end --
INSERT INTO otolithe.lumieretype (lumieretype_libelle) VALUES (E'Transmitted light');
-- ddl-end --

-- object: otolithe.peche_peche_id_seq | type: SEQUENCE --
-- DROP SEQUENCE IF EXISTS otolithe.peche_peche_id_seq CASCADE;
CREATE SEQUENCE otolithe.peche_peche_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 9223372036854775807
	START WITH 1
	CACHE 1
	NO CYCLE
	OWNED BY NONE;

-- ddl-end --
ALTER SEQUENCE otolithe.peche_peche_id_seq OWNER TO otolithe;
-- ddl-end --

-- object: otolithe.peche | type: TABLE --
-- DROP TABLE IF EXISTS otolithe.peche CASCADE;
CREATE TABLE otolithe.peche (
	peche_id integer NOT NULL DEFAULT nextval('otolithe.peche_peche_id_seq'::regclass),
	site character varying,
	zonesite character varying,
	peche_date timestamp,
	campagne character varying,
	peche_engin character varying,
	personne character varying,
	operateur character varying,
	CONSTRAINT pk_sitepeche PRIMARY KEY (peche_id)
);
-- ddl-end --
COMMENT ON TABLE otolithe.peche IS E'Date de peche et lieu de capture';
-- ddl-end --
ALTER TABLE otolithe.peche OWNER TO otolithe;
-- ddl-end --

-- object: otolithe.photo_photo_id_seq | type: SEQUENCE --
-- DROP SEQUENCE IF EXISTS otolithe.photo_photo_id_seq CASCADE;
CREATE SEQUENCE otolithe.photo_photo_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 9223372036854775807
	START WITH 1
	CACHE 1
	NO CYCLE
	OWNED BY NONE;

-- ddl-end --
ALTER SEQUENCE otolithe.photo_photo_id_seq OWNER TO otolithe;
-- ddl-end --

-- object: otolithe.photo | type: TABLE --
-- DROP TABLE IF EXISTS otolithe.photo CASCADE;
CREATE TABLE otolithe.photo (
	photo_id integer NOT NULL DEFAULT nextval('otolithe.photo_photo_id_seq'::regclass),
	piece_id integer NOT NULL,
	lumieretype_id integer,
	photo_nom character varying,
	description character varying,
	photo_filename character varying,
	photo_date timestamp,
	color character varying,
	grossissement integer,
	repere double precision,
	photo_data bytea,
	photo_thumbnail bytea,
	uri character varying,
	long_reference double precision,
	photo_height integer,
	photo_width integer,
	long_ref_pixel integer,
	CONSTRAINT pk_photo PRIMARY KEY (photo_id)
);
-- ddl-end --
COMMENT ON TABLE otolithe.photo IS E'photos associees a une piece';
-- ddl-end --
COMMENT ON COLUMN otolithe.photo.photo_height IS E'Hauteur de la photo originale';
-- ddl-end --
COMMENT ON COLUMN otolithe.photo.photo_width IS E'Largeur de la photo originale';
-- ddl-end --
COMMENT ON COLUMN otolithe.photo.long_ref_pixel IS E'Longueur de reference en pixels - valeur par defaut pour photolecture, si non lu';
-- ddl-end --
ALTER TABLE otolithe.photo OWNER TO otolithe;
-- ddl-end --

-- object: otolithe.photolecture_photolecture_id_seq | type: SEQUENCE --
-- DROP SEQUENCE IF EXISTS otolithe.photolecture_photolecture_id_seq CASCADE;
CREATE SEQUENCE otolithe.photolecture_photolecture_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 9223372036854775807
	START WITH 1
	CACHE 1
	NO CYCLE
	OWNED BY NONE;

-- ddl-end --
ALTER SEQUENCE otolithe.photolecture_photolecture_id_seq OWNER TO otolithe;
-- ddl-end --

-- object: otolithe.photolecture | type: TABLE --
-- DROP TABLE IF EXISTS otolithe.photolecture CASCADE;
CREATE TABLE otolithe.photolecture (
	photolecture_id integer NOT NULL DEFAULT nextval('otolithe.photolecture_photolecture_id_seq'::regclass),
	photo_id integer NOT NULL,
	lecteur_id integer NOT NULL,
	final_stripe_id integer,
	centre character varying,
	bordure varchar,
	points geometry,
	points_ref_lecture geometry,
	photolecture_date timestamp NOT NULL,
	long_ref_mesuree double precision,
	photolecture_height integer,
	photolecture_width integer,
	long_totale_lue double precision,
	long_totale_reel double precision,
	rayon_point_initial real,
	read_fiability real,
	consensual_reading smallint,
	annee_naissance integer,
	commentaire varchar,
	remarkable_points json,
	CONSTRAINT enforce_dims_points CHECK ((st_ndims(points) = 2)),
	CONSTRAINT enforce_dims_points_ref_lecture CHECK ((st_ndims(points_ref_lecture) = 2)),
	CONSTRAINT enforce_geotype_points CHECK (((geometrytype(points) = 'MULTIPOINT'::text) OR (points IS NULL))),
	CONSTRAINT enforce_geotype_points_ref_lecture CHECK (((geometrytype(points_ref_lecture) = 'MULTIPOINT'::text) OR (points_ref_lecture IS NULL))),
	CONSTRAINT pk_photolecture PRIMARY KEY (photolecture_id)
);
-- ddl-end --
COMMENT ON TABLE otolithe.photolecture IS E'Lecture realisee par une personne';
-- ddl-end --
COMMENT ON COLUMN otolithe.photolecture.points_ref_lecture IS E'Emplacement des points utilises pour lire la longueur de reference';
-- ddl-end --
COMMENT ON COLUMN otolithe.photolecture.photolecture_height IS E'Hauteur de la photo utilisee pour la lecture';
-- ddl-end --
COMMENT ON COLUMN otolithe.photolecture.photolecture_width IS E'Largeur de la photo affichee pour realiser la lecture';
-- ddl-end --
COMMENT ON COLUMN otolithe.photolecture.long_totale_lue IS E'Somme des segments entre chacun des points';
-- ddl-end --
COMMENT ON COLUMN otolithe.photolecture.long_totale_reel IS E'Longueur totale réelle calculée pour le lecteur\n(long_reference / long_ref_mesuree * long_totale_lue)';
-- ddl-end --
COMMENT ON COLUMN otolithe.photolecture.read_fiability IS E'Fiabilité de la lecture';
-- ddl-end --
COMMENT ON COLUMN otolithe.photolecture.consensual_reading IS E'1 si lecture consensuelle';
-- ddl-end --
COMMENT ON COLUMN otolithe.photolecture.annee_naissance IS E'Année de naissance estimée';
-- ddl-end --
COMMENT ON COLUMN otolithe.photolecture.commentaire IS E'Commentaire sur la lecture';
-- ddl-end --
COMMENT ON COLUMN otolithe.photolecture.remarkable_points IS E'Liste des points remarquables identifiés sur la photo';
-- ddl-end --
ALTER TABLE otolithe.photolecture OWNER TO otolithe;
-- ddl-end --

-- object: otolithe.piece_piece_id_seq | type: SEQUENCE --
-- DROP SEQUENCE IF EXISTS otolithe.piece_piece_id_seq CASCADE;
CREATE SEQUENCE otolithe.piece_piece_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 9223372036854775807
	START WITH 1
	CACHE 1
	NO CYCLE
	OWNED BY NONE;

-- ddl-end --
ALTER SEQUENCE otolithe.piece_piece_id_seq OWNER TO otolithe;
-- ddl-end --

-- object: otolithe.piece | type: TABLE --
-- DROP TABLE IF EXISTS otolithe.piece CASCADE;
CREATE TABLE otolithe.piece (
	piece_id integer NOT NULL DEFAULT nextval('otolithe.piece_piece_id_seq'::regclass),
	individu_id integer NOT NULL,
	piecetype_id integer NOT NULL,
	traitementpiece_id integer,
	piececode character varying(255),
	uuid uuid DEFAULT gen_random_uuid(),
	CONSTRAINT pk_piece PRIMARY KEY (piece_id)
);
-- ddl-end --
COMMENT ON TABLE otolithe.piece IS E'Pieces analysees';
-- ddl-end --
ALTER TABLE otolithe.piece OWNER TO otolithe;
-- ddl-end --

-- object: otolithe.piecetype_piecetype_id_seq | type: SEQUENCE --
-- DROP SEQUENCE IF EXISTS otolithe.piecetype_piecetype_id_seq CASCADE;
CREATE SEQUENCE otolithe.piecetype_piecetype_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 9223372036854775807
	START WITH 1
	CACHE 1
	NO CYCLE
	OWNED BY NONE;

-- ddl-end --
ALTER SEQUENCE otolithe.piecetype_piecetype_id_seq OWNER TO otolithe;
-- ddl-end --

-- object: otolithe.piecetype | type: TABLE --
-- DROP TABLE IF EXISTS otolithe.piecetype CASCADE;
CREATE TABLE otolithe.piecetype (
	piecetype_id integer NOT NULL DEFAULT nextval('otolithe.piecetype_piecetype_id_seq'::regclass),
	piecetype_libelle character varying NOT NULL,
	CONSTRAINT pk_piecetype PRIMARY KEY (piecetype_id)
);
-- ddl-end --
COMMENT ON TABLE otolithe.piecetype IS E'Type de piece';
-- ddl-end --
ALTER TABLE otolithe.piecetype OWNER TO otolithe;
-- ddl-end --

-- object: otolithe.sexe | type: TABLE --
-- DROP TABLE IF EXISTS otolithe.sexe CASCADE;
CREATE TABLE otolithe.sexe (
	sexe_id integer NOT NULL,
	sexe_libelle character varying NOT NULL,
	sexe_libellecourt character varying NOT NULL,
	CONSTRAINT pk_sexe PRIMARY KEY (sexe_id)
);
-- ddl-end --
ALTER TABLE otolithe.sexe OWNER TO otolithe;
-- ddl-end --

INSERT INTO otolithe.sexe (sexe_id, sexe_libelle, sexe_libellecourt) VALUES (E'1', E'Mâle', E'm');
-- ddl-end --
INSERT INTO otolithe.sexe (sexe_id, sexe_libelle, sexe_libellecourt) VALUES (E'2', E'Femelle', E'f');
-- ddl-end --
INSERT INTO otolithe.sexe (sexe_id, sexe_libelle, sexe_libellecourt) VALUES (E'3', E'Indéterminé', E'i');
-- ddl-end --

-- object: otolithe.traitementpiece_traitementpiece_id_seq | type: SEQUENCE --
-- DROP SEQUENCE IF EXISTS otolithe.traitementpiece_traitementpiece_id_seq CASCADE;
CREATE SEQUENCE otolithe.traitementpiece_traitementpiece_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 9223372036854775807
	START WITH 1
	CACHE 1
	NO CYCLE
	OWNED BY NONE;

-- ddl-end --
ALTER SEQUENCE otolithe.traitementpiece_traitementpiece_id_seq OWNER TO otolithe;
-- ddl-end --

-- object: otolithe.traitementpiece | type: TABLE --
-- DROP TABLE IF EXISTS otolithe.traitementpiece CASCADE;
CREATE TABLE otolithe.traitementpiece (
	traitementpiece_id integer NOT NULL DEFAULT nextval('otolithe.traitementpiece_traitementpiece_id_seq'::regclass),
	traitementpiece_libelle character varying NOT NULL,
	CONSTRAINT pk_traitementpiece PRIMARY KEY (traitementpiece_id)
);
-- ddl-end --
ALTER TABLE otolithe.traitementpiece OWNER TO otolithe;
-- ddl-end --

INSERT INTO otolithe.traitementpiece (traitementpiece_libelle) VALUES (E'polishing');
-- ddl-end --
INSERT INTO otolithe.traitementpiece (traitementpiece_libelle) VALUES (E'grinding,polishing');
-- ddl-end --
INSERT INTO otolithe.traitementpiece (traitementpiece_libelle) VALUES (E'grinding,polishing,staining');
-- ddl-end --
INSERT INTO otolithe.traitementpiece (traitementpiece_libelle) VALUES (E'burning,cracking,grinding,polishing');
-- ddl-end --
INSERT INTO otolithe.traitementpiece (traitementpiece_libelle) VALUES (E'burning,cracking');
-- ddl-end --
INSERT INTO otolithe.traitementpiece (traitementpiece_libelle) VALUES (E'cracking,grinding,polishing');
-- ddl-end --
INSERT INTO otolithe.traitementpiece (traitementpiece_libelle) VALUES (E'not recorded');
-- ddl-end --

-- object: otolithe.dbparam | type: TABLE --
-- DROP TABLE IF EXISTS otolithe.dbparam CASCADE;
CREATE TABLE otolithe.dbparam (
	dbparam_id serial NOT NULL,
	dbparam_name character varying NOT NULL,
	dbparam_value character varying,
	dbparam_description varchar,
	dbparam_description_en varchar,
	CONSTRAINT dbparam_pk PRIMARY KEY (dbparam_id)
);
-- ddl-end --
COMMENT ON TABLE otolithe.dbparam IS E'Table des parametres associes de maniere intrinseque a l''instance';
-- ddl-end --
COMMENT ON COLUMN otolithe.dbparam.dbparam_name IS E'Nom du parametre';
-- ddl-end --
COMMENT ON COLUMN otolithe.dbparam.dbparam_value IS E'Valeur du paramètre';
-- ddl-end --
ALTER TABLE otolithe.dbparam OWNER TO otolithe;
-- ddl-end --

INSERT INTO otolithe.dbparam (dbparam_id, dbparam_name, dbparam_value, dbparam_description, dbparam_description_en) VALUES (E'1', E'APPLI_code', E'OTOLITHE', E'Code de l''application', E'Code of the application');
-- ddl-end --
INSERT INTO otolithe.dbparam (dbparam_id, dbparam_name, dbparam_value, dbparam_description, dbparam_description_en) VALUES (E'2', E'APPLI_title', E'Otolithe', E'Titre de l''application, affiché à côté de l''icône', DEFAULT);
-- ddl-end --
INSERT INTO otolithe.dbparam (dbparam_id, dbparam_name, dbparam_value, dbparam_description, dbparam_description_en) VALUES (E'3', E'otp_issuer', E'otolithe', E'Nom affiché dans les applications de génération de codes uniques pour l''identification à double facteur', E'Name displayed in applications generating unique codes for two-factor identification');
-- ddl-end --

-- object: otolithe.dbversion_dbversion_id_seq | type: SEQUENCE --
-- DROP SEQUENCE IF EXISTS otolithe.dbversion_dbversion_id_seq CASCADE;
CREATE SEQUENCE otolithe.dbversion_dbversion_id_seq
	INCREMENT BY 1
	MINVALUE 1
	START WITH 1
	CACHE 1
	NO CYCLE
	OWNED BY NONE;

-- ddl-end --
ALTER SEQUENCE otolithe.dbversion_dbversion_id_seq OWNER TO otolithe;
-- ddl-end --

-- object: otolithe.dbversion | type: TABLE --
-- DROP TABLE IF EXISTS otolithe.dbversion CASCADE;
CREATE TABLE otolithe.dbversion (
	dbversion_id integer NOT NULL DEFAULT nextval('otolithe.dbversion_dbversion_id_seq'::regclass),
	dbversion_number character varying NOT NULL,
	dbversion_date timestamp NOT NULL,
	CONSTRAINT dbversion_pk PRIMARY KEY (dbversion_id)
);
-- ddl-end --
COMMENT ON TABLE otolithe.dbversion IS E'Table des versions de la base de donnees';
-- ddl-end --
COMMENT ON COLUMN otolithe.dbversion.dbversion_number IS E'Numero de la version';
-- ddl-end --
COMMENT ON COLUMN otolithe.dbversion.dbversion_date IS E'Date de la version';
-- ddl-end --
ALTER TABLE otolithe.dbversion OWNER TO otolithe;
-- ddl-end --

INSERT INTO otolithe.dbversion (dbversion_number, dbversion_date) VALUES (E'24.0', E'2024-06-19');
-- ddl-end --

-- object: otolithe.metadatatype_metadatatype_id_seq | type: SEQUENCE --
-- DROP SEQUENCE IF EXISTS otolithe.metadatatype_metadatatype_id_seq CASCADE;
CREATE SEQUENCE otolithe.metadatatype_metadatatype_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 9223372036854775807
	START WITH 1
	CACHE 1
	NO CYCLE
	OWNED BY NONE;

-- ddl-end --
ALTER SEQUENCE otolithe.metadatatype_metadatatype_id_seq OWNER TO otolithe;
-- ddl-end --

-- object: otolithe.piecemetadata_piecemetadata_id_seq | type: SEQUENCE --
-- DROP SEQUENCE IF EXISTS otolithe.piecemetadata_piecemetadata_id_seq CASCADE;
CREATE SEQUENCE otolithe.piecemetadata_piecemetadata_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 9223372036854775807
	START WITH 1
	CACHE 1
	NO CYCLE
	OWNED BY NONE;

-- ddl-end --
ALTER SEQUENCE otolithe.piecemetadata_piecemetadata_id_seq OWNER TO otolithe;
-- ddl-end --

-- object: otolithe.piecemetadata | type: TABLE --
-- DROP TABLE IF EXISTS otolithe.piecemetadata CASCADE;
CREATE TABLE otolithe.piecemetadata (
	piecemetadata_id integer NOT NULL DEFAULT nextval('otolithe.piecemetadata_piecemetadata_id_seq'::regclass),
	piece_id integer NOT NULL,
	metadatatype_id integer NOT NULL,
	metadata json,
	piecemetadata_date timestamp,
	piecemetadata_comment varchar,
	CONSTRAINT piecemetadata_pk PRIMARY KEY (piecemetadata_id)
);
-- ddl-end --
COMMENT ON TABLE otolithe.piecemetadata IS E'Métadonnées rattachées à une pièce calcifiée';
-- ddl-end --
COMMENT ON COLUMN otolithe.piecemetadata.metadata IS E'Valeurs associées, au format Json';
-- ddl-end --
COMMENT ON COLUMN otolithe.piecemetadata.piecemetadata_date IS E'Date d''acquisition des informations';
-- ddl-end --
COMMENT ON COLUMN otolithe.piecemetadata.piecemetadata_comment IS E'Commentaires libres';
-- ddl-end --
ALTER TABLE otolithe.piecemetadata OWNER TO otolithe;
-- ddl-end --

-- object: otolithe.metadatatype | type: TABLE --
-- DROP TABLE IF EXISTS otolithe.metadatatype CASCADE;
CREATE TABLE otolithe.metadatatype (
	metadatatype_id integer NOT NULL DEFAULT nextval('otolithe.metadatatype_metadatatype_id_seq'::regclass),
	metadatatype_name varchar NOT NULL,
	metadatatype_comment varchar,
	metadatatype_description bytea,
	is_array boolean DEFAULT false,
	metadatatype_schema json,
	CONSTRAINT metadatatype_pk PRIMARY KEY (metadatatype_id)
);
-- ddl-end --
COMMENT ON COLUMN otolithe.metadatatype.metadatatype_name IS E'Nom du type de métadonnées';
-- ddl-end --
COMMENT ON COLUMN otolithe.metadatatype.metadatatype_comment IS E'Description du type de métadonnées';
-- ddl-end --
COMMENT ON COLUMN otolithe.metadatatype.metadatatype_description IS E'Description externe du jeu de métadonnées (fichier PDF attaché, par exemple)';
-- ddl-end --
COMMENT ON COLUMN otolithe.metadatatype.is_array IS E'Définit si les données sont sous forme de tableau ou uniques';
-- ddl-end --
COMMENT ON COLUMN otolithe.metadatatype.metadatatype_schema IS E'Description JSON au format AlpacaJS du type de métadonnées';
-- ddl-end --
ALTER TABLE otolithe.metadatatype OWNER TO otolithe;
-- ddl-end --

-- object: pgcrypto | type: EXTENSION --
-- DROP EXTENSION IF EXISTS pgcrypto CASCADE;
CREATE EXTENSION pgcrypto
WITH SCHEMA public;
-- ddl-end --

-- object: gacl.aclacl | type: TABLE --
-- DROP TABLE IF EXISTS gacl.aclacl CASCADE;
CREATE TABLE gacl.aclacl (
	aclaco_id integer NOT NULL,
	aclgroup_id integer NOT NULL,
	CONSTRAINT aclacl_pk PRIMARY KEY (aclaco_id,aclgroup_id) DEFERRABLE INITIALLY IMMEDIATE
);
-- ddl-end --
COMMENT ON TABLE gacl.aclacl IS E'Rights table';
-- ddl-end --
ALTER TABLE gacl.aclacl OWNER TO otolithe;
-- ddl-end --

INSERT INTO gacl.aclacl (aclaco_id, aclgroup_id) VALUES (E'1', E'1');
-- ddl-end --
INSERT INTO gacl.aclacl (aclaco_id, aclgroup_id) VALUES (E'2', E'2');
-- ddl-end --
INSERT INTO gacl.aclacl (aclaco_id, aclgroup_id) VALUES (E'3', E'3');
-- ddl-end --
INSERT INTO gacl.aclacl (aclaco_id, aclgroup_id) VALUES (E'4', E'4');
-- ddl-end --

-- object: gacl.aclaco_aclaco_id_seq | type: SEQUENCE --
-- DROP SEQUENCE IF EXISTS gacl.aclaco_aclaco_id_seq CASCADE;
CREATE SEQUENCE gacl.aclaco_aclaco_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 9223372036854775807
	START WITH 6
	CACHE 1
	NO CYCLE
	OWNED BY NONE;

-- ddl-end --
ALTER SEQUENCE gacl.aclaco_aclaco_id_seq OWNER TO otolithe;
-- ddl-end --

-- object: gacl.aclaco | type: TABLE --
-- DROP TABLE IF EXISTS gacl.aclaco CASCADE;
CREATE TABLE gacl.aclaco (
	aclaco_id integer NOT NULL DEFAULT nextval('gacl.aclaco_aclaco_id_seq'::regclass),
	aco character varying NOT NULL,
	aclappli_id integer NOT NULL,
	CONSTRAINT aclaco_pk PRIMARY KEY (aclaco_id)
);
-- ddl-end --
COMMENT ON TABLE gacl.aclaco IS E'List of managed rights';
-- ddl-end --
ALTER TABLE gacl.aclaco OWNER TO otolithe;
-- ddl-end --

INSERT INTO gacl.aclaco (aclaco_id, aclappli_id, aco) VALUES (E'1', E'1', E'admin');
-- ddl-end --
INSERT INTO gacl.aclaco (aclaco_id, aclappli_id, aco) VALUES (E'2', E'1', E'manage');
-- ddl-end --
INSERT INTO gacl.aclaco (aclaco_id, aclappli_id, aco) VALUES (E'3', E'1', E'consult');
-- ddl-end --
INSERT INTO gacl.aclaco (aclaco_id, aclappli_id, aco) VALUES (E'4', E'1', E'param');
-- ddl-end --
INSERT INTO gacl.aclaco (aclaco_id, aclappli_id, aco) VALUES (E'5', E'1', E'read');
-- ddl-end --

-- object: gacl.aclappli_aclappli_id_seq | type: SEQUENCE --
-- DROP SEQUENCE IF EXISTS gacl.aclappli_aclappli_id_seq CASCADE;
CREATE SEQUENCE gacl.aclappli_aclappli_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 9223372036854775807
	START WITH 2
	CACHE 1
	NO CYCLE
	OWNED BY NONE;

-- ddl-end --
ALTER SEQUENCE gacl.aclappli_aclappli_id_seq OWNER TO otolithe;
-- ddl-end --

-- object: gacl.aclappli | type: TABLE --
-- DROP TABLE IF EXISTS gacl.aclappli CASCADE;
CREATE TABLE gacl.aclappli (
	aclappli_id integer NOT NULL DEFAULT nextval('gacl.aclappli_aclappli_id_seq'::regclass),
	appli character varying NOT NULL,
	applidetail character varying,
	CONSTRAINT aclappli_pk PRIMARY KEY (aclappli_id)
);
-- ddl-end --
COMMENT ON TABLE gacl.aclappli IS E'Managed software table';
-- ddl-end --
COMMENT ON COLUMN gacl.aclappli.appli IS E'Software name from rights management';
-- ddl-end --
COMMENT ON COLUMN gacl.aclappli.applidetail IS E'Software description';
-- ddl-end --
ALTER TABLE gacl.aclappli OWNER TO otolithe;
-- ddl-end --

INSERT INTO gacl.aclappli (aclappli_id, appli, applidetail) VALUES (E'1', E'otolithe', DEFAULT);
-- ddl-end --

-- object: gacl.aclgroup_aclgroup_id_seq | type: SEQUENCE --
-- DROP SEQUENCE IF EXISTS gacl.aclgroup_aclgroup_id_seq CASCADE;
CREATE SEQUENCE gacl.aclgroup_aclgroup_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 9223372036854775807
	START WITH 5
	CACHE 1
	NO CYCLE
	OWNED BY NONE;

-- ddl-end --
ALTER SEQUENCE gacl.aclgroup_aclgroup_id_seq OWNER TO otolithe;
-- ddl-end --

-- object: gacl.aclgroup | type: TABLE --
-- DROP TABLE IF EXISTS gacl.aclgroup CASCADE;
CREATE TABLE gacl.aclgroup (
	aclgroup_id integer NOT NULL DEFAULT nextval('gacl.aclgroup_aclgroup_id_seq'::regclass),
	groupe character varying NOT NULL,
	aclgroup_id_parent integer,
	CONSTRAINT aclgroup_pk PRIMARY KEY (aclgroup_id)
);
-- ddl-end --
COMMENT ON TABLE gacl.aclgroup IS E'Login groups';
-- ddl-end --
ALTER TABLE gacl.aclgroup OWNER TO otolithe;
-- ddl-end --

INSERT INTO gacl.aclgroup (aclgroup_id, groupe, aclgroup_id_parent) VALUES (E'1', E'admin', DEFAULT);
-- ddl-end --
INSERT INTO gacl.aclgroup (aclgroup_id, groupe, aclgroup_id_parent) VALUES (E'2', E'consult', DEFAULT);
-- ddl-end --
INSERT INTO gacl.aclgroup (aclgroup_id, groupe, aclgroup_id_parent) VALUES (E'3', E'manage', E'2');
-- ddl-end --
INSERT INTO gacl.aclgroup (aclgroup_id, groupe, aclgroup_id_parent) VALUES (E'4', E'param', E'3');
-- ddl-end --

-- object: gacl.acllogin_acllogin_id_seq | type: SEQUENCE --
-- DROP SEQUENCE IF EXISTS gacl.acllogin_acllogin_id_seq CASCADE;
CREATE SEQUENCE gacl.acllogin_acllogin_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 9223372036854775807
	START WITH 2
	CACHE 1
	NO CYCLE
	OWNED BY NONE;

-- ddl-end --
ALTER SEQUENCE gacl.acllogin_acllogin_id_seq OWNER TO otolithe;
-- ddl-end --

-- object: gacl.acllogin | type: TABLE --
-- DROP TABLE IF EXISTS gacl.acllogin CASCADE;
CREATE TABLE gacl.acllogin (
	acllogin_id integer NOT NULL DEFAULT nextval('gacl.acllogin_acllogin_id_seq'::regclass),
	login character varying NOT NULL,
	logindetail character varying NOT NULL,
	CONSTRAINT acllogin_pk PRIMARY KEY (acllogin_id)
);
-- ddl-end --
COMMENT ON TABLE gacl.acllogin IS E'Users login';
-- ddl-end --
COMMENT ON COLUMN gacl.acllogin.logindetail IS E'Nom affiché';
-- ddl-end --
ALTER TABLE gacl.acllogin OWNER TO otolithe;
-- ddl-end --

INSERT INTO gacl.acllogin (acllogin_id, login, logindetail) VALUES (E'1', E'admin', E'admin');
-- ddl-end --

-- object: gacl.acllogingroup | type: TABLE --
-- DROP TABLE IF EXISTS gacl.acllogingroup CASCADE;
CREATE TABLE gacl.acllogingroup (
	acllogin_id integer NOT NULL,
	aclgroup_id integer NOT NULL,
	CONSTRAINT acllogingroup_pk PRIMARY KEY (acllogin_id) DEFERRABLE INITIALLY IMMEDIATE
);
-- ddl-end --
COMMENT ON TABLE gacl.acllogingroup IS E'Relationship between logins and groups';
-- ddl-end --
ALTER TABLE gacl.acllogingroup OWNER TO otolithe;
-- ddl-end --

INSERT INTO gacl.acllogingroup (acllogin_id, aclgroup_id) VALUES (E'1', E'1');
-- ddl-end --
INSERT INTO gacl.acllogingroup (acllogin_id, aclgroup_id) VALUES (E'1', E'4');
-- ddl-end --

-- object: gacl.seq_logingestion_id | type: SEQUENCE --
-- DROP SEQUENCE IF EXISTS gacl.seq_logingestion_id CASCADE;
CREATE SEQUENCE gacl.seq_logingestion_id
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 999999
	START WITH 2
	CACHE 1
	NO CYCLE
	OWNED BY NONE;

-- ddl-end --
ALTER SEQUENCE gacl.seq_logingestion_id OWNER TO otolithe;
-- ddl-end --

-- object: gacl.logingestion | type: TABLE --
-- DROP TABLE IF EXISTS gacl.logingestion CASCADE;
CREATE TABLE gacl.logingestion (
	id integer NOT NULL DEFAULT nextval('gacl.seq_logingestion_id'::regclass),
	login character varying(32) NOT NULL,
	password character varying(255),
	nom character varying(32),
	prenom character varying(32),
	mail character varying(255),
	datemodif date,
	actif smallint DEFAULT 1,
	is_clientws boolean NOT NULL DEFAULT false,
	tokenws character varying,
	is_expired boolean DEFAULT false,
	nb_attempts smallint,
	lastattempt timestamp,
	CONSTRAINT logingestion_pk PRIMARY KEY (id)
);
-- ddl-end --
ALTER TABLE gacl.logingestion OWNER TO otolithe;
-- ddl-end --

INSERT INTO gacl.logingestion (id, login, password, nom, prenom, mail, datemodif, actif, is_clientws, tokenws, is_expired) VALUES (E'1', E'admin', E'cd916028a2d8a1b901e831246dd5b9b4d3832786ddc63bbf5af4b50d9fc98f50', E'admin', DEFAULT, DEFAULT, DEFAULT, E'1', E'false', DEFAULT, E'false');
-- ddl-end --

-- object: gacl.log_log_id_seq | type: SEQUENCE --
-- DROP SEQUENCE IF EXISTS gacl.log_log_id_seq CASCADE;
CREATE SEQUENCE gacl.log_log_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 9223372036854775807
	START WITH 1
	CACHE 1
	NO CYCLE
	OWNED BY NONE;

-- ddl-end --
ALTER SEQUENCE gacl.log_log_id_seq OWNER TO otolithe;
-- ddl-end --

-- object: gacl.log | type: TABLE --
-- DROP TABLE IF EXISTS gacl.log CASCADE;
CREATE TABLE gacl.log (
	log_id integer NOT NULL DEFAULT nextval('gacl.log_log_id_seq'::regclass),
	login character varying(32) NOT NULL,
	nom_module character varying,
	log_date timestamp NOT NULL,
	commentaire character varying,
	ipaddress character varying,
	CONSTRAINT log_pk PRIMARY KEY (log_id)
);
-- ddl-end --
COMMENT ON TABLE gacl.log IS E'list of connexions and actions recorded';
-- ddl-end --
COMMENT ON COLUMN gacl.log.log_date IS E'Connexion time';
-- ddl-end --
COMMENT ON COLUMN gacl.log.commentaire IS E'others data';
-- ddl-end --
COMMENT ON COLUMN gacl.log.ipaddress IS E'ip address of client';
-- ddl-end --
ALTER TABLE gacl.log OWNER TO otolithe;
-- ddl-end --

-- object: log_date_idx | type: INDEX --
-- DROP INDEX IF EXISTS gacl.log_date_idx CASCADE;
CREATE INDEX log_date_idx ON gacl.log
USING btree
(
	log_date
)
WITH (FILLFACTOR = 90);
-- ddl-end --

-- object: log_login_idx | type: INDEX --
-- DROP INDEX IF EXISTS gacl.log_login_idx CASCADE;
CREATE INDEX log_login_idx ON gacl.log
USING btree
(
	login
)
WITH (FILLFACTOR = 90);
-- ddl-end --

-- object: gacl.passwordlost_passwordlost_id_seq | type: SEQUENCE --
-- DROP SEQUENCE IF EXISTS gacl.passwordlost_passwordlost_id_seq CASCADE;
CREATE SEQUENCE gacl.passwordlost_passwordlost_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 9223372036854775807
	START WITH 1
	CACHE 1
	NO CYCLE
	OWNED BY NONE;

-- ddl-end --
ALTER SEQUENCE gacl.passwordlost_passwordlost_id_seq OWNER TO otolithe;
-- ddl-end --

-- object: gacl.passwordlost | type: TABLE --
-- DROP TABLE IF EXISTS gacl.passwordlost CASCADE;
CREATE TABLE gacl.passwordlost (
	passwordlost_id integer NOT NULL DEFAULT nextval('gacl.passwordlost_passwordlost_id_seq'::regclass),
	token character varying NOT NULL,
	expiration timestamp NOT NULL,
	usedate timestamp,
	id integer NOT NULL,
	CONSTRAINT passwordlost_pk PRIMARY KEY (passwordlost_id)
);
-- ddl-end --
COMMENT ON TABLE gacl.passwordlost IS E'password lost table';
-- ddl-end --
COMMENT ON COLUMN gacl.passwordlost.token IS E'token used for renewal';
-- ddl-end --
COMMENT ON COLUMN gacl.passwordlost.expiration IS E'Token expiration date';
-- ddl-end --
ALTER TABLE gacl.passwordlost OWNER TO otolithe;
-- ddl-end --

-- object: aclaco_fk | type: CONSTRAINT --
-- ALTER TABLE gacl.aclacl DROP CONSTRAINT IF EXISTS aclaco_fk CASCADE;
ALTER TABLE gacl.aclacl ADD CONSTRAINT aclaco_fk FOREIGN KEY (aclaco_id)
REFERENCES gacl.aclaco (aclaco_id) MATCH FULL
ON DELETE CASCADE ON UPDATE CASCADE DEFERRABLE INITIALLY IMMEDIATE;
-- ddl-end --

-- object: aclappli_fk | type: CONSTRAINT --
-- ALTER TABLE gacl.aclaco DROP CONSTRAINT IF EXISTS aclappli_fk CASCADE;
ALTER TABLE gacl.aclaco ADD CONSTRAINT aclappli_fk FOREIGN KEY (aclappli_id)
REFERENCES gacl.aclappli (aclappli_id) MATCH FULL
ON DELETE NO ACTION ON UPDATE CASCADE DEFERRABLE INITIALLY IMMEDIATE;
-- ddl-end --

-- object: aclgroup_fk | type: CONSTRAINT --
-- ALTER TABLE gacl.aclacl DROP CONSTRAINT IF EXISTS aclgroup_fk CASCADE;
ALTER TABLE gacl.aclacl ADD CONSTRAINT aclgroup_fk FOREIGN KEY (aclgroup_id)
REFERENCES gacl.aclgroup (aclgroup_id) MATCH FULL
ON DELETE CASCADE ON UPDATE CASCADE DEFERRABLE INITIALLY IMMEDIATE;
-- ddl-end --

-- object: acllogin_fk | type: CONSTRAINT --
-- ALTER TABLE gacl.acllogingroup DROP CONSTRAINT IF EXISTS acllogin_fk CASCADE;
ALTER TABLE gacl.acllogingroup ADD CONSTRAINT acllogin_fk FOREIGN KEY (acllogin_id)
REFERENCES gacl.acllogin (acllogin_id) MATCH FULL
ON DELETE CASCADE ON UPDATE CASCADE DEFERRABLE INITIALLY IMMEDIATE;
-- ddl-end --

-- object: logingestion_fk | type: CONSTRAINT --
-- ALTER TABLE gacl.passwordlost DROP CONSTRAINT IF EXISTS logingestion_fk CASCADE;
ALTER TABLE gacl.passwordlost ADD CONSTRAINT logingestion_fk FOREIGN KEY (id)
REFERENCES gacl.logingestion (id) MATCH FULL
ON DELETE NO ACTION ON UPDATE CASCADE DEFERRABLE INITIALLY IMMEDIATE;
-- ddl-end --

-- object: tablefunc | type: EXTENSION --
-- DROP EXTENSION IF EXISTS tablefunc CASCADE;
CREATE EXTENSION tablefunc
WITH SCHEMA public
VERSION '1.0';
-- ddl-end --
COMMENT ON EXTENSION tablefunc IS E'functions that manipulate whole tables, including crosstab';
-- ddl-end --

-- object: gacl.login_oldpassword_login_oldpassword_id_seq | type: SEQUENCE --
-- DROP SEQUENCE IF EXISTS gacl.login_oldpassword_login_oldpassword_id_seq CASCADE;
CREATE SEQUENCE gacl.login_oldpassword_login_oldpassword_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 9223372036854775807
	START WITH 1
	CACHE 1
	NO CYCLE
	OWNED BY NONE;

-- ddl-end --
ALTER SEQUENCE gacl.login_oldpassword_login_oldpassword_id_seq OWNER TO quinton;
-- ddl-end --

-- object: aclgroup | type: CONSTRAINT --
-- ALTER TABLE gacl.acllogingroup DROP CONSTRAINT IF EXISTS aclgroup CASCADE;
ALTER TABLE gacl.acllogingroup ADD CONSTRAINT aclgroup FOREIGN KEY (aclgroup_id)
REFERENCES gacl.aclgroup (aclgroup_id) MATCH FULL
ON DELETE NO ACTION ON UPDATE CASCADE DEFERRABLE INITIALLY IMMEDIATE;
-- ddl-end --

-- object: espece_individu_fk | type: CONSTRAINT --
-- ALTER TABLE otolithe.individu DROP CONSTRAINT IF EXISTS espece_individu_fk CASCADE;
ALTER TABLE otolithe.individu ADD CONSTRAINT espece_individu_fk FOREIGN KEY (espece_id)
REFERENCES otolithe.espece (espece_id) MATCH SIMPLE
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --

-- object: peche_individu_fk | type: CONSTRAINT --
-- ALTER TABLE otolithe.individu DROP CONSTRAINT IF EXISTS peche_individu_fk CASCADE;
ALTER TABLE otolithe.individu ADD CONSTRAINT peche_individu_fk FOREIGN KEY (peche_id)
REFERENCES otolithe.peche (peche_id) MATCH SIMPLE
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --

-- object: sexe_individu_fk | type: CONSTRAINT --
-- ALTER TABLE otolithe.individu DROP CONSTRAINT IF EXISTS sexe_individu_fk CASCADE;
ALTER TABLE otolithe.individu ADD CONSTRAINT sexe_individu_fk FOREIGN KEY (sexe_id)
REFERENCES otolithe.sexe (sexe_id) MATCH SIMPLE
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --

-- object: experimentation_individu_experimentation_fk | type: CONSTRAINT --
-- ALTER TABLE otolithe.individu_experimentation DROP CONSTRAINT IF EXISTS experimentation_individu_experimentation_fk CASCADE;
ALTER TABLE otolithe.individu_experimentation ADD CONSTRAINT experimentation_individu_experimentation_fk FOREIGN KEY (exp_id)
REFERENCES otolithe.experimentation (exp_id) MATCH SIMPLE
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --

-- object: individu_individu_experimentation_fk | type: CONSTRAINT --
-- ALTER TABLE otolithe.individu_experimentation DROP CONSTRAINT IF EXISTS individu_individu_experimentation_fk CASCADE;
ALTER TABLE otolithe.individu_experimentation ADD CONSTRAINT individu_individu_experimentation_fk FOREIGN KEY (individu_id)
REFERENCES otolithe.individu (individu_id) MATCH SIMPLE
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --

-- object: experimentation_lecteur_experimentation_fk | type: CONSTRAINT --
-- ALTER TABLE otolithe.lecteur_experimentation DROP CONSTRAINT IF EXISTS experimentation_lecteur_experimentation_fk CASCADE;
ALTER TABLE otolithe.lecteur_experimentation ADD CONSTRAINT experimentation_lecteur_experimentation_fk FOREIGN KEY (exp_id)
REFERENCES otolithe.experimentation (exp_id) MATCH SIMPLE
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --

-- object: lecteur_lecteur_experimentation_fk | type: CONSTRAINT --
-- ALTER TABLE otolithe.lecteur_experimentation DROP CONSTRAINT IF EXISTS lecteur_lecteur_experimentation_fk CASCADE;
ALTER TABLE otolithe.lecteur_experimentation ADD CONSTRAINT lecteur_lecteur_experimentation_fk FOREIGN KEY (lecteur_id)
REFERENCES otolithe.lecteur (lecteur_id) MATCH SIMPLE
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --

-- object: fk_photo_lumieretype | type: CONSTRAINT --
-- ALTER TABLE otolithe.photo DROP CONSTRAINT IF EXISTS fk_photo_lumieretype CASCADE;
ALTER TABLE otolithe.photo ADD CONSTRAINT fk_photo_lumieretype FOREIGN KEY (lumieretype_id)
REFERENCES otolithe.lumieretype (lumieretype_id) MATCH SIMPLE
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --

-- object: fk_photo_piece | type: CONSTRAINT --
-- ALTER TABLE otolithe.photo DROP CONSTRAINT IF EXISTS fk_photo_piece CASCADE;
ALTER TABLE otolithe.photo ADD CONSTRAINT fk_photo_piece FOREIGN KEY (piece_id)
REFERENCES otolithe.piece (piece_id) MATCH SIMPLE
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --

-- object: final_stripe_photolecture_fk | type: CONSTRAINT --
-- ALTER TABLE otolithe.photolecture DROP CONSTRAINT IF EXISTS final_stripe_photolecture_fk CASCADE;
ALTER TABLE otolithe.photolecture ADD CONSTRAINT final_stripe_photolecture_fk FOREIGN KEY (final_stripe_id)
REFERENCES otolithe.final_stripe (final_stripe_id) MATCH SIMPLE
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --

-- object: fk_photolecture_lecteur | type: CONSTRAINT --
-- ALTER TABLE otolithe.photolecture DROP CONSTRAINT IF EXISTS fk_photolecture_lecteur CASCADE;
ALTER TABLE otolithe.photolecture ADD CONSTRAINT fk_photolecture_lecteur FOREIGN KEY (lecteur_id)
REFERENCES otolithe.lecteur (lecteur_id) MATCH SIMPLE
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --

-- object: fk_photolecture_photo | type: CONSTRAINT --
-- ALTER TABLE otolithe.photolecture DROP CONSTRAINT IF EXISTS fk_photolecture_photo CASCADE;
ALTER TABLE otolithe.photolecture ADD CONSTRAINT fk_photolecture_photo FOREIGN KEY (photo_id)
REFERENCES otolithe.photo (photo_id) MATCH SIMPLE
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --

-- object: individu_piece_fk | type: CONSTRAINT --
-- ALTER TABLE otolithe.piece DROP CONSTRAINT IF EXISTS individu_piece_fk CASCADE;
ALTER TABLE otolithe.piece ADD CONSTRAINT individu_piece_fk FOREIGN KEY (individu_id)
REFERENCES otolithe.individu (individu_id) MATCH SIMPLE
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --

-- object: fk_piece_piecetype | type: CONSTRAINT --
-- ALTER TABLE otolithe.piece DROP CONSTRAINT IF EXISTS fk_piece_piecetype CASCADE;
ALTER TABLE otolithe.piece ADD CONSTRAINT fk_piece_piecetype FOREIGN KEY (piecetype_id)
REFERENCES otolithe.piecetype (piecetype_id) MATCH SIMPLE
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --

-- object: fk_piece_traitement | type: CONSTRAINT --
-- ALTER TABLE otolithe.piece DROP CONSTRAINT IF EXISTS fk_piece_traitement CASCADE;
ALTER TABLE otolithe.piece ADD CONSTRAINT fk_piece_traitement FOREIGN KEY (traitementpiece_id)
REFERENCES otolithe.traitementpiece (traitementpiece_id) MATCH SIMPLE
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --

-- object: piece_fk | type: CONSTRAINT --
-- ALTER TABLE otolithe.piecemetadata DROP CONSTRAINT IF EXISTS piece_fk CASCADE;
ALTER TABLE otolithe.piecemetadata ADD CONSTRAINT piece_fk FOREIGN KEY (piece_id)
REFERENCES otolithe.piece (piece_id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --

-- object: metadatatype_fk | type: CONSTRAINT --
-- ALTER TABLE otolithe.piecemetadata DROP CONSTRAINT IF EXISTS metadatatype_fk CASCADE;
ALTER TABLE otolithe.piecemetadata ADD CONSTRAINT metadatatype_fk FOREIGN KEY (metadatatype_id)
REFERENCES otolithe.metadatatype (metadatatype_id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --

-- object: aclaco_aclacl_fk | type: CONSTRAINT --
-- ALTER TABLE gacl.aclacl DROP CONSTRAINT IF EXISTS aclaco_aclacl_fk CASCADE;
ALTER TABLE gacl.aclacl ADD CONSTRAINT aclaco_aclacl_fk FOREIGN KEY (aclaco_id)
REFERENCES gacl.aclaco (aclaco_id) MATCH SIMPLE
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --

-- object: aclgroup_aclacl_fk | type: CONSTRAINT --
-- ALTER TABLE gacl.aclacl DROP CONSTRAINT IF EXISTS aclgroup_aclacl_fk CASCADE;
ALTER TABLE gacl.aclacl ADD CONSTRAINT aclgroup_aclacl_fk FOREIGN KEY (aclgroup_id)
REFERENCES gacl.aclgroup (aclgroup_id) MATCH SIMPLE
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --

-- object: aclappli_aclaco_fk | type: CONSTRAINT --
-- ALTER TABLE gacl.aclaco DROP CONSTRAINT IF EXISTS aclappli_aclaco_fk CASCADE;
ALTER TABLE gacl.aclaco ADD CONSTRAINT aclappli_aclaco_fk FOREIGN KEY (aclappli_id)
REFERENCES gacl.aclappli (aclappli_id) MATCH SIMPLE
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --

-- object: aclgroup_aclgroup_fk | type: CONSTRAINT --
-- ALTER TABLE gacl.aclgroup DROP CONSTRAINT IF EXISTS aclgroup_aclgroup_fk CASCADE;
ALTER TABLE gacl.aclgroup ADD CONSTRAINT aclgroup_aclgroup_fk FOREIGN KEY (aclgroup_id_parent)
REFERENCES gacl.aclgroup (aclgroup_id) MATCH SIMPLE
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --

-- object: acllogin_acllogingroup_fk | type: CONSTRAINT --
-- ALTER TABLE gacl.acllogingroup DROP CONSTRAINT IF EXISTS acllogin_acllogingroup_fk CASCADE;
ALTER TABLE gacl.acllogingroup ADD CONSTRAINT acllogin_acllogingroup_fk FOREIGN KEY (acllogin_id)
REFERENCES gacl.acllogin (acllogin_id) MATCH SIMPLE
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --
