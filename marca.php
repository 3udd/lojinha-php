<?php
$host = 'localhost';
$db   = 'lojinha';
$user = 'postgres';
$pass = '123';

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$db;", $user, $pass);
    
    $sql = "INSERT INTO public.marcas(nome_marca, pais_origem)
	            VALUES (:mar_nome, :mar_pais)";
    $stmt = $pdo->prepare($sql);

    $nome = $_POST[':mar_nome'];
    $pais = $_POST[':mar_pais'];

    $stmt->execute(
        [
            ':mar_nome' => $nome,
            ':mar_pais' => $pais
        ]
    );

    echo "Marca inserida com sucesso! com o ID: ". $pdo->lastInsertID();

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}