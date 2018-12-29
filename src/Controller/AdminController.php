<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProduitRepository;
use App\Repository\CategorieRepository;
use App\Repository\CommandeRepository;
use App\Repository\LigneCommandeRepository;
use App\Entity\LigneCommande;
use App\Repository\AvisRepository;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(ProduitRepository $repoP, CategorieRepository $repoCa, CommandeRepository $repoCo, LigneCommandeRepository $repoL, AvisRepository $repoAvis)
    {
        return $this->render('admin/index.html.twig', [
            'nb_p' => count($repoP->findAll()),
            'nb_ca' => count($repoCa->findAll()),
            'nb_co' => count($repoCo->findAll()),
            'total_m' => $repoL->FindTotalPrix(),
            'nb_avis' => count($repoAvis->findAll())
        ]);
    }
}
