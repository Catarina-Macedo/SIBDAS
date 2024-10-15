CREATE DATABASE IF NOT EXISTS projeto;
USE projeto;

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
    id_equipamento CHAR(36) UNIQUE NOT NULL,
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


/*DROP TABLE IF EXISTS plano_treino_execucao;
DROP TABLE IF EXISTS plano_treino;
DROP TABLE IF EXISTS execucao;
DROP TABLE IF EXISTS exercicio;
DROP TABLE IF EXISTS grupo_muscular;
DROP TABLE IF EXISTS equipamento;
DROP TABLE IF EXISTS tipo_equipamento;
DROP TABLE IF EXISTS medida;
DROP TABLE IF EXISTS sinal;
DROP TABLE IF EXISTS funcao_utilizador;
DROP TABLE IF EXISTS utilizador;
DROP TABLE IF EXISTS funcao;



-- Queries
-- Mostrar o plano de treino, nome do cliente e exercicios
/*SELECT pt.id AS id_plano_treino,
       u.nome AS nome_cliente,
       e.nome AS nome_exercicio
FROM plano_treino pt
JOIN utilizador u ON pt.id_cliente = u.id
JOIN plano_treino_exercicio pte ON pt.id = pte.id_plano_treino
JOIN exercicio e ON pte.id_exercicio = e.id;

-- saber o id do plano de treino de cada cliente
SELECT u.nome AS nome_cliente, pt.id AS id_plano_treino
FROM utilizador u
LEFT JOIN plano_treino pt ON u.id = pt.id_cliente;

-- saber os clientes sem planos atribuidos
SELECT u.nome AS nome_cliente
FROM utilizador u
LEFT JOIN plano_treino pt ON u.id = pt.id_cliente
WHERE pt.id IS NULL;

-- saber os clientes com planos atribuidos
SELECT u.nome AS nome_cliente
FROM utilizador u
LEFT JOIN plano_treino pt ON u.id = pt.id_cliente
WHERE pt.id IS NOT NULL;

-- selecionar todos os exercicios de um plano de treino
SELECT pt.id AS id_plano_treino, e.nome AS nome_exercicio
FROM plano_treino pt
INNER JOIN plano_treino_exercicio pte ON pt.id = pte.id_plano_treino
INNER JOIN exercicio e ON pte.id_exercicio = e.id;

-- Selecionar os sinais de cada cliente pelo mais recente
SELECT s1.id, s1.spo2, s1.freq_card, s1.press_art_min, s1.press_art_max, s1.data, u.nome AS nome_cliente
FROM sinal s1
JOIN utilizador u ON s1.id_cliente = u.id
LEFT JOIN sinal s2 ON s1.id_cliente = s2.id_cliente AND s1.data < s2.data
WHERE s2.id IS NULL;

-- Selecionar as medidas de cada cliente pelo mais recente
SELECT m1.id, m1.percentagem_massa_gorda, m1.imc, m1.peso, m1.altura, m1.data, u.nome AS nome_cliente
FROM medida m1
JOIN utilizador u ON m1.id_cliente = u.id
LEFT JOIN medida m2 ON m1.id_cliente = m2.id_cliente AND m1.data < m2.data
WHERE m2.id IS NULL;

-- Visualizar os planos de treino e ver à quanto tempo foram realizados
SELECT pt.id AS id_plano_treino, u.nome AS nome_cliente, DATEDIFF(CURDATE(), pt.data) AS dias_atribuido
FROM plano_treino pt
JOIN utilizador u ON pt.id_cliente = u.id;

-- Mostrar os detalhes de um exercício específico, incluindo o grupo muscular e o equipamento utilizado:
SELECT e.nome AS nome_exercicio, gm.nome AS grupo_muscular, te.tipo AS tipo_equipamento
FROM exercicio e
JOIN grupo_muscular gm ON e.id_grupo_muscular = gm.id
JOIN equipamento eq ON e.id_equipamento = eq.id
JOIN tipo_equipamento te ON eq.id_tipo = te.id
WHERE e.id = '31e77859-ff6a-11ee-b1a1-fc3fdb8fa140'; 

-- média do IMC de um determinado utilizador 
SELECT AVG(imc) AS media_imc
FROM medida
WHERE id_cliente = '31757fec-ff6a-11ee-b1a1-fc3fdb8fa140';*/






agentsagentsmedidaexercicio