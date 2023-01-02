BEGIN;

CREATE TABLE IF NOT EXISTS versions(
       version SERIAL8 PRIMARY KEY NOT NULL
);

CREATE OR REPLACE PROCEDURE new_version(current INTEGER, commands TEXT) AS $$
BEGIN
  IF NOT EXISTS (SELECT version FROM versions WHERE version = current)
  THEN
    EXECUTE commands;
    INSERT INTO versions (version) VALUES (current);
  END IF;
END; $$ LANGUAGE plpgsql;

CALL new_version(1, $$
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
$$); -- version 1

CALL new_version(2, $$
  CREATE TABLE IF NOT EXISTS archive (
         id SERIAL8 PRIMARY KEY NOT NULL,
         title VARCHAR NOT NULL,
         author VARCHAR,
         pub_date DATE,
         img_url VARCHAR,
         url VARCHAR NOT NULL
  );
$$); -- version 2

COMMIT;
