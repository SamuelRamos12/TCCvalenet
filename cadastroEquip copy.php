<?php
include 'conexão.php';

// Função para inserir um novo equipamento na tabela equipamentos usando PDO
function inserirEquipamento($IP, $mac, $tipo, $descrição, $cpf, $conn) {
    $sql = "INSERT INTO Equipamentos(IP, Mac, Tipo, Descrição, Cliente_CPF) VALUES (:IP, :mac, :tipo, :descrição, :cpf)";
    $stmt = $conn->prepare($sql);
    
    // Bind dos parâmetros
    $stmt->bindParam(':IP', $IP);
    $stmt->bindParam(':mac', $mac);
    $stmt->bindParam(':tipo', $tipo);
    $stmt->bindParam(':descrição', $descrição);
    $stmt->bindParam(':cpf', $cpf);
    
    // Tenta executar a query e retorna o ID inserido, ou false em caso de erro
    if ($stmt->execute()) {
        return $conn->lastInsertId(); // Retorna o ID do equipamento inserido
    } else {
        echo "Erro ao cadastrar o equipamento: " . implode(" - ", $stmt->errorInfo());
        return false;
    }
}

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $IP = $_POST['IP'];
    $mac = $_POST['Mac'];
    $tipo = $_POST['Tipo'];
    $descrição = $_POST['Descrição'];
    $cpf = $_POST['Cliente_CPF'];

    // Insere o equipamento na tabela Equipamentos
    $IPEquipamento = inserirEquipamento($IP, $mac, $tipo, $descrição, $cpf, $conn);

    // Se o equipamento foi inserido com sucesso, insere um registro
    if ($IPEquipamento !== false) {
        echo "Equipamento cadastrado com sucesso! IP: " . htmlspecialchars($IP);
    }
}

// Não há necessidade de fechar a conexão com PDO
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Registro</title>
</head>
<body>
    <div class="painel">
        <div class="form"> <h1>REGISTRE-SE</h1>
            <form action="cadastroEquip.php" method="post">
                <div class="titulo">
                    <h1>Realize o Cadastro</h1>
                </div>
                <div class="card">
                    <label for="IP">IP</label>
                    <input id="IP" type="text" name="IP" placeholder="Digite o IP do equipamento aqui!" required>
                    
                    <label for="Mac">Mac</label>
                    <input id="Mac" type="text" name="Mac" placeholder="Digite o MAC aqui!" required>
    
                    <label for="Tipo">Tipo</label>
                    <input id="Tipo" type="text" name="Tipo" placeholder="Digite o tipo de equipamento (versão e informações extras sobre o equipamento)!" required>
    
                    <label for="Descrição">Descrição</label>
                    <input id="Descrição" type="text" name="Descrição" placeholder="Descreva a função do equipamento" required>
    
                    <label for="Cliente_CPF">Cliente_CPF</label>
                    <input id="Cliente_CPF" type="text" name="Cliente_CPF" placeholder="Digite o CPF do titular/Cliente" required>
                </div>
                <button type="submit" value="Registrar">Cadastrar</button>
            </form>
        </div>
    </div>
</body>
</html>
