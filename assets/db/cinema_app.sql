create database cinema_app;

use cinema_app;

# TABELA movies
create table movies (
	id int(10) auto_increment primary key,
    title varchar(128),
    rating varchar(6),
    duration int(4),
    visible bool default(false)
);

# TABELA users
create table users (
	id int(10) auto_increment primary key,
    name varchar(70) not null,
    email varchar(128) not null unique,
    utype varchar(3) not null default("USR"),
    password varchar(512) not null
);

insert into movies 
values (null, "Sorri 2", "M16", 210);

insert into users 
values (null, "Alyrx", "alyrx1@proton.me", "ADM", "15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225"); # Password = 123456789, Hash = sha256
