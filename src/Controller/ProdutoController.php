<?php

namespace App\Controller;

use App\Model\Produto;

class ProdutoController
{
    private function verificarAutenticacao()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /index.php?controller=user&action=login");
            exit();
        }
    }

    public function index()
    {
        $this->verificarAutenticacao(); 
        
        $produtos = Produto::findAll();

        $content_view = __DIR__ . '/../View/produtos.phtml';

        require_once __DIR__ . '/../View/layout.phtml';
    }

    public function adicionar()
    {
        $this->verificarAutenticacao(); 

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $categoria = $_POST['categoria'] ?? '';
            $valorcusto = $_POST['valorcusto'] ?? 0.0;
            $valorvenda = $_POST['valorvenda'] ?? 0.0;

            $produto = new Produto($name, $categoria, $valorcusto, $valorvenda);
            $produto->save();

            header('Location: /index.php?controller=produto&action=index');
            exit();
        }

        $content_view = __DIR__ . '/../View/adicionar_produto.phtml';
        require_once __DIR__ . '/../View/layout.phtml';

    }
}