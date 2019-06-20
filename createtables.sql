create table t_users(
username VARCHAR(30),
fullname VARCHAR(30),
password VARCHAR(20),
email VARCHAR(254),
PRIMARY KEY (username));

create table t_news(
id integer AUTO_INCREMENT,
username VARCHAR(30) not null,
news VARCHAR(500),
ts timestamp default now(),
score integer default 0,
PRIMARY KEY (id));

create table t_pluses(
id integer AUTO_INCREMENT,
username VARCHAR(30),
newsid integer,
score integer default 1,
ts timestamp default now(),
PRIMARY KEY (id));
