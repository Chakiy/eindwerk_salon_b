<?php

namespace App\Controller\Admin;


use App\Entity\Address;
use App\Entity\Appointment;
use App\Entity\Cost;
use App\Entity\Customer;
use App\Entity\Images;
use App\Entity\Services;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use Symfony\Component\Security\Core\User\UserInterface;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="app_easyadmin")
     */
    public function index(): Response
    {
        // redirect to some CRUD controller
        $routeBuilder = $this->get(AdminUrlGenerator::class);

        return $this->redirect($routeBuilder->setController(AppointmentCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Beauty Salon');


    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::section('Customer');
        yield MenuItem::linkToCrud('Customers', 'fas fa-user', Customer::class);
        yield MenuItem::linkToCrud('Appointment', 'far fa-calendar-alt', Appointment::class);
        yield MenuItem::linkToCrud('Address', 'fas fa-map-marked-alt', Address::class);

        yield MenuItem::section('Services');
        yield MenuItem::linkToCrud('Services', 'fas fa-concierge-bell', Services::class);
        yield MenuItem::linkToCrud('Cost', 'fas fa-dollar-sign', Cost::class);
        yield MenuItem::linkToCrud('Images', 'far fa-images', Images::class);


        yield MenuItem::section();
        yield MenuItem::linkToUrl('visit Beauty Salon', 'fab fa-chrome', 'https://google.com');
        yield MenuItem::linkToLogout('Logout', 'fa fa-sign-out');


    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        // Usually it's better to call the parent method because that gives you a
        // user menu with some menu items already created ("sign out", "exit impersonation", etc.)
        // if you prefer to create the user menu from scratch, use: return UserMenu::new()->...
        return parent::configureUserMenu($user)
            // use the given $user object to get the user name
            ->setName($user->getFullName($user->getName(), $user->getLastName()))


//             you can return an URL with the avatar image
            ->setAvatarUrl('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSymjxHoVB2hlH41ioYDjkzOd7oVPhJu-uIeQ&usqp=CAU');
    }
}
