<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\HotelContactFromType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'show_home', methods: ['GET'])]
    public function showHome(): Response
    {
        return $this->render('default/show_home.html.twig');
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
