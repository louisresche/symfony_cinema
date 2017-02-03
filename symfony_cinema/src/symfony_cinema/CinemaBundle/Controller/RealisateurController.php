<?php
// src/symfony_cinema/CinemaBundle/Controller/RealisateurController.php
namespace symfony_cinema\CinemaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class RealisateurController extends Controller
{


    /**
     * @Route("/realisateurs", name="page_realisateurs")
     */
    public function listAction()
    {
        $realisateurs = $this->getDoctrine()->getRepository('symfony_cinemaCinemaBundle:Personne')->findAll();

        $titre_de_la_page = 'Réalisateurs';


        return $this->render(
            'symfony_cinemaCinemaBundle:Personne:list.html.twig',
            ['realisateurs' => $realisateurs, 'titre' => $titre_de_la_page]
        );

    }




}