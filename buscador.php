<?php
include 'conexao.php';  // Inclui o arquivo de conexão com o banco de dados

// Inicializa a variável de resultados e a variável de consulta
$resultados = [];
$query = "";

if (isset($_GET['query'])) {  // Verifica se a palavra-chave foi enviada
    $query = $_GET['query'];  // Obtém a palavra-chave da URL

    // Prepara a consulta SQL para buscar registros que contenham a palavra-chave
    $stmt = $conn->prepare("SELECT * FROM equipamentos WHERE Cliente_CPF LIKE ? OR Funcionario_Matricula LIKE ? OR Descrição LIKE ? OR Tipo LIKE ? OR Mac LIKE ? OR IP LIKE ?");
    
    if ($stmt === false) {
        die("Erro na preparação da consulta: " . $conn->error);
    }
    
    // Prepara a palavra-chave com os caracteres curinga
    $likeQuery = "%$query%";
    
    // Vincula a palavra-chave a todos os parâmetros da consulta
    if (!$stmt->bind_param("ssssss", $likeQuery, $likeQuery, $likeQuery, $likeQuery, $likeQuery, $likeQuery)) {
        die("Erro na vinculação dos parâmetros: " . $stmt->error);
    }
    
    // Executa a consulta
    if (!$stmt->execute()) {
        die("Erro na execução da consulta: " . $stmt->error);
    }
    
    // Obtém os resultados da consulta
    $result = $stmt->get_result();
    if ($result === false) {
        die("Erro ao obter os resultados: " . $stmt->error);
    }
    $resultados = $result->fetch_all(MYSQLI_ASSOC);
}

// Retorna os resultados como JSON
header('Content-Type: application/json');
echo json_encode(['query' => $query, 'resultados' => $resultados]);
?>
