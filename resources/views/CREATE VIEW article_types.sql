CREATE VIEW article_types
(id, designation, code, description_article, id_typearticle, id_user, created_at, nom_prenoms, libele)
AS SELECT articles.id, articles.designation, articles.code, articles.description_article, articles.id_typearticle, articles.id_user, articles.created_at, users.nom_prenoms, typearticles.libele

FROM articles articles, users users, typearticles typearticles
WHERE articles.id_user=users.id AND articles.id_typearticle=typearticles.id