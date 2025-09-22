<?php

namespace App\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;


#[Entity]
class Venda
{
    #[Column, Id, GeneratedValue()]
    private int $id;

    #[Column(type: 'datetime')]
    private \DateTimeInterface $data;

    #[Column(type: 'decimal', precision: 10, scale: 2)]
    private float $total;

    #[ManyToOne(targetEntity: User::class)]
    #[JoinColumn(name: "usuariosID", referencedColumnName: "id")]
    private User $usuario;

    #[OneToMany(mappedBy: "venda", targetEntity: ItemVenda::class, cascade: ["persist", "remove"])]
    private Collection $itens;

    public function __construct(User $usuario)
    {
        $this->usuario = $usuario;
        $this->data = new \DateTime('now');
        $this->total = 0.0;
        $this->itens = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getData(): \DateTimeInterface
    {
        return $this->data;
    }

    public function getTotal(): float
    {
        return $this->total;
    }
    
    public function setTotal(float $total): void
    {
        $this->total = $total;
    }

    public function getUsuario(): User
    {
        return $this->usuario;
    }

    public function getItens(): Collection
    {
        return $this->itens;
    }
    
    public function addItem(ItemVenda $item): void
    {
        if (!$this->itens->contains($item)) {
            $this->itens->add($item);
        }
    }
}