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

-- =====================================================
-- ARTICLES AVEC CONTENU HTML (TinyMCE)
-- =====================================================

INSERT INTO articles
(titre, slug, contenu, date_publication, date_creation, date_modification, id_user, id_categorie)
VALUES

-- Article 1 : Guerre en Iran
('Escalade militaire en Iran : les frappes aériennes s''intensifient',
'escalade-militaire-iran-frappes-aeriennes',
'<h2>Une situation critique au Moyen-Orient</h2>
<p>Depuis le début de l''année 2026, la situation en <strong>Iran</strong> s''est considérablement détériorée. Les frappes aériennes menées par une coalition internationale ont ciblé plusieurs installations stratégiques dans le pays.</p>
<blockquote>
<p>"Nous assistons à l''une des escalades les plus significatives de ces dernières décennies dans la région." - Analyste du Conseil de sécurité de l''ONU</p>
</blockquote>
<h3>Les zones touchées</h3>
<ul>
<li><strong>Téhéran</strong> - Banlieue industrielle</li>
<li><strong>Ispahan</strong> - Installations nucléaires</li>
<li><strong>Bandar Abbas</strong> - Port stratégique</li>
<li><strong>Tabriz</strong> - Bases militaires</li>
</ul>
<p>Les autorités iraniennes ont condamné ces attaques qu''elles qualifient d''<em>"actes de guerre injustifiés"</em>. La communauté internationale reste divisée sur la réponse à apporter.</p>
<h3>Bilan provisoire</h3>
<p>Selon les sources locales, les frappes auraient causé des dégâts importants aux infrastructures militaires. Le bilan humain reste incertain, les deux camps communiquant des chiffres contradictoires.</p>',
'2026-01-22 08:30:00', '2026-01-21 15:45:00', '2026-01-21 15:45:00', 1, 1),

-- Article 2 : Guerre en Iran
('L''Iran riposte : missiles balistiques lancés vers le Golfe',
'iran-riposte-missiles-balistiques-golfe',
'<h2>Une réponse militaire d''envergure</h2>
<p>En réponse aux frappes subies ces derniers jours, l''<strong>Iran</strong> a lancé une salve de <strong>missiles balistiques</strong> vers des bases militaires situées dans le Golfe Persique.</p>
<h3>Chronologie des événements</h3>
<ol>
<li><strong>03h00</strong> - Premiers tirs détectés depuis l''ouest de l''Iran</li>
<li><strong>03h15</strong> - Activation des systèmes de défense anti-missiles</li>
<li><strong>03h30</strong> - Impacts confirmés sur plusieurs sites</li>
<li><strong>04h00</strong> - Déclaration officielle de Téhéran</li>
</ol>
<p>Le <em>Corps des Gardiens de la Révolution islamique</em> a revendiqué cette opération baptisée <strong>"Tempête de la Vengeance"</strong>.</p>
<h3>Réactions internationales</h3>
<p>Les principales puissances mondiales ont appelé à la <strong>désescalade</strong>. Le Conseil de sécurité de l''ONU se réunira en session d''urgence dans les prochaines heures.</p>
<blockquote>
<p>"Cette escalade menace la stabilité de toute la région et pourrait avoir des conséquences catastrophiques pour l''économie mondiale." - Secrétaire général de l''ONU</p>
</blockquote>',
'2026-02-01 10:00:00', '2026-01-31 18:20:00', '2026-01-31 18:20:00', 1, 1),

