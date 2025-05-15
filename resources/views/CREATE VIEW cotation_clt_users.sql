CREATE VIEW cotation_clt_users 
(id, date_creation, numero_devis, date_validite, id_client , id_service, valide, rejete, motif, created_at, id_user, nom, nom_prenoms, libele_service) 
AS SELECT cotations.id, cotations.date_creation, cotations.numero_devis, cotations.date_validite,
 cotations.id_client , cotations.id_service, cotations.valide, cotations.rejete, cotations.motif, cotations.created_at, cotations.id_user, clients.nom, users.nom_prenoms, services.libele_service
 FROM cotations cotations, clients clients, users users, services services
 WHERE cotations.id_user = users.id AND cotations.id_client=clients.id AND cotations.id_service=services.id;