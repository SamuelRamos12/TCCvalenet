<?php
$servername = "localhost";  // Nome do servidor
$username = "root";   // Usuário do banco de dados
$password = "21009";     // Senha do banco de dados
$dbname = "TCC"; // Nome do banco de dados

try {
    // Tenta criar uma nova conexão PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Configura o PDO para lançar exceções em caso de erro
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // Exibe uma mensagem de erro caso a conexão falhe
    echo "Connection failed: " . $e->getMessage();
    die();  // Encerra o script em caso de falha na conexão
}
?>