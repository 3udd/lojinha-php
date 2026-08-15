<?php
$host = 'localhost';
$db   = 'lojinha';
$user = 'postgres';
$pass = '123';

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$db;", $user, $pass);
    
    $sql = "INSERT INTO public.clientes(nome_cliente, email, cidade)
	            VALUES (:cli_nome, :cli_email, :cli_cidade)";
    $stmt = $pdo->prepare($sql);

    $nome = $_POST[':cli_nome'];
    $email = $_POST[':cli_email'];
    $cidade = $_POST[':cli_cidade'];

    $stmt->execute(
        [
            ':cli_nome' => $nome,
            ':cli_email' => $email,
            ':cli_cidade' => $cidade
        ]
    );

    echo "Cliente inserido com sucesso! com o ID: ". $pdo->lastInsertID();

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}