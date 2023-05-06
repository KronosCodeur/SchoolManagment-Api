<?php

namespace App\Controller\Admin;

use App\Entity\Classe;
use App\Entity\Cours;
use App\Entity\Etudiant;
use App\Entity\Professeur;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('SchoolManagment Admin')
            ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Classes', 'fas fa-school', Classe::class);
        yield MenuItem::linkToCrud('Etudiants', 'fas fa-people-group', Etudiant::class);
        yield MenuItem::linkToCrud('Profs', 'fas fa-person-chalkboard', Professeur::class);
        yield MenuItem::linkToCrud('Cours', 'fas fa-book', Cours::class);
    }
}
