<?php

namespace App\Controller;

use DateTime;
use App\Entity\Membre;
use App\Form\RegisterFormType;
use App\Repository\MembreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class MembreController extends AbstractController
{
    #[Route('/inscription', name: 'app_register', methods: ['GET', 'POST'])]
    public function register(Request $request, MembreRepository $membreRepository, UserPasswordHasherInterface $userPasswordHasher): Response
    {

        $membre = new Membre();

        $form = $this->createForm(RegisterFormType::class, $membre)->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $membre->setCreatedAt(new DateTime());
            $membre->setUpdatedAt(new DateTime());
            $membre->setRoles(["ROLE_ADMIN"]);
            $membre->setPassword($userPasswordHasher->hashPassword($membre, $membre->getPassword()));

            $membreRepository->save($membre, true);

            // $this->addFlash('success', "Votre inscription a été correctement enregistrée !!!");

            return $this->redirectToRoute('app_login');
        }



        return $this->render('admin/membre.html.twig', [
            'form' => $form->createView()
        ]);
    }


    #[Route('/modifier-un-membre/{id}', name: 'upgrade_membre', methods: ['GET', 'POST'])]
    public function upgradeMembre(Membre $membre, Request $request, MembreRepository $membreRepository, UserPasswordHasherInterface $userPasswordHasher): Response
    {

        $form = $this->createForm(RegisterFormType::class, $membre)->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $membre->setUpdatedAt(new DateTime());
            $membre->setRoles(["ROLE_ADMIN"]);
            $membre->setPassword($userPasswordHasher->hashPassword($membre, $membre->getPassword()));

            $membreRepository->save($membre, true);

            // $this->addFlash('success', "Votre inscription a été correctement enregistrée !!!");

            return $this->redirectToRoute('show_membres');
        }

        return $this->render('admin/membre.html.twig', [
            'form' => $form->createView()
        ]);
    }


    #[Route('/archiver-un-membre/{id}', name: 'soft_delete_membre', methods:['GET'])]
    public function softDeleteMembre(Membre $membre, MembreRepository $repository):Response
    {
        $membre->setDeletedAt(new DateTime());

        $repository->save($membre, true);

        // $this->addFlash('success', "L'article " . $article->getTitle() . "a bien été archivé");

        return $this->redirectToRoute('show_membres');
    } 
}
