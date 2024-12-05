create database cinema_app;

use cinema_app;

create table movies (
	id int(10) auto_increment primary key,
    title varchar(128),
    rating varchar(6),
    duration int(4)
);

insert into movies values (null, "Sorri 2", "M16", 210);
