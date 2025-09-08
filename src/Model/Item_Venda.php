<?php

use App\Core\Database;
use App\Model\Produto;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

#[Entity]
class Item_Venda
{
    #[Column, Id, GeneratedValue()]
    private int $id;

    #[Column]
    private int $quantidade;

    #[ManyToOne(targetEntity: Venda::class)]
    #[JoinColumn(name: "id_venda", referencedColumnName: "id")]
    private int $id_venda;

    #[ManyToOne(targetEntity: Produto::class)]
    #[JoinColumn(name: "id_produto", referencedColumnName: "id")]
    private int $id_produto;

    public function __construct(int $quantidade, int $id_venda, int $id_produto)
    {
        $this->quantidade = $quantidade;
        $this->id_venda = $id_venda;
        $this->id_produto = $id_produto;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getQuantidade(): int
    {
        return $this->quantidade;
    }

    public function getIdVenda(): int
    {
        return $this->id_venda;
    }

    public function getIdProduto(): int
    {
        return $this->id_produto;
    }



    public function save(): void
    {
        $em = Database::getEntityManager();
        $em->persist($this);
        $em->flush();
    }
}
