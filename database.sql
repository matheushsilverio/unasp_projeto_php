CREATE DATABASE usuario;|

CREATE TABLE usuario (
  ID INT NOT NULL AUTO_INCREMENT,
  usuario VARCHAR(200) NOT NULL,
  senha VARCHAR(32) NOT NULL,
  nome VARCHAR(32) NOT NULL,
  email VARCHAR(32) NOT NULL,
  PRIMARY KEY (ID));
  

INSERT INTO sistemas.usuario
(ID, usuario, senha, nome, email)
VALUES(1, 'gregory', '12345', 'Gregory Oliveira', 'gregory.oliveira@unasp.edu.br');


USE sistemas;
SELECT * FROM usuario WHERE usuario = 'gregory' AND senha = '12345';

SELECT ID, usuario, senha, nome, email
FROM sistemas.usuario;