-- Article 3 : Guerre en Iran
('Téhéran sous tension : la population civile prise au piège',
'teheran-tension-population-civile',
'<h2>Une capitale en état de siège</h2>
<p>La capitale iranienne vit des heures sombres alors que les <strong>sirènes d''alerte</strong> retentissent plusieurs fois par jour. La population tente de survivre dans un contexte de guerre de plus en plus oppressant.</p>
<h3>Le quotidien des habitants</h3>
<p>Les témoignages affluent des différents quartiers de Téhéran :</p>
<ul>
<li>Les <strong>abris anti-aériens</strong> sont bondés chaque nuit</li>
<li>Les <strong>pénuries alimentaires</strong> commencent à se faire sentir</li>
<li>Les <strong>hôpitaux</strong> manquent de médicaments essentiels</li>
<li>Les <strong>écoles</strong> restent fermées depuis deux semaines</li>
</ul>
<h3>L''aide humanitaire bloquée</h3>
<p>Les organisations humanitaires internationales peinent à acheminer l''aide nécessaire. Le <em>Croissant-Rouge iranien</em> lance un appel urgent à la communauté internationale.</p>
<table>
<thead>
<tr><th>Besoin</th><th>Situation actuelle</th><th>Urgence</th></tr>
</thead>
<tbody>
<tr><td>Médicaments</td><td>Stock critique</td><td>Très élevée</td></tr>
<tr><td>Nourriture</td><td>Rationnement</td><td>Élevée</td></tr>
<tr><td>Eau potable</td><td>Distribution limitée</td><td>Élevée</td></tr>
<tr><td>Électricité</td><td>Coupures fréquentes</td><td>Moyenne</td></tr>
</tbody>
</table>',
'2026-02-08 14:15:00', '2026-02-07 11:30:00', '2026-02-07 11:30:00', 2, 1),

-- Article 4 : Guerre en Iran
('Les négociations de paix échouent à Genève',
'negociations-paix-echouent-geneve-iran',
'<h2>Un espoir de courte durée</h2>
<p>Les pourparlers de paix organisés à <strong>Genève</strong> sous l''égide de l''ONU se sont soldés par un <strong>échec cuisant</strong>. Les deux parties n''ont pas réussi à trouver un terrain d''entente.</p>
<h3>Points de blocage</h3>
<p>Plusieurs sujets majeurs ont empêché tout accord :</p>
<ol>
<li><strong>Le programme nucléaire iranien</strong> - L''Iran refuse toute inspection internationale supplémentaire</li>
<li><strong>Les sanctions économiques</strong> - Téhéran exige leur levée immédiate et totale</li>
<li><strong>Le retrait des troupes</strong> - Désaccord sur le calendrier et les modalités</li>
<li><strong>Les réparations de guerre</strong> - Aucun consensus sur les responsabilités</li>
</ol>
<blockquote>
<p>"Nous ne signerons jamais un accord qui compromet notre souveraineté nationale." - Ministre des Affaires étrangères iranien</p>
</blockquote>
<h3>Et maintenant ?</h3>
<p>L''échec de ces négociations laisse craindre une <em>intensification du conflit</em>. Les médiateurs internationaux n''excluent pas de nouvelles tentatives dans les semaines à venir.</p>',
'2026-02-15 09:45:00', '2026-02-14 16:10:00', '2026-02-14 16:10:00', 1, 2),

-- Article 5 : Guerre en Iran
('Analyse : les enjeux stratégiques du conflit iranien',
'analyse-enjeux-strategiques-conflit-iranien',
'<h2>Comprendre les racines du conflit</h2>
<p>Le conflit actuel en Iran ne peut se comprendre sans analyser les <strong>enjeux géopolitiques</strong> complexes qui le sous-tendent. Cette analyse propose un décryptage des principales forces en présence.</p>
<h3>Les acteurs majeurs</h3>
<h4>L''Iran</h4>
<p>Puissance régionale avec des <strong>ambitions nucléaires</strong>, l''Iran cherche à affirmer son influence au Moyen-Orient. Le pays dispose de :</p>
<ul>
<li>Une armée de <strong>500 000 soldats</strong> actifs</li>
<li>Un arsenal de <strong>missiles balistiques</strong> sophistiqués</li>
<li>Des <strong>milices alliées</strong> dans plusieurs pays voisins</li>
</ul>
<h4>La coalition internationale</h4>
<p>Face à l''Iran, une coalition hétérogène s''est formée, réunissant des intérêts parfois divergents :</p>
<ul>
<li>Les <strong>États-Unis</strong> - Leadership militaire</li>
<li>Les <strong>pays du Golfe</strong> - Financement et bases logistiques</li>
<li>Certains <strong>pays européens</strong> - Soutien diplomatique</li>
</ul>
<h3>Les ressources en jeu</h3>
<p>Au-delà des considérations idéologiques, ce conflit met en lumière l''importance stratégique de la région :</p>
<table>
<thead>
<tr><th>Ressource</th><th>Importance</th><th>Contrôle actuel</th></tr>
</thead>
<tbody>
<tr><td>Pétrole</td><td>10% production mondiale</td><td>Partiellement perturbé</td></tr>
<tr><td>Détroit d''Ormuz</td><td>20% trafic pétrolier mondial</td><td>Contesté</td></tr>
<tr><td>Gaz naturel</td><td>Réserves majeures</td><td>Iran</td></tr>
</tbody>
</table>',
'2026-02-22 13:00:00', '2026-02-21 10:25:00', '2026-02-21 10:25:00', 2, 4),

