<?php

namespace App\Repositories;

use Symfony\Component\HttpFoundation\JsonResponse;

class CustomersRepository
{
    public function __construct(
        private JsonResponse $data,
    ) {
    }

    public function findAll(): ?JsonResponse
    {
        return $this->data;
    }

    public function find(?int $id): ?object
    {
        $count = 0;
        // dd($this->findAll());

        $customers = $this->findAll()->getContent();

        // dd($customer);

        foreach (json_decode($customers) as $customer) {
            if ($customer->id == $id) {
                return $customer;
            }
        }

        return null;
    }
}
