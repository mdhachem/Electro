<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Form\CommandeType;
use App\Entity\LigneCommande;
use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\CommandeRepository;

class OrderController extends AbstractController
{
    /**
     * @Route("/order", name="order")
     */
    public function order(Request $request, ObjectManager $em, ProduitRepository $repo)
    {
    	// Build oder form    
        $commande = new Commande();
        $form = $this->createForm(CommandeType::class, $commande);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $commande->setCreatedAt(new \DateTime());
            $em->persist($commande);

            $session = new Session();
            $cart = $session->get('session_cart');

            foreach ($cart as $prd_id => $qty) {
                $ligneCommande = new LigneCommande();
                $ligneCommande->setQuantite($qty);
                $prd = $repo->find($prd_id);
                $ligneCommande->setPrix($prd->getPrix());
                $ligneCommande->setProduit($prd);
                $ligneCommande->setCommande($commande);

                $em->persist($ligneCommande);
            }
            $em->flush();

            $num_cmd = $commande->getId();

            return $this->redirectToRoute('success', [
                'order_id' => $num_cmd
            ]);
        }

        return $this->render("order/order.html.twig", [
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/success/{order_id}", name="success")
     */
    public function success($order_id)
    {
        $session = new Session();
        $session->clear();

        return $this->render('order/success.html.twig', [
            'num_cmd' => $order_id
        ]);
    }


    /**
     * @Route("/admin/order", name="admin_order")
     */
    public function ordersAction(CommandeRepository $repo)
    {
        return $this->render('order/index.html.twig', array(
            'commandes' => $repo->findAll(),
        ));
    }

    /**
     * @Route("/admin/order/{id}", name="admin_order_show")
     */
    public function detailsAction(Commande $commande)
    {
        return $this->render('order/show.html.twig', array(
            'commande' => $commande,
        ));
    }
}
