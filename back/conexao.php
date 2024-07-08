<?php
$servername = "localhost";  // Nome do servidor
$username = "root";   // Usuário do banco de dados
$password = "21009";     // Senha do banco de dados
$dbname = "TCC"; // Nome do banco de dados

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
$conn->set_charset("utf8");
?>