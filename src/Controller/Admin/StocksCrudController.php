<?php

namespace App\Controller\Admin;

use App\Entity\Stocks;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class StocksCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Stocks::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            //IdField::new('id'),
            IntegerField::new('quantite'),
            AssociationField::new('variant'),
        ];
    }
    
}