-- Article 6 : Économie
('Le pétrole flambe : les marchés mondiaux en ébullition',
'petrole-flambe-marches-mondiaux-ebullition',
'<h2>Une crise énergétique sans précédent</h2>
<p>Le conflit en Iran a des répercussions majeures sur les <strong>marchés pétroliers mondiaux</strong>. Le prix du baril a atteint des sommets historiques, dépassant les <strong>150 dollars</strong>.</p>
<h3>Évolution des prix</h3>
<p>Depuis le début du conflit, les prix ont connu une hausse vertigineuse :</p>
<ul>
<li><strong>Janvier 2026</strong> : 85$/baril</li>
<li><strong>Février 2026</strong> : 110$/baril</li>
<li><strong>Mars 2026</strong> : 152$/baril</li>
</ul>
<h3>Impact sur l''économie mondiale</h3>
<p>Cette flambée des prix a des conséquences en cascade :</p>
<ol>
<li><strong>Transport</strong> - Hausse des coûts logistiques de 40%</li>
<li><strong>Industrie</strong> - Ralentissement de la production</li>
<li><strong>Consommation</strong> - Inflation généralisée</li>
<li><strong>Emploi</strong> - Premières vagues de licenciements</li>
</ol>
<blockquote>
<p>"Nous sommes face à un choc pétrolier comparable à celui de 1973. Les économies mondiales doivent se préparer à une période difficile." - Directrice du FMI</p>
</blockquote>
<h3>Les alternatives envisagées</h3>
<p>Face à cette crise, plusieurs pays accélèrent leur <em>transition énergétique</em> et cherchent des sources d''approvisionnement alternatives.</p>',
'2026-03-01 11:20:00', '2026-02-28 14:40:00', '2026-02-28 14:40:00', 1, 3),

-- Article 7 : Politique internationale
('L''Europe divisée face au conflit iranien',
'europe-divisee-conflit-iranien',
'<h2>Des positions inconciliables</h2>
<p>L''<strong>Union européenne</strong> peine à adopter une position commune face au conflit en Iran. Les divergences entre États membres fragilisent la diplomatie européenne.</p>
<h3>Les différentes positions</h3>
<h4>Le camp interventionniste</h4>
<p>Certains pays soutiennent une intervention militaire :</p>
<ul>
<li><strong>Royaume-Uni</strong> - Participation active aux frappes</li>
<li><strong>Pologne</strong> - Soutien logistique</li>
<li><strong>Pays baltes</strong> - Alignement sur l''OTAN</li>
</ul>
<h4>Le camp pacifiste</h4>
<p>D''autres privilégient la voie diplomatique :</p>
<ul>
<li><strong>France</strong> - Médiation active, refus d''intervention directe</li>
<li><strong>Allemagne</strong> - Appel au dialogue, aide humanitaire</li>
<li><strong>Espagne</strong> - Neutralité affichée</li>
</ul>
<h3>Les conséquences de cette division</h3>
<p>Cette <em>cacophonie européenne</em> affaiblit considérablement le poids de l''UE sur la scène internationale. Le Haut représentant pour les affaires étrangères a appelé à plus de cohésion.</p>
<blockquote>
<p>"L''Europe doit parler d''une seule voix si elle veut peser dans la résolution de ce conflit." - Président du Conseil européen</p>
</blockquote>',
'2026-03-08 15:30:00', '2026-03-07 09:50:00', '2026-03-07 09:50:00', 2, 2),

