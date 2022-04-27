<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Entity\Images;
use App\Entity\RetourAds;
use App\Form\ViType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VirementController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/virement', name: 'app_virement')]
    public function index(Request $request): Response
    {
        $retourSurAnnonce = $this->entityManager->getRepository(RetourAds::class)->findAll();

        // recupere le premier element

        $retourSurAnnonce = $retourSurAnnonce[0];

        $form = $this->createForm(ViType::class);
        $form->handleRequest($request);

        if ($form ->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            // recupere l'image de $data et upload dans le dossier upload
            $file = $data['image'];
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('images_directory'), $fileName);

            // afficher l'image uploader

            $img = new Images();
            $img->setImage($fileName);

            $this->entityManager->persist($img);
            $this->entityManager->flush();

            $mail = $this->entityManager->getRepository(\App\Entity\Mail::class)->findAll();

            $mail = $mail[0];

            $monEmail = $mail->getEmail();



            $mail = new Mail();
            $mail->send($monEmail, 'Virement', 'Virement ', "Vous avez un nouvelle ordre de virement");

            $this->addFlash('success', 'Votre ordre de virement a été envoyé avec succès');

        }

        return $this->render('virement/index.html.twig', [
            'form' => $form->createView(),
            'retourSurAnnonce' => $retourSurAnnonce,
        ]);

    }
}
