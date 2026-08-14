<?php
// 1. Configurações do Banco de Dados
$host = 'localhost';
$db   = 'lojinha';
$user = 'postgres';
$pass = '123';

try {
    // 2. Conexão com o Banco de Dados
    $pdo = new PDO("pgsql:host=$host;dbname=$db;", $user, $pass);
    

    // 4. Preparar a query SQL (com placeholders ':' para segurança)
    $sql = "INSERT INTO public.produtos(nome_produto, preco, estoque, marca_id)
	        VALUES (:prod_nome, :prod_preco, :prod_estoque, :prod_marca_id)";
    $stmt = $pdo->prepare($sql);

    //Etapa de barreira de dados
    //Que os jogos comecem

    $nome = $_POST[':prod_nome'];
    $preco = $_POST[':prod_preco'];
    $estoque = $_POST[':prod_estoque'];
    $marca_id = $_POST[':prod_marca_id'];

    //
    $preco = str_replace(',', '.', $preco);

    if (!is_numeric($preco)){
        die("Você é um usuário do mal");
    }

    // 5. Executar passando os dados reais
    $stmt->execute(
        [
            ':prod_nome' => $nome,
            ':prod_preco' => $preco,
            ':prod_estoque' => $estoque,
            ':prod_marca_id' => $marca_id
        ]
    );

    echo "Dados inseridos com sucesso! com o ID: ". 
            $pdo->lastInsertID();

} catch (PDOException $e) {
    // Caso dê algum erro na conexão ou na query
    echo "Erro: " . $e->getMessage();
}