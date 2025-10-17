<?php

namespace App\Repository;

use App\Repository\AbstractRepository;
use App\Entity\EntityInterface;
use App\Entity\User;

class UserRepository extends AbstractRepository
{
    public function __construct()
    {
        $this->setConnection();
    }

    public function find(int $id): User
    {
        return new User();
    }

    public function findAll(): array
    {
        return [];
    }

    public function save(EntityInterface $entity): User
    {
        return $entity;
    }
}
