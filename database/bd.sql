CREATE DATABASE Gestao_Brinquedos;

USE Gestao_Brinquedos;

CREATE TABLE brinquedos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    categoria VARCHAR(50) NOT NULL,
    faixa_etaria VARCHAR(50) NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    quantidade_estoque INT NOT NULL
);