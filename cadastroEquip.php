<?php
include 'conexão.php';
// Função para inserir um novo equipamento na tabela equipamentos
function inserirEquipamento($IP, $mac, $tipo, $descrição, $cpf, $conn){
    $sql = "INSERT INTO Equipamentos(IP, Mac, Tipo, Descrição, Cliente_CPF) VALUES ('$IP', '$mac', '$tipo', '$descrição', '$cpf')";
    if(mysqli_query($conn, $sql)){
        return mysqli_insert_id($conn); // Retorna o ID do equipamento inserido.
    } else{
        echo "Erro ao cadastrar o equipamento: " . mysqli_error($conn);
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
        echo "Equipamento cadastrado com sucesso! IP: " . $IP    ;
    }
}

mysqli_close($conn);
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

            <form action="cadastro.php" method="post">
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
                <button type="submit" value="Registrar"> Cadastrar</button>
            
            </form>

        </div>
       
    </div>
    
</body>
</html>
