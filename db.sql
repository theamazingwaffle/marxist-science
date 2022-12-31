CREATE TABLE users (
       id serial8 primary key not null,
       name varchar,
       pass_hash varchar
);

CREATE TABLE sessions (
       id serial8 primary key not null,
       user_id serial8 references users(id),
       content varchar
);

CREATE TABLE articles (
       id serial8 primary key not null,
       title varchar,
       markdown_url varchar,
       image_url varchar
);

CREATE TABLE images (
       id serial8 primary key not null,
       url varchar
);

CREATE TABLE tags (
       id serial8 primary key not null,
       article_id serial8 references articles(id),
       tag varchar
);
