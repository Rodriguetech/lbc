<?php

namespace App\Controller;

use App\Entity\Homing;
use App\Entity\RetourAds;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $accueil = $this->entityManager->getRepository(Homing::class)->findAll();

        // recupere le premier element de $accueil
        $accueil = $accueil[0];

        $retourSurAnnonce = $this->entityManager->getRepository(RetourAds::class)->findAll();

        // recupere le premier element

        $retourSurAnnonce = $retourSurAnnonce[0];

        return $this->render('home/index.html.twig',[
            'accueil' => $accueil,
            'retourSurAnnonce' => $retourSurAnnonce,

        ]);
    }

}
