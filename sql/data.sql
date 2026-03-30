-- Insertion de 5 utilisateurs pour la table `users`
-- Mot de passe stocké en clair ici pour faciliter les tests (adapter en production)
INSERT INTO users (username, email, mot_de_passe, role) VALUES
('rakoto', 'rakoto@gmail.com', 'rakotoAdmin', 'admin'),
('rasoa', 'rasoa@gmail.com', 'rasoaAdmin', 'admin'),
('rabe', 'rabe@gmail.com', 'rabe123', 'user'),
('razaka', 'razaka@gmail.com', 'razaka456', 'user'),
('ratavy', 'ratavy@gmail.com', 'ratavy789', 'user');

INSERT INTO categories (nom, slug, date_creation) VALUES
('Conflit militaire', 'conflit-militaire', '2026-01-05 10:30:00'),
('Politique internationale', 'politique-internationale', '2026-01-10 14:20:00'),
('Economie', 'economie', '2026-01-15 09:15:00'),
('Analyse & Contexte', 'analyse-contexte', '2026-01-20 16:45:00');

INSERT INTO articles 
(titre, slug, contenu, date_publication, date_creation, date_modification, id_user, id_categorie) 
VALUES

('Montée des tensions au Moyen-Orient en début d''année',
'montee-tensions-moyen-orient',
'Depuis janvier, les tensions entre l''Iran et plusieurs puissances internationales se sont intensifiées...',
'2026-01-22 08:30:00', '2026-01-21 15:45:00', '2026-01-21 15:45:00', 1, 2),

('Premières frappes militaires signalées',
'premieres-frappes-militaires',
'Des frappes ont été signalées dans plusieurs zones stratégiques, marquant une escalade du conflit...',
'2026-02-01 10:00:00', '2026-01-31 18:20:00', '2026-01-31 18:20:00', 1, 1),

('Réactions internationales face au conflit',
'reactions-internationales-conflit',
'Plusieurs pays ont exprimé leurs préoccupations face à l''évolution rapide de la situation...',
'2026-02-08 14:15:00', '2026-02-07 11:30:00', '2026-02-07 11:30:00', 1, 2),

('Impact sur le marché du pétrole',
'impact-marche-petrole',
'Les tensions dans la région ont entraîné une hausse significative des prix du pétrole...',
'2026-02-15 09:45:00', '2026-02-14 16:10:00', '2026-02-14 16:10:00', 1, 3),

('Analyse des forces militaires en présence',
'analyse-forces-militaires',
'Les capacités militaires des différents acteurs du conflit sont au cœur des préoccupations...',
'2026-02-22 13:00:00', '2026-02-21 10:25:00', '2026-02-21 10:25:00', 1, 4),

('Escalade des attaques et cybersécurité',
'escalade-attaques-cybersecurite',
'En plus des affrontements physiques, des cyberattaques ont été rapportées...',
'2026-03-01 11:20:00', '2026-02-28 14:40:00', '2026-02-28 14:40:00', 1, 1),

('Rôle des organisations internationales',
'role-organisations-internationales',
'Les organisations internationales tentent de jouer un rôle de médiation...',
'2026-03-08 15:30:00', '2026-03-07 09:50:00', '2026-03-07 09:50:00', 1, 2),

('Conséquences économiques mondiales',
'consequences-economiques-mondiales',
'Le conflit a des répercussions importantes sur l''économie mondiale...',
'2026-03-15 10:10:00', '2026-03-14 17:15:00', '2026-03-14 17:15:00', 1, 3),

('Comprendre les origines du conflit',
'origines-du-conflit-iran',
'Les tensions actuelles trouvent leurs racines dans des conflits historiques et politiques...',
'2026-03-22 12:45:00', '2026-03-21 13:20:00', '2026-03-21 13:20:00', 1, 4),

('Situation actuelle et perspectives',
'situation-actuelle-perspectives',
'La situation reste instable avec des risques d''escalade dans les semaines à venir...',
'2026-03-30 08:00:00', '2026-03-29 16:30:00', '2026-03-29 16:30:00', 1, 1);


INSERT INTO articles 
(titre, slug, contenu, date_publication, date_creation, date_modification, id_user, id_categorie) 
VALUES

('Hausse des prix du pétrole liée au conflit en Iran',
'hausse-prix-petrole-conflit-iran',
'Le conflit en Iran continue de perturber fortement les marchés énergétiques mondiaux. La fermeture partielle du détroit d''Ormuz et les tensions militaires ont provoqué une forte hausse des prix du pétrole. Cette situation impacte directement plusieurs économies dépendantes des importations énergétiques et pourrait entraîner une inflation globale durable.',
'2026-03-30 09:30:00', '2026-03-30 09:30:00', '2026-03-30 09:30:00', 1, 3),

('Nouvelles tensions militaires et rejet des propositions de paix',
'tensions-militaires-rejet-paix-iran',
'La situation reste critique au Moyen-Orient avec une intensification des frappes et des attaques de missiles. L''Iran a récemment rejeté plusieurs propositions de paix jugées inacceptables, tandis que les tensions avec les États-Unis et leurs alliés continuent de croître. Les risques d''escalade régionale restent élevés, malgré des tentatives de médiation internationale.',
'2026-03-30 11:45:00', '2026-03-30 11:45:00', '2026-03-30 11:45:00', 1, 1);