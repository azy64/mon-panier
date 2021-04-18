<?php

namespace App\Controller\Admin;

use App\Entity\Produits;
use App\Entity\TypeProduits;
use App\Repository\CategorieRepository;
use App\Repository\GenresRepository;
use App\Repository\TypeProduitsRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProduitsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Produits::class;
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
     
    public function configureFields(string $pageName): iterable
    {
        return [
           // IdField::new('id'),
            TextField::new('nom'),
            TextField::new('marque'),
            TextField::new('reference'),
            AssociationField::new('type',"Product Type"),
            AssociationField::new('categorie'),
            AssociationField::new('genre')
        ];
    }
    
}
