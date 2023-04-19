<?php

namespace App\Controller;



use App\Entity\Contact;
use App\Entity\Newsletter;
use App\Entity\Slider;
use App\Form\NewsletterFormType;
use App\Form\HotelContactFromType;
use App\Repository\SliderRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'show_home', methods: ['GET'])]
    public function showHome(SliderRepository $sliderRepository): Response
    {
        $sliders = $sliderRepository->findBy([
            'deletedAt' => null,
            //'ordre' => 'ch1'

        ]);


        dd($sliders);

        return $this->render('default/show_home.html.twig', [
            'sliders' => $sliders
        ]);

        /* $sliders1 = $sliderRepository->findOneBy([
            'deletedAt' => null,
            'ordre' => 'ch1'
        ]);
        $sliders2 = $sliderRepository->findOneBy([
            'deletedAt' => null,
            'ordre' => 'ch2'
        ]);
        $sliders3 = $sliderRepository->findOneBy([
            'deletedAt' => null,
            'ordre' => 'ch3'
        ]); 


        return $this->render('default/show_home.html.twig', [
            'sliders1' => $sliders1,
            'sliders2' => $sliders2,
            'sliders3' => $sliders3
        ]);*/
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

        $this->addFlash('success', "Votre message a bien été envoyé, nous reviendrons vers vous dans les plus brefs délais.");


        return $this->render('hotel/contact_hotel.html.twig', [
            'form' => $form->createView()
        ]);
    }

    //////////////////////////////FIN DE VUE HOTEL//////////////////////////////

    //*********************spa************** */
    #[Route('/spa/voir-spa', name: 'show_spa', methods: ['GET'])]
    public function showSpa(): Response
    {

        return $this->render('/spa/show_spa.html.twig');
    }

    //*****************spa-détente***** */
    #[Route('/spa/voir-spa-detente', name: 'show_spa-detente', methods: ['GET'])]
    public function showSpaDetente(): Response
    {

        return $this->render('/spa/spa-detente.html.twig');
    }
    //*****************spa-relaxante************ */
    #[Route('/spa/voir-spa-relaxant', name: 'show_spa-relaxant', methods: ['GET'])]
    public function showSpaRelaxant(): Response
    {

        return $this->render('/spa/spa_relaxant.html.twig');
    }

    //******************spa-palaisir********** */

    #[Route('/spa/voir-spa-plaisir', name: 'show_spa-plaisir', methods: ['GET'])]
    public function showSpaPlaisir(): Response
    {

        return $this->render('spa/spa_plaisir.html.twig');
    }
}
