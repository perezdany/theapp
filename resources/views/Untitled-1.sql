CREATE VIEW fournisseur_users (id, nom, telephone,
 adresse_geo, email, created_at, id_user, nom_prenoms)
 AS SELECT fournisseurs.id, fournisseurs.nom, fournisseurs.telephone, fournisseurs.adresse_geo, fournisseurs.email,
 fournisseurs.created_at, fournisseurs.id_user, users.nom_prenoms
 FROM fournisseurs fournisseurs, users users 
 WHERE fournisseurs.id_user = users.id ;