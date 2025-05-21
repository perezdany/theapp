CREATE VIEW projet_users
(id, nom_projet, id_client, description, date_debut, date_fin, created_at, id_user, nom_prenoms, nom) 
AS SELECT projets.id, projets.nom_projet, projets.id_client,
projets.description, projets.date_debut, projets.date_fin, projets.created_at, projets.id_user, users.nom_prenoms,
clients.nom
 FROM projets projets, users users, clients clients
 WHERE projets.id_user = users.id AND projets.id_client = clients.id