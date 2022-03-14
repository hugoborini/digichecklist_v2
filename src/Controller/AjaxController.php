<?php

namespace App\Controller;

use App\Entity\Activite;
use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AjaxController extends AbstractController
{
    /**
     * @Route("/ajax", name="app_ajax")
     */
    public function index(): Response
    {
        return $this->render('ajax/index.html.twig', [
            'controller_name' => 'AjaxController',
        ]);
    }

    /**
     * @Route("/ajax/category/{id_category}", name="app_ajax_category")
     */
    public function findByCategory(int $id_category): Response
    {
        $activiteRepo = $this->getDoctrine()->getRepository(Activite::class);
        $categorys = $activiteRepo->findByCategoryId($id_category);
        $jsonTab;
        $i = 0;

        foreach ($categorys as $key => $category) {
            $jsonTab[$i]['id'] = $category->getid();
            $jsonTab[$i]['nameActivite'] = $category->getnameActivivite();
            $jsonTab[$i]['isCheck'] = $category->getIsCheck();
            $i++;


        }
        //return $this->json(["result" => $jsonTab]);
        //return $this->render("ajax/debug.html.twig", []);
    }

    /**
     * @Route("/ajax/addDigi", name="app_ajax_Digi")
     */
    public function addDigi(Request $request, EntityManagerInterface $manager): Response
    {
        $data = json_decode($request->getContent());
        $activite = new Activite();

        $repo = $this->getDoctrine()->getRepository(Category::class);

        $category = $repo->find($data->categoryId);

        $activite->setNameActivivite($data->nameActivite)
                 ->setCategoryId($category)
                 ->setIsCheck(false)
        ;
        $manager->persist($activite);
        $manager->flush();
        return $this->json(["result" => "sucess" ]);
    }

    /**
     * @Route("/ajax/addCheck", name="app_ajax_Check")
     */
    public function addCheck(Request $request, EntityManagerInterface $manager): Response
    {

        $data = json_decode($request->getContent());
        $activite = $this->getDoctrine()->getRepository(Activite::class)->find($data->id);
        if ($activite->getIsCheck()){
            $activite->setIsCheck(false);
        } else{
            $activite->setIsCheck(true);
        }

        $manager->flush();

        return $this->json(["result" => "sucess" ]);
    }

    /**
     * @Route("/ajax/sup", name="app_ajax_sup")
     */
    public function sup(Request $request, EntityManagerInterface $manager): Response
    {

        $data = json_decode($request->getContent());

        $activite = $this->getDoctrine()->getRepository(Activite::class)->find($data->id);

        $manager->remove($activite);
        $manager->flush();
        
        return $this->json(["result" => "sucess" ]);
    }
}
