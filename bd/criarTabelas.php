<?php
$servidor = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'bdMuseu';

try 
{
    $dsn = "mysql:host=$servidor;dbname=$banco;charset=utf8"; 
    $conexao = new PDO($dsn, $usuario, $senha);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Criar tabela admin
    $sql = "
        CREATE TABLE IF NOT EXISTS admin (
            id INT AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(100) NOT NULL UNIQUE,
            senha VARCHAR(255) NOT NULL
        );
    ";
    $conexao->exec($sql);
    echo "Tabela 'admin' criada com sucesso (ou já existia).<br>";

    // Criar tabela membro
    $sql = "
        CREATE TABLE IF NOT EXISTS membro (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nome VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL UNIQUE,
            sobre TEXT,
            perfil ENUM('monitor(a)', 'professor(a)') NOT NULL
        );
    ";
    $conexao->exec($sql);
    echo "Tabela 'membro' criada com sucesso (ou já existia).<br>";

    // Criar tabela horario_funcionamento
    $sql = "
        CREATE TABLE IF NOT EXISTS horario_funcionamento (
            id INT AUTO_INCREMENT PRIMARY KEY,
            dia_semana VARCHAR(20) NOT NULL,
            horario_abertura TIME NOT NULL,
            horario_fechamento TIME NOT NULL
        );
    ";
    $conexao->exec($sql);
    echo "Tabela 'horario_funcionamento' criada com sucesso (ou já existia).<br>";

    // Criar tabela visita
    $sql = "
        CREATE TABLE IF NOT EXISTS visita (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nome_responsavel VARCHAR(100) NOT NULL,
            nome_escola VARCHAR(150) NOT NULL,
            dia_pretendido DATE NOT NULL,
            horario TIME NOT NULL,
            n_visitante INT NOT NULL,
            telefone VARCHAR(20) NOT NULL,
            email VARCHAR(100),
            faixa_etaria VARCHAR(50) NOT NULL
        );
    ";
    $conexao->exec($sql);
    echo "Tabela 'visita' criada com sucesso (ou já existia).<br>";

} catch (PDOException $e) {
    echo "Erro ao criar as tabelas: " . $e->getMessage();
}
?>
