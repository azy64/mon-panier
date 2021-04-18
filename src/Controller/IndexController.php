<?php

namespace App\Controller;

use App\Entity\Paniers;
use App\Entity\Produits;
use App\Entity\Variants;
use App\Form\TypeProduitsType;
use App\Repository\CategorieRepository;
use App\Repository\GenresRepository;
use App\Repository\ProduitsRepository;
use App\Repository\CouleursRepository;
use App\Repository\PaniersRepository;
use App\Repository\TaillesRepository;
use App\Repository\VariantsRepository;
use App\Repository\TypeProduitsRepository;
use DateInterval;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    
    /**
     * @Route("/", name="index")
     */
    public function index(PaginatorInterface $page, Request $request,VariantsRepository $v,TypeProduitsRepository $types,CouleursRepository $color, GenresRepository $genre,CategorieRepository $cat, TaillesRepository $taille,PaniersRepository $pp): Response
    {
        $donnees=$v->findAll();
        $variants=$page->paginate($donnees,
        $request->query->getInt("page",1),
        5
    );
       if(!$request->getSession()->has("idClient")){
        $request->getSession()->set("idClient",uniqid("",true));
        }   
        $nbr=count($pp->findBy(["idClient"=>$request->getSession()->get("idClient")]));
        return $this->render('index/index.html.twig', [
            'variants' => $variants,
            'types'=>$types->findAll(),
            'genres'=>$genre->findAll(),
            'categories'=>$cat->findAll(),
            'colors'=>$color->findAll(),
            'size'=>$taille->findAll(),
            'nombre'=>$nbr
        ]);
    }
    /**
     * @Route("/panier/{qu}/{taille}/{couleur}/{id}", name="put_in_basket")
     */
    public function putInBasket(Variants $p,TaillesRepository $tr,CouleursRepository $cr, $qu,$taille,$couleur){

        $pan=new Paniers();
        $co=$cr->findOneBy(['id'=>$couleur]);
        $tt=$tr->findOneBy(["id"=>$taille]);
        $pan->setCouleur($co);
        $pan->setTaille($tt);
        $pan->setVariant($p);
        $pan->setQuantity((int)$qu);
        $pan->setIdClient($this->s->get("idClient"));
        $d=new \DateTime();
        $d->add(new \DateInterval("P7D"));
        $j=(int)$d->format("w");
        if($j==0){
            $d->add(new \DateInterval("P1D"));
        }
        if($j==6){
            $d->add(new \DateInterval("P2D"));
        }
        $pan->setDateLivraison($d);
        $m=$this->getDoctrine()->getManager();
        $m->persist($pan);
        $m->flush();
        return $this->redirectToRoute("index");

    }
    /**
     * @Route("/panier", name="my_basket")
     */
    public function seeMyBasket(PaniersRepository $p){

        return $this->render('index/panier.html.twig', [
            'panier' => $p->findAll(),
            'idclient'=>$this->s->get("idClient")
            
        ]);

    }
}
