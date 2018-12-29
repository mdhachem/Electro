<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Entity\Categorie;
use App\Repository\ProduitRepository;
use App\Repository\CategorieRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Avis;
use Doctrine\Common\Persistence\ObjectManager;
use App\Repository\AvisRepository;

class FrontController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(CategorieRepository $repo)
    {
        return $this->render('front/index.html.twig', [
            'categories' => $repo->findAll()
        ]);
    }

    /**
     * @Route("/category/{id}", name="category_produits")
     */
    public function categoryAction(Categorie $categorie, ProduitRepository $repo)
    {
        $produits = $repo->createQueryBuilder('u')
            ->innerJoin('u.categories', 'g')
            ->where('g.id = :group_id')
            ->setParameter('group_id', $categorie->getId())
            ->getQuery()->getResult();

        return $this->render("front/produits.html.twig", [
            'produits' => $produits,
            'categorie' => $categorie
        ]);
    }


    /**
     * @Route("/produit/{id}", name="show_produit")
     */
    public function showProduit(Produit $produit, Request $request, ObjectManager $em, AvisRepository $repoAvis)
    {
        $avis = new Avis();

        //dump($request);

        if ($request->request->count() == 4) {
            $avis->setEmail($request->request->get('email'));
            $avis->setDescription($request->request->get('desc'));
            $avis->setFullName($request->request->get('nom'));
            $avis->setRating($request->request->get('rating'));
            $avis->setProduit($produit);
            $avis->setCreatedAt(new \DateTime());
            $em->persist($avis);
            $em->flush();
        }



        return $this->render('front/produit.html.twig', [
            'produit' => $produit,
            'star_one' => $repoAvis->findStarOne($produit->getId()),
            'star_two' => $repoAvis->findStarTwo($produit->getId()),
            'star_three' => $repoAvis->findStarThree($produit->getId()),
            'star_four' => $repoAvis->findStarFour($produit->getId()),
            'star_five' => $repoAvis->findStarFive($produit->getId()),
            'avg_rating' => $repoAvis->findAvgRating($produit->getId()),
        ]);
    }


    public function libelleCategorie(CategorieRepository $repo)
    {
        return $this->render('front/categories.html.twig', [
            'categories' => $repo->findAll()
        ]);
    }

    /**
     * @Route("/search", name="search")
     */
    public function searchBar(Request $request, ProduitRepository $repo)
    {
        $em = $this->getDoctrine()->getManager();

        $prd = $request->get('q');
        $categorie = $request->get('cat');

        $produits = $repo->createQueryBuilder('u')
            ->innerJoin('u.categories', 'g')
            ->where('g.id Like :cat And u.libelle Like :str')
            ->setParameter('str', '%' . $prd . '%')
            ->setParameter('cat', '%' . $categorie . '%')
            ->getQuery()->getResult();



        return $this->render('front/produitsRecherche.html.twig', [
            'produits' => $produits
        ]);
    }
}
