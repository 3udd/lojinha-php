<?php
// 1. Configurações do Banco de Dados
$host = 'localhost';
$db   = 'lojinha';
$user = 'postgre';
$pass = '123';

try {
    // 2. Conexão com o Banco de Dados
    $pdo = new PDO("pgsql:host=$host;dbname=$db;", $user, $pass);
    

    // 4. Preparar a query SQL (com placeholders ':' para segurança)
    $sql = "INSERT INTO produto (nome, preco) 
                VALUES (:nome_prod, :preco_prod)";
    $stmt = $pdo->prepare($sql);

    // 5. Executar passando os dados reais
    $stmt->execute($_POST);

    echo "Dados inseridos com sucesso! com o ID: ". 
            $pdo->lastInsertID();

} catch (PDOException $e) {
    // Caso dê algum erro na conexão ou na query
    echo "Erro: " . $e->getMessage();
}