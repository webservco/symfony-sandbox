<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Address;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Override;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class DashboardController extends AbstractDashboardController
{
    #[IsGranted('ROLE_ADMIN')]
    #[Override]
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        //return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');

        return $this->render('admin/dashboard/index.html.twig');
    }

    /**
     * https://symfony.com/bundles/EasyAdminBundle/current/dashboards.html#dashboard-configuration
     */
    #[Override]
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Custom Admin');
    }

    /**
     * https://symfony.com/bundles/EasyAdminBundle/current/dashboards.html#main-menu
     *
     * @SuppressWarnings("PHPMD.StaticAccess")
     * @return iterable<\EasyCorp\Bundle\EasyAdminBundle\Contracts\Menu\MenuItemInterface>
     */
    #[Override]
    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Addresses', 'fa fa-address-book', Address::class);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
