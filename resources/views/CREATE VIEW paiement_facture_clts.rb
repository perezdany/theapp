CREATE VIEW paiement_facture_clts (id, id_paiement, date_paiement, numero, commentaire, paiement, id_facture, id_mode_reglement,
         created_at, id_user, numero_facture, id_client, nom_prenoms, nom, id_cotation)
 AS SELECT details_paiements.id, details_paiements.id_paiement, details_paiements.date_paiement,
 details_paiements.numero, details_paiements.commentaire, paiements.paiement, paiements.id_facture, paiements.id_mode_reglement,
 paiements.created_at, paiements.id_user, factures.numero_facture, cotations.id_client, users.nom_prenoms, clients.nom,
 factures.id_cotation
 FROM paiements paiements, factures factures, cotations cotations, clients clients, users users, details_paiements details_paiements
 WHERE details_paiements.id_paiement = paiements.id AND paiements.id_facture=factures.id AND factures.id_cotation = cotations.id AND factures.id_user = users.id AND cotations.id_client=clients.id;