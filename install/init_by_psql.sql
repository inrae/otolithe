CREATE ROLE otolithe WITH 
	INHERIT
	LOGIN
	ENCRYPTED PASSWORD 'b94866f346fc0b2478904d086f909c4e';

/*
 * Database creation
 */
create database otolithe owner otolithe;
\c "dbname=otolithe"
create extension postgis schema public;
-- object: pgcrypto | type: EXTENSION --
-- DROP EXTENSION IF EXISTS pgcrypto CASCADE;
CREATE EXTENSION pgcrypto
WITH SCHEMA public;
-- ddl-end --

/*
 * connexion a la base otolithe, avec l'utilisateur otolithe, en localhost,
 * depuis psql
 * Connection to collec database with user otolithe on localhost server
 */
\c "dbname=otolithe user=otolithe password=otolithePassword host=localhost"


/*
 * Creation des tables
 */
\ir pgsql/create.sql