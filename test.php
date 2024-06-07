<?php
include 'conexao.php';

// Inicializa variáveis
$resultados = [];
$query = "";
$mensagem = "";

// Função para inserir um novo equipamento na tabela equipamentos para clientes
function inserirEquipamentoCliente($IP, $mac, $tipo, $descricao, $cpf, $conn) {
    $sql = "INSERT INTO Equipamentos(IP, Mac, Tipo, Descricao, Cliente_CPF) VALUES ('$IP', '$mac', '$tipo', '$descricao', '$cpf')";
    if(mysqli_query($conn, $sql)) {
        return mysqli_insert_id($conn);
    } else {
        return "Erro ao cadastrar o equipamento: " . mysqli_error($conn);
    }
}

// Função para inserir um novo equipamento na tabela equipamentos para funcionários
function inserirEquipamentoFuncionario($IP, $mac, $tipo, $descricao, $matricula, $conn) {
    $sql = "INSERT INTO Equipamentos(IP, Mac, Tipo, Descricao, Funcionario_Matricula) VALUES ('$IP', '$mac', '$tipo', '$descricao', '$matricula')";
    if(mysqli_query($conn, $sql)) {
        return mysqli_insert_id($conn);
    } else {
        return "Erro ao cadastrar o equipamento: " . mysqli_error($conn);
    }
}

// Processa a busca
if (isset($_GET['action']) && $_GET['action'] == 'search') {
    if (isset($_GET['query'])) {
        $query = $_GET['query'];
        $stmt = $conn->prepare("SELECT * FROM equipamentos WHERE Cliente_CPF LIKE ? OR Funcionario_Matricula LIKE ? OR Descricao LIKE ? OR Tipo LIKE ? OR Mac LIKE ? OR IP LIKE ?");
        $likeQuery = "%$query%";
        $stmt->bind_param("ssssss", $likeQuery, $likeQuery, $likeQuery, $likeQuery, $likeQuery, $likeQuery);
        $stmt->execute();
        $result = $stmt->get_result();
        $resultados = $result->fetch_all(MYSQLI_ASSOC);
    }
}

// Processa o cadastro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $IP = $_POST['IP'];
    $mac = $_POST['Mac'];
    $tipo = $_POST['Tipo'];
    $descricao = $_POST['Descricao'];

    if (isset($_POST['Cliente_CPF'])) {
        $cpf = $_POST['Cliente_CPF'];
        $mensagem = inserirEquipamentoCliente($IP, $mac, $tipo, $descricao, $cpf, $conn);
    } elseif (isset($_POST['Funcionario_Matricula'])) {
        $matricula = $_POST['Funcionario_Matricula'];
        $mensagem = inserirEquipamentoFuncionario($IP, $mac, $tipo, $descricao, $matricula, $conn);
    }

    if (is_int($mensagem)) {
        $mensagem = "Equipamento cadastrado com sucesso! IP: " . $IP;
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Equipamentos</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <h1>Gerenciamento de Equipamentos</h1>
    <nav>
        <ul>
            <li><a href="unified.php?action=search">Buscador de Equipamentos</a></li>
            <li><a href="unified.php?action=register&target=client">Cadastro de Equipamentos para Clientes</a></li>
            <li><a href="unified.php?action=register&target=employee">Cadastro de Equipamentos para Funcionários</a></li>
        </ul>
    </nav>

    <?php if (isset($_GET['action']) && $_GET['action'] == 'search'): ?>
        <h2>Buscador de Equipamentos</h2>
        <form method="get" action="unified.php">
            <input type="hidden" name="action" value="search">
            <input type="text" name="query" placeholder="Digite a palavra-chave para buscar" value="<?php echo htmlspecialchars($query); ?>" required>
            <button type="submit">Buscar</button>
        </form>
        <h2>Resultados da Busca</h2>
        <?php if (!empty($resultados)): ?>
            <ul>
                <?php foreach ($resultados as $equipamento): ?>
                    <li>
                        <h3><?php echo htmlspecialchars($equipamento['Cliente_CPF'] ?? $equipamento['Funcionario_Matricula']); ?></h3>
                        <p><?php echo htmlspecialchars($equipamento['IP']); ?></p>
                        <p><?php echo htmlspecialchars($equipamento['Mac']); ?></p>
                        <p><?php echo htmlspecialchars($equipamento['Tipo']); ?></p>
                        <p><?php echo htmlspecialchars($equipamento['Descricao']); ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Nenhum resultado encontrado para "<?php echo htmlspecialchars($query); ?>"</p>
        <?php endif; ?>
    <?php elseif (isset($_GET['action']) && $_GET['action'] == 'register' && $_GET['target'] == 'client'): ?>
        <h2>Cadastro de Equipamentos para Clientes</h2>
        <form method="post" action="unified.php">
            <div class="card">
                <label for="IP">IP</label>
                <input id="IP" type="text" name="IP" placeholder="Digite o IP do equipamento aqui!" required>
                
                <label for="Mac">Mac</label>
                <input id="Mac" type="text" name="Mac" placeholder="Digite o MAC aqui!" required>

                <label for="Tipo">Tipo</label>
                <input id="Tipo" type="text" name="Tipo" placeholder="Digite o tipo de equipamento!" required>

                <label for="Descricao">Descricao</label>
                <input id="Descricao" type="text" name="Descricao" placeholder="Descreva a função do equipamento" required>

                <label for="Cliente_CPF">Cliente_CPF</label>
                <input id="Cliente_CPF" type="text" name="Cliente_CPF" placeholder="Digite o CPF do titular/Cliente" required>
            </div>
            <button type="submit">Cadastrar</button>
        </form>
        <?php if (!empty($mensagem)) echo "<p>$mensagem</p>"; ?>
    <?php elseif (isset($_GET['action']) && $_GET['action'] == 'register' && $_GET['target'] == 'employee'): ?>
        <h2>Cadastro de Equipamentos para Funcionários</h2>
        <form method="post" action="unified.php">
            <div class="card">
                <label for="IP">IP</label>
                <input id="IP" type="text" name="IP" placeholder="Digite o IP do equipamento aqui!" required>
                
                <label for="Mac">Mac</label>
                <input id="Mac" type="text" name="Mac" placeholder="Digite o MAC aqui!" required>

                <label for="Tipo">Tipo</label>
                <input id="Tipo" type="text" name="Tipo" placeholder="Digite o tipo de equipamento!" required>

                <label for="Descricao">Descricao</label>
                <input id="Descricao" type="text" name="Descricao" placeholder="Descreva a função do equipamento" required>

                <label for="Funcionario_Matricula">Funcionario_Matricula</label>
                <input id="Funcionario_Matricula" type="text" name="Funcionario_Matricula" placeholder="Digite a matrícula do funcionário" required>
            </div>
            <button type="submit">Cadastrar</button>
        </form>
        <?php if (!empty($mensagem)) echo "<p>$mensagem</p>"; ?>
    <?php endif; ?>
</body>
</html>