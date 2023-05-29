/*DATABASE PER DATI DEGLI UTENTI E DEI POSTS*/
use hw1;

CREATE TABLE users
(
    id        integer primary key auto_increment,
    username  varchar(16)  not null unique,
    password  varchar(255) not null,
    email     varchar(255) not null unique,
    firstname varchar(16) not null,
    lastname  varchar(16) not null,
    since     timestamp    not null default current_timestamp
);

CREATE TABLE posts
(
    id     integer primary key auto_increment,
    author integer   not null,
    time   timestamp not null default current_timestamp,
    title  tinytext,
    cap    text,
    gif    tinytext,
    foreign key (author) references users (id) on delete cascade on update cascade
);
