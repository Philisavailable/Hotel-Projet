<?php

namespace App\Controller;

use App\Entity\Newsletter;
use App\Form\NewsletterFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Contact;
use App\Form\HotelContactFromType;

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
    }
    
    #[Route('/restaurant/voir-restaurant', name: 'show_restaurant', methods: ['GET'])]
    public function showRestaurant(): Response
    {
        return $this->render('/restaurant/show_restaurant.html.twig');
    }
    //////////////////////////////VUE HOTEL//////////////////////////////

        //////////Qui Sommes-nous?//////////

    #[Route('/hotel/qui-sommes-nous', name: 'presentation_hotel', methods: ['GET'])]
    public function hotelQuiSommesNous(): Response
    {
        
        return $this->render('hotel/presentation_hotel.html.twig');
    }

        //////////Accès//////////

    #[Route('/hotel/accedez-a-notre-hotel', name: 'acces_hotel', methods: ['GET'])]
    public function hotelAcces(): Response
    {
        
        return $this->render('hotel/acces_hotel.html.twig');
    }

        //////////Contact//////////

    #[Route('/hotel/contactez-nous', name: 'contact_hotel', methods: ['GET', 'POST'])]
    public function hotelContact(): Response
    {

        $contact = new Contact();

        $form = $this->createForm(HotelContactFromType::class, $contact);


        if($form->isSubmitted() && $form->isValid()) {

            $this->addFlash('success', "Votre message a bien été envoyé, nous reviendrons vers vous dans les plus brefs délais.");

        }// enf if()

        return $this->render('hotel/contact_hotel.html.twig', [
            'form' => $form->createView()
        ]);
    }

    //////////////////////////////FIN DE VUE HOTEL//////////////////////////////

}

