create database cinema_app;

use cinema_app;

# TABELA movies
create table movies (
	id int(10) auto_increment primary key,
    title varchar(128) not null,
    synposis text not null,
    rating varchar(6) not null,
    duration int(4) not null,
    image_name varchar(256) not null,
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

# TABELA tickets
create table tickets (
	id int(10) auto_increment primary key,
    movie_id int(10) not null,
    user_id int(10) not null,
    seat varchar(4) not null,
    foreign key (movie_id) references movies(id),
    foreign key (user_id) references users(id)
);

insert into movies 
values (null, "Sorri 2", "M16", 210, "6761bc0156c9c_sorri2.webp", 1);

insert into users 
values (null, "admin", "admin@cinema.app", "ADM", "15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225"); # Password = 123456789, Hash = sha256
