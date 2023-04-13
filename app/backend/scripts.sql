-- Cria o schema de banco de dados:
CREATE SCHEMA `sistema-fit` ;

-- Cria a tabela de usuário dentro do banco:
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT UNIQUE,
  `cnpj` varchar(50) NOT NULL UNIQUE,
  `email` varchar(50) NOT NULL UNIQUE,
  `senha` varchar(15) NOT NULL,
  `user` varchar(15),
  `gym_name` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
);

-- Seleciona todos os usuários
SELECT * FROM `sistema-fit`.users;

-- Seed usuário para testes no sistema:
INSERT INTO `sistema-fit`.`users` (`id`, `cnpj`, `email`, `senha`, `user`, `gym_name`) VALUES ('1', '08.246.344/0001-97', 'admin@maisfit.com.br', '123456', 'Carlos Santana', 'Academia + fit');
