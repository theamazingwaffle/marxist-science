BEGIN;


CREATE TABLE IF NOT EXISTS versions(
       version SERIAL8 PRIMARY KEY NOT NULL
);

CREATE TABLE IF NOT EXISTS users (
       id SERIAL8 PRIMARY KEY NOT NULL,
       name VARCHAR NOT NULL,
       pass_hash VARCHAR NOT NULL
);

CREATE TABLE IF NOT EXISTS sessions (
       id SERIAL8 PRIMARY KEY NOT NULL,
       user_id SERIAL8 REFERENCES users(id),
       content VARCHAR
);

CREATE TABLE IF NOT EXISTS articles (
       id SERIAL8 PRIMARY KEY NOT NULL,
       title VARCHAR,
       markdown_url VARCHAR,
       image_url VARCHAR
);

CREATE TABLE IF NOT EXISTS images (
       id SERIAL8 PRIMARY KEY NOT NULL,
       url VARCHAR
);

CREATE TABLE IF NOT EXISTS tags (
       id SERIAL8 PRIMARY KEY NOT NULL,
       article_id SERIAL8 REFERENCES articles(id),
       tag VARCHAR
);

COMMIT;
