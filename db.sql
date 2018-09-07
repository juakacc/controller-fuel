-- MySQL Workbench Synchronization
-- Generated: 2018-09-07 16:26
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: juaka

CREATE SCHEMA IF NOT EXISTS gveiculos DEFAULT CHARACTER SET utf8 ;

CREATE TABLE IF NOT EXISTS gveiculos.carro (
  id INT(11) NOT NULL AUTO_INCREMENT,
  nome VARCHAR(45) NOT NULL,
  placa VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE INDEX placa_UNIQUE (placa ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS gveiculos.abastecimento (
  id INT(11) NOT NULL AUTO_INCREMENT,
  combustivel VARCHAR(45) NOT NULL,
  quantidade DOUBLE NULL DEFAULT NULL,
  competencia_id INT(11) NOT NULL,
  PRIMARY KEY (id),
  INDEX fk_abastecimento_competencia1_idx (competencia_id ASC),
  CONSTRAINT fk_abastecimento_competencia1
    FOREIGN KEY (competencia_id)
    REFERENCES gveiculos.competencia (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS gveiculos.conserto (
  id INT(11) NOT NULL AUTO_INCREMENT,
  servico VARCHAR(45) NOT NULL,
  competencia_id INT(11) NOT NULL,
  PRIMARY KEY (id),
  INDEX fk_conserto_competencia1_idx (competencia_id ASC),
  CONSTRAINT fk_conserto_competencia1
    FOREIGN KEY (competencia_id)
    REFERENCES gveiculos.competencia (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS gveiculos.aquisicao (
  id INT(11) NOT NULL AUTO_INCREMENT,
  peca VARCHAR(45) NOT NULL,
  conserto_id INT(11) NOT NULL,
  PRIMARY KEY (id),
  INDEX fk_aquisicao_conserto1_idx (conserto_id ASC),
  CONSTRAINT fk_aquisicao_conserto1
    FOREIGN KEY (conserto_id)
    REFERENCES gveiculos.conserto (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS gveiculos.competencia (
  id INT(11) NOT NULL AUTO_INCREMENT,
  carro_id INT(11) NOT NULL,
  referencia DATE NOT NULL,
  quilometragem DOUBLE NOT NULL,
  INDEX fk_competencia_carro1_idx (carro_id ASC),
  PRIMARY KEY (id),
  CONSTRAINT fk_competencia_carro1
    FOREIGN KEY (carro_id)
    REFERENCES gveiculos.carro (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS gveiculos.usuario (
  cpf CHAR(11) NOT NULL,
  nome_usuario VARCHAR(45) NULL DEFAULT NULL,
  senha VARCHAR(45) NULL DEFAULT NULL,
  email VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (cpf))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;
