<?php

namespace App\Controller\Admin;

use App\Entity\TypeProduits;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TypeProduitsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TypeProduits::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
