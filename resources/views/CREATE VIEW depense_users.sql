CREATE VIEW depense_users
(id, date_sortie, montant, numero, objet, created_at, updated_at, id_user, nom_prenoms)
AS SELECT  depenses.id, depenses.date_sortie, depenses.montant, depenses.numero, depenses.objet,
 depenses.created_at, depenses.updated_at, depenses.id_user, users.nom_prenoms

FROM depenses depenses,  users users
WHERE depenses.id_user = users.id