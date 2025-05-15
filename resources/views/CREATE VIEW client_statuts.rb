CREATE VIEW client_statuts
(id, nom, adresse, id_statutclient, particulier, telephone, activite, actif,
 adresse_email, adresse_facturation, numero_contribuable, created_at,  id_user, libele_statut, nom_prenoms)
AS SELECT  clients.id, clients.nom, clients.adresse, clients.id_statutclient, clients.particulier, 
clients.telephone, clients.activite, clients.actif, clients.adresse_email, clients.adresse_facturation, 
clients.numero_contribuable, clients.created_at,  clients.id_user, statutclient.libele_statut,
 users.nom_prenoms

FROM clients clients, users users, statutclient statutclient
WHERE clients.id_statutclient=statutclient.id AND clients.id_user=users.id