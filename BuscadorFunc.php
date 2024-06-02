<?php
include 'conexão.php';  // Inclui o arquivo de conexão com o banco de dados

// Inicializa a variável de resultados e a variável de consulta
$resultados = [];
$query = "";

if (isset($_GET['query'])) {  // Verifica se a palavra-chave foi enviada
    $query = $_GET['query'];  // Obtém a palavra-chave da URL

    // Prepara a consulta SQL para buscar registros que contenham a palavra-chave
    $stmt = $conn->prepare("SELECT * FROM equipamentos WHERE Funcionario_Matricula LIKE :query OR Descrição LIKE :query");
    // Executa a consulta com a palavra-chave
    $stmt->execute(['query' => "%$query%"]);

    // Obtém todos os resultados da consulta
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Buscador</title>
</head>
<body>
    <h1>Buscador de Equipamentos</h1>
    <form method="get" action="BuscadorFunc.php">
        <input type="text" name="query" placeholder="Digite a palavra-chave para buscar" value="<?php echo htmlspecialchars($query); ?>" required>
        <button type="submit">Buscar</button>
    </form>

    <h2>Resultados da Busca</h2>
    <?php if (!empty($resultados)): ?>
        <ul>
            <?php foreach ($resultados as $equipamento): ?>
                <li>
                    <h3><?php echo htmlspecialchars($equipamento['Funcionario_Matricula']); ?></h3>
                    <p><?php echo htmlspecialchars($equipamento['Descrição']); ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Nenhum resultado encontrado para "<?php echo htmlspecialchars($query); ?>"</p>
    <?php endif; ?>
</body>
</html>
