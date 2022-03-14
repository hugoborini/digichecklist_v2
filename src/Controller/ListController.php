<?php

namespace App\Controller;

use App\Entity\Activite;
use App\Entity\Category;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ListController extends AbstractController
{
    /**
     * @Route("/", name="app_list")
     */
    public function index(): Response
    {
        $categoryRepo = $this->getDoctrine()->getRepository(Category::class);

        $activiteRepo = $this->getDoctrine()->getRepository(Activite::class);

        $categorys = $categoryRepo->findAll();
        $activites = $activiteRepo->findBy(
            array(),
            array('isCheck' => 'ASC')
        );;
        return $this->render('list/list.html.twig', [
            "categorys" => $categorys,
            "activites" => $activites,
        ]);
    }

    /**
     * @Route("/category/{category_id}", name="app_list_category")
     */
    public function category(int $category_id): Response{
        $activiteRepo = $this->getDoctrine()->getRepository(Activite::class);

        $categoryRepo = $this->getDoctrine()->getRepository(Category::class);

        $categorys = $categoryRepo->findAll();

        $activites = $activiteRepo->findByCategoryId($category_id, array("isCheck" => "ASC"));

        return $this->render('list/list.html.twig', [
            "categorys" => $categorys,
            "activites" => $activites,
        ]);
    }
}
