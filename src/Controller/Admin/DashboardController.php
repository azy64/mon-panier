<?php

namespace App\Controller\Admin;

use App\Entity\Categorie;
use App\Entity\Genres;
use App\Entity\Paniers;
use App\Entity\Produits;
use App\Entity\Stocks;
use App\Entity\TypeProduits;
use App\Entity\Variants;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('My Panier');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        //yield MenuItem::linktoDashboard('Products', 'fa fa-box-open');
        /************************************produits******************************************* */
       yield MenuItem::section('Products');
        yield MenuItem::linkToCrud('Product', 'fas fa-box-open', Produits::class);
        yield MenuItem::linkToCrud('Add Product', 'fas fa-plus', Produits::class)->setAction("new");
        yield MenuItem::linkToCrud('Show Products', 'fas fa-list', Produits::class)->setAction("detail");
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
        /****************************************Variants***************************************** */
        yield MenuItem::section('Variants');
        yield MenuItem::linkToCrud('Variant', 'fas fa-box-open', Variants::class);
        yield MenuItem::linkToCrud('Add Variant', 'fas fa-plus', Variants::class)->setAction("new");
        /****************************************Panier***************************************** */
        yield MenuItem::section('Paniers');
        yield MenuItem::linkToCrud('Panier', 'fas fa-basket', Paniers::class);
        yield MenuItem::linkToCrud('Add Panier', 'fas fa-plus', Paniers::class)->setAction("new");
        /*****************************************categorie************************************* */
        /*****************************************categorie************************************* */
        
        yield MenuItem::section('Categories');
        yield MenuItem::linkToCrud('Category', 'fas fa-box-open', Categorie::class);
        yield MenuItem::linkToCrud('Add Category', 'fas fa-plus', Categorie::class)->setAction("new");
        yield MenuItem::linkToCrud('Show Categories', 'fas fa-list', Categorie::class)->setAction("detail");
        /*****************************************Type Produits************************************* */
        yield MenuItem::section('Type Roducts');
        yield MenuItem::linkToCrud('Type', 'fas fa-box-open', TypeProduits::class);
        yield MenuItem::linkToCrud('Add Type', 'fas fa-plus', TypeProduits::class)->setAction("new");
        yield MenuItem::linkToCrud('Show Type', 'fas fa-list', TypeProduits::class)->setAction("detail");
        /*****************************************genre************************************* */
        yield MenuItem::section('Genders');
        yield MenuItem::linkToCrud('Gender', 'fas fa-box-open', Genres::class);
        yield MenuItem::linkToCrud('Add Gender', 'fas fa-plus', Genres::class)->setAction("new");
        yield MenuItem::linkToCrud('Show Gender', 'fas fa-list', Genres::class)->setAction("detail");
        /*****************************************categorie************************************* */
        yield MenuItem::section('Stocks');
        yield MenuItem::linkToCrud('Stock', 'fas fa-box-open', Stocks::class);
        yield MenuItem::linkToCrud('Add Stock', 'fas fa-plus', Stocks::class)->setAction("new");
        yield MenuItem::linkToCrud('Show Stock', 'fas fa-list', Stocks::class)->setAction("detail");
    }
}
