ALTER USER 'root'@'%' IDENTIFIED WITH mysql_native_password BY 'password';
GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' WITH GRANT OPTION;
FLUSH PRIVILEGES;
CREATE DATABASE IF NOT EXISTS projektppz_testing;
GRANT ALL PRIVILEGES ON projektppz_testing.* TO 'sail'@'%';
FLUSH PRIVILEGES;