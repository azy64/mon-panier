<?php

namespace App\DataFixtures;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\TypeProduits;
use App\Entity\Genres;
use App\Entity\Categorie;
use App\Entity\Couleurs;
use App\Entity\Tailles;

use function PHPSTORM_META\map;

class LoaderFixtures extends Fixture
{
    private $manager=null;
    public function load(ObjectManager $manager)
    {
        $colors=[
            "10"=>"blanc",
            "20"=>"rouge",
            "30"=>"bleu",
            "40"=>"violet",
            "50"=>"noir",
            "60"=>"orange",
            "70"=>"maron"
        ];
        $this->manager=$manager;
/***********************************couleur****************************** */
        array_map(function($key,$value){
            $c=new Couleurs();
            $c->setCodecouleur((int)$key);
            $c->setLibele($value);
            $this->manager->persist($c);
            $this->manager->flush();
        },array_keys($colors),array_values($colors));

        //Categorie

       array_map(function($el){
        $ob=new Categorie();
        $ob->setLibele($el);
        $this->manager->persist($ob);
        $this->manager->flush();
       },["chaussant","textile"]);
       
       //type produit
       array_map(function($el){
        $ob=new TypeProduits();
        $ob->setLibele($el);
        $this->manager->persist($ob);
        $this->manager->flush();
       },["sneakers","tee-shirt"]);
       
       //Genres

       array_map(function($el){
        $ob=new Genres();
        $ob->setLibele($el);
        $this->manager->persist($ob);
        $this->manager->flush();
       },["Homme","Femme","Mixte"]);
       
       //Taille
       array_map(function($el){
        $ob=new Tailles();
        $ob->setLibele($el);
        $this->manager->persist($ob);
        $this->manager->flush();
       },["XS","S","M","L","38","39","40","41","42","43","44"]);
    }
    
    
}
