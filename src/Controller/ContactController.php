<?php

namespace App\Controller;

use App\DTO\ContactData;
use App\Form\ContactForm;
use App\Service\CoreService;
use App\Utils\Constant;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ContactController extends AbstractController
{
    #[Route('contact/new', name: Constant::APP_CONTACT_NEW, methods: ['GET', 'POST'])]
    public function newContact(Request $request, CoreService $core): Response
    {
        $dto = new ContactData();

        $form = $this->createForm(ContactForm::class, $dto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $res = $core->insertCustomer($data->getName());

            if ($res > 0) {
                $this->addFlash('success', $data->getName().' is added successfully.');

                return $this->redirectToRoute(Constant::APP_HOME);
            }
        }

        return $this->render('contacts/info.html.twig', [
            'form' => $form->createView(),
            'form-action' => $this->generateUrl(Constant::APP_CONTACT_NEW),
        ]);
    }

    #[Route('contact/edit/{id}', name: Constant::APP_CONTACT_EDIT, methods: ['GET', 'POST'])]
    public function editContact(string $id, Request $request, CoreService $core): Response
    {
        $dto = new ContactData();
        $cinfo = $core->getCustomer($id);

        $dto->setName($cinfo['name']);

        $form = $this->createForm(ContactForm::class, $dto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $res = $core->editCustomer($id, $data->getName());

            if ($res > 0) {
                $this->addFlash('success', $cinfo['name'].' is successfully changed to '.$data->getName().'.');

                return $this->redirectToRoute(Constant::APP_HOME);
            }
        }

        return $this->render('contacts/info.html.twig', [
            'form' => $form->createView(),
            'form-action' => $this->generateUrl(Constant::APP_CONTACT_EDIT, [
                'id' => $id,
            ]),
        ]);
    }
}
