<?php
include 'conexão.php';

// Função para inserir um novo equipamento na tabela equipamentos associado a um cliente
function inserirEquipamentoCliente($IP, $mac, $tipo, $descrição, $cpf, $conn){
    $sql = "INSERT INTO Equipamentos(IP, Mac, Tipo, Descrição, Cliente_CPF) VALUES ('$IP', '$mac', '$tipo', '$descrição', '$cpf')";
    if(mysqli_query($conn, $sql)){
        return mysqli_insert_id($conn); // Retorna o ID do equipamento inserido.
    } else{
        echo "Erro ao cadastrar o equipamento: " . mysqli_error($conn);
        return false;
    }
}

// Função para inserir um novo equipamento na tabela equipamentos associado a um funcionário
function inserirEquipamentoFuncionario($IP, $mac, $tipo, $descrição, $matricula, $conn){
    $sql = "INSERT INTO Equipamentos(IP, Mac, Tipo, Descrição, Funcionario_Matricula) VALUES ('$IP', '$mac', '$tipo', '$descrição', '$matricula')";
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

    if(isset($_POST['tipo_usuario'])) {
        if($_POST['tipo_usuario'] === "cliente") {
            $cpf = $_POST['Cliente_CPF'];
            // Insere o equipamento na tabela Equipamentos associado a um cliente
            $IPEquipamento = inserirEquipamentoCliente($IP, $mac, $tipo, $descrição, $cpf, $conn);
        } elseif($_POST['tipo_usuario'] === "funcionario") {
            $matricula = $_POST['Funcionario_Matricula'];
            // Insere o equipamento na tabela Equipamentos associado a um funcionário
            $IPEquipamento = inserirEquipamentoFuncionario($IP, $mac, $tipo, $descrição, $matricula, $conn);
        }
    }

    // Se o equipamento foi inserido com sucesso, exibe uma mensagem
    if ($IPEquipamento !== false) {
        echo "Equipamento cadastrado com sucesso! IP: " . $IP;
    }
}

mysqli_close($conn);
?>
