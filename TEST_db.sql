/*==============================================================*/
/* Nom de SGBD :  PostgreSQL 8                                  */
/* Date de création :  10/09/2024 13:31:26                      */
/*==============================================================*/


/*==============================================================*/
/* Table : administrateur                                       */
/*==============================================================*/
create table administrateur (
   iduser               int4                not null,
   idadmin              serial                 not null,
   constraint pk_administrateur primary key (iduser, idadmin)
);

/*==============================================================*/
/* Index : administrateur_pk                                    */
/*==============================================================*/
create unique index administrateur_pk on administrateur (
iduser,
idadmin
);

/*==============================================================*/
/* Index : generalisation_1_fk                                  */
/*==============================================================*/
create  index generalisation_1_fk on administrateur (
iduser
);

/*==============================================================*/
/* Table : client                                               */
/*==============================================================*/
create table client (
   iduser               int4                 not null,
   idclient             serial                 not null,
   idcolis              int4                 not null,
   constraint pk_client primary key (iduser, idclient)
);

/*==============================================================*/
/* Index : client_pk                                            */
/*==============================================================*/
create unique index client_pk on client (
iduser,
idclient
);

/*==============================================================*/
/* Index : envoyer_fk                                           */
/*==============================================================*/
create  index envoyer_fk on client (
idcolis
);

/*==============================================================*/
/* Index : generalisation_3_fk                                  */
/*==============================================================*/
create  index generalisation_3_fk on client (
iduser
);

/*==============================================================*/
/* Table : colis                                                */
/*==============================================================*/
create table colis (
   idcolis              serial                 not null,
   iduser               int4                 not null,
   idresponsable        int4                 not null,
   nature               varchar(254)         null,
   nomexpediteur        varchar(254)         null,
   nomdestinataire      varchar(254)         null,
   destianation         varchar(254)         null,
   constraint pk_colis primary key (idcolis)
);

/*==============================================================*/
/* Index : colis_pk                                             */
/*==============================================================*/
create unique index colis_pk on colis (
idcolis
);

/*==============================================================*/
/* Index : association3_fk                                      */
/*==============================================================*/
create  index association3_fk on colis (
iduser,
idresponsable
);

/*==============================================================*/
/* Table : destinataire                                         */
/*==============================================================*/
create table destinataire (
   iduser               int4                 not null,
   iddestinataire       serial                 not null,
   idcolis              int4                 not null,
   nomdestinataires     int4                 null,
   prenomdestinataires  int4                 null,
   telephonedestinataire int4                 null,
   constraint pk_destinataire primary key (iduser, iddestinataire)
);

/*==============================================================*/
/* Index : destinataire_pk                                      */
/*==============================================================*/
create unique index destinataire_pk on destinataire (
iduser,
iddestinataire
);

/*==============================================================*/
/* Index : recevoir_fk                                          */
/*==============================================================*/
create  index recevoir_fk on destinataire (
idcolis
);

/*==============================================================*/
/* Index : generalisation_4_fk                                  */
/*==============================================================*/
create  index generalisation_4_fk on destinataire (
iduser
);

/*==============================================================*/
/* Table : recu                                                 */
/*==============================================================*/
create table recu (
   idrecu               serial                 not null,
   iduser               int4                 null,
   idresponsable        int4                 null,
   nomexpediteur        varchar(254)         null,
   telephoneexpediteur  int4                 null,
   nomdest              varchar(254)         null,
   telephonedest        int4                 null,
   naturecolis          varchar(254)         null,
   destinationcolis     varchar(254)         null,
   numerosuivi          varchar(254)         null,
   constraint pk_recu primary key (idrecu)
);

/*==============================================================*/
/* Index : recu_pk                                              */
/*==============================================================*/
create unique index recu_pk on recu (
idrecu
);

/*==============================================================*/
/* Index : association2_fk                                      */
/*==============================================================*/
create  index association2_fk on recu (
iduser,
idresponsable
);

/*==============================================================*/
/* Table : responsable                                          */
/*==============================================================*/
create table responsable (
   iduser               int4                 not null,
   idresponsable        serial                not null,
   constraint pk_responsable primary key (iduser, idresponsable)
);

/*==============================================================*/
/* Index : responsable_pk                                       */
/*==============================================================*/
create unique index responsable_pk on responsable (
iduser,
idresponsable
);

/*==============================================================*/
/* Index : generalisation_2_fk                                  */
/*==============================================================*/
create  index generalisation_2_fk on responsable (
iduser
);

/*==============================================================*/
/* Table : utilisateur                                          */
/*==============================================================*/
create table utilisateur (
   iduser               serial                 not null,
   nom                  varchar(254)         null,
   prenom               varchar(254)         null,
   age                  int4                 null,
   sexe                 varchar(254)         null,
   constraint pk_utilisateur primary key (iduser)
);

/*==============================================================*/
/* Index : utilisateur_pk                                       */
/*==============================================================*/
create unique index utilisateur_pk on utilisateur (
iduser
);

alter table administrateur
   add constraint fk_administ_generalis_utilisat foreign key (iduser)
      references utilisateur (iduser)
      on delete restrict on update restrict;

alter table client
   add constraint fk_client_generalis_utilisat foreign key (iduser)
      references utilisateur (iduser)
      on delete restrict on update restrict;

alter table client
   add constraint fk_client_envoyer_colis foreign key (idcolis)
      references colis (idcolis)
      on delete restrict on update restrict;

alter table colis
   add constraint fk_colis_associati_responsa foreign key (iduser, idresponsable)
      references responsable (iduser, idresponsable)
      on delete restrict on update restrict;

alter table destinataire
   add constraint fk_destinat_generalis_utilisat foreign key (iduser)
      references utilisateur (iduser)
      on delete restrict on update restrict;

alter table destinataire
   add constraint fk_destinat_recevoir_colis foreign key (idcolis)
      references colis (idcolis)
      on delete restrict on update restrict;

alter table recu
   add constraint fk_recu_associati_responsa foreign key (iduser, idresponsable)
      references responsable (iduser, idresponsable)
      on delete restrict on update restrict;

alter table responsable
   add constraint fk_responsa_generalis_utilisat foreign key (iduser)
      references utilisateur (iduser)
      on delete restrict on update restrict;

