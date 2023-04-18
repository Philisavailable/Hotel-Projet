<?php

namespace App\Controller;

use DateTime;
use App\Entity\Commande;
use App\Form\CommandeFormType;
use App\Repository\CommandeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommandeController extends AbstractController
{

    #[Route('admin/ajouter-une-commande', name: 'create_commande', methods: ['GET', 'POST'])]
    public function createCommande(CommandeRepository $repository, Request $request): Response
    {
        $commande = new Commande();
        $form = $this->createForm(CommandeFormType::class, $commande)
            ->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $commande->setCreatedAt(new DateTime());
            $commande->setUpdatedAt(new DateTime());

            $repository->save($commande, true);
            $this->addFlash('success', "La commande  a été ajouté !");

            return $this->redirectToRoute('create_commande');

        
        }
        $commandes = $repository->findAll();
        return $this->render('admin/commande/show_form_commande.html.twig', [
            'form' => $form->createView(),
            'commandes'=> $commandes
            
        ]);
    }


    #[Route('admin/modifier-une-commande/{id}', name: 'update_commande', methods: ['GET', 'POST'])]
    public function updateCommande(Commande $commande, Request $request, CommandeRepository $repository): Response
    {
        $form = $this->createForm(CommandeFormType::class, $commande, [
            'commande' => $commande
        ])
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $commande->setUpdatedAt(new DateTime());

            # L'alias nous servira pour construire l'url d'un article


            $repository->save($commande, true);

            $this->addFlash('success', "La commande est modifiée avec succès !");
            return $this->redirectToRoute('create_commande');
        }

        return $this->render('admin/commande/show_form_commande.html.twig', [
            'form' => $form->createView(),
            'commande' => $commande
        ]);
    }

    #[Route('admin/supprimer-une-commande/{id}', name: 'delete_commande', methods: ['GET'])]
    public function DeleteCommande(Commande $commande, CommandeRepository $repository): Response
    {
        $repository->remove($commande, true);

        $this->addFlash('success', "La commande a bien été supprimé définitivement.");
        return $this->redirectToRoute('create_commande');
    }
}
