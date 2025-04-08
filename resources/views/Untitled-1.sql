CREATE VIEW fournisseur_users (id, nom, telephone, created_at, id_user, nom_prenoms)
 AS SELECT fournisseurs.id, fournisseurs.nom, fournisseurs.telephone, 
 fournisseurs.created_at, fournisseurs.id_user, users.nom_prenoms
 FROM fournisseurs fournisseurs, users users 
 WHERE fournisseurs.id_user = users.id ;