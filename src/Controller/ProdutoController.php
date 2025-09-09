<?php

namespace App\Controller;

use App\Model\Produto;

class ProdutoController
{
    public function index()
    {
        // 1. Interagir com o Modelo (buscar dados)
        $produtos = Produto::findAll();

        // 2. Carregar a Visão e passar os dados
        require_once __DIR__ . '/../View/produtos.phtml';
    }

    public function adicionar()
    {
        // Verifica se a requisição foi um POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Pega os dados do formulário
            $name = $_POST['name'] ?? '';
            $categoria = $_POST['categoria'] ?? '';
            $valorcusto = $_POST['valorcusto'] ?? 0.0;
            $valorvenda = $_POST['valorvenda'] ?? 0.0;

            // Cria um novo objeto Produto (o nosso Modelo)
            $produto = new Produto($name, $categoria, $valorcusto, $valorvenda);

            // Chama o método save() para persistir no banco de dados
            $produto->save();

            // Redireciona para a página principal de produtos
            header('Location: /index.php?controller=produto&action=index');
            exit();
        }

        // Se a requisição não for POST, apenas exibe a página de adicionar produto
        require_once __DIR__ . '/../View/adicionar_produto.phtml';

    }
}