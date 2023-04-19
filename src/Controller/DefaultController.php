<?php

namespace App\Controller;

use App\Entity\Newsletter;
use App\Form\NewsletterFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'show_home', methods: ['GET'])]
    public function showHome(): Response
    {
        return $this->render('default/show_home.html.twig');
    }

    #[Route('/liens_divers/voir-liens', name: 'show_mentions_legales', methods: ['GET'])]
    public function showMentions(): Response
    {
        return $this->render('/liens_divers/show_mentions_legales.html.twig');
    }

    #[Route('/liens_divers/voir-cgv', name: 'show_cgv', methods: ['GET'])]
    public function showCgv(): Response
    {
        return $this->render('/liens_divers/show_cgv.html.twig');
    }

    #[Route('/liens_divers/voir-plan-du-site', name: 'show_plan', methods: ['GET'])]
    public function showPlan(): Response
    {
        return $this->render('/liens_divers/show_plan.html.twig');
    }

    #[Route('/liens_divers/voir-partage', name: 'show_partage', methods: ['GET'])]
    public function showPartage(): Response
    {
        return $this->render('/liens_divers/show_partage.html.twig');
    }

    #[Route('/liens_divers/voir-newsletter', name: 'show_newsletter', methods: ['GET', 'POST'])]
    public function showNewsletter(Request $request): Response
    {
        $newsletter = new Newsletter();

        $form = $this->createForm(NewsletterFormType::class, $newsletter)
            ->handleRequest($request);

        $this->addFlash('success', "Vous êtes bien inscrit à notre Newsletter !");
        return $this->render('/liens_divers/show_newsletter.html.twig', [
            'form' => $form->createView()
        ]);
    #[Route('/restaurant/voir-restaurant', name: 'show_restaurant', methods: ['GET'])]
    public function showRestaurant(): Response
    {
        return $this->render('/restaurant/show_restaurant.html.twig');
    }
}
