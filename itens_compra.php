<?php
$host = 'localhost';
$db   = 'lojinha';
$user = 'postgres';
$pass = '123';

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$db;", $user, $pass);
    
    $sql = "INSERT INTO public.itens_compra(pedido_id, produto_id, quantidade, preco_unitario)
	            VALUES (:ic_pedido_id, :ic_produto_id, :ic_quantidade, :ic_preco)";
    $stmt = $pdo->prepare($sql);

    $pedido_id = $_POST[':ic_pedido_id'];
    $produto_id = $_POST[':ic_produto_id'];
    $quantidade = $_POST[':ic_quant'];
    $preco_unitario = $_POST[':ic_preco'];
    

    $preco_unitario = str_replace(',', '.', $preco_unitario);

    if (!is_numeric($preco_unitario)){
        die("Você é um usuário do mal. Preço deve ser um número");
    }

    if (!is_numeric($quantidade)){
        die("Você é um usuário do mal. Quantidade deve ser um número");
    }


    $stmt->execute(
        [
            ':ic_pedido_id' => $pedido_id,
            ':ic_produto_id' => $produto_id,
            ':ic_quantidade' => $quantidade,
            ':ic_preco' => $preco_unitario
        ]
    );

    echo "Associação inserida com sucesso! com o ID: ". $pdo->lastInsertID();

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}