CREATE VIEW user_departements
(id, login, password, nom_prenoms, departements_id, poste, active, login_token, count_login, created_by, created_at, libele_departement)
AS SELECT  users.id, users.login, users.password, users.nom_prenoms, users.departements_id, users.poste, users.active, users.login_token, users.count_login, users.created_by, users.created_at, departements.libele_departement

FROM users users, departements departements
WHERE users.departements_id = departements.id