CREATE VIEW paiement_facture_clts (id, paiement, id_facture, date_paiement, date_reception, banque, date_virement, numero_virement, created_at, id_user, numero_facture, id_client, nom_prenoms, nom, id_cotation)
 AS SELECT paiements.id, paiements.paiement, paiements.id_facture, paiements.date_paiement, paiements.date_reception, 
 paiements.banque, paiements.date_virement, paiements.numero_virement, 
 paiements.created_at, paiements.id_user, factures.numero_facture, cotations.id_client, users.nom_prenoms, clients.nom,
 factures.id_cotation
 FROM paiements paiements, factures factures, cotations cotations, clients clients, users users 
 WHERE paiements.id_facture=factures.id AND factures.id_cotation = cotations.id AND factures.id_user = users.id AND cotations.id_client=clients.id;