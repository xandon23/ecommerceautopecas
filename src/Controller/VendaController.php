<?php

namespace App\Controller;

use App\Model\User;
use App\Model\Produto;
use App\Model\Venda;
use App\Model\ItemVenda;
use App\Core\Database;


class VendaController
{
    public function criar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $em = Database::getEntityManager();
            $data = $_POST['produtos'] ?? [];

            // Vamos assumir que o usuário de ID 1 está logado para o teste
            // No futuro, isso seria o usuário da sessão
            $user = $em->getRepository(User::class)->find(1);

            if (!$user) {
                // Se o usuário de teste não existir, cria-o
                $user = new User("usuario_teste", password_hash("123456", PASSWORD_DEFAULT));
                $user->setName("usuario_teste");
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
                echo "Venda criada com sucesso! Total: R$ " . number_format($totalVenda, 2, ',', '.');
            } else {
                echo "Nenhum produto foi selecionado para a venda.";
            }

        } else {
            // Se não for um POST, redireciona para o formulário de vendas
            // Por agora, vamos apenas mostrar uma mensagem
            echo "Acesso inválido. Use um formulário POST para criar uma venda.";
        }
    }

    public function index()
    {
        // Obtém o EntityManager para buscar os produtos
        $em = Database::getEntityManager();
        $produtos = $em->getRepository(Produto::class)->findAll();
        
        // Passa a lista de produtos para a View
        require_once __DIR__ . '/../View/vendas.phtml';
    }
}  