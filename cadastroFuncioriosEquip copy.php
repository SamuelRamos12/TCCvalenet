<?php
include 'conexão.php';

// Função para inserir um novo equipamento na tabela equipamentos usando PDO
function inserirEquipamento($IP, $mac, $tipo, $descrição, $Funcionario_Matricula, $conn) {
    $sql = "INSERT INTO Equipamentos (IP, Mac, Tipo, Descrição, Funcionario_Matricula) VALUES (:IP, :mac, :tipo, :descrição, :Funcionario_Matricula)";
    $stmt = $conn->prepare($sql);
    
    // Bind dos parâmetros
    $stmt->bindParam(':IP', $IP);
    $stmt->bindParam(':mac', $mac);
    $stmt->bindParam(':tipo', $tipo);
    $stmt->bindParam(':descrição', $descrição);
    $stmt->bindParam(':Funcionario_Matricula', $Funcionario_Matricula);
    
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
    $Funcionario_Matricula = $_POST['Funcionario_Matricula'];

    // Insere o equipamento na tabela Equipamentos
    $IPEquipamento = inserirEquipamento($IP, $mac, $tipo, $descrição, $Funcionario_Matricula, $conn);

    // Se o equipamento foi inserido com sucesso, insere um registro
    if ($IPEquipamento !== false) {
        echo "Equipamento cadastrado com sucesso! IP: " . htmlspecialchars($IP);
    }
}

// A conexão PDO não precisa ser fechada manualmente
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
            <form action="cadastroFuncioriosEquip.php" method="post">
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
    
                    <label for="Funcionario_Matricula">Funcionario_Matricula</label>
                    <input id="Funcionario_Matricula" type="text" name="Funcionario_Matricula" placeholder="Digite a matricula do funcionario" required>
                </div>
                <button type="submit" value="Registrar">Cadastrar</button>
            </form>
        </div>
    </div>
</body>
</html>
