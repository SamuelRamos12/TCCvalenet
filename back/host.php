<?php
require_once 'conexao.php';

$sql = "SELECT link1 FROM links_principais LIMIT 1";  // Ajuste o LIMIT se você deseja pegar apenas um link
$resultado = $conn->query($sql);

$link = '';

if($resultado->num_rows > 0) {
    $row = $resultado->fetch_assoc();
    $link = $row['link1'];
}

$conn->close();

echo json_encode(array('link' => $link));
?>