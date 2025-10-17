<?php

namespace App\Repository;

use App\Entity\EntityInterface;
use App\Database\Mysql;

abstract class AbstractRepository
{
    /**
     * Attributs
     * 
     */
    protected \PDO $connection;

    //Méthode pour assigner la connexion PDO 
    protected function setConnection()
    {
        $this->connection = (new Mysql())->connectBdd();
    }

    /**
     * Méthodes abstraites
     */
    public abstract function find(int $id): EntityInterface;

    /**
     * @return array<EntityInterface>
     */
    public abstract function findAll(): array;

    public abstract function save(EntityInterface $entity): EntityInterface;
}
