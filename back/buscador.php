<?php
include 'conexao.php';  // Inclui o arquivo de conexão com o banco de dados

// Inicializa a variável de resultados e a variável de consulta
$resultados = [];
$query = "";

if (isset($_GET['query'])) {  // Verifica se a palavra-chave foi enviada
    $query = $_GET['query'];  // Obtém a palavra-chave da URL

    // Define a consulta SQL baseada no tipo de query
    if (preg_match('/^\d{11}$/', $query)) {
        // Query parece um CPF (11 dígitos)
        $stmt = $conn->prepare("SELECT * FROM equipamentos WHERE Cliente_CPF = ?");
    } elseif (preg_match('/^\d+$/', $query)) {
        // Query parece uma matrícula (somente dígitos)
        $stmt = $conn->prepare("SELECT * FROM equipamentos WHERE Funcionario_Matricula = ?");
    } else {
        // Assume que a query é o tipo de equipamento
        $stmt = $conn->prepare("SELECT * FROM equipamentos WHERE Tipo = ?");
    }
    
    if ($stmt === false) {
        die("Erro na preparação da consulta: " . $conn->error);
    }
    
    // Vincula a palavra-chave ao parâmetro da consulta
    if (!$stmt->bind_param("s", $query)) {
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
