<?php

// Verifica se os dados foram enviados via método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Pega os dados do formulário (nome de usuário e senha)
    // O nome 'usuario_teste' e 'senha' aqui são um exemplo.
    // Você precisa ajustar para o nome real dos campos no seu HTML
    $username = $_POST['nome_de_usuario']; 
    $password = $_POST['senha'];

    // Agora, você pode fazer a verificação.
    // Este é um exemplo simples para fins de demonstração.
    // NUNCA use senhas em texto puro em um sistema real!
    if ($username === 'usuario_teste' && $password === '12345') {
        echo "Login bem-sucedido!";
        // Aqui você pode redirecionar o usuário para outra página
        // Por exemplo: header("Location: dashboard.php");
    } else {
        echo "Usuário ou senha incorretos.";
    }
} else {
    // Se a requisição não for POST, redireciona de volta para o login
    header("Location: index.php");
}

?>