-- Article 8 : Économie
('Récession mondiale : les experts tirent la sonnette d''alarme',
'recession-mondiale-experts-alarme',
'<h2>Des prévisions économiques sombres</h2>
<p>Les principales institutions financières internationales ont revu leurs <strong>prévisions de croissance</strong> à la baisse. Le spectre d''une <strong>récession mondiale</strong> se précise.</p>
<h3>Les chiffres clés</h3>
<table>
<thead>
<tr><th>Région</th><th>Prévision initiale</th><th>Nouvelle prévision</th></tr>
</thead>
<tbody>
<tr><td>États-Unis</td><td>+2.5%</td><td>-0.8%</td></tr>
<tr><td>Zone Euro</td><td>+1.8%</td><td>-1.2%</td></tr>
<tr><td>Chine</td><td>+5.2%</td><td>+2.1%</td></tr>
<tr><td>Monde</td><td>+3.1%</td><td>+0.3%</td></tr>
</tbody>
</table>
<h3>Les secteurs les plus touchés</h3>
<ol>
<li><strong>Tourisme</strong> - Effondrement de 60% des réservations</li>
<li><strong>Automobile</strong> - Chute des ventes de 35%</li>
<li><strong>Aviation</strong> - Annulation massive de vols</li>
<li><strong>Commerce de détail</strong> - Baisse de la consommation</li>
</ol>
<h3>Les mesures envisagées</h3>
<p>Face à cette situation, les banques centrales préparent des <em>plans de relance massifs</em>. La BCE et la Fed ont déjà annoncé des baisses de taux d''intérêt.</p>',
'2026-03-15 10:10:00', '2026-03-14 17:15:00', '2026-03-14 17:15:00', 1, 3),

-- Article 9 : Analyse
('Histoire : les précédents conflits Iran-Occident',
'histoire-precedents-conflits-iran-occident',
'<h2>Un siècle de tensions</h2>
<p>Pour comprendre le conflit actuel, il est essentiel de revenir sur l''<strong>histoire tumultueuse</strong> des relations entre l''Iran et les puissances occidentales.</p>
<h3>Chronologie des crises majeures</h3>
<h4>1953 : Le coup d''État</h4>
<p>La CIA et le MI6 orchestrent le renversement du Premier ministre <strong>Mossadegh</strong>, qui avait nationalisé le pétrole iranien. Cet événement reste une blessure profonde dans la mémoire collective iranienne.</p>
<h4>1979 : La Révolution islamique</h4>
<p>Le Shah est renversé. L''<strong>Ayatollah Khomeini</strong> instaure la République islamique. La crise des otages de l''ambassade américaine marque une rupture durable.</p>
<h4>1980-1988 : Guerre Iran-Irak</h4>
<p>Un conflit dévastateur qui fait plus d''un <strong>million de morts</strong>. L''Occident soutient l''Irak de Saddam Hussein.</p>
<h4>2000s-2020s : La question nucléaire</h4>
<p>Négociations, accords et ruptures se succèdent autour du <strong>programme nucléaire iranien</strong>.</p>
<h3>Les leçons de l''histoire</h3>
<blockquote>
<p>"Ceux qui ne connaissent pas l''histoire sont condamnés à la répéter." - George Santayana</p>
</blockquote>
<p>Cette rétrospective nous rappelle que les solutions durables passent nécessairement par une <em>compréhension mutuelle</em> des griefs historiques.</p>',
'2026-03-22 12:45:00', '2026-03-21 13:20:00', '2026-03-21 13:20:00', 2, 4),

