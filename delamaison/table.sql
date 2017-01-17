#### ACTION #### 

-- DROP SEQUENCE fte_action_seq;

CREATE SEQUENCE fte_action_seq
  INCREMENT 1
  MINVALUE 1
  MAXVALUE 9223372036854775807
  START 1
  CACHE 1;
ALTER TABLE fte_action_seq
  OWNER TO postgres;
GRANT ALL ON TABLE fte_action_seq TO postgres;


-- DROP TABLE fte_action;

CREATE TABLE fte_action
(
  fte_action_id integer NOT NULL DEFAULT nextval(('public.fte_action_seq'::text)::regclass),
  libelle character varying,
  process_id integer NOT NULL,
  process_redirect_id integer NOT NULL,
  action_js text,
  traitement_id integer,
  id_html character varying,
  flag integer DEFAULT 1,
  CONSTRAINT pk_fte_action PRIMARY KEY (fte_action_id )
)
WITH (
  OIDS=TRUE
);
ALTER TABLE fte_action
  OWNER TO postgres;
  
#### CATEGORIE ####

-- DROP SEQUENCE fte_categories_seq;

CREATE SEQUENCE fte_categories_seq
  INCREMENT 1
  MINVALUE 1
  MAXVALUE 9223372036854775807
  START 1
  CACHE 1;
ALTER TABLE fte_categories_seq
  OWNER TO postgres;
GRANT ALL ON TABLE fte_categories_seq TO postgres;

-- DROP TABLE fte_categories;

CREATE TABLE fte_categories
(
  fte_categories_id integer NOT NULL DEFAULT nextval(('public.fte_categories_seq'::text)::regclass),
  libelle_categories character varying,
  niveau integer,
  parent_id integer,
  traitement_id integer DEFAULT 0,
  contenu_categorie text,
  categories_id integer,
  root_id integer,
  flag integer DEFAULT 1,
  CONSTRAINT pk_fte_categories PRIMARY KEY (fte_categories_id )
)
WITH (
  OIDS=TRUE
);
ALTER TABLE fte_categories
  OWNER TO postgres;
  
#### HISTORIQUE ####

-- DROP SEQUENCE fte_historique_seq;

CREATE SEQUENCE fte_historique_seq
  INCREMENT 1
  MINVALUE 1
  MAXVALUE 9223372036854775807
  START 1
  CACHE 1;
ALTER TABLE fte_historique_seq
  OWNER TO postgres;
GRANT ALL ON TABLE fte_historique_seq TO postgres;

-- DROP TABLE fte_historique;

CREATE TABLE fte_historique
(
  fte_historique_id integer NOT NULL DEFAULT nextval(('public.fte_historique_seq'::text)::regclass),
  process_id integer NOT NULL,
  session_id character varying,
  heure timestamp without time zone NOT NULL DEFAULT (now())::timestamp without time zone,
  flag integer DEFAULT (-1),
  matricule integer,
  CONSTRAINT pk_fte_historique PRIMARY KEY (fte_historique_id )
)
WITH (
  OIDS=TRUE
);
ALTER TABLE fte_historique
  OWNER TO postgres;
  
  
#### PROCESS ####

-- DROP SEQUENCE fte_process_seq;  

CREATE SEQUENCE fte_process_seq
  INCREMENT 1
  MINVALUE 1
  MAXVALUE 9223372036854775807
  START 1
  CACHE 1;
ALTER TABLE fte_process_seq
  OWNER TO postgres;
GRANT ALL ON TABLE fte_process_seq TO postgres;

-- DROP TABLE fte_process;

CREATE TABLE fte_process
(
  fte_process_id integer NOT NULL DEFAULT nextval(('public.fte_process_seq'::text)::regclass),
  parent_id integer NOT NULL,
  campagne_id integer NOT NULL,
  image_id integer DEFAULT 0,
  commentaire_id integer DEFAULT 0,
  text_html text,
  ordre integer,
  alias character varying,
  libelle character varying(254),
  flag integer DEFAULT 1,
  CONSTRAINT pk_fte_process PRIMARY KEY (fte_process_id )
)
WITH (
  OIDS=TRUE
);
ALTER TABLE fte_process
  OWNER TO postgres;
GRANT ALL ON TABLE fte_process TO postgres;
GRANT ALL ON TABLE fte_process TO public;


#### TRAITEMENT ####

-- DROP SEQUENCE fte_traitement_seq; 

CREATE SEQUENCE fte_traitement_seq
  INCREMENT 1
  MINVALUE 1
  MAXVALUE 9223372036854775807
  START 1
  CACHE 1;
ALTER TABLE fte_traitement_seq
  OWNER TO postgres;
