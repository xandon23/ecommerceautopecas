<?php

namespace App\Model;

use App\Core\Database;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;

#[Entity]
class Produto
{
    #[Column, Id, GeneratedValue()]
    private int $id;

    #[Column]
    private string $name;

    #[Column]
    private string $categoria;

    #[Column]
    private float $valorcusto;
    
    #[Column]
    private float $valorvenda;

    public function __construct(string $name, string $categoria, float $valorcusto, float $valorvenda)
    {
        $this->name = $name;
        $this->categoria = $categoria;
        $this->valorcusto = $valorcusto;
        $this->valorvenda = $valorvenda;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCategoria(): string
    {
        return $this->categoria;
    }

    public function getValorcusto(): float
    {
        return $this->valorcusto;
    }

    public function getValorvenda(): float
    {
        return $this->valorvenda;
    }

    public function save(): void
    {
        $em = Database::getEntityManager();
        $em->persist($this);
        $em->flush();
    }

    /**
    * @return Produto[]
    */
    
    public static function findAll(): array
    {
        $em = Database::getEntityManager();
        return $em->getRepository(Produto::class)->findAll();
    }

    public static function find(int $id): ?Produto
    {
        $em = Database::getEntityManager();
        return $em->find(Produto::class, $id);
    }
    
}
