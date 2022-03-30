<?php

namespace App\Controller;

use App\Entity\Infos;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InfosController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/infos', name: 'app_infos')]
    public function index(): Response
    {

        $infos = $this->entityManager->getRepository(Infos::class)->findAll();

        // premier element de la liste
        $first = $infos[0];

        return $this->render('infos/index.html.twig', [
            'infos' => $first,
        ]);
    }
}
