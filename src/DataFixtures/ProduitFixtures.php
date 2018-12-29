<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Avis;
use App\Entity\Produit;
use App\Entity\Commande;
use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\LigneCommande;

class ProduitFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        $categories = [];

        for ($i = 0; $i < 6; $i++) {
            $categorie = new Categorie();
            $categorie->setLibelle($faker->sentence(6))
                ->setDescription('<p>' . join(',', $faker->paragraphs()) . '</p>')
                ->setImage("http://placehold.it/350x350");

            $manager->persist($categorie);
            //$manager->flush();

            $categories[] = $categorie;
        }

        $produits = [];


        for ($i = 0; $i < 20; $i++) {
            $produit = new Produit();
            $produit->setLibelle($faker->sentence(6))
                ->setDescriptionCourt($faker->sentence(6))
                ->setDescriptionLong('<p>' . join(',', $faker->paragraphs()) . '</p>')
                ->setImagePrincipale("http://placehold.it/150x150")
                ->setImageSecondaire1("http://placehold.it/150x150")
                ->setImageSecondaire2("http ://placehold.it/150x150")
                ->setPrix($faker->randomNumber(3))
                ->setCategories($faker->randomElements($categories));
            $manager->persist($produit);
            $produits[] = $produit;

            $commande = new Commande();
            $commande->setFullName($faker->name)
                ->setAddress($faker->city)
                ->setCreatedAt(new \DateTime())
                ->setCity($faker->city)
                ->setEmail($faker->email)
                ->setTelephone($faker->e164PhoneNumber)
                ->setZipCode($faker->ein);

            $manager->persist($commande);

            for ($j = 0; $j < mt_rand(0, 6); $j++) {
                $ligneCommande = new LigneCommande();
                $ligneCommande->setCommande($commande)
                    ->setQuantite(mt_rand(1, 3))
                    ->setPrix($produit->getPrix())
                    ->setProduit($produit);

                $manager->persist($ligneCommande);
            }

            for ($j = 0; $j < mt_rand(0, 6); $j++) {
                $avis = new Avis();
                $avis->setEmail($faker->email)
                    ->setCreatedAt(new \DateTime())
                    ->setDescription($faker->sentence(6))
                    ->setRating(mt_rand(1, 5))
                    ->setFullName($faker->name)
                    ->setProduit($produit);

                $manager->persist($avis);
            }
        }


        $manager->flush();

    }
}
