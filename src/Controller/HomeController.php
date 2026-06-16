<?php

namespace App\Controller;

use App\Model\Customer;
use App\Repositories\CustomersRepository;
use App\Service\CoreService;
use App\Service\DatabaseService;
use App\Utils\Constant;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home', methods: ['GET'])]
    public function index(CoreService $core, DatabaseService $db): Response
    {
        $name = 'John';

        $res = $db->getCustomers();
        $customers = $res ?? [];

        $customerObjects = [];

        foreach ($customers as $row) {
            $customerObjects[] = new Customer(
                (int) $row['id'], // Cast to int to prevent PHP TypeErrors
                $row['name'],
                $row['dtcreated'],
                $row['dtupdated'] ?? ''
            );
        }

        // if (count($customerObjects) > 0) {
        //   $customersObj = new CustomersRepository($this->json($customerObjects));
        //   //dd($customersObj->findAll());
        //   //dd($customersObj->find(2));
        //   return $this->json($customerObjects);
        // }
        // dd($customers);

        return $this->render('home/index.html.twig', [
            'data' => [
                'name' => $name,
                'gender' => 'Male',
                'customers' => $customers,
                'add_url' => Constant::APP_CONTACT_NEW,
                'module' => 'Contact',
            ]]);
    }
}
