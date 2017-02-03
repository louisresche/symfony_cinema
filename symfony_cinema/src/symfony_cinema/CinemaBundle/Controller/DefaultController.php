<?php
// src/symfony_cinema/CinemaBundle/Controller/DefaultController.php
namespace symfony_cinema\CinemaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="page_accueil")
     */
    public function indexAction()
    {
        return $this->render('symfony_cinemaCinemaBundle:Default:index.html.twig');
    }

    /**
     * @Route("/Films", name="page_films")
     */
    public function listAction()
    {
        $films = $this->getDoctrine()->getRepository('symfony_cinemaCinemaBundle:Film')->findAll();

        $titre_de_la_page = 'Films de la bibliothèques';


        return $this->render(
            'symfony_cinemaCinemaBundle:Film:list.html.twig',
            ['films' => $films, 'titre' => $titre_de_la_page]
        );
        
    }

    /**
     * @Route("/Film/{id}", requirements={"id": "\d+"}, name="page_film")
     */
    public function showAction($id)
    {
        $film = $this->getDoctrine()->getRepository('symfony_cinemaCinemaBundle:Film')->find($id);

        return $this->render(
            'symfony_cinemaCinemaBundle:Film:show.html.twig',
            ['film' => $film]
        );
    }
}