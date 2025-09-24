<?php

namespace App\Controller;

use App\Model\User;
use App\Model\Produto;
use App\Model\Venda;
use App\Model\ItemVenda;
use App\Core\Database;


class VendaController
{
    private function verificarAutenticacao()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /index.php?controller=user&action=login");
            exit();
        }
    }

    public function criar()
    {
        $this->verificarAutenticacao();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $em = Database::getEntityManager();
            $data = $_POST['produtos'] ?? [];

            $user = $em->getRepository(User::class)->find(1);

            if (!$user) {
                $user = new User("alexandre23", password_hash("123456", PASSWORD_DEFAULT));
                $user->setName("alexandre23");
                $user->setPassword(password_hash("123456", PASSWORD_DEFAULT));
                $em->persist($user);
                $em->flush();
            }

            $venda = new Venda($user);
            $totalVenda = 0;

            foreach ($data as $produtoId => $quantidade) {
                if ($quantidade > 0) {
                    $produto = $em->getRepository(Produto::class)->find($produtoId);

                    if ($produto) {
                        $itemVenda = new ItemVenda($venda, $produto, $quantidade);
                        $totalItem = $produto->getValorvenda() * $quantidade;
                        $totalVenda += $totalItem;
                        $em->persist($itemVenda);
                    }
                }
            }

            if ($totalVenda > 0) {
                $venda->setTotal($totalVenda);
                $em->persist($venda);
                $em->flush();
                header("Location: /index.php?controller=venda&action=listar");
                exit();
            } else {
                echo "Nenhum produto foi selecionado para a venda.";
            }
        } else {
            echo "Acesso inválido. Use um formulário POST para criar uma venda.";
        }
    }

    public function index()
    {
        $this->verificarAutenticacao();

        $em = Database::getEntityManager();
        $produtos = $em->getRepository(Produto::class)->findAll();

        $content_view = __DIR__ . '/../View/vendas.phtml';

        require_once __DIR__ . '/../View/layout.phtml';
    }

    public function listar()
    {
        $this->verificarAutenticacao();

        $em = Database::getEntityManager();
        $vendas = $em->getRepository(Venda::class)->findAll();

        $content_view = __DIR__ . '/../View/vendas_lista.phtml';

        require_once __DIR__ . '/../View/layout.phtml';
    }

    public function detalhes()
    {
        $this->verificarAutenticacao();

        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            http_response_code(404);
            echo "ID da venda não encontrado.";
            exit();
        }

        $vendaId = $_GET['id'];
        $em = Database::getEntityManager();

        $venda = $em->getRepository(Venda::class)->find($vendaId);

        if (!$venda) {
            http_response_code(404);
            echo "Venda não encontrada.";
            exit();
        }

        $content_view = __DIR__ . '/../View/venda_detalhe.phtml';
        require_once __DIR__ . '/../View/layout.phtml';
    }
}
