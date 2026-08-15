<?php
$host = 'localhost';
$db   = 'lojinha';
$user = 'postgres';
$pass = '123';

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$db;", $user, $pass);
    
    $sql = "INSERT INTO public.pedidos(cliente_id, data_pedido, status_pedido)
	            VALUES (:ped_cliente_id, :ped_data, :ped_status)";
    $stmt = $pdo->prepare($sql);

    $cliente_id = $_POST[':ped_cliente_id'];
    $data_pedido = $_POST[':ped_data'];
    $status = $_POST[':ped_status'];

    $stmt->execute(
        [
            ':ped_cliente_id' => $cliente_id,
            ':ped_data' => $data_pedido,
            ':ped_status' => $status
        ]
    );

    echo "Pedido inserido com sucesso! com o ID: ". $pdo->lastInsertID();

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}