<?php

namespace App\Controller;

use App\Entity\Subscription;
use App\Repository\PdfRepository;
use App\Repository\SubscriptionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AbonnementController extends AbstractController
{


    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/abonnement', name: 'app_abonnement')]
    public function index(
        SubscriptionRepository $subscriptionRepository,
        EntityManagerInterface $entityManager,
        Request $request,
        PdfRepository $pdfRepository
    ): Response {
        $user = $this->getUser();
        $subscriptions = $this->entityManager->getRepository(Subscription::class)->findAll();
        return $this->render('abonnement/index.html.twig', [
            'controller_name' => 'AbonnementController',
            'subscriptions' => $subscriptions,
            'user' => $user,

        ]);
    }
}
