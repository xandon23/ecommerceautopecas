<?php

use App\Core\Database;
use App\Model\User;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

#[Entity]
class Venda
{
    #[Column, Id, GeneratedValue()]
    private int $id;

    #[Column]
    private DateTime $data;

    #[Column]
    private float $vtotal;

    #[ManyToOne(targetEntity: User::class)]
    #[JoinColumn(name: "id_user", referencedColumnName: "id")]
    private int $id_user;

    public function __construct(DateTime $data, float $vtotal, int $id_user)
    {
        $this->data = $data;
        $this->vtotal = $vtotal;
        $this->id_user = $id_user;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getData(): DateTime
    {
        return $this->data;
    }

    public function getVtotal(): float
    {
        return $this->vtotal;
    }

    public function getIdUser(): int
    {
        return $this->id_user;
    }

    public function save(): void
    {
        $em = Database::getEntityManager();
        $em->persist($this);
        $em->flush();
    }
}
