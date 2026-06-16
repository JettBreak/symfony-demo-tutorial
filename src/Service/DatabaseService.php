<?php

namespace App\Service;

use Doctrine\Persistence\ManagerRegistry;

class DatabaseService
{
    public function __construct(
        private ManagerRegistry $doctrine,
    ) {
    }

    public function getCustomers(): array
    {
        $conn = $this->doctrine->getConnection('default');

        $sql = 'SELECT * FROM customers';

        $stmt = $conn->prepare($sql);
        $result = $stmt->executeQuery()->fetchAllAssociative();

        return $result ?? [];
    }
}
