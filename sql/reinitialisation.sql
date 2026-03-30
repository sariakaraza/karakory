-- =========================
-- 🔥 DROP TABLES (ordre important à cause des FK)
-- =========================

DROP TABLE IF EXISTS images_articles CASCADE;
DROP TABLE IF EXISTS articles CASCADE;
DROP TABLE IF EXISTS categories CASCADE;
DROP TABLE IF EXISTS users CASCADE;

-- =========================
-- 🧑 USERS
-- =========================

CREATE TABLE users(
   id_user SERIAL,
   username VARCHAR(50) NOT NULL,
   email VARCHAR(100) NOT NULL,
   mot_de_passe TEXT NOT NULL,
   role VARCHAR(20) DEFAULT 'admin',
   date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   PRIMARY KEY(id_user),
   UNIQUE(username),
   UNIQUE(email)
);

-- =========================
-- 📁 CATEGORIES
-- =========================

CREATE TABLE categories(
   id_categorie SERIAL,
   nom VARCHAR(100) NOT NULL,
   slug VARCHAR(150) NOT NULL,
   date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   PRIMARY KEY(id_categorie)
);

-- =========================
-- 📰 ARTICLES
-- =========================

CREATE TABLE articles(
   id_article SERIAL,
   titre VARCHAR(255) NOT NULL,
   slug VARCHAR(255) NOT NULL,
   contenu TEXT NOT NULL,
   date_publication TIMESTAMP,
   date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   date_modification TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   id_user INTEGER NOT NULL,
   id_categorie INTEGER NOT NULL,
   PRIMARY KEY(id_article),
   FOREIGN KEY(id_user) REFERENCES users(id_user) ON DELETE CASCADE,
   FOREIGN KEY(id_categorie) REFERENCES categories(id_categorie) ON DELETE CASCADE
);

-- =========================
-- 🖼️ IMAGES ARTICLES
-- =========================

CREATE TABLE images_articles(
   id_image SERIAL,
   url TEXT NOT NULL,
   date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   id_article INTEGER NOT NULL,
   PRIMARY KEY(id_image),
   FOREIGN KEY(id_article) REFERENCES articles(id_article) ON DELETE CASCADE
);