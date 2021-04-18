<?php

namespace App\Controller\Admin;

use App\Entity\Tailles;
use App\Entity\Variants;
use App\Repository\ProduitsRepository;
use App\Repository\TaillesRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\VarDumper\VarDumper;

class VariantsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Variants::class;
    }
    

    
    public function configureFields(string $pageName): iterable
    {
        //dd($this);
        return [
           // IdField::new('id',"ID"),
            AssociationField::new('couleur',"Color"),
            MoneyField::new('prix',"price")->setCurrency("EUR"),
            ImageField::new('photo',"picture")->setUploadDir("public/upload"),
            AssociationField::new("taille","size"),
            AssociationField::new('produit',"Product reference"),
            //AssociationField::new('stock',"Product stock")
            
            //->add('stock')
        ];
    }
    
    
}
