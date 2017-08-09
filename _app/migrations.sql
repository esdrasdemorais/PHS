/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  victorcaetano
 * Created: 22/06/2017
 */

CREATE DATABASE phs;

USE phs;

CREATE TABLE endereco (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    logradouro VARCHAR(250) NOT NULL,
    bairro VARCHAR(100) NOT NULL,
    cidade VARCHAR(100) NOT NULL,
    estado CHAR(2) NOT NULL,
    cep CHAR(8),
    numero VARCHAR(10) NOT NULL,
    geoLocalizacao VARCHAR(77) NOT NULL
);

CREATE UNIQUE INDEX un_ix_endereco ON endereco (cep, numero, geoLocalizacao); 

CREATE TABLE cliente (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(170) NOT NULL,
    email VARCHAR(170) NOT NULL,
    endereco_id INT NOT NULL,
    telefone VARCHAR(20) NOT NULL
);

CREATE UNIQUE INDEX un_ix_cliente ON cliente (email);

CREATE TABLE complemento (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    complemento VARCHAR(177) NOT NULL UNIQUE
);

CREATE TABLE cliente_complemento (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT UNSIGNED NOT NULL,
    endereco_id INT UNSIGNED NOT NULL,
    complemento_id INT UNSIGNED NOT NULL
);

CREATE TABLE servico_complemento (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    servico_id INT UNSIGNED NOT NULL,
    endereco_id INT UNSIGNED NOT NULL,
    complemento_id INT UNSIGNED NOT NULL
);

CREATE TABLE servico_endereco (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    servico_id INT UNSIGNED NOT NULL,
    endereco_id INT UNSIGNED NOT NULL,
    complemento_id INT UNSIGNED NOT NULL,
    descricao VARCHAR(177) NOT NULL
);

CREATE TABLE cliente_endereco (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    servico_id INT UNSIGNED NOT NULL,
    endereco_id INT UNSIGNED NOT NULL,
    complemento_id INT UNSIGNED NOT NULL,
    descricao VARCHAR(177) NOT NULL
);

CREATE TABLE login (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT UNSIGNED,
    login VARCHAR(37) NOT NULL UNIQUE,
    senha VARCHAR(40) NOT NULL,
    ativo CHAR(1) NOT NULL DEFAULT 1,
    data_ultimo_acesso DATETIME NOT NULL DEFAULT now(),
    logado CHAR(1) NOT NULL DEFAULT 1,
    cookie_hash VARCHAR(128),
    tipo CHAR(1) NOT NULL DEFAULT 1
);

CREATE UNIQUE INDEX un_ix_login ON login (login);

CREATE TABLE descricao (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(177) NOT NULL,
    status CHAR(1) NOT NULL DEFAULT 1
);

CREATE UNIQUE INDEX un_ix_descricao ON descricao (nome);

CREATE TABLE servico_descricao (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    servico_id INT UNSIGNED NOT NULL,
    descricao_id INT UNSIGNED NOT NULL
);

CREATE UNIQUE INDEX un_ix_servico_descricao ON servico_descricao (servico_id,
    descricao_id);

CREATE TABLE servico (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(177) NOT NULL,
    status CHAR(1) NOT NULL DEFAULT '1',
    icon VARCHAR(47) NOT NULL,
    valorHora FLOAT NOT NULL
);

CREATE TABLE servico_agendamento (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    tipo CHAR(1) NOT NULL DEFAULT 3,
    data DATE NOT NULL,
    hora TIME NOT NULL,
    periodo VARCHAR(70) NOT NULL,
    valorTotal FLOAT NOT NULL,
    cliente_id INT UNSIGNED NOT NULL,
    emailEnviado CHAR(1) NOT NULL DEFAULT 'N',
    servico_id INT UNSIGNED NOT NULL
);

CREATE UNIQUE INDEX un_ix_servico_agendamento ON servico_agendamento (
    cliente_id, servico_id, data, hora
);

CREATE TABLE contrato (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    numero VARCHAR(17) NOT NULL,
    data   DATETIME NOT NULL DEFAULT now(),
    qtdDiarias INT NOT NULL,
    valor FLOAT NOT NULL
);

CREATE UNIQUE INDEX un_ix_contrato ON contrato (numero);
