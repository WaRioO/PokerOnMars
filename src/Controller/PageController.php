<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    /**
     * @Route("/", name="Home", methods={"GET"})
     */
    public function index()
    {
        $repo = $this->getDoctrine()->getRepository('App:News');
        $news = $repo->getLastXPosts(3);
        return $this->render('page/index.html.twig', array(
            'newsList' => $news
        ));
    }

    /**
     * @Route("/", name="showXnews", methods={"POST"})
     */
    public function showXarticles(){
        $number = $_POST['newsNumber'];
        if (!is_numeric($number)){
            $number = 3;
        } else if ($number > 10 || $number < 3 ){
            $number = 3;
        }
        $repo = $this->getDoctrine()->getRepository('App:News');
        $news = $repo->getLastXPosts($number);
        return $this->render('page/index.html.twig', array(
            'controller_name' => 'PageController',
            'newsList' => $news
        ));
    }

    /**
     * @Route("/club/description", name="DescriptionClub")
     */
    public function descriptionClub()
    {
        return $this->render('page/club/description.twig', [
            'controller_name' => 'PageController',
        ]);
    }

    /**
     * @Route("/admin", name="Administration")
     */
    public function adminSite()
    {
        return $this->render('page/admin/adminHome.html.twig', [
            'controller_name' => 'PageController',
        ]);
    }


    /**
     * @Route("/club/membres", name="ClubMembers")
     */
    public function membresClub()
    {
        return $this->render('page/club/membres.twig', [
            'controller_name' => 'PageController',
        ]);
    }

    /**
     * @Route("/club/resultats", name="ClubResults")
     */
    public function resultatsClub()
    {
        return $this->render('page/club/resultats.html.twig', [
            'controller_name' => 'PageController',
        ]);
    }
}
