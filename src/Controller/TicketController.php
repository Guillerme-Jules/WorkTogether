<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Entity\CustomerTicket;
use App\Form\TicketFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\HttpFoundation\Request;

#[IsGranted('ROLE_CLIENT')]
class TicketController extends AbstractController
{
    #[Route('/ticket', name: 'app_ticket')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $ticket = new CustomerTicket();
        $form = $this->createForm(TicketFormType::class, $ticket);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $ticket->setDone(false);
            $ticket->setCustomer($entityManager->getRepository(Customer::class)->findOneBy(array('email' => $this->getUser()->getUserIdentifier())));
            $entityManager->persist($ticket);
            $entityManager->flush();
            return $this->redirectToRoute("app_home");
        }
        return $this->render('ticket/index.html.twig', [
            'controller_name' => 'TicketController',
            'form' => $form,
        ]);
    }
}
