-- Criação do banco de dados
CREATE DATABASE loja;

-- Uso do banco de dados
USE loja;

-- Criação da tabela de cadastro
CREATE TABLE cadastro (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

SELECT * FROM  cadastro;

INSERT INTO cadastro(usuario,email,senha) VALUES ('Adm','adm@adm.com','0987') ;

-- Criação da tabela de produtos
CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    preco DECIMAL(10, 2) NOT NULL,
    desconto DECIMAL(10, 2),
    quantidade INT (10) NOT NULL,
    imagem VARCHAR(255)
);



CREATE TABLE carrinho (
    id INT (10) PRIMARY KEY,
    quantidadeProduto INT (10) NOT NULL 
);

SELECT * FROM produtos;

INSERT INTO carrinho (id,quantidadeProduto) VALUES (9,10);
DROP TABLE carrinho;