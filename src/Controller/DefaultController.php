<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'show_home', methods: ['GET'])]
    public function showHome(): Response
    {
        return $this->render('default/show_home.html.twig');
    }
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
