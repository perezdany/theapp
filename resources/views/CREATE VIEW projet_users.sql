CREATE VIEW projet_users
(id, nom_projet, created_at, id_user, nom_prenoms) 
AS SELECT projets.id, projets.nom_projet, projets.created_at, projets.id_user, users.nom_prenoms
 FROM projets projets, users users
 WHERE projets.id_user = users.id