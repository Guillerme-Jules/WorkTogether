<?php

namespace App\Controller;

use App\DTO\Buy;
use App\Entity\Customer;
use App\Entity\Pack;
use App\Entity\Reservation;
use App\Entity\Unit;
use App\Form\BuyFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DomCrawler\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PackController extends AbstractController
{
    #[Route('/pack/list', name: 'app_pack_list')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $packs = $entityManager->getRepository(Pack::class)->findAll();

        return $this->render('pack/index.html.twig', [
            'controller_name' => 'PackController',
            'packs' => $packs,
        ]);
    }

    #[Route('pack/info/{id}', name: 'app_pack_info')]
    public function info(EntityManagerInterface $entityManager, $id): Response
    {
        $pack = $entityManager->getRepository(Pack::class)->find($id);

        return $this->render('pack/info.html.twig', [
            'controller_name' => 'PackController',
            'pack' => $pack,
        ]);
    }

    #[Route('pack/buy/{id}', name: 'app_pack_buy')]
    public function buy(Request $request, EntityManagerInterface $entityManager, $id): Response
    {
        $messageError = "";
        $pack = $entityManager->getRepository(Pack::class)->find($id);
        $buy = new Buy();
        $form = $this->createForm(BuyFormType::class, $buy);
        $form->handleRequest($request);
        $units = $entityManager->getRepository(Unit::class)->findBy(array('reservation' => null));
        if ($form->isSubmitted() && $form->isValid()) {
            if (count($units) >= $pack->getNumberSlot()) {
                $user = $this->getUser();
                $customer = $entityManager->getRepository(Customer::class)->findOneBy(array('email' => $user->getUserIdentifier()));
                for ($i = 0; $i < $buy->getQuantity(); $i++) {
                    $reservation = new Reservation();
                    $reservation->setElement($pack, $customer, $buy);
                    $entityManager->persist($reservation);
                    $entityManager->flush();
                    for ($j = 0; $j < $reservation->getPack()->getNumberSlot(); $j++) {
                        $units[$j]->setReservation($reservation);
                        $entityManager->flush();
                    }
                }

                return $this->redirectToRoute("app_reservation");
            }
            else{
                $messageError = "Il n'y a plus assez d'unité de libre";
            }
        }
        return $this->render('pack/buy.html.twig', [
            'controller_name' => 'PackController',
            'form' => $form,
            'pack' => $pack,
            'messageError' => $messageError,
        ]);
    }
}
