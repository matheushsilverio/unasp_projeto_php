use projeto;
CREATE TABLE usuario (
  id int auto_increment primary key,
  nome varchar(100),
  senha varchar(100),
  usuario varchar(100) unique,
  email varchar(100)
);
CREATE TABLE produto (
  hash varchar(100) unique primary key,
  nome varchar(100),
  quantidade int,
  data datetime DEFAULT NOW()
);