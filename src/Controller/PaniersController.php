<?php

namespace App\Controller;

use App\Entity\Paniers;
use App\Form\Paniers1Type;
use App\Repository\CategorieRepository;
use App\Repository\CouleursRepository;
use App\Repository\GenresRepository;
use App\Repository\PaniersRepository;
use App\Repository\TaillesRepository;
use App\Repository\TypeProduitsRepository;
use App\Repository\VariantsRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/paniers")
 */
class PaniersController extends AbstractController
{
   
    /**
     * @Route("/{id_client}", name="paniers_index", methods={"GET"})
     */
    public function index(PaniersRepository $paniersRepository,$id_client): Response
    {
        return $this->render('paniers/index.html.twig', [
            'paniers' => $paniersRepository->findBy(['idClient'=>$id_client]),
        ]);
    }

    /**
     * @Route("/new", name="paniers_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $panier = new Paniers();
        $form = $this->createForm(Paniers1Type::class, $panier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($panier);
            $entityManager->flush();

            return $this->redirectToRoute('paniers_index');
        }

        return $this->render('paniers/new.html.twig', [
            'panier' => $panier,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="paniers_show", methods={"GET"})
     */
    public function show(Paniers $panier): Response
    {
        return $this->render('paniers/show.html.twig', [
            'panier' => $panier,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="paniers_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Paniers $panier): Response
    {
        $form = $this->createForm(Paniers1Type::class, $panier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('paniers_index');
        }

        return $this->render('paniers/edit.html.twig', [
            'panier' => $panier,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/filtre", name="filtre", methods={"POST"})
     */
    public function filtres(PaginatorInterface $paginator,Request $request, PaniersRepository $pp,VariantsRepository $v,TaillesRepository $t,CouleursRepository $c,CategorieRepository $ca, TypeProduitsRepository $types,GenresRepository $genres){
        $cat=(int)$request->request->get("categorie");
        $type=(int)$request->request->get("typeProduit");
        $genre=(int)$request->request->get("genre");
        $color=(int)$request->request->get("color");
        $taille=(int)$request->request->get("taille");
        $id=$request->request->get("id");
        $taille=$t->findOneBy(['id'=>$taille]);
        $color=$c->findOneBy(['id'=>$color]);
        $ob=$v->findAll();
        $ob=array_filter($ob,function($el) use($taille,$color,$genre,$cat,$type){
            if($el->getTaille()->contains($taille) && $el->getCouleur()->contains($color) && $el->getProduit()->getGenre()->getId()==$genre && $el->getProduit()->getCategorie()->getId()==$cat && $el->getProduit()->getType()->getId()==$type)
                return $el;
        });

        if($ob==null){
            $this->redirectToRoute("index");
        }
        $variants=$paginator->paginate(
            $ob,
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
                'genres'=>$genres->findAll(),
                'categories'=>$ca->findAll(),
                'colors'=>$c->findAll(),
                'size'=>$t->findAll(),
                'nombre'=>$nbr,
                'display_home'=>true
        ]);
    }

    /**
     * @Route("/{id}", name="paniers_delete", methods={"POST"})
     */
    public function delete(Request $request, Paniers $panier): Response
    {
        if ($this->isCsrfTokenValid('delete'.$panier->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($panier);
            $entityManager->flush();
        }

        return $this->redirectToRoute('index');
    }
    
}
