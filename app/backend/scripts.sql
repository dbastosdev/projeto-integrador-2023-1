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

-- CRUD do Estudante
CREATE TABLE `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT UNIQUE,
  `name` varchar(50) NOT NULL UNIQUE,
  `email` varchar(50) NOT NULL UNIQUE,
  `start` date,
  `payment-status` varchar(15),
  `sport` varchar(15),
  PRIMARY KEY (`id`)
);

-- Seed usuário para testes no sistema:
INSERT INTO `sistema-fit`.`students` (`id`, `name`, `email`, `start`, `payment-status`, `sport`) 
VALUES ('1', 'Romário', 'romario@gmail.com', '2023-01-01', 'Pendente', 'Futebol');

INSERT INTO `sistema-fit`.`students` (`id`, `name`, `email`, `start`, `payment-status`, `sport`) 
VALUES ('2', 'LeBron', 'lebron@gmail.com', '2023-02-01', 'Pago', 'Basquete');

INSERT INTO `sistema-fit`.`students` (`id`, `name`, `email`, `start`, `payment-status`, `sport`) 
VALUES ('3', 'Mat Fraser', 'fraser@gmail.com', '2023-03-01', 'Atrasado', 'Crossfit');