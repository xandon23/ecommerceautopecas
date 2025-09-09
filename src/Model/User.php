<?php

namespace App\Model;

use App\Core\Database;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;

#[Entity]
class User
{
    #[Column, Id, GeneratedValue()]
    private int $id;

    #[Column]
    private string $name;

    #[Column]
    private string $password;

    public function __construct(string $name, string $password)
    {
        $this->name = $name;
        $this->password = $password;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->name;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function save(): void
    {
        $em = Database::getEntityManager();
        $em->persist($this);
        $em->flush();
    }

    public function validatePassword(): void {}

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
}
