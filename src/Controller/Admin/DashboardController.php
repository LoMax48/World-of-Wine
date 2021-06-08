<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Fridge;
use App\Entity\Name;
use App\Entity\Order;
use App\Entity\Batch;
use App\Entity\Contains;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(AdminUrlGenerator::class);
        return $this->redirect($routeBuilder->setController(UserCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Админ-панель World of Wine');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Холодильные камеры', 'fas fa-list', Fridge::class);
        yield MenuItem::linkToCrud('Винные партии', 'fas fa-list', Batch::class);
        yield MenuItem::linkToCrud('Заказы', 'fas fa-list', Order::class);
        yield MenuItem::linkToCrud('Вина', 'fas fa-list', Name::class);
        yield MenuItem::linkToCrud('Данные для заказа', 'fas fa-list', Contains::class);
        yield MenuItem::linkToRoute('Вернуться на главную', 'fa fa-home', 'home');
    }
}
