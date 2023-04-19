<?php

namespace App\Controller;

use App\Entity\Membre;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class AdminController extends AbstractController
{
    #[Route('/tableau-de-membres', name: 'show_membres', methods:['GET'])]
    public function showMembres(EntityManagerInterface $entityManager): Response
    {
        try{
            $this->denyAccessUnlessGranted("ROLE_ADMIN");
        }
        catch(AccessDeniedException){
            // $this->addFlash('danger', "Cette partie du site est réservé");
            return $this->redirectToRoute('app_login');
        }

        $membres = $entityManager->getRepository(Membre::class)->findBy(['deletedAt' => null]);
        
        return $this->render('admin/membre/show_membres.html.twig', [
            'membres' => $membres,
        ]);
    }
}
