<?php

namespace App\Service;

use Doctrine\DBAL\ParameterType;
use Doctrine\Persistence\ManagerRegistry;

class CoreService
{
    private ManagerRegistry $doctrine;
    private $db1 = 'default';

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function getCustomers(): array
    {
        $conn = $this->doctrine->getConnection($this->db1);

        $sql = 'SELECT * FROM customers;';

        $result = $conn->prepare($sql)
            ->executeQuery()
            ->fetchAllAssociative();

        return $result ?? [];
    }

    public function insertCustomer(
        string $name,
    ): int {
        $conn = $this->doctrine->getConnection($this->db1);

        $sql = 'INSERT INTO customers SET name = :name, dtcreated = now();';

        $stmt = $conn->prepare($sql);
        $stmt->bindValue('name', $name, ParameterType::STRING);

        $result = $stmt->executeStatement();

        return $result;
    }

    public function getCustomer(
        int $id,
    ): array {
        $conn = $this->doctrine->getConnection($this->db1);

        $sql = 'SELECT * FROM customers WHERE id = :id;';

        $stmt = $conn->prepare($sql);
        $stmt->bindValue('id', $id, ParameterType::INTEGER);

        $result = $stmt->executeQuery()->fetchAssociative();

        return $result;
    }

    public function editCustomer(
        int $id,
        string $name,
    ): int {
        $conn = $this->doctrine->getConnection($this->db1);

        $sql = 'UPDATE customers SET name = :name, dtupdated = now() WHERE id = :id;';

        $stmt = $conn->prepare($sql);
        $stmt->bindValue('name', $name, ParameterType::STRING);
        $stmt->bindValue('id', $id, ParameterType::INTEGER);

        $result = $stmt->executeStatement();

        return $result;
    }
}
