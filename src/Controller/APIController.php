<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\FilmRepository;
use App\Repository\ActeurRepository;
use App\Repository\CategoryRepository;
use App\Entity\Acteur;
use App\Entity\Category;
use App\Entity\Film;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;


class APIController extends AbstractController
{

    private $manager;

    public function __Construct(EntityManagerInterface $manager)
    {

        $this->manager=$manager;
    }

    /**
     * @Route("/new/actor", name="add_actor",methods={"POST"})
     */
    public function newActor(FilmRepository $filrepo,Request $request,EntityManagerInterface $manager): Response
    {
        $response=new Response();

        $acteur= new Acteur();
        $nom=$request->request->get('nom');
        $prenom=$request->request->get('prenom');
        $filmId=$request->request->get('film_id');

        if(!empty($nom) && $nom && $prenom && !empty($prenom)){
            $acteur->setNom($nom);
            $acteur->setPrenom($nom);
            $acteur->setFilm($filrepo->find($filmId));

        }else{
            $response->setStatusCode(400);
        }

        if(isset($nom) && !empty($nom) && isset($prenom) && !empty($prenom)) {
            $manager->persist($acteur);
            $manager->flush();
            $response->setStatusCode(201);
        }else{
            $response->setStatusCode(400);
        }

        return $response;

    }

        /**
     * @Route("/new/category", name="add_category",methods={"POST"})
     */
    public function newCategory(Request $request,EntityManagerInterface $manager): Response
    {
        $response=new Response();

        $category= new Category();
        $nom=$request->request->get('nom');

        if(!empty($nom) && $nom ){
            $category->setNom($nom);

        }else{
            $response->setStatusCode(400);
        }

        if(isset($nom) && !empty($nom) ) {
            $manager->persist($category);
            $manager->flush();
            $response->setStatusCode(201);
        }else{
            $response->setStatusCode(400);
        }

        return $response;

    }

    /**
     * @Route("/new/film", name="add_film",methods={"POST"})
     */
    public function newFilm(CategoryRepository $categoryrepo,Request $request,EntityManagerInterface $manager): Response
    {
        $response=new Response();

        $film= new Film();
        $nom=$request->request->get('nom');
        $categoryId=$request->request->get('category_id');

        if(!empty($nom) && $nom ){
            $film->setNom($nom);
            $film->setCategory($categoryrepo->find($categoryId));
        }else{
            $response->setStatusCode(400);
        }

        if(isset($nom) && !empty($nom) ) {
            $manager->persist($film);
            $manager->flush();
            $response->setStatusCode(201);
        }else{
            $response->setStatusCode(400);
        }

        return $response;

    }

    /**
     * @Route("/delete/actor/{id}", name="delete_actor")
     */
    public function deleteActor($id=0,ActeurRepository $actorrepo,Request $request): Response
    {
        $response=new Response();
        $acteur=$actorrepo->find($id);

        if($acteur){
            $acteur->setFilm(null);
            $this->manager->remove($acteur);
            $this->manager->flush();
            $response->setStatusCode(201);

        }else{
            $response->setStatusCode(400);

        }

        return $response;

    }

    /**
     * @Route("/delete/category/{id}", name="delete_cate")
     */
    public function deleteCate($id=0,CategoryRepository $caterepo,Request $request): Response
    {
        $response=new Response();
        $category=$caterepo->find($id);

        if($category){
            $this->manager->remove($category);
            $this->manager->flush();
            $response->setStatusCode(201);

        }else{
            $response->setStatusCode(400);

        }

        return $response;

    }

    /**
     * @Route("/delete/film/{id}", name="delete_category")
     */
    public function deleteFilm($id=0,FilmRepository $filmrepo,Request $request): Response
    {
        $film=$filmrepo->find($id);
        $response=new Response();

        if($film){

            $this->manager->remove($film);
            $this->manager->flush();
            $response->setStatusCode(201);

        }else{
            $response->setStatusCode(400);
        }

        return $response;

    }
}
