<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Category;
use App\Entity\Film;
use App\Entity\Acteur;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
       $category = new Category();
        $category->setNom("horror");
        $manager->persist($category);

        $film=new Film();
        $film->setNom("horror 1");
        $film->setCategory($category);
        $manager->persist($film);
        $acteur= new Acteur();
        $acteur->setNom("Al");
        $acteur->setPrenom("Pacino");
        $acteur->setFilm($film);
        $manager->persist($acteur);

        $film=new Film();
        $film->setNom("horror 2");
        $film->setCategory($category);
        $manager->persist($film);
        $acteur= new Acteur();
        $acteur->setNom(" De Niro ");
        $acteur->setPrenom("Robert");
        $acteur->setFilm($film);
        $manager->persist($acteur);


        $category = new Category();
        $category->setNom("fantasy");
        $film=new Film();
        $film->setNom("fantasy 1");
        $film->setCategory($category);
        $manager->persist($film);
        $acteur= new Acteur();
        $acteur->setNom("DiCaprio");
        $acteur->setPrenom("Leonardo");
        $acteur->setFilm($film);
        $manager->persist($acteur);


        $film=new Film();
        $film->setNom("fantasy 2");
        $film->setCategory($category);
        $manager->persist($film);
        $acteur= new Acteur();
        $acteur->setNom("Kevin ");
        $acteur->setPrenom("Spacey");
        $acteur->setFilm($film);
        $manager->persist($acteur);
        $acteur= new Acteur();
        $acteur->setNom("DiCaprio");
        $acteur->setPrenom("Leonardo");
        $acteur->setFilm($film);
        $manager->persist($acteur);


        $manager->persist($category);
        $category = new Category();
        $category->setNom("humor");
        $manager->persist($category);
        $film=new Film();
        $film->setNom("humor 1");
        $film->setCategory($category);
        $manager->persist($film);
        $acteur= new Acteur();
        $acteur->setNom("Humphrey ");
        $acteur->setPrenom("Bogart");
        $acteur->setFilm($film);
        $manager->persist($acteur);

        $film=new Film();
        $film->setNom("humor 2");
        $film->setCategory($category);
        $manager->persist($film);
        $acteur= new Acteur();
        $acteur->setNom("Toshirō ");
        $acteur->setPrenom("Mifune");
        $acteur->setFilm($film);
        $manager->persist($acteur);



        $manager->flush();
    }
}
