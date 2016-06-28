create database if not exists shop27 charset=utf8;
-- 增加一个独立管理shop27库的mysql服务器用户
create user 'shop27'@'%' identified by '1234abcd';
grant all privileges on shop27.* to 'shop27'@'%';

use `shop27`;

-- 管理员表
create table if not exists `it_admin` (
admin_id int unsigned primary key auto_increment,
admin_name varchar(20) not null unique key,
admin_pass char(32),
login_time int,
login_ip int,
login_num tinyint,
email varchar(255)
) charset=utf8;

insert into `it_admin` values 
(23, 'admin', md5('1234abcd'), 1234567890, 1234567890, 0, 'admin@kang.com'),
(34, '王力', md5('1234abcd'), 1234567890, 1234567890, 0, 'liwang@kang.com');