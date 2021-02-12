<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Category;
use App\Entity\Acteur;
use App\Entity\Film;

class CinemaController extends AbstractController
{
    
    /**
     * @Route("/cinema/{name}", name="cinema")
     */
    public function name($name=""): Response
    {
        $getInfo = $this->getDoctrine()->getRepository(Acteur::class)->findByNom($name);

        return $this->render('cinema/index.html.twig', [
            'controller_name' => 'CinemaController','film'=>$getInfo,'nomActor'=>$getInfo[0]->getNom(),
            'prenomActor'=>$getInfo[0]->getPrenom()
        ]);
    }
    
    /**
     * @Route("/category/{category}", name="category")
     */
    public function category($category=""): Response
    {
        $getInfo = $this->getDoctrine()->getRepository(Category::class)->findByCategory($category);

        $getFilm=$this->getDoctrine()->getRepository(Film::class)->findAll();
        var_dump($getInfo[0]->getId());

        return $this->render('cinema/category.html.twig', [
            'controller_name' => 'CinemaController',"categoryName"=>$getInfo[0]->getNom(),"id"=>$getInfo[0]->getId(),"film"=>$getFilm
        ]);
    }

}
