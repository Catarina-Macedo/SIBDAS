CREATE DATABASE IF NOT EXISTS p31211279;
USE p31211279;


CREATE TABLE IF NOT EXISTS funcao (
    id CHAR(36) PRIMARY KEY DEFAULT (UUID()),
    nome VARCHAR(255) UNIQUE NOT NULL
);

CREATE TABLE IF NOT EXISTS utilizador (
    id CHAR(36) PRIMARY KEY DEFAULT (UUID()),
    nome VARCHAR(255) NOT NULL,
    genero VARCHAR(255) NOT NULL,
    data_nascimento DATETIME NOT NULL,
    morada VARCHAR(255) NOT NULL,
    nr_telemovel VARCHAR(255),
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    id_fisiologista CHAR(36),
    FOREIGN KEY (id_fisiologista) REFERENCES utilizador(id) ON DELETE CASCADE 
);

CREATE TABLE IF NOT EXISTS funcao_utilizador (
    id_utilizador CHAR(36),
    id_funcao CHAR(36),
    PRIMARY KEY (id_utilizador, id_funcao),
    FOREIGN KEY (id_utilizador) REFERENCES utilizador(id) ON DELETE CASCADE,
    FOREIGN KEY (id_funcao) REFERENCES funcao(id) ON DELETE CASCADE 
);

CREATE TABLE IF NOT EXISTS sinal (
    id CHAR(36) PRIMARY KEY DEFAULT (UUID()),
    spo2 NUMERIC NOT NULL,
    freq_card NUMERIC NOT NULL,
    press_art_min NUMERIC NOT NULL,
    press_art_max NUMERIC NOT NULL,
    data DATETIME NOT NULL,
    id_cliente CHAR(36) NOT NULL,
    FOREIGN KEY (id_cliente) REFERENCES utilizador(id) ON DELETE CASCADE  
);

CREATE TABLE IF NOT EXISTS medida (
    id CHAR(36) PRIMARY KEY DEFAULT (UUID()),
    percentagem_massa_gorda NUMERIC NOT NULL,
    imc NUMERIC NOT NULL,
    peso NUMERIC NOT NULL,
    altura NUMERIC NOT NULL,
    data DATETIME NOT NULL,
    id_cliente CHAR(36) NOT NULL,
    FOREIGN KEY (id_cliente) REFERENCES utilizador(id) ON DELETE CASCADE  
);