GRANT ALL ON TABLE fte_traitement_seq TO postgres;

-- DROP TABLE fte_traitement;

CREATE TABLE fte_traitement
(
  fte_traitement_id integer NOT NULL DEFAULT nextval(('public.fte_traitement_seq'::text)::regclass),
  info_traitement character varying,
  source_info character varying,
  flag integer DEFAULT 1,
  flag_processus integer DEFAULT 0,
  flag_action integer DEFAULT 0,
  CONSTRAINT pk_fte_traitement PRIMARY KEY (fte_traitement_id )
)
WITH (
  OIDS=TRUE
);
ALTER TABLE fte_traitement
  OWNER TO postgres;
  
  
#### TRAITEMENT FONCTION ####

-- DROP SEQUENCE fte_traitement_fonction_seq; 

CREATE SEQUENCE fte_traitement_fonction_seq
  INCREMENT 1
  MINVALUE 1
  MAXVALUE 9223372036854775807
  START 1
  CACHE 1;
ALTER TABLE fte_traitement_fonction_seq
  OWNER TO postgres;
GRANT ALL ON TABLE fte_traitement_fonction_seq TO postgres;


-- DROP TABLE fte_traitement_fonction;

CREATE TABLE fte_traitement_fonction
(
  fte_traitement_fonction_id integer NOT NULL DEFAULT nextval(('public.fte_traitement_fonction_seq'::text)::regclass),
  text_js text,
  traitement_id integer,
  CONSTRAINT pk_fte_traitement_fonction PRIMARY KEY (fte_traitement_fonction_id )
)
WITH (
  OIDS=TRUE
);
ALTER TABLE fte_traitement_fonction
  OWNER TO postgres;
GRANT ALL ON TABLE fte_traitement_fonction TO postgres;

### USER ####

-- DROP SEQUENCE fte_user_seq; 

CREATE SEQUENCE fte_user_seq
  INCREMENT 1
  MINVALUE 1
  MAXVALUE 9223372036854775807
  START 1
  CACHE 1;
ALTER TABLE fte_user_seq
  OWNER TO postgres;
GRANT ALL ON TABLE fte_user_seq TO postgres;

-- DROP TABLE fte_user;

CREATE TABLE fte_user
(
  fte_user_id integer NOT NULL DEFAULT nextval(('public.fte_user_seq'::text)::regclass),
  matricule integer NOT NULL,
  pass character varying(255),
  level character varying(10),
  prenom character varying,
  mail character varying,
  statut integer DEFAULT 1,
  access_1 integer DEFAULT 0,
  flag integer DEFAULT 1,
  gestion_process integer DEFAULT 0,
  gestion_user integer DEFAULT 0,
  CONSTRAINT fte_user_id_pkey PRIMARY KEY (fte_user_id )
)
WITH (
  OIDS=FALSE
);
ALTER TABLE fte_user
  OWNER TO postgres;
  
  
#### VUE POUR HISTORIQUE ####

-- DROP VIEW vw_historique;

CREATE OR REPLACE VIEW vw_historique AS 
 WITH fte_historique2 AS (
         SELECT fh.process_id,
            fh.heure,
            fh.session_id,
            fh.flag,
            fh.matricule,
            fp.libelle,
            fp.campagne_id
           FROM fte_historique fh
             LEFT JOIN fte_process fp ON fh.process_id = fp.fte_process_id ORDER BY fh.heure ASC
        )
 SELECT max(fte_historique2.campagne_id) AS campagne_id,
    fte_historique2.session_id,
    fte_historique2.matricule,
    string_agg(((fte_historique2.libelle::text || ' '::text) ||
        CASE
            WHEN fte_historique2.flag = 0 THEN '<span class="label label-default"> annulé </span>'::text
            WHEN fte_historique2.flag = 1 THEN '<span class="label label-success"> ok </span>'::text
            WHEN fte_historique2.flag = 2 THEN '<span class="label label-success"> sortie normal </span>'::text
            WHEN fte_historique2.flag = (-2) THEN '<span class="label label-danger"> sortie interrompue </span>'::text
            ELSE NULL::text
        END) || ' '::text, '<i class="fa fa-hand-o-right" aria-hidden="true"></i> '::text) AS etapes,
    to_char(min(fte_historique2.heure), 'DD/MM/YYYY à HH24:MI:SS'::text) AS debut,
    to_char(max(fte_historique2.heure), 'DD/MM/YYYY à HH24:MI:SS'::text) AS fin
   FROM fte_historique2
  GROUP BY fte_historique2.session_id, fte_historique2.matricule
  ORDER BY debut DESC ;

ALTER TABLE vw_historique
  OWNER TO postgres;