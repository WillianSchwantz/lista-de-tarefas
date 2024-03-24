<?php

// Configurações do banco de dados
$host = 'localhost';
$user = 'seu_usuario';
$password = 'sua_senha';
$database = 'nome_do_banco';

// Conexão com o banco de dados
$conn = new mysqli($host, $user, $password, $database);

// Verifica se ocorreu algum erro na conexão
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Processa o envio do formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task = $_POST['task'];
    if (!empty($task)) {
        // Insere a tarefa no banco de dados
        $sql = "INSERT INTO tasks (name) VALUES ('$task')";
        if ($conn->query($sql) === TRUE) {
            // Redireciona para a página inicial após adicionar a tarefa
            header('Location: index.php');
            exit();
        } else {
            echo "Erro ao adicionar tarefa: " . $conn->error;
        }
    }
}

// Seleciona todas as tarefas do banco de dados
$sql = "SELECT * FROM tasks";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Exibe as tarefas
    while($row = $result->fetch_assoc()) {
        echo "<li>" . $row["name"] . "</li>";
    }
} else {
    echo "<li>Nenhuma tarefa encontrada</li>";
}

// Fecha a conexão com o banco de dados
$conn->close();

?>