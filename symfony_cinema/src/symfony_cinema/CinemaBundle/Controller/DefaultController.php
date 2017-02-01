<?php
// src/symfony_cinema/CinemaBundle/Controller/DefaultController.php
namespace symfony_cinema\CinemaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('symfony_cinemaCinemaBundle:Default:index.html.twig');
    }

    /**
     * @Route("/Films")
     */
    public function listAction()
    {
        $films = $this->getDoctrine()->getRepository('symfony_cinemaCinemaBundle:Film')->findAll();


        return $this->render('symfony_cinemaCinemaBundle:Film:list.html.twig');
    }

    /**
     * @Route("/Film/{id}", requirements={"id": "\d+"})
     */
    public function showAction($id)
    {
        return $this->render('symfony_cinemaCinemaBundle:Film:show.html.twig');
    }
}