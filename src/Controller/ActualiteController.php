<?php

namespace App\Controller;

use DateTime;
use App\Entity\Actualite;
use App\Form\ActualiteFormType;
use App\Repository\ActualiteRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ActualiteController extends AbstractController
{
    #[Route('admin/ajouter-une-actualite', name: 'create_actualite', methods: ['GET', 'POST'])]
    public function createActualite(ActualiteRepository $repository, Request $request): Response
    {
        $actualite = new Actualite();
        $form = $this->createForm(ActualiteFormType::class, $actualite)
            ->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $actualite->setCreatedAt(new DateTime());
            $actualite->setUpdatedAt(new DateTime());

            $repository->save($actualite, true);
            $this->addFlash('success', "La actualite  a été ajouté !");

            return $this->redirectToRoute('create_actualite');

        
        }
        $actualites = $repository->findAll();
        return $this->render('admin/actualite/actualite-form.html.twig', [
            'form' => $form->createView(),
            'actualites'=> $actualites
            
        ]);
    }


    #[Route('admin/modifier-une-actualite/{id}', name: 'update_actualite', methods: ['GET', 'POST'])]
    public function updateActualite(Actualite $actualite, Request $request, ActualiteRepository $repository): Response
    {
        $form = $this->createForm(ActualiteFormType::class, $actualite, [
            'actualite' => $actualite
        ])
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $actualite->setUpdatedAt(new DateTime());

          

            $repository->save($actualite, true);

            $this->addFlash('success', "La actualite est modifiée avec succès !");
            return $this->redirectToRoute('create_actualite');
        }

        return $this->render('actualite/actualite-form.html.twig', [
            'form' => $form->createView(),
            'actualite' => $actualite
        ]);
    }

    #[Route('admin/supprimer-une-actualite/{id}', name: 'delete_actualite', methods: ['GET'])]
    public function DeleteActualite(Actualite $actualite, ActualiteRepository $repository): Response
    {
        $repository->remove($actualite, true);

        $this->addFlash('success', "L'actualite est bien été supprimé définitivement.");
        return $this->redirectToRoute('create_actualite');
    }



    #[Route('/voir-actualite/voir-liens1', name: 'show_actualite1', methods: ['GET'])]
    public function showActualite1(): Response
    {
        return $this->render('actualite/show-actualite1.html.twig');
    }

    #[Route('/voir-actualite/voir-liens2', name: 'show_actualite2', methods: ['GET'])]
    public function showActualite2(): Response
    {
        return $this->render('actualite/show-actualite2.html.twig');
    }

    #[Route('/voir-actualite/voir-liens3', name: 'show_actualite3', methods: ['GET'])]
    public function showActualite3(): Response
    {
        return $this->render('actualite/show-actualite3.html.twig');
    }


    #[Route('/voir-actualite/voir-liens4', name: 'show_actualite4', methods: ['GET'])]
    public function showActualite4(): Response
    {
        return $this->render('actualite/show-actualite4.html.twig');
    }
}
