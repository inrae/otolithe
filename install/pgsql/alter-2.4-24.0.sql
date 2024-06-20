alter table gacl.logingestion add column nbattempts int2;
alter table gacl.logingestion add column lastattempt timestamp;
alter table gacl.acllogin add column totp_key varchar;
alter table gacl.acllogin add column email varchar;
update gacl.aclaco set aco = 'read' where aco = 'lecture';
update gacl.aclaco set aco = 'manage' where aco = 'gestion';
update gacl.aclaco set aco = 'param' where aco = 'gestionCompte';
update gacl.aclgroup set groupe = 'manage' where groupe = 'gestion';
update gacl.aclgroup set groupe = 'param' where groupe = 'gestionCompte';

create sequence otolithe.dbparam_id_seq;
alter table otolithe.dbparam alter column dbparam_id set default nextval('otolithe.dbparam_id_seq');
alter sequence otolithe.dbparam_id_seq owned by otolithe.dbparam.dbparam_id ;
select setval('otolithe.dbparam_id_seq', (select max(dbparam_id) from otolithe.dbparam));
INSERT INTO otolithe.dbparam (dbparam_name,dbparam_value,dbparam_description,dbparam_description_en) VALUES
	 ('APPLI_code','OTOLITHE','Code de l''application','Code of the application'),
	 ('APPLI_title','Otolithe','Titre de l''application, affiché à côté de l''icône',''),
	 ('otp_issuer','otolithe.local','Nom affiché dans les applications de génération de codes uniques pour l''identification à double facteur','Name displayed in applications generating unique codes for two-factor identification');

insert into otolithe.dbversion(dbversion_number, dbversion_date) values ('24.0','2024-06-19');