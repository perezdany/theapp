CREATE VIEW depense_users
(id, date_sortie, montant, nom_beneficiaire, numero_cheque, banque, date_virement, numero_virement, objet, created_at, id_user, nom_prenoms)
AS SELECT  depenses.id, depenses.date_sortie, depenses.montant, depenses.nom_beneficiaire, depenses.numero_cheque, depenses.banque, depenses.date_virement, depenses.numero_virement, depenses.objet, depenses.created_at, depenses.id_user, users.nom_prenoms

FROM depenses depenses,  users users
WHERE depenses.id_user = users.id