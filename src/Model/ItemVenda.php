<?php

namespace App\Model;

use App\Core\Database;
use App\Model\Produto;
use App\Model\Venda; 
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

#[Entity]
class ItemVenda
{
    #[Column, Id, GeneratedValue()]
    private int $id;

    #[Column]
    private int $quantidade;

    #[ManyToOne(targetEntity: Venda::class)]
    #[JoinColumn(name: 'vendaId', referencedColumnName: 'id')]
    private Venda $venda; 

    #[ManyToOne(targetEntity: Produto::class)]
    #[JoinColumn(name: 'produtoId', referencedColumnName: 'id')]
    private Produto $produto; 

    public function __construct(Venda $venda, Produto $produto, int $quantidade)
    {
        $this->venda = $venda;
        $this->produto = $produto;
        $this->quantidade = $quantidade;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getQuantidade(): int
    {
        return $this->quantidade;
    }

    public function getVenda(): Venda
    {
        return $this->venda;
    }

    public function getProduto(): Produto
    {
        return $this->produto;
    }

    public function save(): void
    {
        $em = Database::getEntityManager();
        $em->persist($this);
        $em->flush();
    }
}