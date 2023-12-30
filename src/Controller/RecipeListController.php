<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RecipeListController extends AbstractController
{
    #[Route('/', name: 'recipe_list')]
    public function list() : Response {
        return $this->render('recipeList.html.twig', []);
    }
}