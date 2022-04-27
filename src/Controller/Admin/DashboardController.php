<?php

namespace App\Controller\Admin;

use App\Entity\Homing;
use App\Entity\Images;
use App\Entity\Infos;
use App\Entity\Mail;
use App\Entity\RetourAds;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $routeBuilder = $this->container->get(AdminUrlGenerator::class);
        $url = $routeBuilder->setController(HomingCrudController::class)->generateUrl();
        return $this->redirect($url);
        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Lebonc');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Accueil', 'fa fa-home');
        yield MenuItem::linkToCrud('Informations', 'fas fa-info', Infos::class);
        yield MenuItem::linkToCrud('Ordre de virements', 'fas fa-user', Images::class);
        yield MenuItem::linkToCrud('Mon mail', 'fas fa-envelope', Mail::class);
        yield MenuItem::linkToCrud('Retour sur annonce', 'fas fa-arrow-left', RetourAds::class);
    }
}
