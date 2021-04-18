<?php

namespace App\Controller\Admin;

use App\Entity\Paniers;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PaniersCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Paniers::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        
        return [
            IdField::new('id'),
            TextField::new("idClient","ID CLIENT"),
            IntegerField::new("quantity","Quantité"),
            AssociationField::new('variant'),
            DateField::new('dateLivraison'),
        ];
    }
    
}
