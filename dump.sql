create database db_mvc;

use db_mvc;

create table if not exists tb_user (
cd_user int not null autoincrement,
nm_user varchar(100) not null,
cd_email varchar(100) not null,
constraint pk_user 
    primary key(cd_user)
);

insert into tb_user (nm_user, cd_email) values 
('Jonas Kahnwald', 'jonasK@dark.com'),
('Michael Kahnwald', 'michaelKK@dark.com'),
('Martha Nielsen', 'marthaN@dark.com');

select * from tb_user;

truncate table tb_user;