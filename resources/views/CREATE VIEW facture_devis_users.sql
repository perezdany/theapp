CREATE VIEW facture_devis_users (id, numero_facture, numero_avoir, date_reglement, 
date_emission, montant_facture, reglee, annulee, id_cotation, created_at, updated_at, id_user, 
file_path, numero_devis, id_client, nom_prenoms, nom)
 AS SELECT factures.id, factures.numero_facture, factures.numero_avoir, 
 factures.date_reglement, factures.date_emission, factures.montant_facture, factures.reglee, 
 factures.annulee, factures.id_cotation, factures.created_at, factures.updated_at, factures.id_user, 
 factures.file_path, cotations.numero_devis, cotations.id_client, users.nom_prenoms, clients.nom 
 FROM factures factures, cotations cotations, clients clients, users users 
 WHERE factures.id_cotation = cotations.id AND factures.id_user = users.id AND cotations.id_client=clients.id;