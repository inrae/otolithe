set search_path = otolithe;
CREATE TABLE remarkable_type (
	remarkable_type_id serial NOT NULL,
	remarkable_type_name varchar NOT NULL,
	sort_order smallint default 1,
	CONSTRAINT remarkable_type_pk PRIMARY KEY (remarkable_type_id)
);
-- ddl-end --
COMMENT ON TABLE remarkable_type IS E'Types of remarkable points';
-- ddl-end --
ALTER TABLE remarkable_type OWNER TO otolithe;
-- ddl-end --
INSERT INTO remarkable_type ( remarkable_type_name, sort_order) VALUES ( E'Point remarquable', E'1');
-- ddl-end --
INSERT INTO remarkable_type ( remarkable_type_name, sort_order) VALUES ( E'Reproduction', E'2');
-- ddl-end --
INSERT INTO remarkable_type ( remarkable_type_name, sort_order) VALUES (E'Rivière', E'3');
-- ddl-end --
INSERT INTO remarkable_type ( remarkable_type_name, sort_order) VALUES ( E'Mer', E'4');
-- ddl-end --
alter table photolecture add column version smallint NOT NULL DEFAULT 2013;

insert into dbversion (dbversion_date,dbversion_number) values ('2025-03-28','25.0');
