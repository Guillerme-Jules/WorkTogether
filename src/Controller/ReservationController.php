<?php

namespace App\Controller;


use App\DTO\ChoiceTypeUnit;
use App\Entity\Reservation;
use App\Entity\Unit;
use App\Form\ChoiceTypeUnitFormType;
use App\Repository\CustomerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    #[Route('/reservation', name: 'app_reservation')]
    public function index(CustomerRepository $cR): Response
    {
        $customer= $cR->findOneBy(array('email'=>$this->getUser()->getUserIdentifier()));
        $reservations = $customer->getReservations();
        return $this->render('reservation/index.html.twig', [
            'controller_name' => 'ReservationController',
            'customer' => $customer,
            'reservations'=> $reservations
        ]);
    }
    #[Route('/reservation/delete/{id}', name: 'app_reservation_delete')]
    public function delete(EntityManagerInterface $entityManager,$id): Response
    {
        $reservation = $entityManager->getRepository(Reservation::class)->find($id);
        $units = $entityManager->getRepository(Unit::class)->findBy(array('reservation'=>$reservation));
        foreach ($units as $unit){
            $unit->setReservation(null);
            $entityManager->flush();
        }
        $entityManager->remove($reservation);
        $entityManager->flush();
        return $this->redirectToRoute("app_reservation");
    }

    #[Route('/reservation/unit/{id}', name: 'app_reservation_unit')]
    public function unit(EntityManagerInterface $entityManager,Request $request, $id): Response
    {
        $reservation = $entityManager->getRepository(Reservation::class)->find($id);
        $units = $entityManager->getRepository(Unit::class)->findBy(array('reservation'=>$reservation));
        $choiceTypeUnit = new ChoiceTypeUnit();
        $form = $this->createForm(ChoiceTypeUnitFormType::class, $choiceTypeUnit, array('units'=>$units));
        $form->handleRequest($request);
        return $this->render('reservation/unit.html.twig', [
            'controller_name' => 'ReservationController',
            'form' => $form,
            'units' => $units
        ]);
    }
}
