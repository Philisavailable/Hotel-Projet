<?php

namespace App\Controller;

use DateTime;
use App\Entity\Avis;
use App\Form\AvisFormType;
use App\Repository\AvisRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AvisController extends AbstractController
{

    #[Route('/ajouter-un-avis', name: 'create_avis', methods: ['GET', 'POST'])]
    public function createAvis(Request $request, AvisRepository $repo): Response
    {

        $avis = new Avis();

        $form = $this->createForm(AvisFormType::class, $avis)
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $avis->setCreatedAt(new DateTime());
            $avis->setUpdatedAt(new DateTime());

            $repo->save($avis, true);

            $this->addFlash('success', "Nous vous remercions pour votre avis !");

            return $this->redirectToRoute('create_avis');
        }

        $avisList = $repo->findBy(['deletedAt' => null,]);
        $catList = $repo->findAll();

        $category = $repo->findAll('category');
        
        $category = $repo->findBy([
            'deletedAt' => null,
            'category' => $category
        ]);

        return $this->render('avis/create_avis.html.twig', [
            'form' => $form,
            'avisList' => $avisList,
            'catList' => $catList,
            'category' => $category,
            'avis' => $avis,


        ]);
    }

   
    
}
