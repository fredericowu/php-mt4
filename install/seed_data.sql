USE mt4_fred;

GRANT ALL PRIVILEGES ON mt4_fred.* TO `mt4`@`%` IDENTIFIED BY 'mt4pass';

insert into auth_user (auth_user_id, username, password, name) values (1, "demo", "demo", "demo");


insert into device_type (device_type_id, name, description) values (1, "Servidor", "Servidor");
insert into device_type (device_type_id, name, description) values (2, "Roteador", "Roteador");
insert into device_type (device_type_id, name, description) values (3, "Switch", "Switch");


insert into device (auth_user_id, device_type_id, hostname, ip, datetime_creation) values (1, 1, "localhost", "127.0.0.1", now());

