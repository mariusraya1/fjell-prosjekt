create database mydb;

use mydb;

create table users (
    username varchar(40),
    password varchar(40)
);

--Hvis du bruker en annen MariaDB enn den som blir installert med XAMPP, må du kjøre denne i MariaDB
ALTER USER root@localhost IDENTIFIED VIA mysql_native_password;
SET PASSWORD = PASSWORD('foo'); --bytt ut 'foo' med ditt passord, f.eks. 'Admin'