CREATE TABLE IF NOT EXISTS tipo_equipamento (
    id CHAR(36) PRIMARY KEY DEFAULT (UUID()),
    tipo VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE IF NOT EXISTS equipamento (
    id CHAR(36) PRIMARY KEY DEFAULT (UUID()),
    descricao VARCHAR(255) NOT NULL,
    como_usar VARCHAR(255) NOT NULL,
    id_tipo CHAR(36) NOT NULL,
    FOREIGN KEY (id_tipo) REFERENCES tipo_equipamento(id) ON DELETE CASCADE 
);

CREATE TABLE IF NOT EXISTS grupo_muscular (
    id CHAR(36) PRIMARY KEY DEFAULT (UUID()),
    nome VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE IF NOT EXISTS exercicio (
    id CHAR(36) PRIMARY KEY DEFAULT (UUID()),
    nome VARCHAR(255) NOT NULL,
    id_grupo_muscular CHAR(36) NOT NULL,
    id_equipamento CHAR(36) NOT NULL,
    FOREIGN KEY (id_grupo_muscular) REFERENCES grupo_muscular(id) ON DELETE CASCADE,
    FOREIGN KEY (id_equipamento) REFERENCES equipamento(id) ON DELETE CASCADE 
);

CREATE TABLE IF NOT EXISTS execucao (
    id CHAR(36) PRIMARY KEY DEFAULT (UUID()),
    series NUMERIC NOT NULL,
    repeticoes NUMERIC NOT NULL,
    carga_kg NUMERIC,
    tempo_duracao NUMERIC,
    tempo_descanso NUMERIC,
    id_exercicio CHAR(36),
    FOREIGN KEY (id_exercicio) REFERENCES exercicio(id) ON DELETE CASCADE 
);

CREATE TABLE IF NOT EXISTS plano_treino (
    id CHAR(36) PRIMARY KEY DEFAULT (UUID()),
    data DATETIME NOT NULL,
    id_cliente CHAR(36) NOT NULL,
    id_fisiologista CHAR(36) NOT NULL,
    FOREIGN KEY (id_cliente) REFERENCES utilizador(id) ON DELETE CASCADE, 
    FOREIGN KEY (id_fisiologista) REFERENCES utilizador(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS plano_treino_execucao (
    id_plano_treino CHAR(36),
    id_execucao CHAR(36),
    PRIMARY KEY (id_plano_treino, id_execucao),
    FOREIGN KEY (id_plano_treino) REFERENCES plano_treino(id) ON DELETE CASCADE, 
    FOREIGN KEY (id_execucao) REFERENCES execucao(id) ON DELETE CASCADE 
);


-- Inserir funcao
INSERT INTO funcao (nome) 
VALUES ('fisiologista');
INSERT INTO funcao (nome) 
VALUES ('cliente');



-- Inserir utilizadores
INSERT INTO utilizador (id, nome, genero, data_nascimento, morada, nr_telemovel, email, password) VALUES ('ea6ef6fb-ff66-11ee-b1a1-fc3fdb8fa140', 'Coop Schutter', 'Male', '2015-09-09', '90 Larry Parkway', '+86 (696) 439-0111', 'cschutter0@yellowbook.com', '$2a$04$RgjcYxKkLs6feeUH3.CNYOb3zhyTqrUbRR3qsLXFBZrF2pZjApAKa');
INSERT INTO utilizador (nome, genero, data_nascimento, morada, nr_telemovel, email, PASSWORD, id_fisiologista) VALUES ('Brigham Baldam', 'Male', '1961-04-03', '903 Darwin Hill', '+46 (104) 235-8985', 'bbaldam1@umn.edu', '$2a$04$jLiiZQ0m5rdtlncjOHH/EujCFzro1CE3HiZKLzV2.EKbV825pomAW', 'ea6ef6fb-ff66-11ee-b1a1-fc3fdb8fa140');
INSERT INTO utilizador (nome, genero, data_nascimento, morada, nr_telemovel, email, password, id_fisiologista) VALUES ('Forest Drewet', 'Male', '1959-10-19', '53 Lighthouse Bay Center', '+976 (459) 871-6661', 'fdrewet3@reference.com', '$2a$04$udu22dqv8VkMbxMzvM/a9OfgbshBC9mkxYfSPsb3xay1.GAZMOt3q', 'ea6ef6fb-ff66-11ee-b1a1-fc3fdb8fa140');
INSERT INTO utilizador (nome, genero, data_nascimento, morada, nr_telemovel, email, password, id_fisiologista) VALUES ('Gabrila Windle', 'Female', '1963-04-11', '43706 Bonner Junction', '+33 (811) 365-0780', 'gwindle4@gizmodo.com', '$2a$04$MZsEb8DbVWRuID8uaK.2MeQrlohqgh8882if1OUwsWdnqvFJu.7ga', 'ea6ef6fb-ff66-11ee-b1a1-fc3fdb8fa140');
INSERT INTO utilizador (nome, genero, data_nascimento, morada, nr_telemovel, email, password, id_fisiologista) VALUES ('Marlena Stuchbury', 'Female', '1992-08-12', '6776 Grim Court', '+62 (202) 297-3538', 'mstuchbury5@upenn.edu', '$2a$04$V7H8RcrnlePan39C5uQ4H.UcHGkKn03uAoIHLeR1p0gmIIUoJcMxO', 'ea6ef6fb-ff66-11ee-b1a1-fc3fdb8fa140');
INSERT INTO utilizador (nome, genero, data_nascimento, morada, nr_telemovel, email, password, id_fisiologista) VALUES ('Tammie Ketcher', 'Female', '2021-10-07', '590 Portage Street', '+48 (934) 986-5233', 'tketcher6@blog.com', '$2a$04$N6fPBFEHlrnVdi5AHYpbPujlo0bQoggSe878YYQ4R5KXu1WW6k4Cy', 'ea6ef6fb-ff66-11ee-b1a1-fc3fdb8fa140');
INSERT INTO utilizador (nome, genero, data_nascimento, morada, nr_telemovel, email, password, id_fisiologista) VALUES ('Kerwin Najara', 'Male', '2018-02-25', '26 Rowland Junction', '+86 (592) 639-8010', 'knajara7@github.io', '$2a$04$IBXqePfhfjEOOFYgX/xod.12l335FUgSrLW/WEDE.TV3nbF.BG1eK', 'ea6ef6fb-ff66-11ee-b1a1-fc3fdb8fa140');
INSERT INTO utilizador (nome, genero, data_nascimento, morada, nr_telemovel, email, password, id_fisiologista) VALUES ('Lucky Hurcombe', 'Female', '1974-12-26', '14 Corscot Avenue', '+423 (549) 935-0974', 'lhurcombe8@baidu.com', '$2a$04$9norymB8IoYK4Kdx1a5nLut1k/2/LXH1yTuA6DbWo80u6FVaUa/5e', 'ea6ef6fb-ff66-11ee-b1a1-fc3fdb8fa140');
INSERT INTO utilizador (nome, genero, data_nascimento, morada, nr_telemovel, email, password, id_fisiologista) VALUES ('Westley Sigge', 'Male', '1962-12-28', '790 Northridge Trail', '+86 (571) 604-1010', 'wsigge9@people.com.cn', '$2a$04$1UEk1Jg3FVf/ebfdsi28h.QYjGIkB6hLSu39Vw2gWdGsb0nx8ngZy', 'ea6ef6fb-ff66-11ee-b1a1-fc3fdb8fa140');
INSERT INTO utilizador (nome, genero, data_nascimento, morada, nr_telemovel, email, password, id_fisiologista) VALUES ('Eydie Huntly', 'Female', '1983-10-30', '7 Forest Parkway', '+31 (234) 854-1395', 'ehuntlya@youku.com', '$2a$04$agQ7Pltx4IkLs0/rgHTcBeoXfodKjqI9TmlENzmZvnk1QKLfQgQru', 'ea6ef6fb-ff66-11ee-b1a1-fc3fdb8fa140');
INSERT INTO utilizador (nome, genero, data_nascimento, morada, nr_telemovel, email, password, id_fisiologista) VALUES ('Marie-ann Acarson', 'Female', '2016-06-22', '0 Clove Terrace', '+1 (516) 631-3610', 'macarsonb@multiply.com', '$2a$04$STUSOJAj2pZ1SSyZRyRJWOj9mZSwq59JfcO6MSlmU8dppWikr9lWq', 'ea6ef6fb-ff66-11ee-b1a1-fc3fdb8fa140');
INSERT INTO utilizador (nome, genero, data_nascimento, morada, nr_telemovel, email, password, id_fisiologista) VALUES ('Burnard Dightham', 'Male', '1977-02-14', '82 Melrose Crossing', '+86 (761) 285-1017', 'bdighthamc@hugedomains.com', '$2a$04$rsjB.qc/hrA8tzKRQD1U1uMthj3sTWOsgU42KexYTV.00NC3.7gwy', 'ea6ef6fb-ff66-11ee-b1a1-fc3fdb8fa140');
INSERT INTO utilizador (nome, genero, data_nascimento, morada, nr_telemovel, email, password, id_fisiologista) VALUES ('Agata Gabey', 'Female', '1963-04-28', '1456 Lake View Avenue', '+62 (771) 607-0100', 'agabeyd@ebay.co.uk', '$2a$04$1Zw1XQJzWy08XBFwAres0uEcg7d/BeLS4X.csCjLcSJ54IZQ.XuTG', 'ea6ef6fb-ff66-11ee-b1a1-fc3fdb8fa140');
INSERT INTO utilizador (nome, genero, data_nascimento, morada, nr_telemovel, email, password, id_fisiologista) VALUES ('Duffie Dowry', 'Male', '1959-09-07', '06011 Superior Center', '+374 (396) 816-2695', 'ddowrye@bloglovin.com', '$2a$04$4Oc3TCtmv/RvBIWIHqcjmeIgoi1Y/Aag1WhkDMEOTKGOdeptIpZSq', 'ea6ef6fb-ff66-11ee-b1a1-fc3fdb8fa140');
INSERT INTO utilizador (nome, genero, data_nascimento, morada, nr_telemovel, email, password, id_fisiologista) VALUES ('Tadeas Craghead', 'Male', '2000-09-27', '29384 Morrow Way', '+380 (701) 255-5185', 'tcragheadf@bravesites.com', '$2a$04$7KrVUkhe/.3K4eUXrtal8umzJd2Wj/X.rSWgo5AKRQDihy33ryI.O', 'ea6ef6fb-ff66-11ee-b1a1-fc3fdb8fa140');
INSERT INTO utilizador (nome, genero, data_nascimento, morada, nr_telemovel, email, password, id_fisiologista) VALUES ('Holly Annand', 'Female', '1984-01-01', '615 Onsgard Circle', '+86 (680) 832-7588', 'hannandg@upenn.edu', '$2a$04$/ogEEnYZp1PXaVwn5pMy8Oxd7pSxBdAcazPk45jm1BS0IMekpFLBO', 'ea6ef6fb-ff66-11ee-b1a1-fc3fdb8fa140');
INSERT INTO utilizador (nome, genero, data_nascimento, morada, nr_telemovel, email, password, id_fisiologista) VALUES ('Aubine Klehyn', 'Female', '1983-10-14', '05059 Wayridge Parkway', '+33 (576) 965-0320', 'aklehynh@purevolume.com', '$2a$04$NO8VfoWgnD6Sg/spZPBSseTwrt2PCJVpbF4BtI5e/k6MA1b3uUCdC', 'ea6ef6fb-ff66-11ee-b1a1-fc3fdb8fa140');
INSERT INTO utilizador (nome, genero, data_nascimento, morada, nr_telemovel, email, password, id_fisiologista) VALUES ('Bobbi Apted', 'Female', '1980-08-29', '6088 Burrows Park', '+358 (800) 117-1946', 'baptedi@tinypic.com', '$2a$04$IDl/kmohjPIGY6T/Hq7phOoIi2yHfErZKEi4.FBUPqSMjfvhU8qG.', 'ea6ef6fb-ff66-11ee-b1a1-fc3fdb8fa140');
INSERT INTO utilizador (nome, genero, data_nascimento, morada, nr_telemovel, email, password, id_fisiologista) VALUES ('Debbi Brok', 'Female', '1972-09-08', '639 Golden Leaf Junction', '+98 (226) 703-7142', 'dbrokj@timesonline.co.uk', '$2a$04$a3iUEKBycCWBtc9lg.cYmOxHpPxK7SRZ0CZXWgh8s72KbJSmbuaM.', 'ea6ef6fb-ff66-11ee-b1a1-fc3fdb8fa140');
INSERT INTO utilizador (nome, genero, data_nascimento, morada, nr_telemovel, email, password, id_fisiologista) VALUES ('Rickard Devers', 'Male', '1965-01-28', '27338 Browning Parkway', '+51 (175) 674-3075', 'rdeversk@qq.com', '$2a$04$ELjSsQFkuvx0uRPnUO1leODofAiGYK215fG3u.k9ci/mgRo58k65e', 'ea6ef6fb-ff66-11ee-b1a1-fc3fdb8fa140');
INSERT INTO utilizador (nome, genero, data_nascimento, morada, nr_telemovel, email, password, id_fisiologista) VALUES ('Kendall Baytrop', 'Male', '2010-07-22', '3963 Blackbird Place', '+81 (142) 338-3604', 'kbaytropl@ehow.com', '$2a$04$1LLqey9BbI4ujBO7ZLXKweVcmhT5W0aUlldqDr9/aMuG8GOkQ56lS', 'ea6ef6fb-ff66-11ee-b1a1-fc3fdb8fa140');
INSERT INTO utilizador (nome, genero, data_nascimento, morada, nr_telemovel, email, password, id_fisiologista) VALUES ('Loy Pryer', 'Male', '1970-05-13', '66256 Monica Center', '+86 (267) 731-8683', 'lpryerm@home.pl', '$2a$04$/iriJjeCdWm6xQg8nFB7V.F4WJH0MEn2Tv5TD.AiQHgwGzxf0uORi', 'ea6ef6fb-ff66-11ee-b1a1-fc3fdb8fa140');
INSERT INTO utilizador (nome, genero, data_nascimento, morada, nr_telemovel, email, password, id_fisiologista) VALUES ('Harli Griggs', 'Female', '1951-07-25', '66 Pierstorff Alley', '+86 (145) 711-7045', 'hgriggsn@deliciousdays.com', '$2a$04$yMvzO0EL0gUkWDrATahSUu4W7RKz4buc03YNQIYaWpSOb1QnLy.fy', 'ea6ef6fb-ff66-11ee-b1a1-fc3fdb8fa140');
INSERT INTO utilizador (nome, genero, data_nascimento, morada, nr_telemovel, email, password, id_fisiologista) VALUES ('Vachel McKeefry', 'Male', '1989-05-18', '96647 Pennsylvania Road', '+86 (213) 732-6171', 'vmckeefryo@zdnet.com', '$2a$04$PWISAaSMTiDn/PZNBstK4.S9QBf7rhAyYLD9Xf2xXC8QO./HHclCG', 'ea6ef6fb-ff66-11ee-b1a1-fc3fdb8fa140');
INSERT INTO utilizador (nome, genero, data_nascimento, morada, nr_telemovel, email, password, id_fisiologista) VALUES ('Clayborne Wrightem', 'Male', '1960-08-20', '9 Jenna Trail', '+31 (152) 147-6259', 'cwrightemp@slate.com', '$2a$04$plYl1wVoc1QgF8tOkQnf7O0xcKkxG170lC9Hv7IAvQpOYj1iD4ELW', 'ea6ef6fb-ff66-11ee-b1a1-fc3fdb8fa140');
INSERT INTO utilizador (nome, genero, data_nascimento, morada, nr_telemovel, email, password, id_fisiologista) VALUES ('Vittorio Clelland', 'Male', '1968-08-17', '92096 Buhler Center', '+62 (508) 990-9463', 'vclellandq@rakuten.co.jp', '$2a$04$oYHe1g5xgg7wJ.RjfV4ao.rQmICNMjbdMiVznY7K4ygatYOxyAl1S', 'ea6ef6fb-ff66-11ee-b1a1-fc3fdb8fa140');
INSERT INTO utilizador (nome, genero, data_nascimento, morada, nr_telemovel, email, password, id_fisiologista) VALUES ('Kip Eakley', 'Female', '1991-11-15', '6 Fallview Trail', '+86 (416) 257-4759', 'keakleyr@scientificamerican.com', '$2a$04$QStgm5Qhbi3xEafJqlZQ7.5hlft.wj1zCTFAPmmmaiYhGpf9udME2', 'ea6ef6fb-ff66-11ee-b1a1-fc3fdb8fa140');
INSERT INTO utilizador (nome, genero, data_nascimento, morada, nr_telemovel, email, password, id_fisiologista) VALUES ('Jo-anne Paula', 'Female', '1992-02-23', '9 Scoville Plaza', '+86 (426) 990-5973', 'jpaulas@acquirethisname.com', '$2a$04$bvZuleP0vHNYZlhl0rb.VO8MY5FMoF.bWQAoBwYRwOJk5UudDAFkG', 'ea6ef6fb-ff66-11ee-b1a1-fc3fdb8fa140');
INSERT INTO utilizador (nome, genero, data_nascimento, morada, nr_telemovel, email, password, id_fisiologista) VALUES ('Marlow Lucks', 'Male', '1981-12-18', '21999 Blaine Drive', '+351 (184) 504-8976', 'mluckst@alexa.com', '$2a$04$XoIO3o0bwe0F2ekv03nNUeQvfcd5ywC7B/a6FIo6JTMDMsGCqMv5.', 'ea6ef6fb-ff66-11ee-b1a1-fc3fdb8fa140');

UPDATE utilizador SET PASSWORD='123456';

INSERT INTO funcao_utilizador (id_funcao, id_utilizador) 
VALUES ((SELECT id FROM funcao WHERE nome = 'fisiologista'), (SELECT id FROM utilizador WHERE nome = 'Coop Schutter'));
INSERT INTO funcao_utilizador (id_funcao, id_utilizador)
VALUES ((SELECT id FROM funcao WHERE nome = 'cliente'), (SELECT id FROM utilizador WHERE nome = 'Brigham Baldam'));
INSERT INTO funcao_utilizador (id_funcao, id_utilizador)
VALUES ((SELECT id FROM funcao WHERE nome = 'cliente'), (SELECT id FROM utilizador WHERE nome = 'Forest Drewet'));
INSERT INTO funcao_utilizador (id_funcao, id_utilizador)
VALUES ((SELECT id FROM funcao WHERE nome = 'cliente'), (SELECT id FROM utilizador WHERE nome = 'Gabrila Windle'));
INSERT INTO funcao_utilizador (id_funcao, id_utilizador)
VALUES ((SELECT id FROM funcao WHERE nome = 'cliente'), (SELECT id FROM utilizador WHERE nome = 'Marlena Stuchbury'));
INSERT INTO funcao_utilizador (id_funcao, id_utilizador)
VALUES ((SELECT id FROM funcao WHERE nome = 'cliente'), (SELECT id FROM utilizador WHERE nome = 'Tammie Ketcher'));
INSERT INTO funcao_utilizador (id_funcao, id_utilizador)
VALUES ((SELECT id FROM funcao WHERE nome = 'cliente'), (SELECT id FROM utilizador WHERE nome = 'Kerwin Najara'));
INSERT INTO funcao_utilizador (id_funcao, id_utilizador)
VALUES ((SELECT id FROM funcao WHERE nome = 'cliente'), (SELECT id FROM utilizador WHERE nome = 'Lucky Hurcombe'));
INSERT INTO funcao_utilizador (id_funcao, id_utilizador)
VALUES ((SELECT id FROM funcao WHERE nome = 'cliente'), (SELECT id FROM utilizador WHERE nome = 'Westley Sigge'));
INSERT INTO funcao_utilizador (id_funcao, id_utilizador)
VALUES ((SELECT id FROM funcao WHERE nome = 'cliente'), (SELECT id FROM utilizador WHERE nome = 'Eydie Huntly'));
INSERT INTO funcao_utilizador (id_funcao, id_utilizador)
VALUES ((SELECT id FROM funcao WHERE nome = 'cliente'), (SELECT id FROM utilizador WHERE nome = 'Marie-ann Acarson'));
INSERT INTO funcao_utilizador (id_funcao, id_utilizador)
VALUES ((SELECT id FROM funcao WHERE nome = 'cliente'), (SELECT id FROM utilizador WHERE nome = 'Burnard Dightham'));
INSERT INTO funcao_utilizador (id_funcao, id_utilizador)
VALUES ((SELECT id FROM funcao WHERE nome = 'cliente'), (SELECT id FROM utilizador WHERE nome = 'Agata Gabey'));
INSERT INTO funcao_utilizador (id_funcao, id_utilizador)
VALUES ((SELECT id FROM funcao WHERE nome = 'cliente'), (SELECT id FROM utilizador WHERE nome = 'Duffie Dowry'));
INSERT INTO funcao_utilizador (id_funcao, id_utilizador)
VALUES ((SELECT id FROM funcao WHERE nome = 'cliente'), (SELECT id FROM utilizador WHERE nome = 'Tadeas Craghead'));
INSERT INTO funcao_utilizador (id_funcao, id_utilizador)
VALUES ((SELECT id FROM funcao WHERE nome = 'cliente'), (SELECT id FROM utilizador WHERE nome = 'Holly Annand'));
INSERT INTO funcao_utilizador (id_funcao, id_utilizador)
VALUES ((SELECT id FROM funcao WHERE nome = 'cliente'), (SELECT id FROM utilizador WHERE nome = 'Aubine Klehyn'));
INSERT INTO funcao_utilizador (id_funcao, id_utilizador)
VALUES ((SELECT id FROM funcao WHERE nome = 'cliente'), (SELECT id FROM utilizador WHERE nome = 'Bobbi Apted'));
INSERT INTO funcao_utilizador (id_funcao, id_utilizador)
VALUES ((SELECT id FROM funcao WHERE nome = 'cliente'), (SELECT id FROM utilizador WHERE nome = 'Debbi Brok'));
INSERT INTO funcao_utilizador (id_funcao, id_utilizador)
VALUES ((SELECT id FROM funcao WHERE nome = 'cliente'), (SELECT id FROM utilizador WHERE nome = 'Rickard Devers'));
INSERT INTO funcao_utilizador (id_funcao, id_utilizador)
VALUES ((SELECT id FROM funcao WHERE nome = 'cliente'), (SELECT id FROM utilizador WHERE nome = 'Kendall Baytrop'));
INSERT INTO funcao_utilizador (id_funcao, id_utilizador)
VALUES ((SELECT id FROM funcao WHERE nome = 'cliente'), (SELECT id FROM utilizador WHERE nome = 'Loy Pryer'));
INSERT INTO funcao_utilizador (id_funcao, id_utilizador)
VALUES ((SELECT id FROM funcao WHERE nome = 'cliente'), (SELECT id FROM utilizador WHERE nome = 'Harli Griggs'));
INSERT INTO funcao_utilizador (id_funcao, id_utilizador)
VALUES ((SELECT id FROM funcao WHERE nome = 'cliente'), (SELECT id FROM utilizador WHERE nome = 'Vachel McKeefry'));
INSERT INTO funcao_utilizador (id_funcao, id_utilizador)
VALUES ((SELECT id FROM funcao WHERE nome = 'cliente'), (SELECT id FROM utilizador WHERE nome = 'Clayborne Wrightem'));
INSERT INTO funcao_utilizador (id_funcao, id_utilizador)
VALUES ((SELECT id FROM funcao WHERE nome = 'cliente'), (SELECT id FROM utilizador WHERE nome = 'Vittorio Clelland'));
INSERT INTO funcao_utilizador (id_funcao, id_utilizador)
VALUES ((SELECT id FROM funcao WHERE nome = 'cliente'), (SELECT id FROM utilizador WHERE nome = 'Kip Eakley'));
INSERT INTO funcao_utilizador (id_funcao, id_utilizador)
VALUES ((SELECT id FROM funcao WHERE nome = 'cliente'), (SELECT id FROM utilizador WHERE nome = 'Jo-anne Paula'));
INSERT INTO funcao_utilizador (id_funcao, id_utilizador)
VALUES ((SELECT id FROM funcao WHERE nome = 'cliente'), (SELECT id FROM utilizador WHERE nome = 'Marlow Lucks'));

-- Atribuir funcao
-- UPDATE utilizador SET id_fisiologista = (SELECT id FROM utilizador WHERE nome = 'Coop Schutter') WHERE nome not in ('Coop Schutter');

-- Inserir sinais
insert into sinal (spo2, freq_card, press_art_min, press_art_max, data, id_cliente) values (94.4, 62, 68.1, 110.9, NOW(), (SELECT id FROM utilizador WHERE nome = 'Brigham Baldam'));
insert into sinal (spo2, freq_card, press_art_min, press_art_max, data, id_cliente) values (99.8, 87, 67.4, 119.0, NOW(), (SELECT id FROM utilizador WHERE nome = 'Forest Drewet'));
insert into sinal (spo2, freq_card, press_art_min, press_art_max, data, id_cliente) values (99.8, 92, 69.8, 101.4, NOW(), (SELECT id FROM utilizador WHERE nome = 'Gabrila Windle'));
insert into sinal (spo2, freq_card, press_art_min, press_art_max, data, id_cliente) values (92.1, 83, 66.5, 117.5, NOW(), (SELECT id FROM utilizador WHERE nome = 'Marlena Stuchbury'));
insert into sinal (spo2, freq_card, press_art_min, press_art_max, data, id_cliente) values (93.5, 62, 72.9, 109.9, NOW(), (SELECT id FROM utilizador WHERE nome = 'Tammie Ketcher'));
insert into sinal (spo2, freq_card, press_art_min, press_art_max, data, id_cliente) values (94.9, 99, 71.2, 108.8, NOW(), (SELECT id FROM utilizador WHERE nome = 'Kerwin Najara'));
insert into sinal (spo2, freq_card, press_art_min, press_art_max, data, id_cliente) values (95.7, 63, 66.7, 118.8, NOW(), (SELECT id FROM utilizador WHERE nome = 'Lucky Hurcombe'));
insert into sinal (spo2, freq_card, press_art_min, press_art_max, data, id_cliente) values (99.3, 91, 67.3, 112.1, NOW(), (SELECT id FROM utilizador WHERE nome = 'Westley Sigge'));
insert into sinal (spo2, freq_card, press_art_min, press_art_max, data, id_cliente) values (99.8, 88, 66.0, 103.2, NOW(), (SELECT id FROM utilizador WHERE nome = 'Eydie Huntly'));
insert into sinal (spo2, freq_card, press_art_min, press_art_max, data, id_cliente) values (99.2, 69, 69.9, 103.0, NOW(), (SELECT id FROM utilizador WHERE nome = 'Marie-ann Acarson'));
insert into sinal (spo2, freq_card, press_art_min, press_art_max, data, id_cliente) values (97.3, 86, 70.9, 103.4, NOW(), (SELECT id FROM utilizador WHERE nome = 'Burnard Dightham'));
insert into sinal (spo2, freq_card, press_art_min, press_art_max, data, id_cliente) values (93.7, 69, 72.3, 108.9, NOW(), (SELECT id FROM utilizador WHERE nome = 'Agata Gabey'));
insert into sinal (spo2, freq_card, press_art_min, press_art_max, data, id_cliente) values (95.6, 69, 70.9, 115.5, NOW(), (SELECT id FROM utilizador WHERE nome = 'Duffie Dowry'));
insert into sinal (spo2, freq_card, press_art_min, press_art_max, data, id_cliente) values (92.9, 91, 66.0, 115.7, NOW(), (SELECT id FROM utilizador WHERE nome = 'Tadeas Craghead'));
insert into sinal (spo2, freq_card, press_art_min, press_art_max, data, id_cliente) values (95.4, 99, 70.9, 112.6, NOW(), (SELECT id FROM utilizador WHERE nome = 'Holly Annand'));
insert into sinal (spo2, freq_card, press_art_min, press_art_max, data, id_cliente) values (92.9, 86, 67.4, 117.5, NOW(), (SELECT id FROM utilizador WHERE nome = 'Aubine Klehyn'));
insert into sinal (spo2, freq_card, press_art_min, press_art_max, data, id_cliente) values (92.7, 74, 66.3, 113.4, NOW(), (SELECT id FROM utilizador WHERE nome = 'Bobbi Apted'));
insert into sinal (spo2, freq_card, press_art_min, press_art_max, data, id_cliente) values (94.6, 80, 73.5, 107.5, NOW(), (SELECT id FROM utilizador WHERE nome = 'Debbi Brok'));
insert into sinal (spo2, freq_card, press_art_min, press_art_max, data, id_cliente) values (95.6, 71, 68.2, 118.0, NOW(), (SELECT id FROM utilizador WHERE nome = 'Rickard Devers'));
insert into sinal (spo2, freq_card, press_art_min, press_art_max, data, id_cliente) values (95.7, 78, 74.2, 111.8, NOW(), (SELECT id FROM utilizador WHERE nome = 'Kendall Baytrop'));
insert into sinal (spo2, freq_card, press_art_min, press_art_max, data, id_cliente) values (96.3, 78, 66.9, 111.5, NOW(), (SELECT id FROM utilizador WHERE nome = 'Loy Pryer'));
insert into sinal (spo2, freq_card, press_art_min, press_art_max, data, id_cliente) values (98.5, 96, 71.6, 110.8, NOW(), (SELECT id FROM utilizador WHERE nome = 'Harli Griggs'));
insert into sinal (spo2, freq_card, press_art_min, press_art_max, data, id_cliente) values (95.7, 93, 74.6, 110.5, NOW(), (SELECT id FROM utilizador WHERE nome = 'Vachel McKeefry'));
insert into sinal (spo2, freq_card, press_art_min, press_art_max, data, id_cliente) values (97.8, 93, 67.7, 103.6, NOW(), (SELECT id FROM utilizador WHERE nome = 'Clayborne Wrightem'));
insert into sinal (spo2, freq_card, press_art_min, press_art_max, data, id_cliente) values (94.4, 65, 69.4, 111.8, NOW(), (SELECT id FROM utilizador WHERE nome = 'Vittorio Clelland'));
insert into sinal (spo2, freq_card, press_art_min, press_art_max, data, id_cliente) values (99.2, 64, 69.9, 104.6, NOW(), (SELECT id FROM utilizador WHERE nome = 'Kip Eakley'));
insert into sinal (spo2, freq_card, press_art_min, press_art_max, data, id_cliente) values (99.8, 95, 72.0, 109.9, NOW(), (SELECT id FROM utilizador WHERE nome = 'Jo-anne Paula'));


-- Inserir medidas
insert into medida (percentagem_massa_gorda, imc, peso, altura, data, id_cliente) values (32, 75, 73.4, 1.55, NOW(), (SELECT id FROM utilizador WHERE nome = 'Brigham Baldam'));
insert into medida (percentagem_massa_gorda, imc, peso, altura, data, id_cliente) values (21, 70, 85.6, 1.87, NOW(), (SELECT id FROM utilizador WHERE nome = 'Forest Drewet'));
insert into medida (percentagem_massa_gorda, imc, peso, altura, data, id_cliente) values (23, 73, 56.8, 1.81, NOW(), (SELECT id FROM utilizador WHERE nome = 'Gabrila Windle'));
insert into medida (percentagem_massa_gorda, imc, peso, altura, data, id_cliente) values (31, 73, 74.8, 1.76, NOW(), (SELECT id FROM utilizador WHERE nome = 'Marlena Stuchbury'));
insert into medida (percentagem_massa_gorda, imc, peso, altura, data, id_cliente) values (31, 73, 99.0, 1.54, NOW(), (SELECT id FROM utilizador WHERE nome = 'Tammie Ketcher'));
insert into medida (percentagem_massa_gorda, imc, peso, altura, data, id_cliente) values (15, 89, 48.3, 1.83, NOW(), (SELECT id FROM utilizador WHERE nome = 'Kerwin Najara'));
insert into medida (percentagem_massa_gorda, imc, peso, altura, data, id_cliente) values (17, 89, 68.0, 1.71, NOW(), (SELECT id FROM utilizador WHERE nome = 'Lucky Hurcombe'));
insert into medida (percentagem_massa_gorda, imc, peso, altura, data, id_cliente) values (32, 96, 52.0, 1.8, NOW(), (SELECT id FROM utilizador WHERE nome = 'Westley Sigge'));
insert into medida (percentagem_massa_gorda, imc, peso, altura, data, id_cliente) values (24, 90, 80.2, 1.57, NOW(), (SELECT id FROM utilizador WHERE nome = 'Eydie Huntly'));
insert into medida (percentagem_massa_gorda, imc, peso, altura, data, id_cliente) values (29, 78, 48.6, 1.87, NOW(), (SELECT id FROM utilizador WHERE nome = 'Marie-ann Acarson'));
insert into medida (percentagem_massa_gorda, imc, peso, altura, data, id_cliente) values (28, 96, 67.1, 1.82, NOW(), (SELECT id FROM utilizador WHERE nome = 'Burnard Dightham'));
insert into medida (percentagem_massa_gorda, imc, peso, altura, data, id_cliente) values (26, 93, 99.3, 1.76, NOW(), (SELECT id FROM utilizador WHERE nome = 'Agata Gabey'));
insert into medida (percentagem_massa_gorda, imc, peso, altura, data, id_cliente) values (15, 78, 91.3, 1.86, NOW(), (SELECT id FROM utilizador WHERE nome = 'Duffie Dowry'));
insert into medida (percentagem_massa_gorda, imc, peso, altura, data, id_cliente) values (15, 97, 88.3, 1.98, NOW(), (SELECT id FROM utilizador WHERE nome = 'Tadeas Craghead'));
insert into medida (percentagem_massa_gorda, imc, peso, altura, data, id_cliente) values (15, 63, 85.0, 1.95, NOW(), (SELECT id FROM utilizador WHERE nome = 'Holly Annand'));
insert into medida (percentagem_massa_gorda, imc, peso, altura, data, id_cliente) values (15, 100, 89.1, 1.71, NOW(), (SELECT id FROM utilizador WHERE nome = 'Aubine Klehyn'));
insert into medida (percentagem_massa_gorda, imc, peso, altura, data, id_cliente) values (32, 98, 80.7, 1.82, NOW(), (SELECT id FROM utilizador WHERE nome = 'Bobbi Apted'));
insert into medida (percentagem_massa_gorda, imc, peso, altura, data, id_cliente) values (20, 74, 92.9, 1.78, NOW(), (SELECT id FROM utilizador WHERE nome = 'Debbi Brok'));
insert into medida (percentagem_massa_gorda, imc, peso, altura, data, id_cliente) values (25, 88, 64.4, 1.84, NOW(), (SELECT id FROM utilizador WHERE nome = 'Rickard Devers'));
insert into medida (percentagem_massa_gorda, imc, peso, altura, data, id_cliente) values (30, 74, 59.9, 1.76, NOW(), (SELECT id FROM utilizador WHERE nome = 'Kendall Baytrop'));
insert into medida (percentagem_massa_gorda, imc, peso, altura, data, id_cliente) values (17, 62, 54.2, 1.68, NOW(), (SELECT id FROM utilizador WHERE nome = 'Loy Pryer'));
insert into medida (percentagem_massa_gorda, imc, peso, altura, data, id_cliente) values (15, 79, 58.1, 1.53, NOW(), (SELECT id FROM utilizador WHERE nome = 'Harli Griggs'));
insert into medida (percentagem_massa_gorda, imc, peso, altura, data, id_cliente) values (31, 97, 56.3, 1.52, NOW(), (SELECT id FROM utilizador WHERE nome = 'Vachel McKeefry'));
insert into medida (percentagem_massa_gorda, imc, peso, altura, data, id_cliente) values (26, 77, 87.2, 1.71, NOW(), (SELECT id FROM utilizador WHERE nome = 'Clayborne Wrightem'));
insert into medida (percentagem_massa_gorda, imc, peso, altura, data, id_cliente) values (17, 76, 70.6, 1.5, NOW(), (SELECT id FROM utilizador WHERE nome = 'Vittorio Clelland'));
insert into medida (percentagem_massa_gorda, imc, peso, altura, data, id_cliente) values (27, 62, 90.4, 1.95, NOW(), (SELECT id FROM utilizador WHERE nome = 'Kip Eakley'));
insert into medida (percentagem_massa_gorda, imc, peso, altura, data, id_cliente) values (31, 68, 67.3, 1.82, NOW(), (SELECT id FROM utilizador WHERE nome = 'Jo-anne Paula'));
insert into medida (percentagem_massa_gorda, imc, peso, altura, data, id_cliente) values (26, 82, 92.2, 1.53, NOW(), (SELECT id FROM utilizador WHERE nome = 'Marlow Lucks'));

-- Inserir tipos de equipamento
INSERT INTO tipo_equipamento (tipo) VALUES ('cardio'), ('musculacao');

-- Inserir equipamentos
INSERT INTO equipamento (descricao, como_usar, id_tipo) 
VALUES ('Halteres', 'Sao pesos livres utilizados em uma variedade de exercicios de musculacao', 
       (SELECT id FROM tipo_equipamento WHERE tipo = 'musculacao'));

INSERT INTO equipamento (descricao, como_usar, id_tipo) 
VALUES ('Eliptica', 'E um dispositivo de cardio onde o usuario realiza movimentos de caminhada ou corrida', 
       (SELECT id FROM tipo_equipamento WHERE tipo = 'cardio'));

INSERT INTO equipamento (descricao, como_usar, id_tipo) 
VALUES ('Polia', 'E um dispositivo que utiliza uma roda com sulcos para suportar e direcionar a movimentacao de cordas ou cabos, permitindo a transferencia de forca', 
       (SELECT id FROM tipo_equipamento WHERE tipo = 'musculacao'));

INSERT INTO equipamento (descricao, como_usar, id_tipo) 
VALUES ('Passadeira', 'E um equipamento de cardio projetado para simular a corrida ou caminhada. Possui velocidade e inclinacao ajustaveis para um treino personalizado.', 
       (SELECT id FROM tipo_equipamento WHERE tipo = 'cardio'));

INSERT INTO equipamento (descricao, como_usar, id_tipo) 
VALUES ('Smith', 'E uma maquina de resistencia usada para exercicios de musculacao', 
       (SELECT id FROM tipo_equipamento WHERE tipo = 'musculacao'));
-- Inserir grupo muscular
INSERT INTO grupo_muscular (nome) VALUES ('pernas'), ('ombro'), ('costas'), ('peito'), ('triceps'), ('biceps');


-- inserir exercicios
INSERT INTO exercicio (nome, id_grupo_muscular, id_equipamento)
VALUE ('Agachamento Smith', (SELECT id FROM grupo_muscular WHERE nome = 'pernas'), (SELECT id FROM equipamento WHERE descricao = 'Smith'));
INSERT INTO exercicio (nome, id_grupo_muscular, id_equipamento)
VALUE ('Levantamento Terra', (SELECT id FROM grupo_muscular WHERE nome = 'costas'), (SELECT id FROM equipamento WHERE descricao = 'Halteres'));
INSERT INTO exercicio (nome, id_grupo_muscular, id_equipamento)
VALUE ('Desenvolvimento de Ombros', (SELECT id FROM grupo_muscular WHERE nome = 'ombro'), (SELECT id FROM equipamento WHERE descricao = 'Halteres'));
INSERT INTO exercicio (nome, id_grupo_muscular, id_equipamento)
VALUE ('Supino Reto', (SELECT id FROM grupo_muscular WHERE nome = 'peito'), (SELECT id FROM equipamento WHERE descricao = 'Smith'));
INSERT INTO exercicio (nome, id_grupo_muscular, id_equipamento)
VALUE ('Triceps Pulley', (SELECT id FROM grupo_muscular WHERE nome = 'triceps'), (SELECT id FROM equipamento WHERE descricao = 'Polia'));
INSERT INTO exercicio (nome, id_grupo_muscular, id_equipamento)
VALUE ('Rosca Direta', (SELECT id FROM grupo_muscular WHERE nome = 'biceps'), (SELECT id FROM equipamento WHERE descricao = 'Halteres'));
INSERT INTO exercicio (nome, id_grupo_muscular, id_equipamento)
VALUE ('Corrida na Passadeira', (SELECT id FROM grupo_muscular WHERE nome = 'pernas'), (SELECT id FROM equipamento WHERE descricao = 'Passadeira'));
INSERT INTO exercicio (nome, id_grupo_muscular, id_equipamento)
VALUE ('Puxada Alta', (SELECT id FROM grupo_muscular WHERE nome = 'costas'), (SELECT id FROM equipamento WHERE descricao = 'Polia'));
INSERT INTO exercicio (nome, id_grupo_muscular, id_equipamento)
VALUE ('Elevacao Lateral', (SELECT id FROM grupo_muscular WHERE nome = 'ombro'), (SELECT id FROM equipamento WHERE descricao = 'Halteres'));
INSERT INTO exercicio (nome, id_grupo_muscular, id_equipamento)
VALUE('Triceps na Polia', (SELECT id FROM grupo_muscular WHERE nome = 'triceps'), (SELECT id FROM equipamento WHERE descricao = 'Polia'));
INSERT INTO exercicio (nome, id_grupo_muscular, id_equipamento)
VALUE('Flexao de Bracos', (SELECT id FROM grupo_muscular WHERE nome = 'peito'), (SELECT id FROM equipamento WHERE descricao = 'Polia'));
INSERT INTO exercicio (nome, id_grupo_muscular, id_equipamento)
VALUE ('Rosca Martelo', (SELECT id FROM grupo_muscular WHERE nome = 'biceps'), (SELECT id FROM equipamento WHERE descricao = 'Halteres'));



-- Inserir um plano de treino
INSERT INTO plano_treino (data, id_cliente, id_fisiologista)
VALUES (NOW(), (SELECT id FROM utilizador WHERE nome = 'Brigham Baldam'), (SELECT id FROM utilizador WHERE nome = 'Coop Schutter'));
INSERT INTO plano_treino (data, id_cliente, id_fisiologista)
VALUES (NOW(), (SELECT id FROM utilizador WHERE nome = 'Forest Drewet'), (SELECT id FROM utilizador WHERE nome = 'Coop Schutter'));
INSERT INTO plano_treino (data, id_cliente, id_fisiologista)
VALUES (NOW(), (SELECT id FROM utilizador WHERE nome = 'Gabrila Windle'), (SELECT id FROM utilizador WHERE nome = 'Coop Schutter'));
INSERT INTO plano_treino (data, id_cliente, id_fisiologista)
VALUES (NOW(), (SELECT id FROM utilizador WHERE nome = 'Marlena Stuchbury'), (SELECT id FROM utilizador WHERE nome = 'Coop Schutter'));
INSERT INTO plano_treino (data, id_cliente, id_fisiologista)
VALUES (NOW(), (SELECT id FROM utilizador WHERE nome = 'Tammie Ketcher'), (SELECT id FROM utilizador WHERE nome = 'Coop Schutter'));
INSERT INTO plano_treino (data, id_cliente, id_fisiologista)
VALUES (NOW(), (SELECT id FROM utilizador WHERE nome = 'Kerwin Najara'), (SELECT id FROM utilizador WHERE nome = 'Coop Schutter'));
INSERT INTO plano_treino (data, id_cliente, id_fisiologista)
VALUES (NOW(), (SELECT id FROM utilizador WHERE nome = 'Lucky Hurcombe'), (SELECT id FROM utilizador WHERE nome = 'Coop Schutter'));
INSERT INTO plano_treino (data, id_cliente, id_fisiologista)
VALUES (NOW(), (SELECT id FROM utilizador WHERE nome = 'Westley Sigge'), (SELECT id FROM utilizador WHERE nome = 'Coop Schutter'));
INSERT INTO plano_treino (data, id_cliente, id_fisiologista)
VALUES (NOW(), (SELECT id FROM utilizador WHERE nome = 'Eydie Huntly'), (SELECT id FROM utilizador WHERE nome = 'Coop Schutter'));
INSERT INTO plano_treino (data, id_cliente, id_fisiologista)
VALUES (NOW(), (SELECT id FROM utilizador WHERE nome = 'Marie-ann Acarson'), (SELECT id FROM utilizador WHERE nome = 'Coop Schutter'));
INSERT INTO plano_treino (data, id_cliente, id_fisiologista)
VALUES (NOW(), (SELECT id FROM utilizador WHERE nome = 'Burnard Dightham'), (SELECT id FROM utilizador WHERE nome = 'Coop Schutter'));
INSERT INTO plano_treino (data, id_cliente, id_fisiologista)
VALUES (NOW(), (SELECT id FROM utilizador WHERE nome = 'Agata Gabey'), (SELECT id FROM utilizador WHERE nome = 'Coop Schutter'));
INSERT INTO plano_treino (data, id_cliente, id_fisiologista)
VALUES (NOW(), (SELECT id FROM utilizador WHERE nome = 'Duffie Dowry'), (SELECT id FROM utilizador WHERE nome = 'Coop Schutter'));
INSERT INTO plano_treino (data, id_cliente, id_fisiologista)
VALUES (NOW(), (SELECT id FROM utilizador WHERE nome = 'Tadeas Craghead'), (SELECT id FROM utilizador WHERE nome = 'Coop Schutter'));
INSERT INTO plano_treino (data, id_cliente, id_fisiologista)
VALUES (NOW(), (SELECT id FROM utilizador WHERE nome = 'Holly Annand'), (SELECT id FROM utilizador WHERE nome = 'Coop Schutter'));
INSERT INTO plano_treino (data, id_cliente, id_fisiologista)
VALUES (NOW(), (SELECT id FROM utilizador WHERE nome = 'Aubine Klehyn'), (SELECT id FROM utilizador WHERE nome = 'Coop Schutter'));
INSERT INTO plano_treino (data, id_cliente, id_fisiologista)
VALUES (NOW(), (SELECT id FROM utilizador WHERE nome = 'Bobbi Apted'), (SELECT id FROM utilizador WHERE nome = 'Coop Schutter'));
INSERT INTO plano_treino (data, id_cliente, id_fisiologista)
VALUES (NOW(), (SELECT id FROM utilizador WHERE nome = 'Debbi Brok'), (SELECT id FROM utilizador WHERE nome = 'Coop Schutter'));
INSERT INTO plano_treino (data, id_cliente, id_fisiologista)
VALUES (NOW(), (SELECT id FROM utilizador WHERE nome = 'Rickard Devers'), (SELECT id FROM utilizador WHERE nome = 'Coop Schutter'));
INSERT INTO plano_treino (data, id_cliente, id_fisiologista)
VALUES (NOW(), (SELECT id FROM utilizador WHERE nome = 'Kendall Baytrop'), (SELECT id FROM utilizador WHERE nome = 'Coop Schutter'));
INSERT INTO plano_treino (data, id_cliente, id_fisiologista)
VALUES (NOW(), (SELECT id FROM utilizador WHERE nome = 'Loy Pryer'), (SELECT id FROM utilizador WHERE nome = 'Coop Schutter'));
INSERT INTO plano_treino (data, id_cliente, id_fisiologista)
VALUES (NOW(), (SELECT id FROM utilizador WHERE nome = 'Harli Griggs'), (SELECT id FROM utilizador WHERE nome = 'Coop Schutter'));
INSERT INTO plano_treino (data, id_cliente, id_fisiologista)
VALUES (NOW(), (SELECT id FROM utilizador WHERE nome = 'Vachel McKeefry'), (SELECT id FROM utilizador WHERE nome = 'Coop Schutter'));
INSERT INTO plano_treino (data, id_cliente, id_fisiologista)
VALUES (NOW(), (SELECT id FROM utilizador WHERE nome = 'Clayborne Wrightem'), (SELECT id FROM utilizador WHERE nome = 'Coop Schutter'));
INSERT INTO plano_treino (data, id_cliente, id_fisiologista)
VALUES (NOW(), (SELECT id FROM utilizador WHERE nome = 'Vittorio Clelland'), (SELECT id FROM utilizador WHERE nome = 'Coop Schutter'));
INSERT INTO plano_treino (data, id_cliente, id_fisiologista)
VALUES (NOW(), (SELECT id FROM utilizador WHERE nome = 'Kip Eakley'), (SELECT id FROM utilizador WHERE nome = 'Coop Schutter'));
INSERT INTO plano_treino (data, id_cliente, id_fisiologista)
VALUES (NOW(), (SELECT id FROM utilizador WHERE nome = 'Jo-anne Paula'), (SELECT id FROM utilizador WHERE nome = 'Coop Schutter'));
INSERT INTO plano_treino (data, id_cliente, id_fisiologista)
VALUES (NOW(), (SELECT id FROM utilizador WHERE nome = 'Marlow Lucks'), (SELECT id FROM utilizador WHERE nome = 'Coop Schutter'));
-- 30

-- Inserir execução
INSERT INTO execucao (series, repeticoes, carga_kg, tempo_duracao, tempo_descanso, id_exercicio) 
VALUES (3, 12, 50, 30, 90, (SELECT id FROM exercicio WHERE nome = 'Supino Reto'));
INSERT INTO execucao (series, repeticoes, carga_kg, tempo_duracao, tempo_descanso, id_exercicio) 
VALUES (3, 16, 50, 30, 90, (SELECT id FROM exercicio WHERE nome = 'Desenvolvimento de Ombros'));
INSERT INTO execucao (series, repeticoes, carga_kg, tempo_duracao, tempo_descanso, id_exercicio) 
VALUES (3, 17, 50, 30, 90, (SELECT id FROM exercicio WHERE nome = 'Corrida na Passadeira'));

-- Inserir plano_treino_execucao
INSERT INTO plano_treino_execucao (id_plano_treino, id_execucao) 
VALUES (
    (SELECT id FROM plano_treino WHERE id_cliente = (SELECT id FROM utilizador WHERE nome = 'Brigham Baldam')), 
    (SELECT id FROM execucao WHERE id_exercicio = (SELECT id FROM exercicio WHERE nome = 'Supino Reto'))
);

INSERT INTO plano_treino_execucao (id_plano_treino, id_execucao) 
VALUES (
    (SELECT id FROM plano_treino WHERE id_cliente = (SELECT id FROM utilizador WHERE nome = 'Forest Drewet')), 
    (SELECT id FROM execucao WHERE id_exercicio = (SELECT id FROM exercicio WHERE nome = 'Desenvolvimento de Ombros'))
);

INSERT INTO plano_treino_execucao (id_plano_treino, id_execucao) 
VALUES (
    (SELECT id FROM plano_treino WHERE id_cliente = (SELECT id FROM utilizador WHERE nome = 'Gabrila Windle')), 
    (SELECT id FROM execucao WHERE id_exercicio = (SELECT id FROM exercicio WHERE nome = 'Corrida na Passadeira'))
);





