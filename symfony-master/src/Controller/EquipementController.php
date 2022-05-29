<?php
// src/Controller/EquipementController.php
namespace App\Controller;

use App\Entity\Equipement;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class EquipementController extends AbstractController
{
    /**
     * @Route("/equipement/All", name="equipement_show_all")
     */
    public function showAll()
    {
        $equipements = $this->getDoctrine()
            ->getRepository(Equipement::class)
            ->findAll();

        if (!$equipements) {
            throw $this->createNotFoundException(
                'Aucun equipement en BDD'
            );
        }

        return $this->render('equipement/all.html.twig', [
            "equipements" => $equipements
        ]);
        // or render a template
        // in the template, print things with {{ product.name }}
        // return $this->render('product/show.html.twig', ['product' => $product]);
    }

    /**
     * @Route("/equipement/{id}", name="equipement_info")
     */
    public function info(int $id): Response
    {
        $equipement = $this->getDoctrine()
            ->getRepository(Equipement::class)
            ->findOneBy(["id"=>$id]);

        if (!$equipement) {
            throw $this->createNotFoundException(
                'No equipement found for : ' . $id
            );
        }

        return $this->render('equipement/infoEquipement.html.twig',[
            'nom' => $equipement->getNom(), 'marque' => $equipement->getMarque(), 'prix' => $equipement->getPrix(), 'description' => $equipement->getDescription(), 'quantite' => $equipement->getQuantite()
        ]);

    }

        // or render a template
        // in the template, print things with {{ product.name }}
        // return $this->render('product/show.html.twig', ['product' => $product]);


}