-- Article 10 : Conflit militaire
('Dernières nouvelles : cessez-le-feu temporaire annoncé',
'dernieres-nouvelles-cessez-le-feu-temporaire',
'<h2>Une lueur d''espoir ?</h2>
<p>Après des semaines d''intenses combats, un <strong>cessez-le-feu temporaire de 72 heures</strong> a été annoncé ce matin. Cette trêve humanitaire permettra l''acheminement de l''aide aux populations civiles.</p>
<h3>Les termes de l''accord</h3>
<ul>
<li><strong>Durée</strong> : 72 heures, renouvelable</li>
<li><strong>Zone</strong> : L''ensemble du territoire iranien</li>
<li><strong>Objectif</strong> : Permettre l''aide humanitaire</li>
<li><strong>Supervision</strong> : Observateurs de l''ONU</li>
</ul>
<h3>Réactions</h3>
<p>Les différentes parties ont exprimé des positions nuancées :</p>
<blockquote>
<p>"C''est un premier pas, mais la route vers une paix durable sera longue." - Envoyé spécial de l''ONU</p>
</blockquote>
<blockquote>
<p>"Nous acceptons cette trêve pour notre peuple, mais nous restons vigilants." - Porte-parole du gouvernement iranien</p>
</blockquote>
<h3>Les défis à venir</h3>
<ol>
<li><strong>Respecter</strong> le cessez-le-feu sur le terrain</li>
<li><strong>Acheminer</strong> l''aide humanitaire rapidement</li>
<li><strong>Reprendre</strong> les négociations de paix</li>
<li><strong>Construire</strong> une solution politique durable</li>
</ol>
<p>La communauté internationale retient son souffle, espérant que cette trêve puisse ouvrir la voie à une <em>résolution pacifique</em> du conflit.</p>',
'2026-03-30 08:00:00', '2026-03-29 16:30:00', '2026-03-29 16:30:00', 1, 1);

-- =====================================================
-- IMAGES DES ARTICLES
-- =====================================================

INSERT INTO images_articles (url, alt, id_article) VALUES
-- Article 1 : Escalade militaire (3 images)
('assets/images/articles/frappes-aeriennes-iran-1.jpg', 'Frappes aériennes sur une installation militaire iranienne', 1),
('assets/images/articles/frappes-aeriennes-iran-2.jpg', 'Fumée s''élevant après une frappe sur Téhéran', 1),
('assets/images/articles/carte-zones-touchees.jpg', 'Carte des zones touchées par les frappes en Iran', 1),

-- Article 2 : Riposte missiles
('assets/images/articles/missiles-balistiques-iran.jpg', 'Lancement de missiles balistiques iraniens', 2),

-- Article 3 : Téhéran sous tension
('assets/images/articles/teheran-civils-abri.jpg', 'Civils iraniens dans un abri anti-aérien à Téhéran', 3),
('assets/images/articles/aide-humanitaire-iran.jpg', 'Distribution d''aide humanitaire en Iran', 3),

-- Article 4 : Négociations Genève
('assets/images/articles/negociations-geneve.jpg', 'Salle de négociations au Palais des Nations à Genève', 4),

-- Article 5 : Analyse stratégique
('assets/images/articles/carte-moyen-orient.jpg', 'Carte stratégique du Moyen-Orient montrant les forces en présence', 5),

-- Article 6 : Pétrole
('assets/images/articles/prix-petrole-graphique.jpg', 'Graphique de l''évolution des prix du pétrole en 2026', 6),
('assets/images/articles/raffinerie-petrole.jpg', 'Raffinerie de pétrole au coucher du soleil', 6),

-- Article 7 : Europe divisée
('assets/images/articles/sommet-europeen.jpg', 'Dirigeants européens lors d''un sommet extraordinaire à Bruxelles', 7),

-- Article 8 : Récession mondiale
('assets/images/articles/bourse-chute.jpg', 'Écrans de la bourse affichant des indices en baisse', 8),

-- Article 9 : Histoire
('assets/images/articles/histoire-iran-1953.jpg', 'Photo historique de Mohammad Mossadegh en 1953', 9),

-- Article 10 : Cessez-le-feu
('assets/images/articles/cessez-le-feu-onu.jpg', 'Représentants de l''ONU annonçant le cessez-le-feu', 10);
