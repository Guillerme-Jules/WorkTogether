<?php

namespace App\Controller;

use App\Entity\Pack;
use App\Entity\Reservation;
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
    public function buy(Request $request,EntityManagerInterface $entityManager, $id): Response
    {
        $pack = $entityManager->getRepository(Pack::class)->find($id);
        $reservation = new Reservation();
        $reservation->setClient($this->getUser());
        $reservation->setPack($pack);
        $reservation->setPrice($pack->getPrice());
        $reservation->setStartDate(new \DateTime('now'));

        $form = $this->createForm(BuyFormType::class, $reservation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reservation);
            $entityManager->flush();

            return $this->redirectToRoute("app_home");
        }
        return $this->render('pack/buy.html.twig', [
            'controller_name' => 'PackController',
            'form' => $form,
            'pack' => $pack,

        ]);
    }
}
