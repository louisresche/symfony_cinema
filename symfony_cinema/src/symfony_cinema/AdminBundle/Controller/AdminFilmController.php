<?php
// src/symfony_cinema/AdminFilmBundle/Controller/AdminFilmController.php
namespace symfony_cinema\AdminBundle\Controller;

use symfony_cinema\CinemaBundle\Entity\Film;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use symfony_cinema\AdminBundle\Form\FilmType;

/**
 * @Route("/admin/films")
 */
class AdminFilmController extends Controller
{

    /**
     * @Route("/ajout", name="admin_film_ajout")
     */
    public function addAction(Request $request)
    {
        $film = new Film(); //on crée un nouveau film vide
        $form = $this->createForm(FilmType::class, $film); //on le lie à un formulaire de type FilmType

        $form->handleRequest($request); //on lie le formulaire à la requête HTTP

        if ($form->isSubmitted() && $form->isValid()) { //si le formulaire a bien été soumis et qu'il est valide
            $film = $form->getData(); //on crée un objet Film avec les valeurs du formulaire soumis

            $em = $this->getDoctrine()->getManager(); //on récupère le gestionnaire d'entités de Doctrine

            $em->persist($film); //on s'en sert pour enregistrer le film (mais pas encore dans la base de données)

            $em->flush(); //écriture en base de toutes les données persistées

            return $this->redirectToRoute('admin_film_liste'); //puis on redirige l'utilisateur vers la page des films
        }

        return $this->render(
            'symfony_cinemaAdminBundle:Film:form.html.twig',
            ['form' => $form->createView()]
        );
    }

    /**
     * @Route("/liste", name="admin_film_liste")
     */
    public function listAction()
    {
        $films = $this->getDoctrine()->getRepository('symfony_cinemaCinemaBundle:Film')->findAll();

        return $this->render(
            'symfony_cinemaAdminBundle:Film:list.html.twig',
            ['films' => $films]
        );
    }

    /**
     * @Route("/modif/{id}", name="admin_film_modif", requirements={"id": "\d+"})
     */
    public function editAction(Request $request, $id)
    {
        //on récupère le bon Film en fonction de l'id donnée dans l'URL
        $film = $this->getDoctrine()->getRepository('symfony_cinemaCinemaBundle:Film')->find($id);

        $form = $this->createForm(FilmType::class, $film); //on le lie à un formulaire de type FilmType
        //Le formulaire sera donc prérempli avec les données de l'objet Film récupéré en base de données.

        //puis on exécute le même traitement que pour l'ajout
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $film = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($film);
            $em->flush();

            return $this->redirectToRoute('admin_film_liste');
        }

        return $this->render(
            'symfony_cinemaAdminBundle:Film:form.html.twig',
            ['form' => $form->createView()]
        );
    }

    /**
     * @Route("/supprimer/{id}", name="admin_film_supprimer", requirements={"id": "\d+"})
     */
    public function deleteAction($id)
    {
        //on récupère le bon Film en fonction de l'id donnée dans l'URL
        $film = $this->getDoctrine()->getRepository('symfony_cinemaCinemaBundle:Film')->find($id);

        $em = $this->getDoctrine()->getManager(); //on récupère le gestionnaire
        $em->remove($film); //on supprime cette entité
        $em->flush(); //exécution en base

        return $this->redirectToRoute('admin_film_liste'); //redirection vers la liste
    }

}