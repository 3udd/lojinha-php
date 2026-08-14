<?php
$host = 'localhost';
$db   = 'lojinha';
$user = 'postgres';
$pass = '123';

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$db;", $user, $pass);
    
    $sql = "INSERT INTO public.produtos(nome_produto, preco, estoque, marca_id)
	        VALUES (:prod_nome, :prod_preco, :prod_estoque, :prod_marca_id)";
    $stmt = $pdo->prepare($sql);

    $nome = $_POST[':prod_nome'];
    $preco = $_POST[':prod_preco'];
    $estoque = $_POST[':prod_estoque'];
    $marca_id = $_POST[':prod_marca_id'];


    $preco = str_replace(',', '.', $preco);

    if (!is_numeric($preco)){
        die("Você é um usuário do mal. Preço deve ser um número");
    }

    if (!is_numeric($estoque)){
        die("Você é um usuário do mal. Estoque deve ser um número");
    }


    $stmt->execute(
        [
            ':prod_nome' => $nome,
            ':prod_preco' => $preco,
            ':prod_estoque' => $estoque,
            ':prod_marca_id' => $marca_id
        ]
    );

    echo "Produto inserido com sucesso! com o ID: ". $pdo->lastInsertID();

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}