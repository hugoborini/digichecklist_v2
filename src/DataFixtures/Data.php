<?php

namespace App\DataFixtures;

use App\Entity\Activite;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class Data extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $todos = array(
                        array('todo' => 'marche de noel', "category" => "Autres Lieux"),
                        array('todo' => 'Dinard',  "category" => "Hébergements"),
                        array('todo' => 'Allez au dirty dick (bar)', "category" => "Bar"),
                        array('todo' => 'Aller à l’as du falafel', "category" => "Restaurants"),
                        array('todo' => 'Festival (3eph We love Green)', "category" => "Concert/Festivals"),
                        array('todo' => 'Aller chez tin ', "category" => "Restaurants"),
                        array('todo' => 'Faire visiter Montmartre/sacrer cœur à la bg d’Adèle ',"category" => "Autres Lieux"),
                        array('todo' => 'Se voir', "category" => "Wtf"),
                        array('todo' => 'Dormir dans un endroit atypique ', "category" => "Hébergements"),
                        array('todo' => 'Aller dans un endroit giga perdu ', "category" => "Hébergements"),
                        array('todo' => 'Faire une pumpkin pie', "category" => "Recette"),
                        array('todo' => 'Allez à la neige ',"category" =>  "Activités"),
                        array('todo' => 'Tester un bbq coréen ', "category" => "Restaurants"),
                        array('todo' => 'Allez à un concert de laylow ', "category" => "Concert/Festivals"),
                        array('todo' => 'Regarder Harry Potter', "category" => "Film"),
                        array('todo' => 'Tester pizza new-yorkaise paris', "category" => "Restaurants"),
                        array('todo' => 'Manger dans le resto dans le noir', "category" => "Restaurants"),
                        array('todo' => 'Faire un gastro', "category" => "Restaurants"),
                        array('todo' => 'Faire un spa ',"category" =>  "Activités"),
                        array('todo' => 'Aller à rue de l’appe ', "category" => "Bar"),
                        array('todo' => 'L’atelier Durum', "category" => "Restaurants"),
                        array('todo' => 'Regarder le documentaire de YE', "category" => "Film"),
                        array('todo' => 'Aller boir un the matcha ', "category" => "Restaurants"),
                        array('todo' => 'Resto afghan ', "category" => "Restaurants"),
                        array('todo' => 'Théâtre ',"category" =>  "Activités"),
                        array('todo' => 'Aller en Norvège ',"category" =>  "Voyages"),
                        array('todo' => 'Manger un phô', "category" => "Restaurants"),
                        array('todo' => 'Manger un Karaage', "category" => "Restaurants"),
                        array('todo' => 'Manger un bœuf lok lak ', "category" => "Restaurants"),
                        array('todo' => 'Manger ta queue ', "category" => "Wtf"),
                        array('todo' => 'Aller au musée des moulage de l’hôpital saint louis', "category" => "Musées"),
                        array('todo' => 'Aller ds les catacombes ',"category" => "Autres Lieux"),
                        array('todo' => 'Regarder LOL', "category" => "Film"),
                        array('todo' => 'Musée Pompidou ',"category" => "Musées"),
                        array('todo' => 'Musée du Louvre',"category" => "Musées"),
                        array('todo' => 'Musée d’Orsay',"category" => "Musées"),
                        array('todo' => 'Musée de l’orangerie ',"category" => "Musées"),
                        array('todo' => 'Château de Versaille',"category" => "Autres Lieux"),
                        array('todo' => 'Musée Rodin',"category" => "Musées"),
                        array('todo' => 'Musée Bourses de commerces',"category" => "Musées"),
                        array('todo' => 'Atelier des lumières',"category" => "Musées"),
                        array('todo' => 'Musée national des arts asiatiques Guimet',"category" => "Musées"),
                        array('todo' => 'Musée des Arts Décoratifs',"category" => "Musées")
                    );


        $categorys = json_decode(file_get_contents('public/data/category.json'));

        $test = 0;

        foreach ($categorys as $categoryTitle) {
            $category = new Category();
            $category->setNameCategory($categoryTitle);
            $manager->persist($category);

                foreach ($todos as $todo) {
                    $activite = new Activite();

                    if($categoryTitle == $todo["category"]){
                        var_dump($todo["todo"]);

                        $activite->setNameActivivite($todo["todo"])
                                 ->setCategoryId($category)
                                 ->setIsCheck(false)
                        ;
                        $manager->persist($activite);
                    }


                }

                $manager->flush();
            }

        }

    }
